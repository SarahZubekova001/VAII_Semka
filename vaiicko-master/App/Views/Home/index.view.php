<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprievodca obcou Zuberec</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            position: relative;
            background-image: url('/public/img/zuberec.webp'); /* Vymeniť za reálny obrázok */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        header h1 {
            font-family: "Baskerville Old Face", serif;
            position: relative;
            font-size: 48px;
            margin: 0;
        }
        header p {
            position: relative;
            font-size: 24px;
            margin: 10px 0 0;
        }
        main {
            padding: 20px;
            text-align: center;
        }
        .cta {
            margin: 20px 0;
        }
        .cta a {
            font-family: "Baskerville Old Face", serif;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        .cta a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
    <h1>Vitajte na stránke Sprievodca obcou Zuberec</h1>
</header>
<main>
    <p>Chcete zistiť, čo všetko sa nachádza v našej krásnej dedine? Preskúmajte zaujímavosti, históriu a miesta, ktoré stojí za to navštíviť.</p>
    <div class="cta">
        <a href="zaujimavosti.html">Kliknite tu</a>
    </div>
</main>
</body>
</html>
