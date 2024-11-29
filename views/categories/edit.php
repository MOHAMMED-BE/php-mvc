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
    <title>Edit category</title>
</head>

<body>
    <div class="container mt-5">
        <form action="/phpmvc/index.php?category/update&id=<?php echo $category['id']; ?>" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" class="form-control" required>
                <div id="nameHelp" class="form-text text-danger"></div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Current Image:</label><br>
                <?php if (!empty($category['image'])): ?>
                    <img src="/phpmvc/uploads/category_image/<?php echo htmlspecialchars($category['image']); ?>" alt="category Image" class="rounded" style="width: 100px; height: auto; margin-bottom: 10px;">
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