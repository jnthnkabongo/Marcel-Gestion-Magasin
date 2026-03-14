-- Structure de la base de données gestion_materiel
-- Généré le 14/03/2026

-- Table: users
CREATE TABLE `users` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    `remember_token` varchar(100) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `role_id` bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`),
    KEY `users_role_id_foreign` (`role_id`),
    CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: roles
CREATE TABLE `roles` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: categories
CREATE TABLE `categories` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: marques
CREATE TABLE `marques` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `description` varchar(255) DEFAULT NULL,
    `logo` varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: produits
CREATE TABLE `produits` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `categorie_id` bigint(20) unsigned NOT NULL,
    `marque_id` bigint(20) unsigned NOT NULL,
    `modele` varchar(255) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `prix_achat` decimal(10,2) NOT NULL,
    `prix_vente` decimal(10,2) NOT NULL,
    `stock_min` int(11) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `produits_categorie_id_foreign` (`categorie_id`),
    KEY `produits_marque_id_foreign` (`marque_id`),
    CONSTRAINT `produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
    CONSTRAINT `produits_marque_id_foreign` FOREIGN KEY (`marque_id`) REFERENCES `marques` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: produit_unites
CREATE TABLE `produit_unites` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `produit_id` bigint(20) unsigned NOT NULL,
    `numero_serie` varchar(150) NOT NULL,
    `quantite` varchar(100) DEFAULT NULL,
    `statut` enum('en_stock','vendu','defectueux') NOT NULL DEFAULT 'en_stock',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `produit_unites_numero_serie_unique` (`numero_serie`),
    KEY `produit_unites_produit_id_foreign` (`produit_id`),
    CONSTRAINT `produit_unites_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: fournisseurs
CREATE TABLE `fournisseurs` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `contact` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `telephone` varchar(20) DEFAULT NULL,
    `adresse` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: approvisionnements
CREATE TABLE `approvisionnements` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `fournisseur_id` bigint(20) unsigned NOT NULL,
    `date_approvisionnement` date NOT NULL,
    `reference` varchar(255) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `approvisionnements_fournisseur_id_foreign` (`fournisseur_id`),
    CONSTRAINT `approvisionnements_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: approvisionnement_details
CREATE TABLE `approvisionnement_details` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `approvisionnement_id` bigint(20) unsigned NOT NULL,
    `produit_id` bigint(20) unsigned NOT NULL,
    `quantite` int(11) NOT NULL,
    `prix_unitaire` decimal(10,2) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `approvisionnement_details_approvisionnement_id_foreign` (`approvisionnement_id`),
    KEY `approvisionnement_details_produit_id_foreign` (`produit_id`),
    CONSTRAINT `approvisionnement_details_approvisionnement_id_foreign` FOREIGN KEY (`approvisionnement_id`) REFERENCES `approvisionnements` (`id`) ON DELETE CASCADE,
    CONSTRAINT `approvisionnement_details_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: ventes
CREATE TABLE `ventes` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `client_id` bigint(20) unsigned NOT NULL,
    `date_vente` date NOT NULL,
    `reference` varchar(255) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `ventes_client_id_foreign` (`client_id`),
    CONSTRAINT `ventes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: vente_details
CREATE TABLE `vente_details` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `vente_id` bigint(20) unsigned NOT NULL,
    `produit_unite_id` bigint(20) unsigned NOT NULL,
    `prix_vente` decimal(10,2) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `vente_details_vente_id_foreign` (`vente_id`),
    KEY `vente_details_produit_unite_id_foreign` (`produit_unite_id`),
    CONSTRAINT `vente_details_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON DELETE CASCADE,
    CONSTRAINT `vente_details_produit_unite_id_foreign` FOREIGN KEY (`produit_unite_id`) REFERENCES `produit_unites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: garanties
CREATE TABLE `garanties` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `produit_unite_id` bigint(20) unsigned NOT NULL,
    `date_debut` date NOT NULL,
    `date_fin` date NOT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `garanties_produit_unite_id_foreign` (`produit_unite_id`),
    CONSTRAINT `garanties_produit_unite_id_foreign` FOREIGN KEY (`produit_unite_id`) REFERENCES `produit_unites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: historiques
CREATE TABLE `historiques` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` bigint(20) unsigned NOT NULL,
    `action` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `historiques_user_id_foreign` (`user_id`),
    CONSTRAINT `historiques_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: historique_actions
CREATE TABLE `historique_actions` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `icone` varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: password_resets
CREATE TABLE `password_resets` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `password_resets_email_index` (`email`),
    KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: clients
CREATE TABLE `clients` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `email` varchar(255) DEFAULT NULL,
    `telephone` varchar(20) DEFAULT NULL,
    `adresse` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: failed_jobs
CREATE TABLE `failed_jobs` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `uuid` varchar(255) NOT NULL,
    `connection` text NOT NULL,
    `queue` text NOT NULL,
    `payload` longtext NOT NULL,
    `exception` longtext NOT NULL,
    `failed_at` timestamp NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: migrations
CREATE TABLE `migrations` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) NOT NULL,
    `batch` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
