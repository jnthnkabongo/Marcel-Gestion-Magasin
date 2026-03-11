CREATE DATABASE gestion_magasin_informatique;
USE gestion_magasin_informatique;

-- =============================
-- TABLE ROLES
-- =============================
CREATE TABLE roles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) UNIQUE
);

-- =============================
-- TABLE USERS
-- =============================
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    role_id BIGINT,
    name VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- =============================
-- TABLE CLIENTS
-- =============================
CREATE TABLE clients (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150),
    telephone VARCHAR(50),
    email VARCHAR(150),
    adresse TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================
-- TABLE FOURNISSEURS
-- =============================
CREATE TABLE fournisseurs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150),
    telephone VARCHAR(50),
    email VARCHAR(150),
    adresse TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================
-- TABLE CATEGORIES
-- =============================
CREATE TABLE categories (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100)
);

-- =============================
-- TABLE MARQUES
-- =============================
CREATE TABLE marques (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100)
);

-- =============================
-- TABLE PRODUITS
-- =============================
CREATE TABLE produits (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150),
    categorie_id BIGINT,
    marque_id BIGINT,
    modele VARCHAR(100),
    description TEXT,
    prix_achat DECIMAL(10,2),
    prix_vente DECIMAL(10,2),
    stock_min INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (categorie_id) REFERENCES categories(id),
    FOREIGN KEY (marque_id) REFERENCES marques(id)
);

-- =============================
-- TABLE PRODUIT_UNITES
-- =============================
CREATE TABLE produit_unites (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    produit_id BIGINT,
    numero_serie VARCHAR(150) UNIQUE,
    statut ENUM('en_stock','vendu','defectueux') DEFAULT 'en_stock',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (produit_id) REFERENCES produits(id)
);

-- =============================
-- TABLE APPROVISIONNEMENTS
-- =============================
CREATE TABLE approvisionnements (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    fournisseur_id BIGINT,
    user_id BIGINT,
    date DATE,
    total DECIMAL(10,2),

    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =============================
-- TABLE APPROVISIONNEMENT_DETAILS
-- =============================
CREATE TABLE approvisionnement_details (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    approvisionnement_id BIGINT,
    produit_id BIGINT,
    quantite INT,
    prix_achat DECIMAL(10,2),

    FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnements(id),
    FOREIGN KEY (produit_id) REFERENCES produits(id)
);

-- =============================
-- TABLE VENTES
-- =============================
CREATE TABLE ventes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    client_id BIGINT,
    user_id BIGINT,
    date DATETIME,
    total DECIMAL(10,2),
    statut ENUM('paye','credit') DEFAULT 'paye',

    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =============================
-- TABLE VENTE_DETAILS
-- =============================
CREATE TABLE vente_details (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    vente_id BIGINT,
    produit_unite_id BIGINT,
    prix_unitaire DECIMAL(10,2),
    total DECIMAL(10,2),

    FOREIGN KEY (vente_id) REFERENCES ventes(id),
    FOREIGN KEY (produit_unite_id) REFERENCES produit_unites(id)
);

-- =============================
-- TABLE PAIEMENTS
-- =============================
CREATE TABLE paiements (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    vente_id BIGINT,
    montant DECIMAL(10,2),
    methode ENUM('cash','mobile_money','banque'),
    date DATETIME,

    FOREIGN KEY (vente_id) REFERENCES ventes(id)
);

-- =============================
-- TABLE GARANTIES
-- =============================
CREATE TABLE garanties (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    produit_unite_id BIGINT,
    client_id BIGINT,
    date_debut DATE,
    date_fin DATE,

    FOREIGN KEY (produit_unite_id) REFERENCES produit_unites(id),
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

-- =============================
-- TABLE HISTORIQUE_ACTIONS
-- =============================
CREATE TABLE historique_actions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    action VARCHAR(255),
    description TEXT,
    date DATETIME,

    FOREIGN KEY (user_id) REFERENCES users(id)
);