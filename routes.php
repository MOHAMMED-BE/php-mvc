<?php
require_once 'controllers/ProductController.php';

$controller = new ProductController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'show':
        $controller->show($_GET['id']);
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store($_POST['name'], $_POST['price']);
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_GET['id'], $_POST['name'], $_POST['price']);
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
    default:
        $controller->index();
        break;
}
