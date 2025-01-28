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
        <h1 class="text-center mb-4">Upraviť príspevok</h1>

        <form method="post" action="<?= $link->url("post.store") ?>" enctype="multipart/form-data">
            <!-- Skryté pole pre ID prispevok -->
            <input type="hidden" name="id" value="<?= @$data['post']?->getId() ?>">
            <input type="hidden" name="return_url" value="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? '') ?>">

            <div class="form-group">
                <label for="name" class="form-label">Názov príspevku</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?= @$data['post']?->getName() ?>" required>
            </div>

            <?php $address = @$data['post']?->getAddressDetails(); ?>
            <div class="form-group">
                <label for="street" class="form-label">Ulica</label>
                <input type="text" class="form-control" id="street" name="street"
                       value="<?= @$address?->getStreet() ?>" required>
            </div>
            <div class="form-group">
                <label for="descriptive_number" class="form-label">Popisné číslo</label>
                <input type="text" class="form-control" id="descriptive_number" name="descriptive_number"
                       value="<?= @$address?->getDescriptiveNumber() ?>" required>
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
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required><?= @$data['post']?->getOpeningHours() ?></textarea>
            </div>
            <div class="form-group">
                <label for="season" class="form-label">Sezóna</label>
                <select class="form-control" id="season" name="season" required>
                    <option value="">Vyberte sezónu</option>
                    <option value="leto" <?= @$data['post']?->getSeason() === 'leto' ? 'selected' : '' ?>>Leto</option>
                    <option value="zima" <?= @$data['post']?->getSeason() === 'zima' ? 'selected' : '' ?>>Zima</option>
                    <option value="celorocne" <?= @$data['post']?->getSeason() === 'celorocne' ? 'selected' : '' ?>>Celoročne</option>
                </select>
            </div>
            <div class="form-group">
                <label for ="category" class="form-label">Kategória</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Vyberte kategóriu</option>
                    <option value="activity" <?= @$data['post']?->getCategory() === 'activity' ? 'selected' : '' ?>>Aktivity</option>
                    <option value="relax" <?= @$data['post']?->getCategory() === 'relax' ? 'selected' : '' ?>>Relax</option>
                    <option value="sport" <?= @$data['post']?->getCategory() === 'sport' ? 'selected' : '' ?>>Šport</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Popis</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= @$data['post']?->getDescription() ?></textarea>

            <div class="form-group">
                <label for="image" class="form-label">Obrázok</label>
                <?php if ($data['post']?->getImagePath()?->getPath()): ?>
                    <p>Aktuálny obrázok: <?= @$data['post']->getImagePath()?->getPath() ?></p>
                <?php endif; ?>
                <div class="input-group has-validation mb-4 ">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Uložiť</button>
        </form>
    </div>
</div>
</body>
</html>