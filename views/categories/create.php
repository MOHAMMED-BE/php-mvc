<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>

<body>
    <div class="container mt-5">
        <form action="/phpmvc/index.php?category/store" method="POST" enctype="multipart/form-data" id="categoryForm" class="p-4 border rounded bg-light">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
                <div id="nameHelp" class="form-text">Enter the category name (minimum 3 characters).</div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control" required>
                <div id="imageHelp" class="form-text">Upload an image file (JPG, PNG, or WEBP).</div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>

    <script src="assets/js/validate.js"></script>
</body>

</html>