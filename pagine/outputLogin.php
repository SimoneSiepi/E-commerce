<?php
session_start(); 
include_once '../classi/Utente.php';
$_SESSION["utenteLoggato"] = false;
$_SESSION["erroreLogin"] = false;
$email = $_POST["email"];
$password = $_POST["password"];

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $loginUtente = new Utente();

    try {
        if ($loginUtente->controlloUtente($email, $password)) {
            $_SESSION["utenteLoggato"] = true;
            //echo "Login riuscito!";
            $_SESSION["utente"] = $email;
            header('Location: ../index.php');
        } else {
            $_SESSION["erroreLogin"] = true;
            //echo "\nCredenziali errate!";
            // echo $email ." e". $password;
            header('Location: login.php');
        }
    } catch (Exception $e) {
        echo "Errore durante il login: " . $e->getMessage();
    }
} else {
    echo "Email e/o password mancanti!";
}
?>