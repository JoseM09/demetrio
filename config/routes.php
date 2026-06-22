<?php
// routes.php - Definición de rutas (si fuera necesario usar un enfoque de rutas más complejo)

$routes = [
    'home' => ['controller' => 'HomeController', 'action' => 'index'],
    'post' => ['controller' => 'PostController', 'action' => 'index'],
    'post/show' => ['controller' => 'PostController', 'action' => 'show'],
    'auth' => ['controller' => 'AuthController', 'action' => 'login'],
    'contact' => ['controller' => 'ContactController', 'action' => 'form']
];
?>
