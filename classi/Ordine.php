<?php
require_once "Database.php";
class Ordine
{
    private $dataAcquisto;
    private $costoTotale;
    private $idUtente;
    //private $idCarrello;

    public function __construct($dataAcquisto = "", $costoTotale = "", $idUtente = "")
    {
        $this->dataAcquisto = $dataAcquisto;
        $this->costoTotale = $costoTotale;
        $this->idUtente = $idUtente;
        //$this->idCarrello = $idCarrello;
    }

    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        } else {
            return null;
        }
    }

    public function __set($prop, $value)
    {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        } else {
            echo "Impossibile settare la proprietà " . $prop . " ps: e' il set di utente";
        }
    }


    public function inserisciOrdine($idProdotto, $qta)
    {
        $db = new Database;
        $conn = $db->getConn();

        $sql = "INSERT INTO ordini (dataAcquisto, costoTotale, id_utente) 
        VALUES (:dataAcquisto, :costoTotale, :idUtente)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':dataAcquisto', $this->dataAcquisto, PDO::PARAM_STR);
        $stmt->bindParam(':costoTotale', $this->costoTotale, PDO::PARAM_INT);
        $stmt->bindParam(':idUtente', $this->idUtente, PDO::PARAM_INT);
        //$stmt->bindParam(':idCarrello', $this->idCarrello);

        $stmt->execute();

        $idOrdine = $conn->lastInsertId();

        $sql2 = "INSERT INTO dettagli_Ordini (id_prodotto, id_ordine, qta) 
             VALUES (:idProdotto, :idOrdine, :qta)";
        $stmt2 = $conn->prepare($sql2);

        $stmt2->bindParam(':idProdotto', $idProdotto, PDO::PARAM_INT);
        $stmt2->bindParam(':idOrdine', $idOrdine, PDO::PARAM_INT);
        $stmt2->bindParam(':qta', $qta, PDO::PARAM_INT);

        $stmt2->execute();

        $db->chiudiConnessione();
    }

    //metodo per recuperare tutti gli ordini

    public function getOrdiniperUtente($idUtente)
    {
        $db = new Database;
        $conn = $db->getConn();
        $sql = "SELECT 
        prodotti.nome AS nome_prodotto,
        categorie.nome_categoria AS categoria,
        prodotti.prezzo AS prezzo_singolo,
        dettagli_ordini.qta,
        (prodotti.prezzo * dettagli_ordini.qta) AS prezzo_totale,
        ordini.dataAcquisto AS data_spedizione
        FROM 
        dettagli_ordini
        INNER JOIN 
        prodotti ON dettagli_ordini.id_prodotto = prodotti.id
        INNER JOIN 
        ordini ON dettagli_ordini.id_ordine = ordini.id
        INNER JOIN 
        categoria_Prodotti ON categoria_Prodotti.id_prodotto = prodotti.id
        INNER JOIN 
        categorie ON categoria_Prodotti.categoria = categorie.nome_categoria
        WHERE 
        ordini.id_utente = :idUtente;"; // Aggiungi questa clausola per filtrare gli ordini per utente
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':idUtente', $idUtente, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
