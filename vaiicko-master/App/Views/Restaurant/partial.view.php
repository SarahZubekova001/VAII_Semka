<?php
/** @var \App\Models\Restaurant[] $restaurants */
/** @var \App\Core\LinkGenerator $link */
/** @var array $data */
/** @var \App\Core\Auth $auth */
?>
<?php foreach ($data['restaurants'] as $restaurant): ?>
    <div class="col">
        <div class="card h-100">
            <?php
            $imageObject = $restaurant->getImagePath();
            $imagePath = $imageObject ? $imageObject->getPath() : null;
            ?>
            <?php if (!empty($imagePath)): ?>
                <img src="/public/uploads/<?= htmlspecialchars($imagePath) ?>"
                     class="card-img-top h-100"
                     alt="<?= htmlspecialchars($restaurant->getName()) ?>">
            <?php else: ?>
                <p class="text-muted text-center">Obrázok nie je dostupný</p>
            <?php endif; ?>

            <div class="card-body text-center">
                <h5 class="card-title"><?= htmlspecialchars($restaurant->getName()) ?></h5>

                <?php
                $address = $restaurant->getAddressDetails();
                $fullAddress = $address ? $address->getStreet() . ', ' . $address->getCity() : 'Adresa nie je dostupná';
                ?>
                <p class="card-text"><?= htmlspecialchars($fullAddress) ?></p>

                <?php if (!empty($restaurant->getUrlAddress())): ?>
                    <p class="card-text">
                        <a href="<?= htmlspecialchars($restaurant->getUrlAddress()) ?>" target="_blank">
                            <?= htmlspecialchars($restaurant->getUrlAddress()) ?>
                        </a>
                    </p>
                <?php endif; ?>

                <?php if ($auth->isLogged()): ?>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="<?= htmlspecialchars($link->url('restaurant.edit', ['id' => $restaurant->getId()])) ?>" class="btn btn-primary">Upraviť</a>
                        <a href="<?= htmlspecialchars($link->url('restaurant.delete', ['id' => $restaurant->getId()])) ?>" class="btn btn-danger">Zmazať</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
