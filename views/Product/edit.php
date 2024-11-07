<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Product</h1>
        <form action="/php-mvc/routes.php?action=update&id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Current Image:</label><br>
                <?php if (!empty($product['image'])): ?>
                    <img src="/php-mvc/uploads/product_image/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" class="rounded"  style="width: 100px; height: auto; margin-bottom: 10px;">
                <?php else: ?>
                    <p>No image available.</p>
                <?php endif; ?>
                <input type="file" id="image" name="image" class="form-control mt-2">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>