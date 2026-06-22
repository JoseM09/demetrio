<!-- admin/dashboard.php - Panel de Administración Rediseñado (Lujo e Innovación) -->

<?php
// Calcular mensajes sin leer
$unreadCount = 0;
foreach ($messages as $msg) {
    if ($msg['is_read'] == 0) {
        $unreadCount++;
    }
}
?>

<div class="admin-header">
    <div>
        <h2 style="font-size: 2rem; font-weight: 900; letter-spacing: -0.8px;">Panel de Control</h2>
        <p style="color: var(--text-muted); margin-top: 4px; font-weight: 500;">Bienvenido, Dr. Demetrio Núñez. Desde aquí gestiona sus contenidos y consultas.</p>
    </div>
    <a href="<?= BASE_URL ?>index.php?url=post/create" class="btn btn-primary" style="font-size:0.9rem; padding: 10px 20px; font-weight:700;">
        + Nueva Publicación
    </a>
</div>

<!-- Alertas de Acciones -->
<?php if (isset($success) && !empty($success)): ?>
    <div class="alert alert-success animate-on-scroll">
        <span>✓</span> 
        <?php 
        if ($success === 'post_created') echo "¡Publicación creada exitosamente!";
        elseif ($success === 'post_updated') echo "¡Publicación actualizada con éxito!";
        elseif ($success === 'post_deleted') echo "¡Publicación eliminada correctamente!";
        elseif ($success === 'message_read') echo "¡Mensaje marcado como leído!";
        elseif ($success === 'settings_updated') echo "¡Redes sociales actualizadas correctamente!";
        else echo htmlspecialchars($success);
        ?>
    </div>
<?php endif; ?>

<?php if (isset($error) && !empty($error)): ?>
    <div class="alert alert-error animate-on-scroll">
        <span>⚠</span> 
        <?php 
        if ($error === 'delete_failed') echo "Error al intentar eliminar la publicación.";
        else echo htmlspecialchars($error);
        ?>
    </div>
<?php endif; ?>

<!-- Grid de Métricas de Resumen -->
<div class="admin-stats-grid">
    <!-- Métricas 1: Artículos -->
    <div class="admin-stat-card animate-on-scroll delay-1">
        <div class="admin-stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
        </div>
        <div class="admin-stat-info">
            <span class="admin-stat-title">Artículos en Blog</span>
            <span class="admin-stat-val"><?= count($posts) ?></span>
        </div>
    </div>
    
    <!-- Métricas 2: Mensajes Recibidos -->
    <div class="admin-stat-card animate-on-scroll delay-2">
        <div class="admin-stat-icon gold">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        </div>
        <div class="admin-stat-info">
            <span class="admin-stat-title">Buzón de Mensajes</span>
            <span class="admin-stat-val"><?= count($messages) ?></span>
        </div>
    </div>

    <!-- Métricas 3: Mensajes Sin Leer -->
    <div class="admin-stat-card animate-on-scroll delay-3">
        <div class="admin-stat-icon warning">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px;"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </div>
        <div class="admin-stat-info">
            <span class="admin-stat-title">Mensajes Sin Leer</span>
            <span class="admin-stat-val"><?= $unreadCount ?></span>
        </div>
    </div>
</div>

<div class="admin-cols-grid">
    <!-- Columna Principal: Gestión de Publicaciones -->
    <div class="admin-section animate-on-scroll" style="width: 100%;">
        <h3 style="font-weight:800; font-size: 1.25rem;">Entradas Publicadas</h3>
        <div class="table-responsive" style="margin-top: 15px;">
            <table>
                <thead>
                    <tr>
                        <th style="width: 70px; text-align: center;">Imagen</th>
                        <th>Detalles del Artículo</th>
                        <th style="width: 140px;">Fecha</th>
                        <th style="width: 140px; text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $post): ?>
                            <?php
                            $cat = $post['category'] ?? 'Análisis Político';
                            $badgeStyle = "badge-success";
                            if ($cat === 'Derecho Inmobiliario') $badgeStyle = "badge-warning";
                            elseif ($cat === 'Justicia Electoral') $badgeStyle = "badge-success"; // Opcional cambiar
                            ?>
                            <tr style="transition: var(--transition);">
                                <td style="text-align: center; vertical-align: middle;">
                                    <?php if (!empty($post['image'])): ?>
                                        <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($post['image']) ?>" alt="Miniatura" class="post-miniature">
                                    <?php else: ?>
                                        <div class="post-miniature" style="background: rgba(30,41,59,0.06); display:flex; align-items:center; justify-content:center; font-size: 1.1rem;">📝</div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong style="font-size: 1rem; color: var(--text-main); display: block; line-height: 1.3; margin-bottom: 6px;"><?= htmlspecialchars($post['title']) ?></strong>
                                    <span class="badge <?= $badgeStyle ?>" style="font-size: 0.68rem; padding: 2px 8px; letter-spacing: 0.5px;"><?= htmlspecialchars($cat) ?></span>
                                </td>
                                <td style="font-size: 0.85rem; vertical-align: middle;"><?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></td>
                                <td style="vertical-align: middle; text-align: right;">
                                    <div class="table-actions" style="justify-content: flex-end;">
                                        <a href="<?= BASE_URL ?>index.php?url=post/show/<?= $post['slug'] ?>" class="btn-action-icon" target="_blank" title="Ver Artículo">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        <a href="<?= BASE_URL ?>index.php?url=post/edit/<?= $post['id'] ?>" class="btn-action-icon edit" title="Editar Artículo">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </a>
                                        <a href="<?= BASE_URL ?>index.php?url=post/delete/<?= $post['id'] ?>" class="btn-action-icon danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');" title="Eliminar Artículo">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 40px; font-weight: 500;">No hay publicaciones en el blog. Comience creando una nueva.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Columna Lateral: Mensajes de Consultas -->
    <div class="admin-section animate-on-scroll" style="width: 100%;">
        <h3 style="font-weight:800; font-size: 1.25rem;">Mensajes Recibidos</h3>
        <div class="admin-msg-list" style="margin-top: 15px;">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $msg): ?>
                    <?php $isUnread = ($msg['is_read'] == 0); ?>
                    <div class="admin-msg-bubble <?= $isUnread ? 'unread' : '' ?>">
                        <div class="admin-msg-header">
                            <div>
                                <span class="admin-msg-sender"><?= htmlspecialchars($msg['name']) ?></span>
                                <span class="admin-msg-email"><?= htmlspecialchars($msg['email']) ?></span>
                            </div>
                            <span class="admin-msg-date"><?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?></span>
                        </div>
                        <div class="admin-msg-subject">
                            <?php if ($isUnread): ?>
                                <span class="admin-msg-unread-dot"></span>
                            <?php endif; ?>
                            <?= htmlspecialchars($msg['subject']) ?>
                        </div>
                        <div class="admin-msg-body"><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                        
                        <?php if ($isUnread): ?>
                            <div class="admin-msg-actions">
                                <a href="<?= BASE_URL ?>index.php?url=admin/markMessageRead/<?= $msg['id'] ?>" class="btn btn-primary btn-sm" style="font-size: 0.75rem; padding: 6px 12px; border-radius: 6px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="12" height="12" style="margin-right: 4px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    Marcar Leído
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="admin-msg-actions" style="justify-content: flex-end; opacity: 0.6;">
                                <span style="font-size: 0.78rem; font-weight: 700; color: var(--success-color); display: flex; align-items: center; gap: 4px;">
                                    ✓ Mensaje Atendido
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; color: var(--text-muted); padding: 40px; border: 1px dashed var(--border-color); border-radius: var(--radius-md); font-weight: 500;">
                    No se han recibido consultas de contacto.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Columna Lateral: Configuración de Redes Sociales -->
    <div class="admin-section animate-on-scroll" style="width: 100%; margin-top: 30px;">
        <h3 style="font-weight:800; font-size: 1.25rem;">Redes Sociales (Footer)</h3>
        <form action="<?= BASE_URL ?>index.php?url=admin/saveSettings" method="POST" style="margin-top: 15px;">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="social_facebook" style="font-size:0.82rem; font-weight:700;">Facebook URL</label>
                <input type="text" id="social_facebook" name="social_facebook" placeholder="https://facebook.com/..." value="<?= htmlspecialchars($settings['social_facebook'] ?? '') ?>" style="font-size:0.9rem; padding: 10px 12px; background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main);">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="social_twitter" style="font-size:0.82rem; font-weight:700;">Twitter / X URL</label>
                <input type="text" id="social_twitter" name="social_twitter" placeholder="https://twitter.com/..." value="<?= htmlspecialchars($settings['social_twitter'] ?? '') ?>" style="font-size:0.9rem; padding: 10px 12px; background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main);">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="social_instagram" style="font-size:0.82rem; font-weight:700;">Instagram URL</label>
                <input type="text" id="social_instagram" name="social_instagram" placeholder="https://instagram.com/..." value="<?= htmlspecialchars($settings['social_instagram'] ?? '') ?>" style="font-size:0.9rem; padding: 10px 12px; background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main);">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="social_linkedin" style="font-size:0.82rem; font-weight:700;">LinkedIn URL</label>
                <input type="text" id="social_linkedin" name="social_linkedin" placeholder="https://linkedin.com/..." value="<?= htmlspecialchars($settings['social_linkedin'] ?? '') ?>" style="font-size:0.9rem; padding: 10px 12px; background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main);">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 0.85rem; padding: 10px; font-weight: 700; border-radius: var(--radius-sm); border: none; cursor: pointer;">
                Guardar Enlaces
            </button>
        </form>
    </div>
</div>
