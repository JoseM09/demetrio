<?php
// PostController.php - Controlador de publicaciones

class PostController extends Controller {

    // Método auxiliar para proteger rutas administrativas
    private function checkAuth() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: ' . BASE_URL . 'index.php?url=auth/login');
            exit;
        }
    }

    // Listado público de publicaciones
    public function index() {
        $postModel = $this->model('Post');
        $posts = $postModel->getAll();
        
        $this->view('posts/index', [
            'posts' => $posts
        ]);
    }

    // Vista de una publicación individual (soporta ID o Slug)
    public function show($param = null) {
        if ($param === null) {
            header('Location: ' . BASE_URL . 'index.php?url=post/index');
            exit;
        }

        $postModel = $this->model('Post');
        if (is_numeric($param)) {
            $post = $postModel->getById($param);
        } else {
            $post = $postModel->getBySlug($param);
        }

        if (!$post) {
            header("HTTP/1.0 404 Not Found");
            echo "<h1 style='font-family:sans-serif;text-align:center;margin-top:50px;'>Error 404: Publicación no encontrada</h1>";
            die();
        }

        $this->view('posts/view', [
            'post' => $post
        ]);
    }

    // Mostrar formulario de creación (Protegido)
    public function create() {
        $this->checkAuth();
        $this->view('admin/create');
    }

    // Guardar publicación creada (Protegido)
    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $category = trim($_POST['category'] ?? 'Análisis Político');

            if (empty($title) || empty($content)) {
                $this->view('admin/create', ['error' => 'El título y el contenido son obligatorios.']);
                return;
            }

            // Procesar carga de imagen
            $imageName = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $uploadFileDir = ROOT_DIR . '/public/uploads/';
                    if (!file_exists($uploadFileDir)) {
                        mkdir($uploadFileDir, 0755, true);
                    }
                    $newFileName = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $fileName);
                    $dest_path = $uploadFileDir . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $imageName = $newFileName;
                    }
                } else {
                    $this->view('admin/create', ['error' => 'Extensión de archivo no permitida. Use JPG, JPEG, PNG, GIF o WEBP.']);
                    return;
                }
            }

            $postModel = $this->model('Post');
            $success = $postModel->create($title, $content, $imageName, $category);

            if ($success) {
                header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard&success=post_created');
                exit;
            } else {
                $this->view('admin/create', ['error' => 'Ocurrió un error al intentar guardar la publicación.']);
            }
        }
    }

    // Mostrar formulario de edición (Protegido)
    public function edit($id = null) {
        $this->checkAuth();
        if ($id === null) {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard');
            exit;
        }

        $postModel = $this->model('Post');
        $post = $postModel->getById($id);

        if (!$post) {
            die("Publicación no encontrada.");
        }

        $this->view('admin/edit', [
            'post' => $post
        ]);
    }

    // Actualizar publicación en BD (Protegido)
    public function update($id = null) {
        $this->checkAuth();
        if ($id === null || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard');
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $category = trim($_POST['category'] ?? 'Análisis Político');

        $postModel = $this->model('Post');
        $post = $postModel->getById($id);

        if (!$post) {
            die("Publicación no encontrada.");
        }

        if (empty($title) || empty($content)) {
            $this->view('admin/edit', [
                'post' => $post,
                'error' => 'El título y el contenido son obligatorios.'
            ]);
            return;
        }

        // Procesar carga de imagen
        $imageName = $post['image']; // Mantener la actual por defecto
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $uploadFileDir = ROOT_DIR . '/public/uploads/';
                if (!file_exists($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
                
                // Intentar borrar la imagen anterior si existía para no dejar basura
                if (!empty($post['image'])) {
                    $oldFilePath = $uploadFileDir . $post['image'];
                    if (file_exists($oldFilePath)) {
                        @unlink($oldFilePath);
                    }
                }

                $newFileName = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $fileName);
                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $imageName = $newFileName;
                }
            } else {
                $this->view('admin/edit', [
                    'post' => $post,
                    'error' => 'Extensión de archivo no permitida. Use JPG, JPEG, PNG, GIF o WEBP.'
                ]);
                return;
            }
        }

        $success = $postModel->update($id, $title, $content, $imageName, $category);

        if ($success) {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard&success=post_updated');
            exit;
        } else {
            $this->view('admin/edit', [
                'post' => $post,
                'error' => 'Ocurrió un error al actualizar la publicación.'
            ]);
        }
    }

    // Eliminar publicación de la BD (Protegido)
    public function delete($id = null) {
        $this->checkAuth();
        if ($id === null) {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard');
            exit;
        }

        $postModel = $this->model('Post');
        $success = $postModel->delete($id);

        if ($success) {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard&success=post_deleted');
        } else {
            header('Location: ' . BASE_URL . 'index.php?url=admin/dashboard&error=delete_failed');
        }
        exit;
    }
}
?>
