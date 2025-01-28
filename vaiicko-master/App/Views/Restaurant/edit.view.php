<?php

/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uprava</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php if (!is_null(@$data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 w-100" style="max-width: 600px;">
        <h1 class="text-center mb-4">Upraviť reštauráciu</h1>

        <form method="post" action="<?= $link->url("restaurant.store") ?>" enctype="multipart/form-data">
            <!-- Skryté pole pre ID reštaurácie -->
            <input type="hidden" name="id" value="<?= @$data['restaurant']?->getId() ?>">

            <div class="form-group">
                <label for="name" class="form-label">Názov reštaurácie</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?= @$data['restaurant']?->getName() ?>" required>
            </div>

            <?php $address = @$data['restaurant']?->getAddressDetails(); ?>
            <div class="form-group">
                <label for="street" class="form-label">Ulica</label>
                <input type="text" class="form-control" id="street" name="street"
                       value="<?= @$address?->getStreet() ?>" required>
            </div>
            <div class="form-group">
                <label for="city" class="form-label">Mesto</label>
                <input type="text" class="form-control" id="city" name="city"
                       value="<?= @$address?->getCity() ?>" required>
            </div>
            <div class="form-group">
                <label for="postal_code" class="form-label">PSČ</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code"
                       value="<?= @$address?->getPostalCode() ?>" required>
            </div>

            <div class="form-group">
                <label for="opening_hours" class="form-label">Otváracie hodiny</label>
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required><?= @$data['restaurant']?->getOpeningHours() ?></textarea>
            </div>
            <div class="form-group">
                <label for="phone_number" class="form-label">Telefónne číslo</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                       value="<?= @$data['restaurant']?->getPhoneNumber() ?>" required>
            </div>
            <div class="form-group">
                <label for="url_address" class="form-label">Webová adresa</label>
                <input type="text" class="form-control" id="url_address" name="url_address"
                       value="<?= @$data['restaurant']?->getUrlAddress() ?>" required>
            <div class="form-group">
                <label for="image" class="form-label">Obrázok</label>
                <?php if ($data['restaurant']?->getImagePath()?->getPath()): ?>
                    <p>Aktuálny obrázok:</p>
                    <<img src="/uploads/<?= htmlspecialchars($data['restaurant']->getImagePath()?->getPath()) ?>"
                          alt="Obrázok reštaurácie"
                          style="max-width: 100%; height: auto;">

                <?php endif; ?>
                <div class="input-group has-validation mb-4 mt-2">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Uložiť</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>