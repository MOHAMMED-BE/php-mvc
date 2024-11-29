<?php

class Router
{
    private $controllerName = 'ProductController';
    private $action = 'index';
    private $params = [];

    public function __construct()
    {
        $this->parseRoute();
    }

    private function parseRoute()
    {
        $queryKeys = array_keys($_GET);

        if (!empty($queryKeys[0])) {
            $route = $queryKeys[0];
            $segments = explode('/', $route);

            if (!empty($segments[0])) {
                $this->controllerName = ucfirst($segments[0]) . 'Controller';
            }

            if (isset($segments[1]) && $segments[1] !== '') {
                $this->action = $segments[1];
            }
        }

        $allowedControllers = ['ProductController', 'CategoryController', 'UserController'];
        $allowedActions = ['index', 'show', 'create', 'store', 'edit', 'update', 'delete', 'login', 'logincheck', 'logout', 'signup','search'];

        if (!in_array($this->controllerName, $allowedControllers)) {
            die("Controller '{$this->controllerName}' is not allowed.");
        }

        if (!in_array($this->action, $allowedActions)) {
            die("Action '{$this->action}' is not allowed.");
        }

        $this->params = array_merge($_GET, $_POST);
        unset($this->params[$route]);
    }

    public function dispatch()
    {
        $controller = new $this->controllerName();

        if (method_exists($controller, $this->action)) {
            $method = new ReflectionMethod($controller, $this->action);
            $expectedParams = $method->getParameters();
            $callParams = [];

            foreach ($expectedParams as $param) {
                $name = $param->getName();
                if (isset($this->params[$name])) {
                    $callParams[] = $this->params[$name];
                } elseif ($param->isOptional()) {
                    $callParams[] = $param->getDefaultValue();
                } else {
                    die("Missing parameter '{$name}' for action '{$this->action}'.");
                }
            }

            call_user_func_array([$controller, $this->action], $callParams);
        } else {
            die("Action '{$this->action}' not found in controller '{$this->controllerName}'.");
        }
    }
}
