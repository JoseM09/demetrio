-- Script SQL para la base de datos demetrio_blog

CREATE DATABASE IF NOT EXISTS `demetrio_blog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `demetrio_blog`;

-- 1. Tabla de Usuarios (Administradores)
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `name` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabla de Publicaciones (Posts)
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `content` TEXT NOT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `category` VARCHAR(100) NOT NULL DEFAULT 'Análisis Político',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabla de Mensajes de Contacto
CREATE TABLE IF NOT EXISTS `messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar usuario administrador por defecto (admin / admin123)
INSERT INTO `users` (`username`, `password`, `email`, `name`) VALUES
('admin', '$2y$10$VMVtkBME5VFfdZploihEx.2Ae.xA6O7TBP07TlBXTKCL9OQBvIwW2', 'admin@demetrionunez.com', 'Dr. Demetrio Núñez')
ON DUPLICATE KEY UPDATE `username` = `username`;

-- Insertar publicaciones iniciales de demostración
INSERT INTO `posts` (`title`, `slug`, `content`, `image`, `category`, `created_at`) VALUES
('El Rol de la Justicia Electoral en la Democracia Dominicana', 'rol-justicia-electoral-democracia-dominicana', 'La justicia electoral es la garantía primordial de que la voluntad soberana del pueblo dominicano sea respetada en cada certamen electoral. En los últimos años, la República Dominicana ha transitado por reformas legales importantes que fortalecen la institucionalidad de nuestras juntas electorales y del Tribunal Superior Electoral. Como delegados y profesionales del derecho, nuestro mayor compromiso es velar por la transparencia, la equidad del proceso y el cumplimiento de las normativas de partidos políticos. Una democracia madura no solo se mide por la cantidad de votantes, sino por la fortaleza de las instituciones encargadas de arbitrar y validar sus decisiones.', NULL, 'Análisis Político', '2026-06-10 10:00:00'),
('Derecho Inmobiliario y Seguridad Jurídica en el Desarrollo Urbano', 'derecho-inmobiliario-seguridad-juridica-desarrollo', 'El sector inmobiliario es uno de los motores más dinámicos de la economía dominicana, pero su crecimiento sostenible depende directamente de la seguridad jurídica que nuestro marco legal pueda ofrecer. Desde la Ley de Registro Inmobiliario de nuestro país, se han logrado avances significativos en la digitalización, depuración y agilización de los trámites de deslinde, transferencia de títulos y constitución de condominios. No obstante, persisten retos estructurales. Analizar las jurisprudencias recientes y capacitar a los profesionales del área es vital para evitar conflictos de propiedad y asegurar las inversiones nacionales y extranjeras.', NULL, 'Análisis Político', '2026-06-12 14:30:00'),
('La Participación Política de la Juventud en el Siglo XXI', 'participacion-politica-juventud-siglo-xxi', 'Hoy más que nunca, los jóvenes dominicanos tienen un papel crucial en la redefinición del panorama político. A través del movimiento "La Fuerza del Pueblo", hemos visto un renacer del interés de las nuevas generaciones por integrarse a la toma de decisiones estatales. La política no debe verse como un espacio ajeno o de confrontación estéril, sino como la plataforma idónea para plantear soluciones a los problemas del empleo juvenil, la educación técnica y el cambio climático. Invito a la juventud a formarse, a debatir con altura y a ocupar los liderazgos locales con propuestas frescas e innovadoras.', NULL, 'Análisis Político', '2026-06-14 09:15:00'),
('Consolidación y Crecimiento: Nuevos Liderazgos se Suman a la Fuerza del Pueblo', 'consolidacion-y-crecimiento-nuevos-liderazgos-fuerza-del-pueblo', 'La Fuerza del Pueblo continúa su proceso de expansión y consolidación orgánica con la incorporación de nuevos compañeros comprometidos con el desarrollo institucional y democrático de la República Dominicana. Sostuvimos una productiva reunión de trabajo con este destacado grupo de profesionales que hoy formalizan su ingreso a nuestra organización política. Durante el encuentro, compartimos visiones sobre los desafíos nacionales actuales y la importancia de construir una alternativa sólida que represente los anhelos de progreso del pueblo dominicano. La integración de estos nuevos cuadros fortalece nuestra estructura y reafirma el papel protagónico del partido como motor de cambio social en el país. ¡Bienvenidos a este gran esfuerzo colectivo por la patria!', 'fuerza-pueblo-nuevos-companeros.jpg', 'Actividad Política', '2026-06-22 11:00:00'),
('Estrategia Digital y Democracia: Participación en el Curso Taller Internacional sobre Redes Sociales y Política', 'estrategia-digital-democracia-curso-taller-redes-sociales-politica', 'La comunicación política ha experimentado una transformación irreversible en la era digital. Tuvimos el honor de participar en el Curso Taller Internacional sobre Redes Sociales y Política, celebrado en el polo turístico de Punta Cana, República Dominicana. Este evento internacional reunió a consultores, estrategas y líderes de toda América Latina para analizar el impacto de las plataformas digitales en la movilización ciudadana, la transparencia electoral y el debate democrático. En un contexto donde la desinformación representa una amenaza real, capacitarse en el uso ético y efectivo de las redes sociales es fundamental para conectar de manera genuina con los ciudadanos y construir discursos que fortalezcan la confianza en las instituciones políticas.', 'taller-redes-sociales-politica.jpg', 'Capacitación', '2026-06-22 11:15:00'),
('Fortalecimiento de Lazos Institucionales: Encuentro con el Cónsul de Francia en la República Dominicana', 'fortalecimiento-lazos-institucionales-encuentro-consul-francia', 'Sostuvimos un grato y fructífero encuentro de cortesía y trabajo con el Honorable Cónsul de Francia en la República Dominicana. Durante esta reunión protocolar, tuvimos la oportunidad de dialogar sobre temas de interés común para ambas naciones, destacando la cooperación bilateral en materia jurídica, el intercambio cultural y las relaciones históricas que unen a la República Dominicana con la República Francesa. Conversamos ampliamente sobre la importancia de promover sinergias internacionales que beneficien el desarrollo social e institucional dominicano. Agradecemos la receptividad y la calidez del cónsul, reiterando nuestro compromiso de seguir propiciando espacios de diálogo constructivo con representantes del cuerpo diplomático acreditado en el país.', 'reunion-consul-francia-rd.jpg', 'Relaciones Internacionales', '2026-06-22 11:30:00'),
('Democracia y Desarrollo: Reflexiones desde la Cumbre Internacional de Partidos Políticos', 'democracia-y-desarrollo-reflexiones-cumbre-internacional-partidos', 'Participamos en la Cumbre Internacional sobre Democracia y Desarrollo en los Partidos Políticos, un espacio de alto nivel diseñado para debatir el futuro de la representación democrática y el rol de las organizaciones partidarias en el desarrollo sostenible. El evento abordó los retos de la gobernabilidad democrática en el siglo XXI, el financiamiento político, la equidad de género y la renovación doctrinaria frente a las nuevas demandas ciudadanas. Compartir paneles y reflexiones con destacados intelectuales y líderes políticos del continente nos permite reafirmar la necesidad de contar con partidos modernos, transparentes y conectados con la realidad nacional. Solo a través de la institucionalidad partidaria sólida se pueden impulsar los proyectos de desarrollo a largo plazo que demandan nuestras sociedades.', 'cumbre-democracia-partidos-politicos.jpg', 'Análisis Político', '2026-06-22 11:45:00'),
('Especialización en Justicia Electoral: Graduación en Administración de Procesos y Garantías Democráticas', 'especializacion-justicia-electoral-graduacion-administracion', 'La culminación de un proceso de formación académica siempre es un hito de gran relevancia, especialmente cuando está al servicio de la democracia. Recibimos con gran honor el diploma que acredita la finalización del programa de especialización en Administración de Justicia Electoral, impartido bajo los más altos estándares académicos. En este acto formal de graduación, reafirmamos el compromiso ético y profesional de aplicar las herramientas del derecho para garantizar la transparencia, el debido proceso y la equidad en cada contienda electoral. Fortalecer el conocimiento en justicia electoral es indispensable para blindar la voluntad popular expresada en las urnas y asegurar la paz social del pueblo dominicano. Agradecemos a los docentes e instituciones que hicieron posible esta valiosa capacitación.', 'graduacion-justicia-electoral.jpg', 'Justicia Electoral', '2026-06-22 12:00:00')
ON DUPLICATE KEY UPDATE `slug` = `slug`;
