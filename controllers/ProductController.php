<?php
require_once 'models/Product.php';
require_once 'models/Category.php';

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function index()
    {
        $itemsPerPage = 4; // Items per page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page from query
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Check if there's a search query
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

        // Get total items and paginated items
        $productModel = new Product();

        if ($searchQuery !== '') {
            $totalItems = $productModel->getSearchCount($searchQuery); // Count matching products
            $products = $productModel->search($searchQuery, $itemsPerPage, $offset); // Fetch matching products
        } else {
            $totalItems = $productModel->getCount(); // Total number of products
            $products = $productModel->getPaginated($itemsPerPage, $offset); // Fetch paginated products
        }

        // Generate pagination HTML
        $baseUrl = 'index.php?product/index' . ($searchQuery !== '' ? '&search=' . urlencode($searchQuery) : '');
        $paginationHtml = PaginationHelper::paginate($totalItems, $itemsPerPage, $currentPage, $baseUrl);

        require 'views/products/index.php';
    }


    public function show(int $id)
    {
        $product = $this->productModel->getById($id);
        require 'views/products/show.php';
    }

    public function create()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        require 'views/products/create.php';
    }

    public function store(string $name, float $price, int $quantity)
    {
        $categoryId = (int)$_POST['category'];
        $this->productModel->create($name, $price, $quantity, $categoryId);

        header('Location: index.php?product/index');
        exit;
    }

    public function edit(int $id)
    {
        $product = $this->productModel->getById($id);
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        require 'views/products/edit.php';
    }

    public function update(int $id, string $name, float $price, int $quantity)
    {
        $categoryId = (int)$_POST['category'];
        $this->productModel->update($id, $name, $price, $quantity, $categoryId);
        header('Location: index.php?product/index');
        exit;
    }

    public function delete(int $id)
    {
        $this->productModel->delete($id);
        header('Location: index.php?product/index');
        exit;
    }
}
