<?php
class Utente
{
    private $id;
    private $nome;
    private $cognome;
    private $email;
    private $citta;
    private $nCivico;
    private $CAP;
    private $indirizzo;
    private $dataDiNascita;

    public function __construct($id, $nome, $cognome, $email, $citta, $nCivico, $CAP, $indirizzo, $dataDiNascita)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->citta = $citta;
        $this->nCivico = $nCivico;
        $this->CAP = $CAP;
        $this->indirizzo = $indirizzo;
        $this->dataDiNascita = $dataDiNascita;
    }

    // getter e setter
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
            echo "impossibile settare la proprieta" . $prop;
        }
    }

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

    //metodo per la registrazione di un'utente
    public function registrazione()
    {
        $controllo = false;
        $db = new Database();
        $conn = $db->getConn();
        if ($this->controlloEmail($this->email)) {
            $query = "INSERT INTO utenti (nome, cognome, email, citta, nCivico, CAP, indirizzo, dataDiNascita) 
                VALUES (:nome, :cognome, :email, :citta, :nCivico, :CAP, :indirizzo, :dataDiNascita)";
            $stmt = $conn->prepare($query);

            // Associa i parametri della query ai valori dell'utente
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':cognome', $this->cognome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':citta', $this->citta, PDO::PARAM_STR);
            $stmt->bindParam(':nCivico', $this->nCivico, PDO::PARAM_INT);
            $stmt->bindParam(':CAP', $this->CAP, PDO::PARAM_INT);
            $stmt->bindParam(':indirizzo', $this->indirizzo, PDO::PARAM_STR);
            $stmt->bindParam(':dataDiNascita', $this->dataDiNascita, PDO::PARAM_STR);

            $successo = $stmt->execute();
            $db->chiudiConnessione();

            // Restituisci true se la registrazione è avvenuta con successo, false altrimenti
            return $controllo = true;
        } else {
            return $controllo;
        }
    }
}
