<?php
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zimné Aktivity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>

<div class="container">
    <a href="<?= htmlspecialchars($link->url('post.activity', ['season' => 'zima'])) ?>" class="section" id="aktivity">
        <div class="text-overlay"></div>
        <h2>AKTIVITY</h2>
    </a>
    <a href="<?= htmlspecialchars($link->url('post.relax', ['season' => 'zima'])) ?>" class="section" id="relax">
        <div class="text-overlay"></div>
        <h2>RELAX</h2>
    </a>
    <a href="<?= htmlspecialchars($link->url('post.sport', ['season' => 'zima'])) ?>" class="section" id="sport">
        <div class="text-overlay"></div>
        <h2>ŠPORT</h2>
    </a>
</div>

</body>
</html>
