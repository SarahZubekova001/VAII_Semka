<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O obci Zuberec</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../../public/css/zuberec.css">
    <link rel="stylesheet" href="../../../public/css/slider.css">
</head>
<body>

<div class="slideshow-container">
    <div class="mySlides Myfade ">
<!--        <div class="numbertext">1 / 3</div>-->
        <img src="../../../public/img/zuberec.jpg" style="width:100%">
    </div>

    <div class="mySlides Myfade">
<!--        <div class="numbertext">2 / 3</div>-->
        <img src="../../../public/img/zuberec.webp" style="width:100%">
    </div>

    <div class="mySlides Myfade">
<!--        <div class="numbertext">3 / 3</div>-->
        <img src="../../../public/img/zuberec2.jpg" style="width:100%">
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>


<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>


<!-- Informácie o obci -->
<div class="container content-section">
    <div class="row">
        <div class="col-md-6">
            <div class="image-box zuberec" ></div>
        </div>
        <div class="col-md-6">
            <h2>O obci</h2>
            <p>Zuberec je malebná obec nachádzajúca sa v regióne Orava na severe Slovenska. Táto obec sa nachádza na úpätí Západných Tatier a ponúka široké možnosti na turistiku, oddych a poznávanie miestnej kultúry.</p>
            <p>Okolie Zuberca je známe svojimi prírodnými krásami, ako sú Roháčske plesá, vodopád Roháčsky vodopád a neďaleké horské chodníky vedúce cez panenskú prírodu Západných Tatier. Táto lokalita je obľúbeným cieľom milovníkov hôr, ktorí sem prichádzajú na pešie túry, lyžovanie alebo jednoducho vychutnávať pokoj vidieka.</p>
            <p>Zuberec je tiež centrom kultúrneho diania v regióne. Medzi najznámejšie podujatia patrí „Podroháčske folklórne slávnosti“, ktoré každoročne prilákajú návštevníkov z celého Slovenska aj zo zahraničia. Počas týchto slávností je možné zažiť autentickú ľudovú hudbu, tanec a ochutnať miestne špeciality.</p>
            <p>Obec je známa aj svojím unikátnym múzeom - Múzeum oravskej dediny, ktoré predstavuje život a tradície oravského regiónu v minulosti. Návštevníci si môžu prezrieť dobové chalupy, tradičné remeselné dielne a historické poľnohospodárske nástroje.</p>
        </div>
    </div>
</div>

<!-- Miestne inštitúcie -->
<div class="container content-section">
    <div class="row">
        <!-- Kostol -->
        <div class="col-md-4">
            <div class="institution-box" id="kostol"></div>
            <h4>Kostol sv. Vendelína</h4>
            <p>Dominanta obce, postavená v roku 1781. Kostol je známy svojou architektúrou a krásnym vnútorným zariadením.</p>
        </div>

        <!-- Informačné centrum -->
        <div class="col-md-4">
            <div class="institution-box" id="info-center"></div>
            <h4>Informačné centrum</h4>
            <p>Poskytuje návštevníkom aktuálne informácie o turistických trasách, kultúrnych podujatiach a ubytovaní v obci.</p>
            <p><strong>Telefón:</strong> +421 43 5395 102</p>
        </div>

        <!-- Obecný úrad -->
        <div class="col-md-4">
            <div class="institution-box" id="obecny-urad"></div>
            <h4>Obecný úrad</h4>
            <p>Administratívne centrum obce, kde sa vybavujú všetky dôležité záležitosti obyvateľov a návštevníkov.</p>
            <p><strong>Adresa:</strong> Zuberec 1, 027 32 Zuberec</p>
            <p><strong>Telefón:</strong> +421 43 5395 101</p>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="../../../public/js/script.js" defer></script>

</body>
</html>
