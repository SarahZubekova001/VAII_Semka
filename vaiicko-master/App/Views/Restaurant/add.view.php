<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pridanie</title>
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center mb-5">Pridať reštauráciu</h1>

    <form method="post" action="<?= $link->url("restaurant.store") ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Názov reštaurácie</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresa</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="hours" class="form-label">Otváracie hodiny</label>
            <textarea class="form-control" id="hours" name="hours" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Obrázok</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Uložiť</button>
    </form>
</div>



</body>
</html>