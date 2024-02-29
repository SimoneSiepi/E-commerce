<?php
require_once 'Database.php';
class Utente
{
    private $id;
    private $nome;
    private $cognome;
    private $email;
    private $citta;
    private $CAP;
    private $indirizzo;
    private $dataDiNascita;
    private $passwird;

    public function __construct($nome = '', $cognome = '', $email = '', $citta = '', $CAP = '', $indirizzo = '', $dataDiNascita = '', $passwird = '') {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->citta = $citta;
        $this->CAP = $CAP;
        $this->indirizzo = $indirizzo;
        $this->dataDiNascita = $dataDiNascita;
        $this->passwird = $passwird;
    }//in questo modo i valori sono opzionali e percio non devo per forza settarli. fa da costruttore vuoto


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
            echo "Impossibile settare la proprietà " . $prop. " ps: e' il set di utente";
        }
    }

    // Metodo privato per il controllo dell'email
    private function controlloEmail($email)
    {
        $db = new Database();
        $conn = $db->getConn();

        // Prepara la query per cercare l'email nella tabella degli utenti
        $query = "SELECT COUNT(*) AS count FROM utenti WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Ottieni il risultato
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Chiudi la connessione al database
        $db->chiudiConnessione();

        // Restituisci true se l'email non esiste, false altrimenti
        return ($result['count'] == 0);
    }

    // Metodo per la registrazione di un utente
    public function registrazione(){
        $controllo = false;

        $db = new Database();
        $conn = $db->getConn();

        if ($this->controlloEmail($this->email)) {
            // Inserisci l'utente nella tabella utenti
            $queryUtenti = "INSERT INTO utenti (nome, cognome, email, citta, CAP, indirizzo, dataDiNascita) 
                VALUES (:nome, :cognome, :email, :citta, :CAP, :indirizzo, :dataDiNascita)";
            $stmtUtenti = $conn->prepare($queryUtenti);

            // Associa i parametri della query ai valori dell'utente
            $stmtUtenti->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $stmtUtenti->bindParam(':cognome', $this->cognome, PDO::PARAM_STR);
            $stmtUtenti->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmtUtenti->bindParam(':citta', $this->citta, PDO::PARAM_STR);
            $stmtUtenti->bindParam(':CAP', $this->CAP, PDO::PARAM_INT);
            $stmtUtenti->bindParam(':indirizzo', $this->indirizzo, PDO::PARAM_STR);
            $stmtUtenti->bindParam(':dataDiNascita', $this->dataDiNascita, PDO::PARAM_STR);

            $stmtUtenti->execute();

            // Ottieni l'id dell'utente appena inserito
            $this->id = $conn->lastInsertId();

            // Inserisci le credenziali nella tabella credenziali
            $hashedPassword = password_hash($this->passwird, PASSWORD_DEFAULT);
            $queryCredenziali = "INSERT INTO credenziali (passwird, id_utente) VALUES (:passwird, :id_utente)";
            $stmtCredenziali = $conn->prepare($queryCredenziali);

            // Associa i parametri della query alle credenziali
            $stmtCredenziali->bindParam(':passwird', $hashedPassword, PDO::PARAM_STR);
            $stmtCredenziali->bindParam(':id_utente', $this->id, PDO::PARAM_INT);

            $stmtCredenziali->execute();

            $controllo = true;
        }
        // Chiudi la connessione al database
        $db->chiudiConnessione();

        return $controllo;
    }

    // Metodo per il controllo del login di un utente
    public function controlloUtente($email, $password){
        $controllo = false;
        if (!$this->controlloEmail($email)) {
            $db = new Database();
            $conn = $db->getConn();
    
            try {
                // Prepara la query per cercare l'utente con l'email corrispondente
                $query = "SELECT u.*, c.passwird 
                  FROM utenti u 
                  INNER JOIN credenziali c ON u.id = c.id_utente 
                  WHERE u.email = :email";
    
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
    
                // Ottieni il risultato
                $utente = $stmt->fetch(PDO::FETCH_ASSOC);
    
                // Chiudi la connessione al database
                $db->chiudiConnessione();

                //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                // Verifica se l'utente esiste e la password è corretta
                if ($utente && password_verify($password, $utente["passwird"])) {
                    $controllo=true;  // Utente e password corretti 
                } /* else {
                    //echo $password."\n\nla password hashata\n\n". $hashedPassword. "\n\n\password inserita dall'utente hashata\n\n". $utente['passwird'];
                    //echo "non funza ";
                    $controllo = false;
                } */
            } catch (PDOException $e) {
                echo "Errore durante il recupero dell'utente: " . $e->getMessage();
                return false;
            }
        }
    
        return $controllo;  // Utente non esiste o password errata
    }

    //metodo per ottenere un utetne dalla email
    public function getUtente($email){
        $db = new Database;
        $conn = $db->getConn();

        $query = "SELECT * FROM utenti WHERE utenti.email = :email;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $utente = $stmt->fetch(PDO::FETCH_ASSOC);

        return $utente;

    }

}
