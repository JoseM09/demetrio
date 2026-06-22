<?php
// Cargar configuraciones de redes sociales en el diseño general
$settingModel = new Setting();
$settings = $settingModel->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Demetrio Núñez - Blog Personal, Derecho y Política</title>
    
    <!-- Script de inicialización de tema para evitar destellos (flickering) -->
    <script>
        const storedTheme = localStorage.getItem('theme') || 'light';
        if (storedTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>

    <!-- Favicon Premium -->
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>assets/images/favicon.png">

    <!-- CSS Estilos Premium -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
</head>
<body>
    <!-- Barra de progreso de lectura -->
    <div class="scroll-progress-bar" id="scroll-progress"></div>

    <!-- Malla abstracta de fondo animada (Mesh Background) -->
    <div class="bg-mesh">
        <div class="bg-mesh-circle bg-mesh-circle-1"></div>
        <div class="bg-mesh-circle bg-mesh-circle-2"></div>
        <div class="bg-mesh-circle bg-mesh-circle-3"></div>
    </div>

    <!-- Header y Menú de Navegación -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <a href="<?= BASE_URL ?>index.php?url=home/index">
                    <span class="logo-title">Dr. Demetrio Núñez</span>
                    <span class="logo-subtitle">Abogado y Politólogo</span>
                </a>
            </div>
            
            <div class="header-right">
                <nav id="nav-menu">
                    <?php 
                    $currentUrl = $_GET['url'] ?? 'home/index';
                    $isHome = strpos($currentUrl, 'home') !== false || $currentUrl === 'home/index';
                    $isAbout = strpos($currentUrl, 'about') !== false;
                    $isPost = strpos($currentUrl, 'post') !== false && strpos($currentUrl, 'admin') === false;
                    $isContact = strpos($currentUrl, 'contact') !== false;
                    $isAdmin = strpos($currentUrl, 'admin') !== false;
                    ?>
                    <a href="<?= BASE_URL ?>index.php?url=home/index" class="<?= $isHome ? 'active' : '' ?>">Inicio</a>
                    <a href="<?= BASE_URL ?>index.php?url=about/index" class="<?= $isAbout ? 'active' : '' ?>">Sobre mí</a>
                    <a href="<?= BASE_URL ?>index.php?url=post/index" class="<?= $isPost ? 'active' : '' ?>">Publicaciones</a>
                    <a href="<?= BASE_URL ?>index.php?url=contact/form" class="<?= $isContact ? 'active' : '' ?>">Contacto</a>
                    
                    <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                        <a href="<?= BASE_URL ?>index.php?url=admin/dashboard" class="btn-admin <?= $isAdmin ? 'active' : '' ?>">Panel Admin</a>
                        <a href="<?= BASE_URL ?>index.php?url=auth/logout" style="color: #fda4af;">Salir</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>index.php?url=auth/login" style="opacity: 0.65; font-size: 0.85rem;">Ingresar</a>
                    <?php endif; ?>
                </nav>

                <div class="header-actions">
                    <!-- Botón de Modo Oscuro / Claro -->
                    <button id="theme-toggle" class="theme-toggle-btn" aria-label="Cambiar Tema">
                        <span class="sun-icon">☀️</span>
                        <span class="moon-icon">🌙</span>
                    </button>
                    
                    <!-- Botón hamburguesa móvil -->
                    <button class="menu-toggle" id="mobile-menu" aria-label="Abrir Menú">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Contenedor Principal de la Vista -->
    <main>
        <div class="container">
            <?php 
            if (isset($viewFile) && file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                echo "<div class='alert alert-error'>Vista no encontrada: " . htmlspecialchars($viewFile ?? '') . "</div>";
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <!-- Columna 1: Info Personal -->
                <div class="footer-col">
                    <h4 style="font-size:1.2rem; font-weight:800; color:var(--text-white);">Dr. Demetrio Núñez</h4>
                    <p style="font-size:0.9rem; color:rgba(255,255,255,0.6); margin-top:10px; line-height: 1.6;">
                        Abogado litigante especializado en Derecho Inmobiliario, Politólogo y representante técnico en Justicia Electoral en la República Dominicana.
                    </p>
                    
                    <!-- Redes Sociales Dinámicas -->
                    <div class="footer-social-links" style="margin-top: 20px; display: flex; gap: 12px;">
                        <?php if (!empty($settings['social_facebook']) && $settings['social_facebook'] !== '#'): ?>
                            <a href="<?= htmlspecialchars($settings['social_facebook']) ?>" target="_blank" class="footer-social-icon" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['social_twitter']) && $settings['social_twitter'] !== '#'): ?>
                            <a href="<?= htmlspecialchars($settings['social_twitter']) ?>" target="_blank" class="footer-social-icon" aria-label="Twitter">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['social_instagram']) && $settings['social_instagram'] !== '#'): ?>
                            <a href="<?= htmlspecialchars($settings['social_instagram']) ?>" target="_blank" class="footer-social-icon" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['social_linkedin']) && $settings['social_linkedin'] !== '#'): ?>
                            <a href="<?= htmlspecialchars($settings['social_linkedin']) ?>" target="_blank" class="footer-social-icon" aria-label="LinkedIn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Columna 2: Enlaces Rápidos -->
                <div class="footer-col">
                    <h4>Enlaces Rápidos</h4>
                    <ul class="footer-menu">
                        <li><a href="<?= BASE_URL ?>index.php?url=home/index">Inicio</a></li>
                        <li><a href="<?= BASE_URL ?>index.php?url=about/index">Sobre mí</a></li>
                        <li><a href="<?= BASE_URL ?>index.php?url=post/index">Publicaciones</a></li>
                        <li><a href="<?= BASE_URL ?>index.php?url=contact/form">Contacto</a></li>
                    </ul>
                </div>
                <!-- Columna 3: Boletín -->
                <div class="footer-col">
                    <h4>Análisis Mensual</h4>
                    <p style="font-size:0.9rem; color:rgba(255,255,255,0.6); margin-bottom: 15px; line-height: 1.6;">Suscríbete para recibir los artículos de opinión y novedades legales del Dr. Núñez.</p>
                    <form class="newsletter-form" onsubmit="event.preventDefault(); alert('¡Gracias por suscribirte!'); this.reset();">
                        <input type="email" placeholder="Tu correo electrónico" required>
                        <button type="submit">Suscribir</button>
                    </form>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?= date("Y"); ?> Dr. Demetrio Núñez. Todos los derechos reservados. Santo Domingo, R.D.</p>
                <div class="footer-bottom-links">
                    <a href="<?= BASE_URL ?>index.php?url=auth/login">Acceso Administrativo</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript para Toggle del Menú Móvil y Cambio de Tema -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu');
            const navMenu = document.getElementById('nav-menu');
            const themeToggleBtn = document.getElementById('theme-toggle');
            const backToTopBtn = document.getElementById('back-to-top');
            
            if (mobileMenuBtn && navMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    navMenu.classList.toggle('active');
                    this.classList.toggle('open');
                });
            }

            // Lógica de cambio de tema
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', () => {
                    let theme = 'light';
                    if (document.documentElement.getAttribute('data-theme') !== 'dark') {
                        document.documentElement.setAttribute('data-theme', 'dark');
                        theme = 'dark';
                    } else {
                        document.documentElement.removeAttribute('data-theme');
                    }
                    localStorage.setItem('theme', theme);
                });
            }

            // Botón flotante Volver Arriba (Back to Top)
            if (backToTopBtn) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 400) {
                        backToTopBtn.classList.add('visible');
                    } else {
                        backToTopBtn.classList.remove('visible');
                    }
                });
                backToTopBtn.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // Barra de progreso de lectura y encogimiento de cabecera
            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                const progressBar = document.getElementById('scroll-progress');
                if (progressBar) {
                    progressBar.style.width = scrolled + '%';
                }

                // Encogimiento dinámico de cabecera
                const header = document.querySelector('header');
                if (header) {
                    if (window.scrollY > 40) {
                        header.classList.add('header-scrolled');
                    } else {
                        header.classList.remove('header-scrolled');
                    }
                }
            });

            // Animaciones al hacer scroll (Intersection Observer)
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.08
            };

            const scrollObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const animElements = document.querySelectorAll('.animate-on-scroll');
            animElements.forEach(el => scrollObserver.observe(el));
        });
    </script>
    <!-- Botón flotante Volver Arriba -->
    <button id="back-to-top" class="back-to-top" aria-label="Volver Arriba">▲</button>
</body>
</html>
