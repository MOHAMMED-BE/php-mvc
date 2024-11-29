<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php?user/login');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <div class="container mt-5">
        <form action="/phpmvc/index.php?product/store" method="POST" enctype="multipart/form-data" id="productForm" class="p-4 border rounded bg-light">
            <div class="mb-2">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <div id="nameHelp" class="form-text">Enter the product name (minimum 3 characters).</div>
            </div>
            <div class="mb-2">
                <label for="price" class="form-label">Price:</label>
                <input type="text" id="price" name="price" class="form-control" required>
                <div id="priceHelp" class="form-text">Enter the product price (e.g., 10.99).</div>
            </div>
            <div class="mb-2">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="text" id="quantity" name="quantity" class="form-control" required>
                <div id="quantityHelp" class="form-text">Enter the quantity of the product in stock.</div>
            </div>
            <div class="mb-2">
                <label for="category" class="form-label">Category:</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="" disabled selected>Select a category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div id="categoryHelp" class="form-text">Select a category for the product.</div>
            </div>
            <div class="mb-2">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control" required>
                <div id="imageHelp" class="form-text">Upload an image file (JPG, PNG, or WEBP).</div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>

</body>

</html>