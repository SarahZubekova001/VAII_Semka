<?php
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Summer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/style.css" >
</head>
<body>

<!-- Obsah -->
<div class="container">
    <a href="<?= $link->url('post.activity') ?>" class="section" id="aktivity">
    <div class="text-overlay"></div>
    <h2>AKTIVITY</h2>
  </a>
    <a href="<?= $link->url('post.relax') ?>" class="section" id="relax">
    <div class="text-overlay"></div>
    <h2>RELAX</h2>
  </a>
    <a href="<?= $link->url('post.sport') ?>" class="section" id="sport">
    <div class="text-overlay"></div>
    <h2>ŠPORT</h2>
  </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
