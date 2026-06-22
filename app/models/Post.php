<?php
// Post.php - Modelo de publicaciones

class Post {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Utiliza la conexión de base de datos unificada
    }

    // Obtener todas las publicaciones
    public function getAll() {
        $query = 'SELECT * FROM posts ORDER BY created_at DESC';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una publicación por ID
    public function getById($id) {
        $query = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener una publicación por Slug
    public function getBySlug($slug) {
        $query = 'SELECT * FROM posts WHERE slug = :slug';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear una nueva publicación
    public function create($title, $content, $image = null, $category = 'Análisis Político') {
        $slug = $this->slugify($title);
        
        // Evitar duplicados de slug agregando un sufijo si ya existe
        $originalSlug = $slug;
        $counter = 1;
        while ($this->getBySlug($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $query = 'INSERT INTO posts (title, slug, content, image, category) VALUES (:title, :slug, :content, :image, :category)';
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':title' => $title,
            ':slug' => $slug,
            ':content' => $content,
            ':image' => $image,
            ':category' => $category
        ]);
    }

    // Actualizar una publicación existente
    public function update($id, $title, $content, $image = null, $category = 'Análisis Político') {
        $slug = $this->slugify($title);
        
        // Evitar duplicados de slug (excluyendo el post actual)
        $originalSlug = $slug;
        $counter = 1;
        while (true) {
            $existing = $this->getBySlug($slug);
            if (!$existing || $existing['id'] == $id) {
                break;
            }
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $query = 'UPDATE posts SET title = :title, slug = :slug, content = :content, image = :image, category = :category WHERE id = :id';
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':slug' => $slug,
            ':content' => $content,
            ':image' => $image,
            ':category' => $category
        ]);
    }

    // Eliminar una publicación
    public function delete($id) {
        $query = 'DELETE FROM posts WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Helper para convertir título en URL amigable (Slug)
    private function slugify($text) {
        // Reemplazar caracteres especiales y acentos en español
        $text = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'],
            ['a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n'],
            $text
        );
        // Quitar caracteres no permitidos
        $text = preg_replace('/[^a-zA-Z0-9\s-]/', '', $text);
        // Reemplazar espacios por guiones y colapsar múltiples espacios/guiones
        $text = preg_replace('/[\s-]+/', '-', $text);
        return strtolower(trim($text, '-'));
    }
}
?>
