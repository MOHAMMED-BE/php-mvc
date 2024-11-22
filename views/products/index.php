<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>

<body>

    <div class="container mt-5">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr class="bg-white">
                        <td>
                            <?php if (!empty($product['image'])): ?>
                                <img src="/phpmvc/uploads/product_image/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['price']); ?>" class="rounded" style="width: 65px; height: auto;">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['category_name'] ?? 'No Category'); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?> MAD</td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?> Unit</td>
                        <td>
                            <a href="/phpmvc/index.php?product/edit&id=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/phpmvc/index.php?product/delete&id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php echo $paginationHtml; ?>

    </div>

</body>

</html>