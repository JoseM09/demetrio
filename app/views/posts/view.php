<!-- posts/view.php - Lectura de una publicación Modernizada e Interactiva -->

<div class="article-detail-container">
    <!-- Botón de regreso minimalista estilo glass -->
    <a href="<?= BASE_URL ?>index.php?url=post/index" class="btn-back-glass">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Volver a publicaciones
    </a>

    <div class="article-split-layout">
        <!-- Columna Izquierda: Foto de Portada (Sticky en desktop) -->
        <div class="article-left-column">
            <?php if (!empty($post['image'])): ?>
                <div class="article-parallax-wrapper animate-on-scroll">
                    <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="article-parallax-image">
                </div>
            <?php endif; ?>
        </div>

        <!-- Columna Derecha: Información y Contenido -->
        <div class="article-right-column">
            <!-- Cabecera de artículo en tarjeta destacada glassmórfica -->
            <div class="article-title-card animate-on-scroll">
                <h1 class="article-title"><?= htmlspecialchars($post['title']) ?></h1>
                
                <div class="article-meta-pills">
                    <span class="meta-pill meta-pill-category">
                        🏷️ <?= htmlspecialchars($post['category'] ?? 'Análisis Político') ?>
                    </span>
                    <span class="meta-pill">
                        📅 <?= formatSpanishDate($post['created_at']) ?>
                    </span>
                    <span class="meta-pill">
                        👤 Autor: Dr. Demetrio Núñez
                    </span>
                </div>
            </div>

            <!-- Contenido y Firma del Autor -->
            <div class="article-body-wrapper animate-on-scroll">
                <div class="article-content" style="font-size: 1.15rem; line-height: 1.85; color: var(--text-main); letter-spacing: -0.1px;">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </div>
                
                <!-- Tarjeta de Firma del Autor / Biografía -->
                <div class="author-bio-card">
                    <div class="author-bio-avatar">
                        <img src="<?= BASE_URL ?>assets/images/dr_demetrio.jpg" alt="Dr. Demetrio Núñez">
                    </div>
                    <div class="author-bio-details">
                        <h4>Dr. Demetrio Núñez</h4>
                        <p class="author-title">Abogado y Politólogo</p>
                        <p class="author-desc">Especialista en Derecho Inmobiliario, Justicia Electoral y analista de opinión política en la República Dominicana. Miembro de la Dirección Central de Fuerza del Pueblo.</p>
                    </div>
                </div>
                
                <!-- Bloque de acciones / Compartir -->
                <div style="margin-top: 40px; border-top: 1px solid var(--border-color); padding-top: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <span style="font-size:0.9rem; color: var(--text-muted);">¿Te ha resultado de utilidad este análisis?</span>
                    <a href="<?= BASE_URL ?>index.php?url=post/index" class="btn btn-secondary" style="font-size: 0.85rem; padding: 8px 16px;">Ver otras publicaciones</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección Dinámica de Lecturas Recomendadas -->
    <?php
    try {
        $postModel = new Post();
        $allPosts = $postModel->getAll();
        $relatedPosts = array_filter($allPosts, function($p) use ($post) {
            return $p['id'] != $post['id'];
        });
        $relatedPosts = array_slice($relatedPosts, 0, 2);
    } catch (Exception $e) {
        $relatedPosts = [];
    }
    ?>
    
    <?php if (!empty($relatedPosts)): ?>
        <div class="related-posts-section animate-on-scroll">
            <h3 class="related-posts-title">Lecturas Recomendadas</h3>
            <div class="related-grid">
                <?php foreach ($relatedPosts as $rPost): ?>
                    <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $rPost['slug'] ?>" class="related-card">
                        <span class="related-card-category"><?= htmlspecialchars($rPost['category'] ?? 'Análisis Político') ?></span>
                        <h4 class="related-card-title"><?= htmlspecialchars($rPost['title']) ?></h4>
                        <span class="related-card-date">📅 <?= formatSpanishDate($rPost['created_at']) ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
