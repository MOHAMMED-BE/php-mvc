<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product Show</h1>

        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add Product
        </button>

        <!-- Modal for adding product -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/supmti/phpmvc/routes.php?action=store" method="POST" enctype="multipart/form-data" id="addProductForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="text" id="price" name="price" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" id="image" name="image" class="form-control" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="addProductForm" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product List Placeholder (Replace with actual product listing) -->
        <p>Product list goes here...</p>
    </div>

</body>

</html>
