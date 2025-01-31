<?php
$layout = 'auth';
/** @var array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<!DOCTYPE html>
    <html lang="sk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vytvorenie noveho účtu</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 w-100" style="max-width: 600px;">
            <?php if (!is_null(@$data['errors'])): ?>
                <?php foreach ($data['errors'] as $error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!is_null(@$data['successMessage'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($data['successMessage']) ?>
                    </div>
                <script>
                    setTimeout(function () {
                        window.location.href = "/"; // Presmerovanie na hlavnú stránku po 5 sekundách
                    }, 2000);
                </script>
            <?php endif; ?>
            <h3 class="text-center mb-4">Registrovanie nového používateľa</h3>
            <div id="message" class="alert d-none"></div>
            <form id="registerForm" action="<?= $link->url('auth.register') ?>" method="post">
                <div class="form-group">
                    <label for="login" class="form-label">Používateľské meno</label>
                    <input type="text" name="login" id="login" class="form-control" placeholder="Zadajte meno" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Heslo</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Zadajte heslo" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Vytvoriť</button>
            </form>
        </div>
    </div>


