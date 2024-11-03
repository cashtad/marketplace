
<div class="container mt-5">
    <h1 class="mb-4">Shopping Cart</h1>

    <?php
    if (!empty($data)) {
        $totalCartPrice = 0;

        foreach ($data as $item) {
            $itemTotal = $item["price"] * $item["amount"];
            $totalCartPrice += $itemTotal;
            ?>
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?php echo $item["picture"]; ?>" class="card-img" alt="<?php echo $item["name"]; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item["name"]; ?></h5>
                            <p class="card-text"><?php echo $item["description"]; ?></p>
                            <p class="card-text">Price: $<?php echo $item["price"]; ?></p>
                            <div class="quantity-control">
                                <button class="quantity-btn minus-btn" data-product-id='<?php echo $item['item_id']; ?>'>-</button>
                                <span class="quantity" data-product-id='<?php echo $item["item_id"]?>'>
                                    <?php echo isset($_SESSION['cart'][$item['item_id']]) ? $_SESSION['cart'][$item['item_id']]['amount'] : 0; ?>
                                </span>
                                <button class="quantity-btn plus-btn" data-product-id='<?php echo $item['item_id']; ?>'>+</button>
                            </div>
                            <p class="card-text text-right" data-product-id="<?php echo $item['item_id']; ?>">Item Total: $<?php echo number_format($itemTotal, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="mt-4">
          <h5 id="cartTotal" class="text-right">Total Cart Price: $<?php echo number_format($totalCartPrice, 2); ?></h5>
        </div>


        <div class="text-center mt-4">
          <button id="clearCartBtn" class="btn btn-danger">Clear Cart</button>

          <form action="" method="post">
            <input type="hidden" name="checkout" value="checkout">

            <button type="submit" class="btn btn-success">Checkout</button>
          </form>

        </div>
        <br>
        <?php
    } else {
        echo "<p>Your shopping cart is empty.</p>";
    }
    ?>

</div>
<script>
    document.getElementById('clearCartBtn').addEventListener('click', function() {
        // Отправляем запрос на сервер для очистки корзины
        fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'clear=true', // Можете добавить любые другие данные, если необходимо
        })
        .then(response => {
            if (response.ok) {
                // Перезагружаем страницу после успешной очистки корзины
                location.reload();
            } else {
                console.error('Failed to clear cart');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        var quantityButtons = document.querySelectorAll('.quantity-btn');

        quantityButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-product-id');
                var action = this.classList.contains('plus-btn') ? 'increase' : 'decrease';

                updateCartQuantity(productId, action);
            });
        });

        function updateCartQuantity(productId, action) {
            // Отправляем AJAX-запрос
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Обработка ответа от сервера
                    var response = JSON.parse(xhr.responseText);
                    console.log('After AJAX request:', response);

                    // Обновление интерфейса или другая логика
                    if (response.status === 'success') {
                      console.log(response);
                        document.querySelector('.card-text[data-product-id="' + productId + '"]').innerText = 'Item Total: $' + response.newCost;
                        document.querySelector('.quantity[data-product-id="' + productId + '"]').innerText = response.newQuantity;
                        document.getElementById('cartTotal').innerText = 'Total Cart Price: $' + response.newCartCost;
                    }
                    if (response.status == 'remove') {
                      document.getElementById('cartTotal').innerText = 'Total Cart Price: $' + response.newCartCost;
                      location.reload();
                    }
                }
            };

            xhr.send('product_id=' + productId + '&action=' + action);
        }
    });
</script>
