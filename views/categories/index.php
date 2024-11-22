<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
</head>

<body>

    <div class="container mt-5">
        <table class="table">
            <thead class="table-dark">
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
                                <img src="/phpmvc/uploads/category_image/<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" class="rounded" style="width: 65px; height: auto;">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td>
                            <a href="/phpmvc/index.php?category/edit&id=<?php echo $category['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/phpmvc/index.php?category/delete&id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php echo $paginationHtml; ?>

    </div>

</body>

</html>