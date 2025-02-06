<?php
/** @var \App\Core\LinkGenerator $link */
/** @var array $data */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úprava reštaurácie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php if (!empty($data['errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 w-100" style="max-width: 600px;">
        <h1 class="text-center mb-4">Upraviť reštauráciu</h1>

        <form method="post" action="<?= htmlspecialchars($link->url("restaurant.store")) ?>" enctype="multipart/form-data">
            <!-- Skryté pole pre ID reštaurácie -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['restaurant']->getId() ?? '') ?>">

            <div class="form-group">
                <label for="name" class="form-label">Názov reštaurácie</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?= htmlspecialchars($data['restaurant']->getName() ?? '') ?>" required>
            </div>

            <?php $address = $data['restaurant']->getAddressDetails() ?? null; ?>
            <div class="form-group">
                <label for="street" class="form-label">Ulica</label>
                <input type="text" class="form-control" id="street" name="street"
                       value="<?= htmlspecialchars($address->getStreet() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="city" class="form-label">Mesto</label>
                <input type="text" class="form-control" id="city" name="city"
                       value="<?= htmlspecialchars($address->getCity() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="descriptive_number" class="form-label">Popisné číslo</label>
                <input type="text" class="form-control" id="descriptive_number" name="descriptive_number"
                       value="<?= htmlspecialchars($address->getDescriptiveNumber() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="postal_code" class="form-label">PSČ</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code"
                       value="<?= htmlspecialchars($address->getPostalCode() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="opening_hours" class="form-label">Otváracie hodiny</label>
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required><?= htmlspecialchars($data['restaurant']->getOpeningHours() ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="phone_number" class="form-label">Telefónne číslo</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                       value="<?= htmlspecialchars($data['restaurant']->getPhoneNumber() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="url_address" class="form-label">Webová adresa</label>
                <input type="text" class="form-control" id="url_address" name="url_address"
                       value="<?= htmlspecialchars($data['restaurant']->getUrlAddress() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Obrázok</label>
                <?php
                $imageObject = $data['restaurant']->getImagePath();
                $imagePath = $imageObject ? $imageObject->getPath() : null;
                ?>

                <?php if (!empty($imagePath)): ?>
                    <p>Aktuálny obrázok: <?= htmlspecialchars(basename($imagePath)) ?></p>
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
<script src="/public/js/form-validation-restaurant.js"></script>

</body>
</html>
