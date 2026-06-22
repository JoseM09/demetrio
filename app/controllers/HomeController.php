<?php
// HomeController.php - Controlador de la página de inicio

class HomeController extends Controller {
    public function index() {
        $postModel = $this->model('Post');
        $allPosts = $postModel->getAll();
        
        // Obtener sólo las 3 últimas publicaciones para mostrarlas en el Home
        $recentPosts = array_slice($allPosts, 0, 3);
        
        $this->view('home/index', [
            'posts' => $recentPosts
        ]);
    }
}
?>
