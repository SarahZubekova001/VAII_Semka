<?php
/** @var \App\Core\LinkGenerator $link */
if (!empty($_SESSION['debug'])) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin: 10px;'>";
    echo $_SESSION['debug'];
    echo "</div>";
    unset($_SESSION['debug']); // Vyčisti debug správy po zobrazení
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprievodca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/css/style.css" >

</head>
<body>



<div class="container">
    <a href="<?= $link->url('home.summer') ?>" class="section" id="summer">
        <div class="text-overlay"></div>
        <h2>LETO U NÁS</h2>
    </a>
    </a>
    <a href="<?= $link->url('home.winter') ?>" class="section" id="winter">
        <div class="text-overlay"></div>
        <h2>ZIMA U NÁS</h2>
    </a>
    <a href="<?= $link->url('restaurant.restaurants') ?>" class="section" id="food">
        <div class="text-overlay"></div>
        <h2>REŠTAURACIE</h2>
    </a>
    <a href="<?= $link->url('home.info') ?>" class="section" id="info">
        <div class="text-overlay"></div>
        <h2>INFO</h2>
    </a>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>