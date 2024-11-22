<?php

require_once 'models/Category.php';

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $itemsPerPage = 2;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $itemsPerPage;

        $categoryModel = new Category();
        $totalItems = $categoryModel->getCount();
        $categories = $categoryModel->getPaginated($itemsPerPage, $offset);

        $baseUrl = 'index.php?category/index';
        $paginationHtml = PaginationHelper::paginate($totalItems, $itemsPerPage, $currentPage, $baseUrl);

        require 'views/categories/index.php';
    }


    public function show(int $id)
    {
        $category = $this->categoryModel->getById($id);
        require 'views/categories/show.php';
    }

    public function create()
    {
        require 'views/categories/create.php';
    }

    public function store(string $name)
    {
        $this->categoryModel->create($name);
        header('Location: index.php?category/index');
        exit;
    }

    public function edit(int $id)
    {
        $category = $this->categoryModel->getById($id);
        require 'views/categories/edit.php';
    }

    public function update(int $id, string $name)
    {
        $this->categoryModel->update($id, $name);
        header('Location: index.php?category/index');
        exit;
    }

    public function delete(int $id)
    {
        $this->categoryModel->delete($id);
        header('Location: index.php?category/index');
        exit;
    }
}
