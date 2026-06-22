<?php

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Verificar si se especificó un controlador en la URL
        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                header("HTTP/1.0 404 Not Found");
                echo "<h1 style='font-family:sans-serif;text-align:center;margin-top:50px;'>Error 404: Página no encontrada</h1>";
                die();
            }
        }

        // Cargar e instanciar el controlador
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Verificar si se especificó un método en la URL
        if (isset($url[1]) && !empty($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                header("HTTP/1.0 404 Not Found");
                echo "<h1 style='font-family:sans-serif;text-align:center;margin-top:50px;'>Error 404: Acción no encontrada</h1>";
                die();
            }
        }

        // Obtener los parámetros restantes de la URL
        $this->params = $url ? array_values($url) : [];

        // Ejecutar el método del controlador con los parámetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url']) && !empty($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
?>
