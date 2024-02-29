<?php
session_start();
include_once '../classi/Prodotto.php';
$prodotto = new Prodotto();
$selectedCategory = isset($_GET['categoria']) ? $_GET['categoria'] : 'tutti';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>catalogo</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="../public/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</head>

<body>

    <!-- header -->
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap" xmlns="http://www.w3.org/2000/svg">
                        <img src="./public/img/house-solid.svg" alt="">
                    </svg>
                </a>



                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="../index.php" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="./catalogo.php" class="nav-link px-2 text-white">Catalogo</a></li>
                </ul>

                <div class="text-end">
                    <?php
                    // Controlla se l'utente è loggato
                    if (isset($_SESSION['utenteLoggato']) && $_SESSION['utenteLoggato'] === true) {
                        echo '<a href="./logOut.php" class="btn btn-outline-light me-2">Log-out</a>';
                    } else {
                        echo '<a href="./pagine/login.php" class="btn btn-outline-light me-2">Login</a>';
                        echo '<a href="./pagine/registrazione.php" class="btn btn-warning">Sign-up</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>


    <!-- main -->
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">scopri la nostra vasta gamma di prodotti</h1>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <div class="btn-group">
                    <a href="?categoria=tutti" class="btn btn-outline-primary <?php echo ($selectedCategory == 'tutti') ? 'active' : ''; ?>">Tutti</a>
                    <a href="?categoria=salotto" class="btn btn-outline-primary <?php echo ($selectedCategory == 'salotto') ? 'active' : ''; ?>">Salotto</a>
                    <a href="?categoria=cucina" class="btn btn-outline-primary <?php echo ($selectedCategory == 'cucina') ? 'active' : ''; ?>">Cucina</a>
                    <a href="?categoria=bagno" class="btn btn-outline-primary <?php echo ($selectedCategory == 'bagno') ? 'active' : ''; ?>">Bagno</a>
                        <!-- Aggiungi più bottoni per ogni categoria -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista dinamica di prodotti dal database -->
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    $prodotti= $prodotto->getPrdottiConCategoria($selectedCategory);
                    //print_r($prodotti);
                    // Loop attraverso i risultati della query e crea le card
                    foreach($prodotti as $row) {
                        echo '<div class="col ' . $row['nome_categoria'] . '">';
                        echo '<div class="card shadow-sm">';
                        echo '<img src="' . $row['percorso'] . '" class="bd-placeholder-img card-img-top" width="100%" height="225">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['nome'] . '</h5>';
                        echo '<p class="card-text">' . $row['descrizione'] . '</p>';
                        echo '<div class="d-flex justify-content-between align-items-center">';
                        echo '<div class="btn-group">';
                        echo '<a href="./dettagliProdotto.php?id=' . $row['id'] . '"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>';
                        echo '</div>';
                        echo '<p class="text-body-secondary">'.number_format($row['prezzo'], 2) .'</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

    </main>
</body>

</html>