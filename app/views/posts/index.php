<!-- posts/index.php - Listado de publicaciones públicas estructurado e interactivo -->

<div class="section-header animate-on-scroll">
    <div>
        <h2 class="section-title">Artículos y Opinión</h2>
        <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 5px;">Investigación jurídica, opinión sobre derecho inmobiliario, institucionalidad y justicia electoral dominicana.</p>
    </div>
</div>

<?php if (!empty($posts)): ?>
    
    <!-- Filtros de categoría y Buscador -->
    <div class="blog-filter-bar animate-on-scroll">
        <div class="filter-container">
            <button class="filter-pill active" data-filter="all">Todos</button>
            <button class="filter-pill" data-filter="Derecho Inmobiliario">⚖️ Derecho Inmobiliario</button>
            <button class="filter-pill" data-filter="Justicia Electoral">🏛️ Justicia Electoral</button>
            <button class="filter-pill" data-filter="Análisis Político">✍️ Análisis Político</button>
            <button class="filter-pill" data-filter="Actividad Política">📢 Actividad Política</button>
            <button class="filter-pill" data-filter="Capacitación">🎓 Capacitación</button>
            <button class="filter-pill" data-filter="Relaciones Internacionales">🌐 Relaciones Internacionales</button>
        </div>
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Buscar artículos...">
            <span class="search-icon">🔍</span>
        </div>
    </div>

    <!-- Post Destacado (Featured Post) -->
    <?php 
    $featured = $posts[0]; 
    $featuredCategory = $featured['category'] ?? 'Análisis Político';
    $featuredWords = str_word_count(strip_tags($featured['content']));
    $featuredReadTime = max(1, ceil($featuredWords / 220));
    ?>
    <div class="featured-post animate-on-scroll" data-category="<?= $featuredCategory ?>">
        <div class="featured-post-image">
            <span class="featured-post-badge"><?= $featuredCategory ?></span>
            <?php if (!empty($featured['image'])): ?>
                <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($featured['image']) ?>" alt="<?= htmlspecialchars($featured['title']) ?>" class="creative-image">
                <div class="image-creative-overlay"></div>
            <?php else: ?>
                <svg class="featured-svg-bg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="2" x2="12" y2="22"></line>
                    <line x1="5" y1="7" x2="19" y2="7"></line>
                    <path d="M5 7v3a7 7 0 0 0 14 0V7"></path>
                    <path d="M9 21h6"></path>
                </svg>
            <?php endif; ?>
        </div>
        <div class="featured-post-details">
            <div class="post-card-meta" style="margin-bottom: 15px;">
                <span>📅 <?= formatSpanishDate($featured['created_at']) ?></span>
                <span>⏱️ <?= $featuredReadTime ?> min de lectura</span>
            </div>
            <h3 class="featured-post-title">
                <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $featured['slug'] ?>" style="color: var(--text-main);">
                    <?= htmlspecialchars($featured['title']) ?>
                </a>
            </h3>
            <p class="post-card-excerpt" style="font-size: 1.05rem; margin-bottom: 25px;">
                <?= htmlspecialchars(substr(strip_tags($featured['content']), 0, 240)) ?>...
            </p>
            <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $featured['slug'] ?>" class="btn btn-primary" style="align-self: flex-start; padding: 12px 28px;">Leer Artículo Destacado</a>
        </div>
    </div>

    <!-- Cuadrícula del resto de publicaciones -->
    <div class="blog-grid" id="posts-grid">
        <?php foreach ($posts as $index => $post): ?>
            <?php 
            // Omitir el post destacado en la cuadrícula general para no duplicar
            if ($index === 0) continue; 
            
            $category = $post['category'] ?? 'Análisis Político';
            $palabras = str_word_count(strip_tags($post['content']));
            $minutosLectura = max(1, ceil($palabras / 220));
            $delayClass = "delay-" . ((($index - 1) % 3) + 1);
            ?>
            <article class="post-card animate-on-scroll <?= $delayClass ?>" data-category="<?= $category ?>">
                <?php if (!empty($post['image'])): ?>
                    <div class="post-card-image">
                        <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="creative-image">
                        <div class="image-creative-overlay"></div>
                    </div>
                <?php endif; ?>
                <div class="post-card-body">
                    <div class="post-card-meta">
                        <span style="color: var(--gold-color); font-weight: 700;"><?= $category ?></span>
                        <span>⏱️ <?= $minutosLectura ?> min</span>
                    </div>
                    <h3 class="post-card-title">
                        <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $post['slug'] ?>">
                            <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </h3>
                    <p class="post-card-excerpt">
                        <?= htmlspecialchars(substr(strip_tags($post['content']), 0, 160)) ?>...
                    </p>
                    <div style="display:flex; justify-content: space-between; align-items: center; margin-top: auto; border-top: 1px solid var(--border-color); padding-top: 15px;">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">📅 <?= formatSpanishDate($post['created_at']) ?></span>
                        <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $post['slug'] ?>" class="post-card-link" style="margin-top:0;">Leer &rarr;</a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <!-- Lógica JavaScript Interactiva para Filtros y Búsquedas -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pills = document.querySelectorAll('.filter-pill');
            const searchInput = document.getElementById('search-input');
            const cards = document.querySelectorAll('.post-card');
            const featuredPost = document.querySelector('.featured-post');
            const grid = document.getElementById('posts-grid');
            
            let activeCategory = 'all';
            let searchQuery = '';
 
            // Función unificada para filtrar artículos
            function applyFilters() {
                let hasResults = false;
                
                // 1. Filtrar Post Destacado
                const featuredCat = featuredPost.getAttribute('data-category');
                const featuredTitle = featuredPost.querySelector('.featured-post-title').textContent.toLowerCase();
                const featuredExcerpt = featuredPost.querySelector('.post-card-excerpt').textContent.toLowerCase();
                
                const matchesCategoryFeatured = (activeCategory === 'all' || featuredCat === activeCategory);
                const matchesSearchFeatured = (featuredTitle.includes(searchQuery) || featuredExcerpt.includes(searchQuery));
                
                if (matchesCategoryFeatured && matchesSearchFeatured) {
                    featuredPost.style.display = 'grid';
                    featuredPost.style.opacity = '1';
                    hasResults = true;
                } else {
                    featuredPost.style.display = 'none';
                    featuredPost.style.opacity = '0';
                }

                // 2. Filtrar Cuadrícula
                cards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    const title = card.querySelector('.post-card-title').textContent.toLowerCase();
                    const excerpt = card.querySelector('.post-card-excerpt').textContent.toLowerCase();
                    
                    const matchesCategory = (activeCategory === 'all' || cardCat === activeCategory);
                    const matchesSearch = (title.includes(searchQuery) || excerpt.includes(searchQuery));
                    
                    if (matchesCategory && matchesSearch) {
                        card.style.display = 'flex';
                        card.style.opacity = '1';
                        hasResults = true;
                    } else {
                        card.style.display = 'none';
                        card.style.opacity = '0';
                    }
                });

                // 3. Mostrar alerta de sin resultados
                const existingMsg = document.getElementById('no-results-msg');
                if (!hasResults) {
                    if (!existingMsg) {
                        const msg = document.createElement('div');
                        msg.id = 'no-results-msg';
                        msg.className = 'alert alert-error animate-on-scroll';
                        msg.style.width = '100%';
                        msg.style.textAlign = 'center';
                        msg.style.gridColumn = '1 / -1';
                        msg.innerHTML = '<span>⚠</span> No se encontraron publicaciones con los filtros aplicados.';
                        grid.appendChild(msg);
                    }
                } else {
                    if (existingMsg) {
                        existingMsg.remove();
                    }
                }
            }

            // Eventos para los Botones de Categorías
            pills.forEach(pill => {
                pill.addEventListener('click', () => {
                    pills.forEach(p => p.classList.remove('active'));
                    pill.classList.add('active');
                    activeCategory = pill.getAttribute('data-filter');
                    applyFilters();
                });
            });

            // Evento para el Buscador en tiempo real
            searchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value.toLowerCase().trim();
                applyFilters();
            });
        });
    </script>
<?php else: ?>
    <div class="alert alert-success animate-on-scroll" style="padding: 30px; border-radius: var(--radius-md); text-align: center;">
        <h3>No hay publicaciones disponibles por el momento</h3>
        <p style="margin-top: 10px;">El Dr. Demetrio Núñez compartirá sus análisis y artículos muy pronto. ¡Mantente atento!</p>
    </div>
<?php endif; ?>
