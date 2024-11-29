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
    <title>Edit Product</title>
</head>

<body>
    <div class="container mt-5">
        <form action="/phpmvc/index.php?product/update&id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
            <div class="mb-2">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" class="form-control" required>
                <div id="nameHelp" class="form-text text-danger"></div>
            </div>
            <div class="mb-2">
                <label for="price" class="form-label">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" class="form-control" required>
                <div id="priceHelp" class="form-text text-danger"></div>
            </div>
            <div class="mb-2">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="text" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" class="form-control" required>
                <div id="quantityHelp" class="form-text text-danger"></div>
            </div>
            <div class="mb-2">
                <label for="category" class="form-label">Category:</label>
                <select id="category" name="category" class="form-select" required>
                    <option value="" disabled>Select a category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo $product['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div id="categoryHelp" class="form-text text-danger"></div>
            </div>
            <div class="mb-2">
                <label for="image" class="form-label">Current Image:</label><br>
                <?php if (!empty($product['image'])): ?>
                    <img src="/phpmvc/uploads/product_image/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" class="rounded" style="width: 100px; height: auto; margin-bottom: 10px;">
                <?php else: ?>
                    <p>No image available.</p>
                <?php endif; ?>
                <input type="file" id="image" name="image" class="form-control mt-2">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

</body>

</html>