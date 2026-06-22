<!-- admin/edit.php - Editar Publicación -->

<div class="article-container" style="max-width: 900px; padding: 40px;">
    <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <h2 style="font-size: 1.8rem; font-weight: 700; color: var(--text-main);">Editar Publicación</h2>
        <a href="<?= BASE_URL ?>index.php?url=admin/dashboard" style="font-size:0.9rem; font-weight: 600;">&larr; Volver al Panel</a>
    </div>

    <!-- Alerta de Errores -->
    <?php if (isset($error) && !empty($error)): ?>
        <div class="alert alert-error">
            <span>⚠</span> <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>index.php?url=post/update/<?= $post['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Título del Artículo *</label>
            <input type="text" id="title" name="title" required value="<?= htmlspecialchars($post['title']) ?>">
        </div>

        <div class="form-group">
            <label for="category">Categoría del Artículo *</label>
            <select id="category" name="category" required>
                <option value="Análisis Político" <?= ($post['category'] === 'Análisis Político') ? 'selected' : '' ?>>Análisis Político</option>
                <option value="Justicia Electoral" <?= ($post['category'] === 'Justicia Electoral') ? 'selected' : '' ?>>Justicia Electoral</option>
                <option value="Derecho Inmobiliario" <?= ($post['category'] === 'Derecho Inmobiliario') ? 'selected' : '' ?>>Derecho Inmobiliario</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Imagen Destacada (Opcional)</label>
            <?php if (!empty($post['image'])): ?>
                <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 15px;">
                    <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($post['image']) ?>" alt="Miniatura" style="width: 120px; height: 80px; object-fit: cover; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                    <span style="font-size: 0.85rem; color: var(--text-muted);">Imagen actual cargada. Sube una nueva para reemplazarla.</span>
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Sube una nueva foto para cambiar la actual (formatos recomendados: JPG, PNG, WEBP).</p>
        </div>

        <div class="form-group">
            <label for="content">Cuerpo y Contenido del Artículo *</label>
            <textarea id="content" name="content" required style="min-height: 350px;"><?= htmlspecialchars($post['content']) ?></textarea>
        </div>

        <div style="margin-top: 30px; display:flex; gap: 15px; justify-content: flex-end;">
            <a href="<?= BASE_URL ?>index.php?url=admin/dashboard" class="btn btn-secondary" style="font-size: 0.95rem; padding: 10px 20px;">Cancelar</a>
            <button type="submit" class="btn btn-primary" style="font-size: 0.95rem; padding: 10px 20px;">Guardar Cambios</button>
        </div>
    </form>
</div>
