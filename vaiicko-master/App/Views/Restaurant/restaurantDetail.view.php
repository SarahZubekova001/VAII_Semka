
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spálená - Západné Tatry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/details.css">
</head>
<body>

<div class="container mt-4">
    <!-- Názov reštaurácie -->
    <h1 class="text-center mb-5"><?= htmlspecialchars($restaurant->getName()) ?></h1>

    <div class="row">
        <!-- Obrázok reštaurácie -->
        <div class="col-12 col-md-6 mb-4">
            <img src="<?= htmlspecialchars($restaurant->getImagePath()) ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($restaurant->getName()) ?>">
        </div>

        <!-- Informácie o reštaurácii -->
        <div class="col-12 col-md-6">
            <h4 class="mb-3">Informácie</h4>
            <p><strong>Adresa:</strong> <?= htmlspecialchars($restaurant->getAddress()) ?></p>
            <p><strong>Otváracie hodiny:</strong></p>
            <ul>
                <?php
                // Rozdelenie otváracích hodín na riadky, ak sú uložené vo formáte "Pondelok: 8:00 - 16:00\nUtorok: 8:00 - 16:00"
                $hours = explode("\n", $restaurant->getHours());
                foreach ($hours as $hour): ?>
                    <li><?= htmlspecialchars($hour) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Google Map -->
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="mb-3">Poloha</h4>
            <iframe
                src="https://www.google.com/maps?q=<?= urlencode($restaurant->getAddress()) ?>&output=embed"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
