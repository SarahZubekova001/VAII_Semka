<?php
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyžiarske Strediská</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/subcategories.css" >
</head>
<body>

<div class="container-fluid mt-4">
    <h1 class="text-center mb-5">Lyžiarske Strediská v Zuberci</h1>

    <div class="row g-4">
        <!-- Spálená -->
        <div class="col-lg-6 col-md-6 col-12">
            <a href="<?= $link->url('home.spalena') ?>" class="image-box spalena d-block"></a>
            <h3 class="mt-3 text-center">Spálená - Západné Tatry</h3>
        </div>

        <!-- Janovky -->
        <div class="col-lg-6 col-md-6 col-12">
            <a href="janovky.html" class="image-box janovky d-block"></a>
            <h3 class="mt-3 text-center">Janovky - Západné Tatry</h3>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
