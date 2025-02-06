<?php
/** @var \App\Core\LinkGenerator $link */
/** @var array $data */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridanie príspevku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 w-100" style="max-width: 600px;">
        <h1 class="text-center mb-4">Pridať príspevok</h1>

        <?php if (!empty($data['errors'])): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($data['errors'] as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= htmlspecialchars($link->url('post.store')) ?>" enctype="multipart/form-data">
            <input type="hidden" name="category" value="<?= htmlspecialchars($data['category'] ?? '') ?>">

            <div class="form-group">
                <label for="name">Názov príspevku</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" class="form-control" id="street" name="street" value="<?= htmlspecialchars($data['street'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="city">Obec</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($data['city'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="descriptive_number">Popisné číslo</label>
                <input type="text" class="form-control" id="descriptive_number" name="descriptive_number" value="<?= htmlspecialchars($data['descriptive_number'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="postal_code">PSČ</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?= htmlspecialchars($data['postal_code'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="opening_hours">Otváracie hodiny</label>
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required><?= htmlspecialchars($data['opening_hours'] ?? '') ?></textarea>
            </div>

            <!-- Sezóna ako výberové menu -->
            <div class="form-group">
                <label for="season">Sezóna</label>
                <select class="form-control" id="season" name="season" required>
                    <option value="">Vyberte sezónu</option>
                    <option value="leto" <?= ($data['season'] ?? '') === 'leto' ? 'selected' : '' ?>>Leto</option>
                    <option value="zima" <?= ($data['season'] ?? '') === 'zima' ? 'selected' : '' ?>>Zima</option>
                    <option value="celorocne" <?= ($data['season'] ?? '') === 'celorocne' ? 'selected' : '' ?>>Celoročne</option>
                </select>
            </div>

            <!-- Kategória ako výberové menu -->
            <div class="form-group">
                <label for="category">Kategória</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Vyberte kategóriu</option>
                    <option value="activity" <?= ($data['category'] ?? '') === 'activity' ? 'selected' : '' ?>>Aktivity</option>
                    <option value="relax" <?= ($data['category'] ?? '') === 'relax' ? 'selected' : '' ?>>Relax</option>
                    <option value="sport" <?= ($data['category'] ?? '') === 'sport' ? 'selected' : '' ?>>Šport</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Opis</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Galéria</label>
                <input type="file" id="image" name="image[]" class="form-control" multiple accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-success btn-block">Uložiť</button>
        </form>
    </div>
</div>
<script src="/public/js/form-validation-post.js"></script>
</body>
</html>
