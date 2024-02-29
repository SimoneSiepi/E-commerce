<?php
require_once 'Database.php';

class Prodotto
{
    private $id;
    private $prezzo;
    private $descrzione;
    private $id_produttore;


    public function __construct($id = '', $prezzo = '', $descrzione = '', $id_produttore = '')
    {
        $this->id = $id;
        $this->prezzo = $prezzo;
        $this->descrzione = $descrzione;
        $this->id_produttore = $id_produttore;
    }

    // Getter e setter
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
            echo "Impossibile settare la proprietà " . $prop . " ps: e' il set di prodotto";
        }
    }


    public function getPrdottiConCategoria($categoria = 'tutti'){
        $db = new Database();
        $conn = $db->getConn();

        $query = "SELECT p.*, c.nome_categoria, i.percorso
        FROM prodotti p
        INNER JOIN categoria_Prodotti cp ON p.id = cp.id_prodotto
        INNER JOIN categorie c ON cp.categoria = c.nome_categoria
        INNER JOIN immagini i ON p.id = i.id_prodotto";
        if ($categoria !== 'tutti') {
            $query .= " WHERE c.nome_categoria = '$categoria'";
        }

        $query .= ";";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db->chiudiConnessione();

        return $result;
    }

    public function getDettagliProdotto($idProdotto){
        $db = new Database;
        $conn = $db->getConn();

        $query = "SELECT p.*, i.percorso
        FROM prodotti p
        INNER JOIN immagini i ON p.id=i.id_prodotto
        WHERE p.id = :id
        GROUP BY p.id;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $idProdotto, PDO::PARAM_INT);

        // Esecuzione della query
        $stmt->execute();

        // Recupero dei risultati
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;

    }
}
