<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Category List</h1>
        <a href="/phpmvc/routes.php?action=create" class="btn btn-success mb-3">Add Category</a>
        <table class="table table-striped table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr class="bg-white">
                        <td>
                            <?php if (!empty($category['image'])): ?>
                                <img src="/phpmvc/uploads/category_image/<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['price']); ?>" class="rounded" style="width: 65px; height: auto;">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td>
                            <a href="/phpmvc/routes.php?action=edit&id=<?php echo $category['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/phpmvc/routes.php?action=delete&id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>