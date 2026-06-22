<!-- auth/login.php - Formulario de inicio de sesión -->

<div class="login-container animate-on-scroll">
    <div class="login-crest">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
    </div>

    <div class="login-header">
        <h2>Acceso Administrativo</h2>
        <p>Introduce tus credenciales para gestionar el blog</p>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <span>⚠</span> <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>index.php?url=auth/login" method="POST">
        <div class="form-group">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" required autocomplete="username" placeholder="Tu nombre de usuario">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Tu contraseña de acceso">
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; font-size:1rem; margin-top: 10px;">Ingresar al Sistema</button>
    </form>

    <div style="text-align: center; margin-top: 25px;">
        <a href="<?= BASE_URL ?>index.php?url=home/index" style="font-size: 0.9rem; color: var(--text-muted);">&larr; Volver al sitio público</a>
    </div>
</div>
