<?php
$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg border-0" style="min-width: 800px; max-width: 1000px;">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Prihlásenie</h3>
                    <!-- Chybové hlásenie -->
                    <?php if (!empty($data['message'])): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($data['message']) ?>
                        </div>
                    <?php endif; ?>
                    <!-- Formulár -->
                    <form method="post" action="<?= $link->url("login") ?>">
                        <div class="form-group mb-3">
                            <label for="login" class="form-label">Používateľské meno</label>
                            <input name="login" type="text" id="login" class="form-control"
                                   placeholder="Zadajte meno" required autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Heslo</label>
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Zadajte heslo" required>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-lg w-100" type="submit" name="submit">Prihlásiť</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
