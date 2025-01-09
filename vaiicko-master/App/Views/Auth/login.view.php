<?php
$layout = 'auth';
/** @var array $data */
?>

    <!DOCTYPE html>
    <html lang="sk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prihlásenie</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 w-100" style="max-width: 600px;">

            <h3 class="text-center mb-4">Prihlásenie</h3>
            <div id="message" class="alert d-none"></div>
            <form id="loginForm">
                <div class="form-group">
                    <label for="login" class="form-label">Používateľské meno</label>
                    <input type="text" name="login" id="login" class="form-control" placeholder="Zadajte meno" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Heslo</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Zadajte heslo" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Prihlásiť sa</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault(); // Zabraň obnoveniu stránky

                $.ajax({
                    url: '/?c=auth&a=login',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            $('#message').removeClass('d-none alert-success').addClass('alert-danger').text(response.message);
                        }
                    },
                    error: function() {
                        $('#message').removeClass('d-none alert-success').addClass('alert-danger').text('Nastala chyba pri spracovaní požiadavky.');
                    }
                });
            });
        });
    </script>
    </body>
    </html>

<?php