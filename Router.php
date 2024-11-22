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
        // $route = isset($_GET['route']) ? $_GET['route'] : '';
        // $route = filter_var($route, FILTER_SANITIZE_URL);
        // $segments = explode('/', $route);

        // Get the query string keys
        $queryKeys = array_keys($_GET);

        if (!empty($queryKeys[0])) {
            // Split the key into controller and action
            $route = $queryKeys[0];
            $segments = explode('/', $route);

            // Determine controller name
            if (!empty($segments[0])) {
                $this->controllerName = ucfirst($segments[0]) . 'Controller';
            }

            // Determine action name
            if (isset($segments[1]) && $segments[1] !== '') {
                $this->action = $segments[1];
            }
        }

        // Validate controller and action
        $allowedControllers = ['ProductController', 'CategoryController'];
        $allowedActions = ['index', 'show', 'create', 'store', 'edit', 'update', 'delete'];

        if (!in_array($this->controllerName, $allowedControllers)) {
            die("Controller '{$this->controllerName}' is not allowed.");
        }

        if (!in_array($this->action, $allowedActions)) {
            die("Action '{$this->action}' is not allowed.");
        }

        // Collect additional parameters from GET and POST, excluding the route key
        $this->params = array_merge($_GET, $_POST);
        unset($this->params[$route]);
    }

    public function dispatch()
    {
        // Instantiate the controller
        $controller = new $this->controllerName();

        // Check if the method exists and call it
        if (method_exists($controller, $this->action)) {
            // Use Reflection to match method parameters
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
