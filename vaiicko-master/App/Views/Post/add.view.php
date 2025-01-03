<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridanie</title>
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

        <form method="post" action="<?= $link->url('post.store') ?>" enctype="multipart/form-data">
            <input type="hidden" name="category" value="<?= htmlspecialchars($data['category'] ?? '') ?>">
            <div class="form-group">
                <label for="name">Názov príspevku</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" class="form-control" id="street" name="street" required>
            </div>
            <div class="form-group">
                <label for="city">Obec</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="descriptive_number">Popisne číslo</label>
                <input type="text" class="form-control" id="descriptive_number" name="descriptive_number" required>
            </div>
            <div class="form-group">
                <label for="postal_code">PSČ</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" required>
            </div>
            <div class="form-group">
                <label for="opening_hours">Otváracie hodiny</label>
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required></textarea>
            </div>
            <!-- Sezóna ako výberové menu -->
            <div class="form-group">
                <label for="season">Sezona</label>
                <select class="form-control" id="season" name="season" required>
                    <option value="">Vyberte sezónu</option>
                    <option value="leto">Leto</option>
                    <option value="zima">Zima</option>
                    <option value="celorocne">Celoročne</option>
                </select>
            </div>

            <!-- Kategória ako výberové menu -->
            <div class="form-group">
                <label for="category">Kategória</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Vyberte kategóriu</option>
                    <option value="activity">Aktivity</option>
                    <option value="relax">Relax</option>
                    <option value="sport">Šport</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Opis</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="gallery">Galéria</label>
                <input type="file" id="gallery" name="gallery[]" class="form-control" multiple accept="image/*">
            </div>
            <button type="submit" class="btn btn-success btn-block">Uložiť</button>
        </form>
    </div>
</div>




