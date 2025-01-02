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
        <h1 class="text-center mb-4">Pridať reštauráciu</h1>

        <?php if (!is_null(@$data['errors'])): ?>
            <?php foreach ($data['errors'] as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <form method="post" action="<?= $link->url('restaurant.store') ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Názov reštaurácie</label>
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
            <div class="form-group">
                <label for="phone_number">Telefónne číslo</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>

            <div class="form-group">
                <label for="image">Obrázok</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Uložiť</button>
        </form>
    </div>
</div>



