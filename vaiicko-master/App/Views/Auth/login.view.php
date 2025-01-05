<?php
$layout = 'auth';
/** @var array $data */
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Prihlásenie</h3>
                    <?php if (!empty($data['message'])): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($data['message']) ?></div>
                    <?php endif; ?>
                    <form action="<?= htmlspecialchars($this->app->getLinkGenerator()->url('auth.login')) ?>" method="POST">
                        <div class="mb-3">
                            <label for="login" class="form-label">Používateľské meno</label>
                            <input type="text" name="login" id="login" class="form-control" placeholder="Zadajte meno" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Heslo</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Zadajte heslo" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Prihlásiť sa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
