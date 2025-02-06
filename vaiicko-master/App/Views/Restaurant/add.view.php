<?php
/** @var \App\Core\LinkGenerator $link */
/** @var array $data */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridanie reštaurácie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 w-100" style="max-width: 600px;">
        <h1 class="text-center mb-4">Pridať reštauráciu</h1>

        <?php if (!empty($data['errors'])): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($data['errors'] as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= htmlspecialchars($link->url('restaurant.store')) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Názov reštaurácie</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" class="form-control" id="street" name="street" value="<?= htmlspecialchars($data['street'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="city">Obec</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($data['city'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="descriptive_number">Popisné číslo</label>
                <input type="text" class="form-control" id="descriptive_number" name="descriptive_number" value="<?= htmlspecialchars($data['descriptive_number'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="postal_code">PSČ</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?= htmlspecialchars($data['postal_code'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="opening_hours">Otváracie hodiny</label>
                <textarea class="form-control" id="opening_hours" name="opening_hours" rows="3" required><?= htmlspecialchars($data['opening_hours'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="phone_number">Telefónne číslo</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($data['phone_number'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="url_address">Webová adresa</label>
                <input type="text" class="form-control" id="url_address" name="url_address" value="<?= htmlspecialchars($data['url_address'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="image">Obrázok</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-success btn-block">Uložiť</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");

        form.addEventListener("submit", function (event) {
            let isValid = true;

            // PSČ - musí byť presne 5 číslic
            const postalCode = document.getElementById("postal_code");
            if (!/^\d{5}$/.test(postalCode.value)) {
                isValid = false;
                showError(postalCode, "PSČ musí obsahovať presne 5 číslic.");
            } else {
                clearError(postalCode);
            }

            // Telefónne číslo - musí mať 9-15 číslic
            const phoneNumber = document.getElementById("phone_number");
            if (!/^\d{9,15}$/.test(phoneNumber.value)) {
                isValid = false;
                showError(phoneNumber, "Telefónne číslo musí mať 9-15 číslic.");
            } else {
                clearError(phoneNumber);
            }

            if (!isValid) {
                event.preventDefault(); // Zabráni odoslaniu formulára
            }
        });

        function showError(input, message) {
            let error = input.nextElementSibling;
            if (!error || !error.classList.contains("text-danger")) {
                error = document.createElement("small");
                error.classList.add("text-danger");
                input.parentNode.appendChild(error);
            }
            error.textContent = message;
        }

        function clearError(input) {
            let error = input.nextElementSibling;
            if (error && error.classList.contains("text-danger")) {
                error.remove();
            }
        }
    });
</script>

</body>
</html>
