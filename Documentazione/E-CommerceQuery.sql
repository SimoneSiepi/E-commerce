CREATE DATABASE IF NOT EXISTS E_commerce;

USE E_commerce;

CREATE TABLE IF NOT EXISTS utenti (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    cognome VARCHAR(60) NOT NULL,
    email VARCHAR(75) NOT NULL UNIQUE,
    citta VARCHAR(75) NOT NULL,
    nCivico INT(5) NOT NULL,
    CAP INT(27) NOT NULL,
    indirizzo VARCHAR(75) NOT NULL,
    dataDiNascita DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS credenziali (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    passwird VARCHAR(30) NOT NULL,
    id_utente INT,
	 FOREIGN KEY (id_utente) REFERENCES utenti(id)
);

CREATE TABLE IF NOT EXISTS ruoli (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_utente INT,
    amministratore BOOLEAN NOT NULL,
	 FOREIGN KEY (id_utente) REFERENCES utenti(id)
);

CREATE TABLE IF NOT EXISTS carrelli (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_utente INT(12) NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES utenti(id)
);

CREATE TABLE IF NOT EXISTS produttori (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome_azienda VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS prodotti (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255),
    prezzo DECIMAL(10, 2),
    descrizione TEXT,
    id_produttore INT(12),
    FOREIGN KEY (id_produttore) REFERENCES produttori(id)
);

CREATE TABLE IF NOT EXISTS immagini (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    percorso VARCHAR(255),
    id_prodotto INT(12),
    FOREIGN KEY (id_prodotto) REFERENCES prodotti(id)
);

CREATE TABLE IF NOT EXISTS carrello_Prodotti (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    quantitaProdotto DECIMAL(10, 2),
    id_carrello INT(12),
    id_prodotto INT(12),
    FOREIGN KEY (id_carrello) REFERENCES carrelli(id),
    FOREIGN KEY (id_prodotto) REFERENCES prodotti(id)
);

CREATE TABLE IF NOT EXISTS ordini (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    dataAcquisto DATE,
    costoTotale DECIMAL(10, 2),
    id_utente INT(12),
    id_carrello INT(12),
    FOREIGN KEY (id_carrello) REFERENCES carrelli(id)
);

CREATE TABLE IF NOT EXISTS recensioni (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titolo VARCHAR(255),
    voto INT(5),
    commento TEXT,
    id_utente INT(12),
    id_prodotto INT(12),
    FOREIGN KEY (id_utente) REFERENCES utenti(id),
    FOREIGN KEY (id_prodotto) REFERENCES prodotti(id)
);

CREATE TABLE IF NOT EXISTS categorie (
    nome VARCHAR(255) PRIMARY KEY NOT NULL,
    path_img VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS categoria_Prodotti (
    id INT(12) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_prodotto INT(12) NOT NULL,
    categoria VARCHAR(255),
    FOREIGN KEY (id_prodotto) REFERENCES prodotti(id),
    FOREIGN KEY (categoria) REFERENCES categorie(nome)
);

CREATE TABLE IF NOT EXISTS dettagli_Ordini (
    id_prodotto INT(12) NOT NULL,
    id_ordine INT(12),
    qta INT(255),
    FOREIGN KEY (id_prodotto) REFERENCES prodotti(id),
    FOREIGN KEY (id_ordine) REFERENCES ordini(id)
);


