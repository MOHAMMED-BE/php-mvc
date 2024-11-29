<?php
require_once 'models/User.php';
require_once 'models/Category.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        require 'views/user/login.php';
    }

    public function signup()
    {
        require 'views/user/signup.php';
    }

    public function store(string $username, string $password)
    {
        $this->userModel->create($username, $password);

        header('Location: index.php?user/login');
        exit;
    }

    public function logincheck()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $this->userModel->loginCheck($username, $password);
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?user/login');
        exit;
    }
}
