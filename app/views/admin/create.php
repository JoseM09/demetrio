<!-- admin/create.php - Crear Nueva Publicación -->

<div class="article-container" style="max-width: 900px; padding: 40px;">
    <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <h2 style="font-size: 1.8rem; font-weight: 700; color: var(--text-main);">Nueva Publicación</h2>
        <a href="<?= BASE_URL ?>index.php?url=admin/dashboard" style="font-size:0.9rem; font-weight: 600;">&larr; Volver al Panel</a>
    </div>

    <!-- Alerta de Errores -->
    <?php if (isset($error) && !empty($error)): ?>
        <div class="alert alert-error">
            <span>⚠</span> <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>index.php?url=post/store" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Título del Artículo *</label>
            <input type="text" id="title" name="title" required placeholder="Ej: Reformas de la Ley de Catastro y Registro Inmobiliario" value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
        </div>

        <div class="form-group">
            <label for="category">Categoría del Artículo *</label>
            <select id="category" name="category" required>
                <option value="Análisis Político" <?= (isset($_POST['category']) && $_POST['category'] === 'Análisis Político') ? 'selected' : '' ?>>Análisis Político</option>
                <option value="Justicia Electoral" <?= (isset($_POST['category']) && $_POST['category'] === 'Justicia Electoral') ? 'selected' : '' ?>>Justicia Electoral</option>
                <option value="Derecho Inmobiliario" <?= (isset($_POST['category']) && $_POST['category'] === 'Derecho Inmobiliario') ? 'selected' : '' ?>>Derecho Inmobiliario</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Imagen Destacada (Opcional)</label>
            <input type="file" id="image" name="image" accept="image/*">
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Formatos recomendados: JPG, PNG, WEBP. Máximo 5MB.</p>
        </div>

        <div class="form-group">
            <label for="content">Cuerpo y Contenido del Artículo *</label>
            <textarea id="content" name="content" required placeholder="Redacte el cuerpo de la publicación aquí..." style="min-height: 350px;"><?= isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '' ?></textarea>
        </div>

        <div style="margin-top: 30px; display:flex; gap: 15px; justify-content: flex-end;">
            <a href="<?= BASE_URL ?>index.php?url=admin/dashboard" class="btn btn-secondary" style="font-size: 0.95rem; padding: 10px 20px;">Cancelar</a>
            <button type="submit" class="btn btn-primary" style="font-size: 0.95rem; padding: 10px 20px;">Publicar Entrada</button>
        </div>
    </form>
</div>
