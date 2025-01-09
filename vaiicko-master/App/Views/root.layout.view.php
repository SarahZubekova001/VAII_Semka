<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <script src="../../public/js/script.js?v=1223344"></script>
</head>
<body>

<nav class="navbar" style="background-color: #e3f2fd; position: relative;">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $link->url('home.index') ?>">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- Navigačné odkazy -->
                <div class="navbar-nav">
                    <a class="nav-link active" href="<?= $link->url('home.winter') ?>">Zima</a>
                    <a class="nav-link active" href="<?= $link->url('home.summer') ?>">Leto</a>
                    <a class="nav-link active" href="<?= $link->url('restaurant.restaurants') ?>">Reštaurácie</a>
                    <a class="nav-link active" href="<?= $link->url('home.info') ?>">Info</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Prihlásenie alebo Odhlásenie -->
    <?php if ($auth->isLogged()): ?>
        <a class="nav-link d-none d-lg-block position-absolute"
           href="<?= $link->url('auth.logout', ['redirect' => urlencode($_SERVER['REQUEST_URI'])]) ?>"
           style="right: 20px;">
            Odhlásenie
        </a>
    <?php else: ?>
        <a class="nav-link d-none d-lg-block position-absolute"
           href="<?= $link->url('auth.showLoginForm', ['redirect' => urlencode($_SERVER['REQUEST_URI'])]) ?>"
           style="right: 20px;">
            Prihlásenie
        </a>

    <?php endif; ?>



</nav>

<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>
