<?php
/** @var \App\Models\Restaurant[] $restaurants */
/** @var \App\Core\LinkGenerator $link */
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


<!--<div class="container-fluid mt-4">-->
<!--    <h1 class="text-center mb-5">Reštaurácie</h1>-->
<!---->
<!--    <div class="row g-4">-->
<!--        <div class="col-lg-6 col-md-6 col-12">-->
<!--            <a href="" class="image-box kycer d-block"></a>-->
<!--            <h3 class="mt-3 text-center">Kycer Burger</h3>-->
<!--        </div>-->
<!--        <div class="col-lg-6 col-md-6 col-12">-->
<!--            <a href="" class="image-box oravskaIzba d-block"></a>-->
<!--            <h3 class="mt-3 text-center">Oravska Izba</h3>-->
<!--        </div>-->
<!--        <div class="col-lg-6 col-md-6 col-12">-->
<!--            <a href="" class="image-box josuu d-block"></a>-->
<!--            <h3 class="mt-3 text-center">Josu</h3>-->
<!--        </div>-->
<!--        <div class="col-lg-6 col-md-6 col-12">-->
<!--            <a href="" class="image-box uno d-block"></a>-->
<!--            <h3 class="mt-3 text-center">Pizzeria Uno</h3>-->
<!--        </div>-->
<!--    </div>-->
    <!-- Tlačidlo na pridanie reštaurácie (len pre prihlásených) -->
    <?php if ($auth->isLogged()): ?>
    <div class="text-center mt-4">
        <a href="<?= $link->url('restaurant.add') ?>" class="btn btn-primary">Pridať reštauráciu</a>
    </div>
    <?php endif; ?>
</div>

<div class="container mt-4">
    <h1 class="text-center mb-5">Reštaurácie</h1>
    <div class="row">
        <?php if (!empty($restaurants)): ?>
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="<?= htmlspecialchars($restaurant->getImagePath()) ?>" class="card-img-top" alt="<?= htmlspecialchars($restaurant->getName()) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($restaurant->getName()) ?></h5>
                            <a href="<?= $link->url('restaurant.detail', ['id' => $restaurant->getId()]) ?>" class="btn btn-primary">Viac info</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Žiadne reštaurácie na zobrazenie.</p>
        <?php endif; ?>
    </div>
</div>


</body>
</html>
