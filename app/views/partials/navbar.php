<?php session_start(); ?>
<nav style="background-color: #2A3F54; color: white; padding: 15px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <strong>Dr. Demetrio Núñez</strong> - Blog Personal
        </div>
        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?controller=auth&action=logout" style="color: white; text-decoration: none;">Cerrar sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
