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
            <tr>
                <td>
                    <?php if (!empty($product['image'])): ?>
                        <img src="uploads/<?php echo $product['image']; ?>" alt="Product Image" style="width: 100px;">
                    <?php else: ?>
                        <span>No Image</span>
                    <?php endif; ?>
                </td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['category_name'] ?? 'No Category'; ?></td>
                <td><?php echo $product['price']; ?> MAD</td>
                <td><?php echo $product['quantity']; ?></td>
                <td>
                    <a href="index.php?product/edit&id=<?php echo $product['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="index.php?product/delete&id=<?php echo $product['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination">
    <?php echo $paginationHtml; ?>
</div>
