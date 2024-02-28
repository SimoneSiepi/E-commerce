
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
