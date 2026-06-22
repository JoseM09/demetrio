<?php

class Controller {
    // Cargar la vista y pasar los datos
    public function view($view, $data = []) {
        // Extraer los datos asociativos en variables locales
        extract($data);
        
        // Definir la ruta del archivo de vista que será cargado por el layout
        $viewFile = '../app/views/' . $view . '.php';
        
        // Requerir el diseño (layout) principal
        require_once '../app/views/layout.php';
    }

    // Instanciar un modelo
    public function model($model) {
        // Gracias al autoloader dinámico en init.php, no es necesario require_once manual
        return new $model();
    }
}
?>
