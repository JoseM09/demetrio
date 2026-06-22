<!-- contact/form.php - Formulario de contacto -->

<div class="section-header animate-on-scroll">
    <h2 class="section-title">Contacto Directo</h2>
</div>

<div class="contact-grid">
    <!-- Información de Contacto -->
    <div class="contact-card animate-on-scroll delay-1">
        <h3>Información Oficial</h3>
        <p style="color: var(--text-muted); margin-bottom: 35px; font-size: 0.98rem; line-height: 1.65;">Si deseas programar una consulta legal, solicitar entrevistas de prensa o enviar invitaciones para conferencias o actividades académicas, puedes usar los siguientes medios directos.</p>
        
        <div class="contact-item">
            <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </div>
            <div class="contact-details">
                <h4>Oficina Principal</h4>
                <p>Santo Domingo, Distrito Nacional, República Dominicana</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </div>
            <div class="contact-details">
                <h4>Correo Electrónico</h4>
                <p>contacto@demetrionunez.com</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22h20"></path><path d="M4 22V11"></path><path d="M10 22V11"></path><path d="M14 22V11"></path><path d="M20 22V11"></path><path d="M12 2L2 11h20L12 2z"></path></svg>
            </div>
            <div class="contact-details">
                <h4>Actividades Electorales</h4>
                <p>Delegación ante la Junta Electoral del Distrito Nacional</p>
            </div>
        </div>

        <!-- Mapa Interactivo Mock (Fidelidad Premium) -->
        <div class="map-mock">
            <div class="map-grid-lines"></div>
            <div class="map-mock-island"></div>
            <div class="map-pulse-marker">
                <div class="map-pulse-dot"></div>
                <div class="map-marker-label">Santo Domingo, Distrito Nacional</div>
            </div>
        </div>
    </div>

    <!-- Formulario de Envío -->
    <div class="contact-card animate-on-scroll delay-2" style="padding: 45px;">
        <h3>Envía un mensaje</h3>
        
        <!-- Alertas de Envío -->
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <span>✓</span> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <span>⚠</span> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>index.php?url=contact/submit" method="POST">
            <div class="form-group">
                <label for="name">Nombre Completo *</label>
                <input type="text" id="name" name="name" required placeholder="Ingresa tu nombre y apellido">
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico *</label>
                <input type="email" id="email" name="email" required placeholder="tucorreo@ejemplo.com">
            </div>

            <div class="form-group">
                <label for="subject">Asunto</label>
                <input type="text" id="subject" name="subject" placeholder="Tema de tu consulta">
            </div>

            <div class="form-group">
                <label for="message">Mensaje *</label>
                <textarea id="message" name="message" required placeholder="Detalla tu consulta o mensaje legal aquí..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; font-size:1rem; padding: 14px 20px;">
                Enviar Mensaje
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 5px;"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
            </button>
        </form>
    </div>
</div>
