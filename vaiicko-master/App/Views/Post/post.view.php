<?php
/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var \App\Core\Auth $auth */
$categoryNameMap = [
    'activity' => 'Aktivity v Zuberci',
    'relax' => 'Relax v Zuberci',
    'sport' => 'Šport v Zuberci'
];
$title = $categoryNameMap[$data['category']] ?? 'Príspevky';
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/subcategories.css">
</head>
<body>
<div class="container-fluid mt-4">
    <h1 class="text-center mb-5"><?= htmlspecialchars($title) ?></h1>

    <?php if ($auth->isLogged()): ?>
        <div class="text-center mt-1">
            <a href="<?= $link->url('post.add', ['category' => $data['category'], 'season' => $data['season']]) ?>"
               class="btn btn-primary">Pridať nový príspevok</a>
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($data['posts'] as $post): ?>
            <div class="col">

                <?php
                $gallery = $post->getGallery();
                $mainImage = $_SESSION['main_image'][$post->getId()] ?? ($gallery[0]->getPath() ?? null);
                ?>
                <?php if (!empty($mainImage)): ?>
                    <a href="<?= $link->url('post.detail', ['id' => $post->getId()]) ?>" class="d-block" style="text-decoration: none;">
                        <div class="image-box" style="background-image: url('/public/uploads/<?= htmlspecialchars($mainImage) ?>'); background-size: cover; background-position: center; height: 200px;"></div>
                    </a>
                <?php else: ?>
                    <p class="text-center text-muted">Obrázok nie je dostupný</p>
                <?php endif; ?>

                <h5 class="card-title"><?= htmlspecialchars($post->getName()) ?></h5>

                    <?php if ($auth->isLogged()): ?>
                        <div class="card-footer text-start">
                            <input type="hidden" name="return_url" value="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? '') ?>">
                            <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" class="btn btn-primary btn-sm">Upraviť</a>
                            <a href="<?= $link->url('post.delete', ['id' => $post->getId(), 'return_url' => urlencode($_SERVER['REQUEST_URI'])]) ?>" class="btn btn-danger btn-sm">Zmazať</a>
                        </div>
                    <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
