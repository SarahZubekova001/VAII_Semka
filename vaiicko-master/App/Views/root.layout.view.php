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

<?php if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'): ?>
    <nav class="navbar" style="background-color: #e3f2fd; position: relative;">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= $link->url('home.home') ?>">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <!-- Navigačné odkazy -->
                    <div class="navbar-nav">
                        <a class="nav-link active" href="<?= $link->url('home.summer') ?>">Leto</a>
                        <a class="nav-link active" href="<?= $link->url('home.winter') ?>">Zima</a>
                        <a class="nav-link active" href="<?= $link->url('restaurant.restaurants') ?>">Reštaurácie</a>
                        <a class="nav-link active" href="<?= $link->url('home.info') ?>">Info</a>
                        <?php if ($auth->isLogged()): ?>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Administrácia
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="<?= $link->url('auth.showRegisterForm')?>">Registrácia nového používateľa</a></li>
                                        <li>
                                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                                Vymazanie účtu
                                            </button>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </nav>
        <!-- Prihlásenie alebo Odhlásenie -->
        <?php if ($auth->isLogged()): ?>

            <a class="nav-link d-none d-lg-block position-absolute"
               href="<?= $link->url('auth.logout', ['redirect' => $_SERVER['REQUEST_URI']]) ?>"
               style="right: 20px;">
                Odhlásenie
            </a>
        <?php else: ?>
            <a class="nav-link d-none d-lg-block position-absolute"
               href="<?= $link->url('auth.showLoginForm', ['redirect' => $_SERVER['REQUEST_URI']]) ?>"
               style="right: 20px;">
                Prihlásenie
            </a>
        <?php endif; ?>
    </nav>
<?php endif; ?>

<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>

<!-- Modal na potvrdenie vymazania účtu -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Potvrdenie vymazania účtu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Naozaj chcete vymazať svoj účet? Táto akcia je nevratná!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušiť</button>
                <form action="<?= $link->url('auth.deleteAccount') ?>" method="POST">
                    <input type="hidden" name="_token" value="<?= $_SESSION['_token'] ?? '' ?>"> <!-- CSRF ochrana -->
                    <button type="submit" class="btn btn-danger">Vymazať účet</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
