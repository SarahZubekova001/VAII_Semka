<?php
/** @var \App\Core\LinkGenerator $link */
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprievodca obcou Zuberec</title>
    <link rel="stylesheet" href="../../../public/css/uvod.css">
</head>
<body>

<div class="content">
    <div class="top-content">
        <h1>Vitajte na stránke</h1>
        <h1>Sprievodca obcou Zuberec</h1>
    </div>

    <div class="bottom-content">
        <p>Chcete zistiť, čo všetko sa nachádza v našej krásnej dedine? Preskúmajte zaujímavosti, históriu a miesta, ktoré stojí za to navštíviť.</p>

        <div class="cta">
            <a href="<?= htmlspecialchars($link->url('home.home')) ?>">Klikni tu</a>
        </div>
    </div>
</div>

</body>
</html>
