-- ====================================================
-- Tira Millas - Esquema de la base de datos
-- Generado el 2026-04-26
-- ====================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------
-- Tabla: users
-- ----------------------------------------------------
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- Tabla: regiones
-- ----------------------------------------------------
CREATE TABLE `regiones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_iso` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regiones_slug_unique` (`slug`),
  UNIQUE KEY `regiones_codigo_iso_unique` (`codigo_iso`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- Tabla: rutas
-- ----------------------------------------------------
CREATE TABLE `rutas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `region_id` bigint unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_larga` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` enum('naturaleza','cultura','gastronomia','patrimonio') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dificultad` enum('facil','moderada','exigente') COLLATE utf8mb4_unicode_ci NOT NULL,
  `distancia_km` decimal(6,2) NOT NULL,
  `duracion_min` smallint unsigned NOT NULL,
  `lat_inicio` decimal(10,7) NOT NULL,
  `lng_inicio` decimal(10,7) NOT NULL,
  `punto_inicio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `punto_fin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mejor_epoca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destacada` tinyint(1) NOT NULL DEFAULT '0',
  `imagen_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rutas_slug_unique` (`slug`),
  KEY `rutas_user_id_foreign` (`user_id`),
  KEY `rutas_region_id_foreign` (`region_id`),
  KEY `rutas_categoria_index` (`categoria`),
  KEY `rutas_destacada_index` (`destacada`),
  CONSTRAINT `rutas_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`),
  CONSTRAINT `rutas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- Tabla: puntos
-- ----------------------------------------------------
CREATE TABLE `puntos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `region_id` bigint unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` enum('monumento','mirador','museo','gastronomia','naturaleza','otro') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `imagen_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `puntos_slug_unique` (`slug`),
  KEY `puntos_user_id_foreign` (`user_id`),
  KEY `puntos_region_id_foreign` (`region_id`),
  KEY `puntos_categoria_index` (`categoria`),
  CONSTRAINT `puntos_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`),
  CONSTRAINT `puntos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- Tabla: negocios
-- ----------------------------------------------------
CREATE TABLE `negocios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `region_id` bigint unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` enum('alojamiento','restaurante','artesania','experiencia','transporte','otro') COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitio_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` enum('basico','pro','premium') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'basico',
  `verificado` tinyint(1) NOT NULL DEFAULT '0',
  `imagen_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `negocios_slug_unique` (`slug`),
  KEY `negocios_user_id_foreign` (`user_id`),
  KEY `negocios_region_id_foreign` (`region_id`),
  KEY `negocios_categoria_index` (`categoria`),
  KEY `negocios_verificado_index` (`verificado`),
  CONSTRAINT `negocios_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`),
  CONSTRAINT `negocios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- Tabla: ruta_punto
-- ----------------------------------------------------
CREATE TABLE `ruta_punto` (
  `ruta_id` bigint unsigned NOT NULL,
  `punto_id` bigint unsigned NOT NULL,
  `orden` smallint unsigned NOT NULL,
  `descripcion_paso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ruta_id`,`punto_id`),
  KEY `ruta_punto_punto_id_foreign` (`punto_id`),
  CONSTRAINT `ruta_punto_punto_id_foreign` FOREIGN KEY (`punto_id`) REFERENCES `puntos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ruta_punto_ruta_id_foreign` FOREIGN KEY (`ruta_id`) REFERENCES `rutas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- Tabla: reviews
-- ----------------------------------------------------
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `ruta_id` bigint unsigned NOT NULL,
  `puntuacion` tinyint unsigned NOT NULL,
  `cuerpo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_user_id_ruta_id_unique` (`user_id`,`ruta_id`),
  KEY `reviews_ruta_id_foreign` (`ruta_id`),
  CONSTRAINT `reviews_ruta_id_foreign` FOREIGN KEY (`ruta_id`) REFERENCES `rutas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------
-- Tabla: favoritos
-- ----------------------------------------------------
CREATE TABLE `favoritos` (
  `user_id` bigint unsigned NOT NULL,
  `favoritable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favoritable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`favoritable_id`,`favoritable_type`),
  KEY `favoritos_favoritable_type_favoritable_id_index` (`favoritable_type`,`favoritable_id`),
  CONSTRAINT `favoritos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
