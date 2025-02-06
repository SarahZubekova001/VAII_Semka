<?php
/** @var \App\Core\LinkGenerator $link */
/** @var array $data */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úprava príspevku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php if (!empty($data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 w-100" style="max-width: 600px;">
        <h1 class="text-center mb-4">Upraviť príspevok</h1>

        <form method="post" action="<?= htmlspecialchars($link->url("post.store")) ?>" enctype="multipart/form-data">
            <!-- Skryté pole pre ID príspevku -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['post']->getId() ?? '') ?>">
            <input type="hidden" name="return_url" value="<?= htmlspecialchars($data['return_url'] ?? ($_SERVER['HTTP_REFERER'] ?? '')) ?>">


            <div class="form-group">
                <label for="name" class="form-label">Názov príspevku</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?= htmlspecialchars($data['post']->getName() ?? '') ?>" required>
            </div>

            <?php $address = $data['post']->getAddressDetails() ?? null; ?>
            <div class="form-group">
                <label for="street" class="form-label">Ulica</label>
                <input type="text" class="form-control" id="street" name="street"
                       value="<?= htmlspecialchars($address->getStreet() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="descriptive_number" class="form-label">Popisné číslo</label>
                <input type="text" class="form-control" id="descriptive_number" name="descriptive_number"
                       value="<?= htmlspecialchars($address->getDescriptiveNumber() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="city" class="form-label">Mesto</label>
                <input type="text" class="form-control" id="city" name="city"
                       value="<?= htmlspecialchars($address->getCity() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="postal_code" class="form-label">PSČ</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code"
                       value="<?= htmlspecialchars($address->getPostalCode() ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="opening_hours" class="form-label">Otváracie hodiny</label>
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required><?= htmlspecialchars($data['post']->getOpeningHours() ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="season" class="form-label">Sezóna</label>
                <select class="form-control" id="season" name="season" required>
                    <option value="">Vyberte sezónu</option>
                    <option value="leto" <?= ($data['post']->getSeason() ?? '') === 'leto' ? 'selected' : '' ?>>Leto</option>
                    <option value="zima" <?= ($data['post']->getSeason() ?? '') === 'zima' ? 'selected' : '' ?>>Zima</option>
                    <option value="celorocne" <?= ($data['post']->getSeason() ?? '') === 'celoročne' ? 'selected' : '' ?>>Celoročne</option>
                </select>
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Kategória</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Vyberte kategóriu</option>
                    <option value="activity" <?= ($data['post']->getCategory() ?? '') === 'activity' ? 'selected' : '' ?>>Aktivity</option>
                    <option value="relax" <?= ($data['post']->getCategory() ?? '') === 'relax' ? 'selected' : '' ?>>Relax</option>
                    <option value="sport" <?= ($data['post']->getCategory() ?? '') === 'šport' ? 'selected' : '' ?>>Šport</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Popis</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($data['post']->getDescription() ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Pridať nové obrázky</label>
                <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple>
            </div>

            <?php if (!empty($data['post']->getGallery())): ?>
                <h5>Existujúce obrázky v galérii</h5>
                <div class="row">
                    <?php foreach ($data['post']->getGallery() as $image): ?>
                        <div class="col-md-3 text-center">
                            <img src="/public/uploads/<?= htmlspecialchars($image->getPath()) ?>" class="img-thumbnail" style="height: 100px;" alt="Obrázok príspevku">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="main_image" value="<?= htmlspecialchars($image->getId()) ?>"
                                    <?= ($data['post']->getMainImage()?->getId() === $image->getId()) ? 'checked' : '' ?>>
                                <label class="form-check-label">Nastaviť ako hlavnú</label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-success">Uložiť</button>
        </form>
    </div>
</div>
<script src="/public/js/form-validation-post.js"></script>

</body>
</html>