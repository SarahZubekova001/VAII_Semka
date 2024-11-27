<?php
/** @var \App\Models\Restaurant[] $restaurants */
/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var \App\Core\Auth $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reštaurácie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/subcategories.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-5">Reštaurácie</h1>
    <?php if ($auth->isLogged()): ?>
    <div class="text-center mt-1">
        <a href="<?= $link->url('restaurant.add') ?>" class="btn btn-primary">Pridať novú reštauráciu</a>
    </div>
    <?php endif; ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($data['restaurants'] as $restaurant): ?>
            <div class="col">
            <div class="card h-100" >
                    <img src="/public/uploads/<?= htmlspecialchars($restaurant->getImagePath()) ?>"
                         class="card-img-top h-100"
                         alt="<?= htmlspecialchars($restaurant->getName()) ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= htmlspecialchars($restaurant->getName()) ?></h5>
                        <p class="card-text">
                            <?= htmlspecialchars($restaurant->getAddress()) ?>
                        </p>
                        <?php if ($auth->isLogged()): ?>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?= $link->url('restaurant.edit', ['id' => $restaurant->getId()]) ?>" class="btn btn-primary">Upraviť</a>
                                <a href="<?= $link->url('restaurant.delete', ['id' => $restaurant->getId()]) ?>" class="btn btn-danger">Zmazať</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
</body>
</html>
