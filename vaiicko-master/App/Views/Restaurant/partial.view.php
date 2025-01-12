
<?php foreach ($data['restaurants'] as $restaurant): ?>
    <div class="col">
        <div class="card h-100">
            <img src="/public/uploads/<?= htmlspecialchars($restaurant->getImagePath()?->getPath()) ?>"
                 class="card-img-top h-100"
                 alt="<?= htmlspecialchars($restaurant->getName()) ?>">
            <div class="card-body text-center">
                <h5 class="card-title"><?= htmlspecialchars($restaurant->getName()) ?></h5>
                <p class="card-text">
                    <?= htmlspecialchars($restaurant->getAddressDetails()->getStreet().', ' . $restaurant->getAddressDetails()->getCity()) ?>
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

