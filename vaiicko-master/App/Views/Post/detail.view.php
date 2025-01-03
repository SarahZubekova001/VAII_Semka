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
</head>
<body>

<div class="container mt-4">
    <div class="text-center mt-4">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? '/' ?>" class="btn btn-secondary">Späť</a>
    </div>
    <h1 class="text-center"><?= htmlspecialchars($data['post']->getName() ?? 'Neznámy príspevok') ?></h1>
    <div class="row">
        <div class="col-md-6">
            <?php if ($data['post']->getImagePath()?->getPath()): ?>
                <img src="/public/uploads/<?= htmlspecialchars($data['post']->getImagePath()?->getPath()) ?>" class="img-fluid" alt="<?= htmlspecialchars($data['post']->getName() ?? 'Obrázok') ?>">
            <?php else: ?>
                <p>Obrázok nie je dostupný.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <p><strong>Kategória:</strong> <?= htmlspecialchars($data['post']->getCategory() ?? 'Neznáma') ?></p>
            <p><strong>Sezóna:</strong> <?= htmlspecialchars($data['post']->getSeason() ?? 'Neznáma') ?></p>
            <p><strong>Popis:</strong> <?= htmlspecialchars($data['post']->getDescription() ?? 'Žiadny popis') ?></p>
            <p><strong>Otváracie hodiny:</strong></p>
            <?php
            $openingHours = array_filter(array_map('trim', explode("\n", $data['post']->getOpeningHours()))); // Odstráni prázdne riadky a orezáva medzery
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

</div>
</body>
</html>
