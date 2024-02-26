-- Inserimento utenti
INSERT INTO utenti (nome, cognome, email, citta, nCivico, CAP, indirizzo, dataDiNascita) 
VALUES 
    ('Mario', 'Rossi', 'mario.rossi@example.com', 'Roma', 123, 00123, 'Via Roma 1', '1990-01-01'),
    ('Giulia', 'Verdi', 'giulia.verdi@example.com', 'Milano', 456, 20145, 'Via Milano 2', '1985-05-15');

-- Inserimento credenziali
INSERT INTO credenziali (passwird, id_utente) 
VALUES 
    ('password123', 1),
    ('segreto456', 2);

-- Inserimento ruoli
INSERT INTO ruoli (id_utente, amministratore) 
VALUES 
    (1, 1),
    (2, 0);

-- Inserimento produttori
INSERT INTO produttori (nome_azienda)
VALUES 
    ('LavabiProduction'),
    ('Divanichequalita');

-- Inserimento prodotti
INSERT INTO prodotti (nome, prezzo, descrizione, id_produttore)
VALUES 
    ('lavaboBello', 299.99, 'un lavabo molto bello', 1),
    ('divanoBello', 399.99, 'un divano molto comodo e bello', 2);

-- Inserimento immagini
INSERT INTO immagini (percorso, id_prodotto)
VALUES 
    ('public/img/prodotti/lavaboBello.jpeg', 1),
    ('public/img/prodotti/divanoBello.jpeg', 2);

-- Inserimento categorie
INSERT INTO categorie (nome, path_img)
VALUES 
    ('cucina', 'public/img/categorie/cucina.jpg'),
    ('salotto', 'public/img/categorie/salotto.jpg');

-- Associazione prodotti alle categorie
INSERT INTO categoria_Prodotti (id_prodotto, categoria)
VALUES 
    (1, 'cucina'),
    (2, 'salotto');
