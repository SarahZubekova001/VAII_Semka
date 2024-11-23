<?php
/** @var \App\Models\Restaurant $restaurant */
?>

    <div class="container mt-4">
        <h1 class="text-center"><?= $restaurant->getName() ?></h1>
        <img src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . '/' . $restaurant->getImagePath() ?>" class="img-fluid" alt="<?= $restaurant->getName() ?>">
        <p><strong>Adresa:</strong> <?= $restaurant->getAddress() ?></p>
        <p><strong>Otváracie hodiny:</strong> <?= $restaurant->getOpeningHours() ?></p>
    </div>
<?php
