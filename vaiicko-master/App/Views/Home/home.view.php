<?php
/** @var \App\Core\LinkGenerator $link */
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprievodca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>

<div class="container">
    <a href="<?= htmlspecialchars($link->url('home.summer')) ?>" class="section" id="summer">
        <div class="text-overlay"></div>
        <h2>LETO U NÁS</h2>
    </a>
    <a href="<?= htmlspecialchars($link->url('home.winter')) ?>" class="section" id="winter">
        <div class="text-overlay"></div>
        <h2>ZIMA U NÁS</h2>
    </a>
    <a href="<?= htmlspecialchars($link->url('restaurant.restaurants')) ?>" class="section" id="food">
        <div class="text-overlay"></div>
        <h2>REŠTAURÁCIE</h2>
    </a>
    <a href="<?= htmlspecialchars($link->url('home.info')) ?>" class="section" id="info">
        <div class="text-overlay"></div>
        <h2>INFO</h2>
    </a>
</div>

</body>
</html>
