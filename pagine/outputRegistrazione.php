<?php 
include_once '../classi/Utente.php';
session_start();
$_SESSION["utenteLoggato"] = false;

$nome=$_POST["nome"];
$cognome=$_POST["cognome"];
$email=$_POST["email"];
$password=$_POST["password"];
$indirizzo=$_POST["indirizzo"];
$citta=$_POST["citta"];
$CAP=$_POST["CAP"];
$nCivico=$_POST["nCivico"];
$dataDiNascita=$_POST["dataDiNascita"];

$utente = new Utente($nome,$cognome,$email,$citta,$nCivico,$CAP,$indirizzo,$dataDiNascita,$password);

if ($utente->registrazione()) {
    echo "funziona";
    $_SESSION["utenteLoggato"] = true;
    $_SESSION["registrazione"] = false;
    header('Location: ../index.php');
}else{
    header('Location: registrazione.php');
    $_SESSION["erroreRegistrazione"] = true;
}


?>