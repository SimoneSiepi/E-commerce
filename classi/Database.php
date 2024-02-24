<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "e_commerce";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Errore di connessione al database: " . $e->getMessage();
        }
    }

    public function getConn() {
        return $this->conn;
    }

    public function chiudiConnessione() {
        $this->conn = null;  // Chiudi la connessione
    }
}

?>