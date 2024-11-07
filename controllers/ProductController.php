<?php
require_once 'models/Product.php';

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function index()
    {
        $products = $this->productModel->getAll();
        require 'views/Product/product-list.php';
    }

    public function show($id)
    {
        $product = $this->productModel->getById($id);
        require 'views/Product/show.php';
    }

    public function create()
    {
        require 'views/Product/create.php';
    }

    public function store($name, $price)
    {
        $this->productModel->create($name, $price);
        header('Location: /php-mvc/routes.php');
    }

    public function edit($id)
    {
        $product = $this->productModel->getById($id);
        require 'views/Product/edit.php';
    }

    public function update($id, $name, $price)
    {
        $this->productModel->update($id, $name, $price);
        header('Location: /php-mvc/routes.php');
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        header('Location: /php-mvc/routes.php');
    }
}
