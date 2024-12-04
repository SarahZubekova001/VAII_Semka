<?php if (!is_null(@$data['errors'])): ?>
    <?php foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="container mt-4">
    <div class="col-6 d-flex gap-4  flex-column">
        <h1 class="text-center mb-5">Upraviť reštauráciu</h1>

        <form method="post" action="<?= $link->url("restaurant.store") ?>" enctype="multipart/form-data">
            <!-- Skryté pole pre ID reštaurácie -->
            <input type="hidden" name="id" value="<?= @$data['restaurant']?->getId() ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Názov reštaurácie</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?= @$data['restaurant']?->getName() ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Adresa</label>
                <input type="text" class="form-control" id="address" name="address"
                       value="<?= @$data['restaurant']?->getAddress() ?>" required>
            </div>
            <div class="mb-3">
                <label for="opening_hours" class="form-label">Otváracie hodiny</label>
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required><?= @$data['restaurant']?->getOpeningHours() ?></textarea>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefónne číslo</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                       value="<?= @$data['restaurant']?->getPhoneNumber() ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Obrázok</label>
                <?php if ($data['restaurant']?->getImagePath()): ?>
                    <p>Aktuálny obrázok: <?= @$data['restaurant']->getImagePath() ?></p>
                <?php endif; ?>
                <div class="input-group has-validation mb-4 ">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Uložiť</button>
        </form>
    </div>
</div>
