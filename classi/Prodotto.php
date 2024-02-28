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


    public function getPrdottiConCategoria(){
        $db = new Database();
        $conn = $db->getConn();

        $query = "SELECT p.*, c.nome_categoria, i.percorso
        FROM prodotti p
        INNER JOIN categoria_Prodotti cp ON p.id = cp.id_prodotto
        INNER JOIN categorie c ON cp.categoria = c.nome_categoria
        INNER JOIN immagini i ON p.id = i.id_prodotto;";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $db->chiudiConnessione();

        return $result;
    }
}
