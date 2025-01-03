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
            <a href="<?= $link->url('post.add') ?>" class="btn btn-primary">Pridať nový príspevok</a>
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($data['posts'] as $post): ?>
            <div class="col">
                    <a class="image-box d-block" style="background-image: url('/public/uploads/<?= htmlspecialchars($post->getImagePath()?->getPath()) ?>'); background-size: cover; background-position: center; height: 250px;"></a>
                    <h5 class="card-title"><?= htmlspecialchars($post->getName()) ?></h5>
                <?php if ($auth->isLogged()): ?>
                    <input type="hidden" name="return_url" value="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? '') ?>">
                    <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" class="btn btn-primary">Upraviť</a>
                    <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>" class="btn btn-danger">Zmazať</a>

                <?php endif; ?>
            </div>

        <?php endforeach; ?>

    </div>
</div>
</body>
</html>
