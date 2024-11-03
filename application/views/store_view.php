<!-- Здесь начинается цикл для каждой позиции товара -->
<div class="container">
    <h1>Store</h1>

    <?php if (!isset($_SESSION["logged_in"])): ?>
        <div class="alert alert-info" role="alert">
            <strong>Welcome!</strong> Please <a href="login">log in</a> or <a href="register">register</a> to make
            purchases.
        </div>
    <?php endif; ?>
    <br>
    <div class="card-deck">
        <?php
        foreach ($data as $product) {
            $availability = $product['available'] == 'Y' ? 'In Stock' : 'Out of Stock';

            echo '<div class="col-md-3 mb-4">'; // Изменен класс на col-md-2
            echo '<div class="card">';
            echo '<img class="card-img-top img-fluid" src="' . $product['picture'] . '" alt="Product Image">'; // Добавлен класс img-fluid
            echo '<div class="card-body d-flex flex-column">';
            echo '<h2 class="card-title">' . $product['name'] . '</h2>';
            echo '<p class="card-text">' . $product['description'] . '</p>';
            echo '<p class="card-text">Price: $' . $product['price'] . '</p>';
            echo '<p class="card-text">' . $availability . '</p>';
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    $buttonClass = $product['available'] == 'Y' ? 'btn-primary' : 'btn-secondary disabled';
                    $buttonText = $product['available'] == 'Y' ? 'Add to Cart' : 'Unavailable';

                    ?>
                    <!-- Ваш HTML-код с кнопкой "Add to Cart" -->

                    <button class="btn <?php echo $buttonClass; ?> btn-sm mt-auto add-to-cart-btn"
                            data-product-id="<?php echo $product['item_id']; ?>"
                        <?php echo $product['available'] == 'Y' ? '' : 'disabled'; ?>>
                        <?php echo $buttonText; ?>
                    </button>

                <?php }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');

                console.log('Before AJAX request');

                // Отправляем AJAX-запрос
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Обработка ответа от сервера
                        const response = xhr.responseText;
                        console.log('After AJAX request:', response);
                        // Добавьте свой код для обновления интерфейса или другой логики
                    }
                };
                xhr.send('product_id=' + productId);
            });
        });
    });
</script>
