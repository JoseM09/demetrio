<!-- home/index.php - Contenido de la página de inicio -->

<!-- Sección Hero -->
<div class="hero animate-on-scroll">
    <div class="hero-grid">
        <div class="hero-content">
            <h2 class="badge-text">Compromiso, Ley y Democracia</h2>
            <h1>Dr. Demetrio Núñez</h1>
            <p>Destacado profesional del derecho, politólogo y miembro de la Dirección Central del partido Fuerza del Pueblo. Bienvenidos a mi espacio de reflexión sobre el ámbito político, constitucional y la justicia electoral de la República Dominicana.</p>
            <div class="hero-buttons">
                <a href="<?= BASE_URL ?>index.php?url=about/index" class="btn btn-primary">
                    Conóceme 
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <a href="<?= BASE_URL ?>index.php?url=post/index" class="btn btn-secondary">Leer Artículos</a>
            </div>
        </div>
        <div class="hero-avatar">
            <div class="hero-avatar-wrapper">
                <img src="<?= BASE_URL ?>assets/images/dr_demetrio.jpg" alt="Dr. Demetrio Núñez">
            </div>
        </div>
    </div>
</div>

<!-- Grid de Especialidades / Presentación -->
<div class="section-header animate-on-scroll">
    <h2 class="section-title">Áreas de Especialidad</h2>
</div>

<div class="blog-grid" style="margin-bottom: 60px;">
    <!-- Tarjeta 1: Derecho Inmobiliario -->
    <div class="specialty-card animate-on-scroll delay-1">
        <div class="specialty-icon" style="background-color: rgba(217, 119, 6, 0.08); color: var(--gold-color);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="22"></line><line x1="5" y1="7" x2="19" y2="7"></line><path d="M5 7v3a7 7 0 0 0 14 0V7"></path><path d="M9 21h6"></path></svg>
        </div>
        <h3>Derecho Inmobiliario</h3>
        <p>Asesoría jurídica de alto nivel en procesos de deslinde, transferencias de propiedad, condominios y litigios inmobiliarios complejos en la República Dominicana.</p>
    </div>
    
    <!-- Tarjeta 2: Justicia Electoral -->
    <div class="specialty-card animate-on-scroll delay-2">
        <div class="specialty-icon" style="background-color: rgba(37, 99, 235, 0.08); color: var(--accent-light);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22h20"></path><path d="M4 22V11"></path><path d="M10 22V11"></path><path d="M14 22V11"></path><path d="M20 22V11"></path><path d="M12 2L2 11h20L12 2z"></path></svg>
        </div>
        <h3>Justicia Electoral</h3>
        <p>Administración electoral, representación ante juntas electorales municipales, el Distrito Nacional y el Tribunal Superior Electoral. Defensa técnica y asesoría de partidos.</p>
    </div>

    <!-- Tarjeta 3: Análisis Político -->
    <div class="specialty-card animate-on-scroll delay-3">
        <div class="specialty-icon" style="background-color: rgba(16, 185, 129, 0.08); color: var(--success-color);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
        </div>
        <h3>Análisis Político</h3>
        <p>Reflexión analítica sobre la democracia dominicana, reformas institucionales, tendencias de participación y partidos políticos modernos.</p>
    </div>
</div>

<!-- Dashboard de Estadísticas -->
<div class="stats-grid">
    <div class="stat-card animate-on-scroll delay-1">
        <div class="stat-number">30+</div>
        <div class="stat-label">Años de Ejercicio</div>
    </div>
    <div class="stat-card animate-on-scroll delay-2">
        <div class="stat-number">150+</div>
        <div class="stat-label">Casos Exitosos</div>
    </div>
    <div class="stat-card animate-on-scroll delay-3">
        <div class="stat-number">40+</div>
        <div class="stat-label">Artículos Escritos</div>
    </div>
    <div class="stat-card animate-on-scroll delay-4">
        <div class="stat-number">12+</div>
        <div class="stat-label">Delegaciones Electorales</div>
    </div>
</div>

<!-- Banner de Cita Personal -->
<div class="quote-banner animate-on-scroll">
    <div class="quote-icon">“</div>
    <p class="quote-text">La justicia no es simplemente aplicar la ley de forma mecánica, sino salvaguardar la dignidad y los derechos fundamentales de cada ciudadano, fortaleciendo los cimientos de la democracia dominicana.</p>
    <p class="quote-author">— Dr. Demetrio Núñez</p>
</div>

<!-- Sección de Respaldo Institucional (Credibilidad) -->
<div class="section-header animate-on-scroll">
    <h2 class="section-title">Trayectoria Institucional</h2>
</div>
<div class="logos-grid animate-on-scroll">
    <div class="logo-item">Junta Central Electoral (JCE)</div>
    <div class="logo-item">Tribunal Superior Electoral (TSE)</div>
    <div class="logo-item">UASD (Doctorado en Derecho)</div>
    <div class="logo-item">Parlamento Centroamericano (PARLACEN)</div>
</div>

<!-- Últimas Publicaciones -->
<div class="section-header animate-on-scroll">
    <h2 class="section-title">Últimas Publicaciones</h2>
    <a href="<?= BASE_URL ?>index.php?url=post/index" class="section-header-link">
        Ver todas 
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
    </a>
</div>

<div class="blog-grid">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $index => $post): ?>
            <?php 
            $palabras = str_word_count(strip_tags($post['content']));
            $minutosLectura = max(1, ceil($palabras / 220));
            $delayClass = "delay-" . (($index % 3) + 1);
            ?>
            <article class="post-card animate-on-scroll <?= $delayClass ?>">
                <?php if (!empty($post['image'])): ?>
                    <div class="post-card-image">
                        <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="creative-image">
                        <div class="image-creative-overlay"></div>
                    </div>
                <?php endif; ?>
                <div class="post-card-body">
                    <div class="post-card-meta">
                        <span style="color: var(--gold-color); font-weight: 700;"><?= htmlspecialchars($post['category'] ?? 'Análisis Político') ?></span>
                        <span>⏱️ <?= $minutosLectura ?> min</span>
                    </div>
                    <h3 class="post-card-title">
                        <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $post['slug'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    </h3>
                    <p class="post-card-excerpt">
                        <?= htmlspecialchars(substr(strip_tags($post['content']), 0, 150)) ?>...
                    </p>
                    <div style="display:flex; justify-content: space-between; align-items: center; margin-top: auto; border-top: 1px solid var(--border-color); padding-top: 15px;">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">📅 <?= formatSpanishDate($post['created_at']) ?></span>
                        <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $post['slug'] ?>" class="post-card-link" style="margin-top:0;">Leer &rarr;</a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-success animate-on-scroll" style="grid-column: 1 / -1; width: 100%;">
            Próximamente se publicarán los primeros artículos de opinión.
        </div>
    <?php endif; ?>
</div>
