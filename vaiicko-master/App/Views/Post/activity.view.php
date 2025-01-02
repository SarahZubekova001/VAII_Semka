<?php
/** @var \App\Core\LinkGenerator $link */
/** @var Array $data */
/** @var \App\Core\Auth $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/subcategories.css" >
</head>
<body>
<div class="container-fluid mt-4">
    <h1 class="text-center mb-5">Aktivity v Zuberci</h1>

    <?php if ($auth->isLogged()): ?>
        <div class="text-center mt-1">
            <a href="<?= $link->url('post.add') ?>" class="btn btn-primary">Pridať nový príspevok</a>
        </div>
    <?php endif; ?>

    <div class="row g-4 mt-4">
        <?php foreach ($data['posts'] as $post): ?>
            <div class="col-lg-6 col-md-6 col-12">
                    <a class="image-box d-block" style="background-image: url('/public/uploads/<?= htmlspecialchars($post->getImagePath()?->getPath()) ?>'); background-size: cover; background-position: center; height: 250px;"></a>
                        <h3 class="mt-3 text-center"><?= htmlspecialchars($post->getName()) ?></h3>
            </div>
        <?php endforeach; ?>
    </div>



</div>

</body>
</html>