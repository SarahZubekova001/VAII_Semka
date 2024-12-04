<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pridanie</title>
</head>
<body>
<?php if (!is_null(@$data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="container mt-4">
    <div class="col-6 d-flex gap-4  flex-column">
    <h1 class="text-center mb-5">Pridať reštauráciu</h1>


    <form method="post" action="<?= $link->url("restaurant.store") ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Názov reštaurácie</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresa</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="opening_hours" class="form-label">Otváracie hodiny</label>
            <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Telefónne číslo</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Obrázok</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Uložiť</button>
    </form>
    </div>
</div>



</body>
</html>