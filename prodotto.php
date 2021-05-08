<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tali e Quadri</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/6d3b88364d.js" crossorigin="anonymous"></script>
</head>

<body class="light-background">
    <header>
        <div id="topbar">
            <form action="#" method="get" id="cerca" role="search">
                <label for="keyword">Cerca</label>
                <input type="search" name="keyword" id="keyword" maxlength="50"
                    aria-label="Cerca per artista, titolo o parola chiave" aria-placeholder="Cerca"
                    placeholder="Cerca..."> <button class="primary-background text-bold"><span class="fas fa-search secondary-color-light" aria-hidden="true"></span></button>
            </form>
            <div id="logo" class="text-center">
                <a href="index.html" title="Home">
                    <img src="img/logo.svg" alt="Logo" width="100">
                    <h1 class="primary-color text-right text-bold">Tali e Quadri<span>FALSI D'AUTORE</span></h1>
                </a>
            </div>
            <ul id="user-menu">
                <li><a href="account.html" title="Vai alla pagina Account"><span class="far fa-user primary-color" aria-hidden="true"></span> Account</a></li>
                <li><a href="carrello.html" title="Vai alla pagina Carrello"><span class="fas fa-shopping-cart primary-color" aria-hidden="true"></span> Carrello</a></li>
            </ul>
        </div>
        <nav>
            <ul>
                <li><a href="index.html" title="Vai alla pagina Home" accesskey="h" class="primary-color text-bold">HOME</a></li>
                <li><a href="#" title="Vai alla pagina Chi siamo" accesskey="s" class="primary-color text-bold">CHI SIAMO</a></li>
                <li><a href="#" title="Vai alla pagina Stili Pittorici" accesskey="p" class="primary-color text-bold">STILI PITTORICI</a></li>
                <li><a href="#" title="Vai alla pagina Artisti" accesskey="a" class="primary-color text-bold">ARTISTI</a></li>
                <li><a href="contatti.html" title="Vai alla pagina Contatti" accesskey="c" class="primary-color text-bold">CONTATTI</a></li>
                <li><a href="lavora-con-noi.html" title="Vai alla pagina Lavora con noi" accesskey="l" class="primary-color text-bold">LAVORA CON NOI</a></li>
                <li><a href="ricerca.html" title="Vai alla pagina Ricerca" accesskey="r" class="secondary-background-dark text-bold">Partecipa alla ricerca!</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <ol class="breadcrumbs">
            <li><a href="index.html" title="Vai alla Home" class="text-bold">Home</a></li>
            <li><a href="impressionismo.html" title="Vai alla pagina Impressionismo" class="text-bold">Impressionismo</a></li>
            <li class="last">Claude Monet - Ninfee</li>
        </ol>
        <div id="pagina-prodotto">
            <div class="half left">
                <img src="img/Claude_Monet_Ninfee.jpg" alt="Claude Monet - Ninfee">
                <div class="img-big">
                    <button type="button" title="Guarda immagine grande" class="text-bold"><span class="fas fa-search-plus" aria-hidden="true"></span></button>
                </div>
            </div>
            <div class="half right secondary-background-light">
                <div class="dettagli">
                    <div class="autore-titolo">
                        <h2 class="text-bold"><span>Claude Monet</span> - <span>Ninfee</span></h2>
                        <h3><a href="artista.html" title="Vai alla pagina dell'artista Claudio Monetti">Claudio Monetti</a></h3>
                    </div>
                    <p class="sku"><span>SKU: </span><span>CM08</span></p>
                    <p class="rating text-right">64 Reviews <span class="fas fa-star" aria-hidden="true"></span> <span class="fas fa-star" aria-hidden="true"></span> <span class="fas fa-star" aria-hidden="true"></span> <span class="fas fa-star" aria-hidden="true"></span> <span class="far fa-star" aria-hidden="true"></span></p>
                    <div class="dimensioni">
                        <label for="dimensioni">Dimensioni:</label>
                        <select name="dimensioni" id="dimensioni">
                            <option value="">Scegli la dimensione</option>
                            <option value="1">50 x 80</option>
                            <option value="2">130 x 90</option>
                            <option value="3">220 X 140</option>
                        </select>
                    </div>
                    <div class="prices">
                        <p>Prezzo:</p>
                        <div class="text-center">
                            <p class="originale scontato"><span>1200,00</span> <span class="sconto">- 20%</span></p>
                            <p class="finale primary-color text-bold"><span>960,00</span> <span>&euro;</span></p>
                        </div>
                    </div>
                    <div class="bottoni">
                        <p id="wishlist" class="text-bold text-center"><a href="#" title="Aggiungi alla wishlist"><span class="fas fa-heart" aria-hidden="true"></span> Aggiungi alla wishlist</a></p> 
                        <p id="cta" class="text-bold text-center"><a href="#" title="Aggiungi al carrello" class="primary-background"><span class="fas fa-shopping-cart" aria-hidden="true"></span> ACQUISTA ORA</a></p>
                    </div>
                    <div class="share">
                        <ul class="icons">
                            <li>Condividi!</li>
                            <li><a href="https://it-it.facebook.com/" title="Vai alla pagina Facebook" target="_blank"><span class="fab fa-facebook" aria-hidden="true"></span></a></li>
                            <li><a href="https://www.instagram.com/" title="Vai alla pagina Instagram" target="_blank"><span class="fab fa-instagram-square" aria-hidden="true"></span></a></li>
                            <li><a href="https://www.pinterest.it/" title="Vai alla pagina Pinterest" target="_blank"><span class="fab fa-pinterest" aria-hidden="true"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <footer>
        <p class="text-center">
            <small>Copyright 2021: Daniele Zamboni & Elena Trudini
                <br>Progetto creato in gruppo collaborativo. <br>
                Tutti i diritti sono riservati agli sviluppatori.
            </small>
        </p>
        <img src="icone/unitoCampusnet.svg" alt="Icona Unito">
        <ul class="icons">
            <li><a href="https://it-it.facebook.com/" title="Vai alla pagina Facebook" target="_blank"><span class="fab fa-facebook" aria-hidden="true"></span></a></li>
            <li><a href="https://www.instagram.com/" title="Vai alla pagina Instagram" target="_blank"><span class="fab fa-instagram-square" aria-hidden="true"></span></a></li>
            <li><a href="https://www.pinterest.it/" title="Vai alla pagina Pinterest" target="_blank"><span class="fab fa-pinterest" aria-hidden="true"></span></a></li>
        </ul>
    </footer>
</body>

</html>