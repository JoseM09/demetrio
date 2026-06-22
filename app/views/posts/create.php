<?php include 'app/views/partials/navbar.php'; ?>

<link rel="stylesheet" href="public/assets/css/style.css">

<h2>Crear nueva publicación</h2>
<form action="index.php?controller=post&action=store" method="post">
    <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="content">Contenido:</label>
        <textarea name="content" id="content" class="form-control" rows="8" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Publicar</button>
</form>
