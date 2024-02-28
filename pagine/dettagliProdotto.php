<?php 
include_once '../classi/Prodotto.php';

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodotto</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <script src="../public/bootstrap-5.3.2-dist/js/bootstrap.bundle.js"></script>
</head>
<body>
<main>
  <div class="container py-4">

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <!-- Carousel with product image -->
        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <img src="">
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <!-- Product details on the right side -->
        <div class="h-100 p-5 bg-body-tertiary rounded-3">
          <h2 class="display-5 fw-bold">Product Title</h2>
          <p class="col-md-8 fs-4">Product Description. Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
          <p class="fs-5">$99.99</p>
          <button class="btn btn-primary btn-lg" type="button">Buy Now</button>
        </div>
      </div>
    </div>

  </div>
</main>
</body>
</html>
