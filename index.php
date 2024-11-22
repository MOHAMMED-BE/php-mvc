<?php
// Autoload controller classes
spl_autoload_register(function ($class_name) {
    // Look for the class in the controllers directory
    $controllerPath = 'controllers/' . $class_name . '.php';
    if (file_exists($controllerPath)) {
        include $controllerPath;
        return;
    }

    // Look for the class in the helpers directory
    $helperPath = 'helpers/' . $class_name . '.php';
    if (file_exists($helperPath)) {
        include $helperPath;
        return;
    }

    throw new Exception("Class $class_name not found in controllers or helpers.");
});

require_once 'Router.php';

$url = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url);
$route = $parsedUrl['query'] ?? '';
$route = explode('&', $route)[0];

$routeDisplay = str_replace(['/', '_'], ' / ', $route);
$routeDisplay = ucwords(str_replace(['product', 'category', 'index'], ['Product', 'Category', 'List'], $routeDisplay));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="assets/media/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="d-flex parent">
        <div class="sidebar bg-dark text-white d-flex flex-column">
            <div class="sidebar-header p-3 text-center">
                <div class="row">
                    <div class="col-4 pe-0">
                        <img src="assets/media/icon.png" alt="" class="side-img">
                    </div>
                    <div class="col-7">
                        <h5> Sidemenus</h5>
                    </div>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo ($route ?? '') === 'product/index' ? 'active' : ''; ?>" href="index.php?product/index">
                        <i class="bi bi-house-door"></i> Product List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo ($route ?? '') === 'product/create' ? 'active' : ''; ?>" href="index.php?product/create">
                        <i class="bi bi-plus-circle"></i> Add Product
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo ($route ?? '') === 'category/index' ? 'active' : ''; ?>" href="index.php?category/index">
                        <i class="bi bi-grid"></i> Category List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo ($route ?? '') === 'category/create' ? 'active' : ''; ?>" href="index.php?category/create">
                        <i class="bi bi-plus-circle"></i> Add Category
                    </a>
                </li>
            </ul>
            <div class="mtauto p-3 text-center user-profile">
                <a href="#" class="text-white">
                    <i class="bi bi-person-circle"></i> User Profile
                </a>
            </div>
        </div>

        <div class="flex-grow-1">
            <div class="top-header d-flex justify-content-between align-items-center  bg-light">
                <h5><?php echo htmlspecialchars($routeDisplay); ?></h5>

                <?php if ($route === 'product/index'): ?>
                    <form method="GET" action="index.php" class="d-flex">
                        <input type="hidden" name="product/index" value="">
                        <input
                            type="text"
                            name="search"
                            class="form-control me-2"
                            placeholder="Search products..."
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="p-4">
                <?php
                $router = new Router();
                $router->dispatch();
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>