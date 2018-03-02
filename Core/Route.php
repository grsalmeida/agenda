<?php

namespace Core;
/*
classe baseada em exemplos do w3scholl
classe responsavel por ordenar e pardronizar as rotas entre controler, model e view
*/
class Route {

    private $routes;
    private $instance;
    private $controller;
    private $action;

    public function get($route, $action) {
        $this->registerRoute('GET', $route, $action);
    }

    public function post($route, $action) {
        $this->registerRoute('POST', $route, $action);
    }


    /**
     * Registra rota PUT.
     * 
     * @param type $route
     * @param type $action
     */
    public function put($route, $action) {
        $this->registerRoute('PUT', $route, $action);
    }

    /**
     * Registra rota DELETE
     * 
     * @param type $route
     * @param type $action
     */
    public function delete($route, $action) {
        $this->registerRoute('DELETE', $route, $action);
    }


    private function registerRoute($method, $route, $action) {
        $route = ltrim($route, "/");
        $this->routes[$method][$route] = $action;
    }

    public function run() {
        $path = ltrim($_SERVER['REDIRECT_URL'], $_SERVER['CONTEXT_PREFIX']);
        $route = explode('/',ltrim($path, "/"));
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $key => $routes) {
            if(strpos($key, '/')  !== false){
                $newkey = explode('/', $key);
            }
            if ($route[0] == $key || isset($newkey) && ($route[0] === $newkey[0] || $route[0] === $newkey[1])) {
                if(isset($this->routes[$_SERVER['REQUEST_METHOD']][$key])){
                    $this->instanceController($this->routes[$_SERVER['REQUEST_METHOD']][$key]);
                    $response = call_user_func_array([$this->instance, $this->action], $this->prepareParameters());
                    if ($response instanceof \Core\View) {
                        $this->view($response);
                    } else {
                        echo $response;
                    }
                } elseif (strpos($key, "public") !== 0) {
                    header("HTTP/1.1 404 Not Found");
                    echo "<h1>404 - Not found</h1>";
                }   
            }
            continue;
        }
    }

    private function instanceController($action) {
        $action = explode("@", $action);
        $this->action = $action[1];
        $this->controller = "\\App\\Controller\\" . $action[0];
        $this->instance = new $this->controller();
    }

    private function prepareParameters() {
        $params = [];
        $postParams = $_POST;
        
        if ($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE') {
            parse_str(file_get_contents("php://input"), $putDelete);
            if (is_array($putDelete)) {
                $postParams = array_merge($postParams, $putDelete);
            }
        }
        
        $reflection = new \ReflectionMethod($this->instance, $this->action);
        $parameters = $reflection->getParameters();
        foreach ($parameters as $k => $param) {
            if (!empty($param->getClass()) && $param->getClass()->name == "Core\Request") {
                $request = new \Core\Request($_GET, $postParams);
                $params[$param->name] = $request;
            }
        }
        return array_merge($params, $_GET, $postParams);
    }

    private function view($view) {
        $__view = $view->getView();
        $dados = $view->getParams();
        include __DIR__ . "/../App/View/" . $__view . ".php";
        unset($__view);
    }

    private function asset($file) {
        return "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['CONTEXT_PREFIX'] . "/public/" . ltrim($file, "/");
    }

}
