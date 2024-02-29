<?php 
include_once '../classi/Utente.php';
session_start();
$_SESSION["utenteLoggato"] = false;

$indirizzo = [
    "indirizzo" => $_POST["indirizzo"],
    "citta" => $_POST["citta"],
    "CAP" => $_POST["CAP"]
];

// Salvare l'array associativo nella sessione
$_SESSION["indirizzo"] = $indirizzo;

$utente = new Utente($_POST["nome"],$_POST["cognome"],$_POST["email"],$_POST["citta"],$_POST["CAP"],$_POST["indirizzo"],$_POST["dataDiNascita"],$_POST["password"]);

if ($utente->registrazione()) {
    echo "funziona";
    $_SESSION["utenteLoggato"] = true;
    $_SESSION["registrazione"] = false;
    $_SESSION["utente"] = $email;
    //$_SESSION["utente"] = $email;
    header('Location: ../index.php');
}else{
    header('Location: registrazione.php');
    $_SESSION["erroreRegistrazione"] = true;
}

?>