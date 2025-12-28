CREATE DATABASE paiement_db;
USE paiement_db;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(150)
);

CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    montant_total DECIMAL(10,2),
    statut ENUM('EN_ATTENTE_PAIEMENT','PAYEE'),
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE paiements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT,
    type_paiement ENUM('carte_bancaire','paypal','virement'),
    montant DECIMAL(10,2),
    statut ENUM('EN_ATTENTE','PAYE','ECHEC','REFUSE'),
    date_paiement DATETIME,
    FOREIGN KEY (commande_id) REFERENCES commandes(id)
);

CREATE TABLE carte_bancaire (
    paiement_id INT PRIMARY KEY,
    numero_carte VARCHAR(20),
    date_expiration VARCHAR(7),
    cvv VARCHAR(4),
    titulaire VARCHAR(100),
    FOREIGN KEY (paiement_id) REFERENCES paiements(id)
);

CREATE TABLE paypal (
    paiement_id INT PRIMARY KEY,
    email_paypal VARCHAR(150),
    FOREIGN KEY (paiement_id) REFERENCES paiements(id)
);

CREATE TABLE virement (
    paiement_id INT PRIMARY KEY,
    iban VARCHAR(34),
    banque VARCHAR(100),
    FOREIGN KEY (paiement_id) REFERENCES paiements(id)
);
