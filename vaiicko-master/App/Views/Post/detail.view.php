<?php
/** @var \App\Models\Post $data['post'] */
if (!isset($data['post'])) {
    echo "Chyba: Premenná \$data['post'] je null.";
    die;
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['post']->getName() ?? 'Neznámy príspevok') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/subcategories.css">
</head>
<body>

<div class="container mt-4">
    <div class="text-center mt-1 mb-4">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? '/' ?>" class="btn btn-secondary">Späť</a>
    </div>
    <h1 class="text-center mb-4"><?= htmlspecialchars($data['post']->getName() ?? 'Neznámy príspevok') ?></h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <?php $mainImage = $data['post']->getGallery()[0] ?? null; ?>
            <?php if ($mainImage): ?>
                <img src="/public/uploads/<?= htmlspecialchars($mainImage->getPath()) ?>" alt="Hlavný obrázok" class="main-image">
            <?php else: ?>
                <p class="text-muted">Hlavný obrázok nie je dostupný.</p>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <p><strong>Kategória:</strong> <?= htmlspecialchars($data['post']->getCategory() ?? 'Neznáma') ?></p>
            <p><strong>Sezóna:</strong> <?= htmlspecialchars($data['post']->getSeason() ?? 'Neznáma') ?></p>
            <p><strong>Popis:</strong> <?= htmlspecialchars($data['post']->getDescription() ?? 'Žiadny popis') ?></p>
            <p><strong>Otváracie hodiny:</strong></p>
            <?php
            $openingHours = array_filter(array_map('trim', explode("\n", $data['post']->getOpeningHours())));
            if (!empty($openingHours)): ?>
                <ul>
                    <?php foreach ($openingHours as $line): ?>
                        <li><?= htmlspecialchars($line) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Otváracie hodiny nie sú dostupné.</p>
            <?php endif; ?>

            <?php
            $address = $data['post']->getAddressDetails();
            if ($address): ?>
                <p><strong>Adresa:</strong> <?= htmlspecialchars($address->getStreet() . ', ' . $address->getCity() . ', ' . $address->getPostalCode()) ?></p>
            <?php else: ?>
                <p>Adresa nie je dostupná.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="mb-3">Galéria obrázkov</h5>
            <div class="gallery row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($data['post']->getGallery() as $galleryItem): ?>
                    <div class="col">
                        <img src="/public/uploads/<?= htmlspecialchars($galleryItem->getPath()) ?>" alt="Obrázok" class="img-fluid">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
