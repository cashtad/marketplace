<div class="container mt-5">
    <h1>My Profile</h1>

    <div class="user-info mb-4">
        <h2>About Me</h2>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($_SESSION["name"]); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION["login"]); ?></p>
        <p><strong>Role:</strong> Seller</p>
    </div>

    <h1 class="mt-4">Add New Product</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Product Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price ($):</label>
            <input type="number" class="form-control" id="price" name="price" min="0.01" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="available">Availability:</label>
            <select class="form-control" id="available" name="available" required>
                <option value="Y">In Stock</option>
                <option value="N">Out of Stock</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category">Select Category:</label>
            <select class="form-control" id="category" name="category_id">
                <?php foreach ($data[1] as $category): ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control-file" id="image" name="product_image">
        </div>

        <input type="submit" value="Submit" class="btn btn-success">
    </form>

    <h1 class="mt-4">Statistics of Items:</h1>

    <?php
    if (!empty($data[0])) {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Time Ordered</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($data[0] as $sale) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($sale['item_name']) . '</td>';
            echo '<td>' . htmlspecialchars($sale['total_sold']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No data to display.</p>';
    }
    ?>
</div>
