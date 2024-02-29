<?php 
session_start();
include_once "../classi/Ordine.php";
include_once "../classi/Utente.php";

$quantita = $_POST["quantita"];
$idProdotto = $_POST["idProdotto"];
$prezzoTotale = $_POST["prezzoTotale"];

date_default_timezone_set('Europe/Rome');
// Ottieni la data corrente nel formato desiderato
$dataOggi = date('Y-m-d');
$user = new Utente();
$dettagliUser = $user->getUtente($_SESSION["utente"]);
$ordine = new Ordine($dataOggi,$prezzoTotale,$dettagliUser['id']);

$ordine->inserisciOrdine($idProdotto,$quantita);

header('Location: ./ordini.php');

?>