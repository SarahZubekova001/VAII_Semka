document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.querySelector('.nav-link[href*="auth.logout"]');

    if (logoutButton) {
        logoutButton.addEventListener('click', function (event) {
            event.preventDefault(); // Zabránime predvolenému chovaniu odkazu

            fetch(logoutButton.href, {
                method: 'POST', // Používame POST
                headers: {
                    'Content-Type': 'application/json' // Nastavujeme hlavičku
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/?c=auth&a=login'; // Presmerovanie na login stránku
                    } else {
                        alert(data.message || 'Nastala chyba pri odhlasovaní.');
                    }
                })
                .catch(error => {
                    console.error('Chyba:', error);
                    alert('Nastala chyba pri spracovaní požiadavky.');
                });
        });
    }
});







