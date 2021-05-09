<?php session_start(); ?>
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
    <?php include("includes/template_header.php") ?>
    <main>
        <?php
        include("includes/utils.php");
        $query_quadro = 'SELECT * FROM quadri WHERE sku = "' . $_GET['sku'] .'"';
        print_r($query_quadro);
        $risultato_quadri = mysqli_query($connTeQ, $query_quadro);
        while ($riga = mysqli_fetch_array($risultato_quadri, MYSQLI_ASSOC)) {
            echo '<pre>';
            print_r($riga);
            echo '</pre>';
            $sku = $riga["sku"];
            $titolo = $riga["titolo"];
            $prezzo = $riga["prezzo"];
            $sconto = $riga["sconto"];
            $finale = $riga["finale"];
            $immagine = $riga["immagine"];
            $mappa = $riga["mappa"];
        }
        ?>
        <ol class="breadcrumbs">
            <li><a href="index.php" title="Vai alla Home" class="text-bold">Home</a></li>
            <li><a href="impressionismo.php" title="Vai alla pagina Impressionismo" class="text-bold">Impressionismo</a></li>
            <li class="last"><?php echo $titolo; ?></li>
        </ol>
        <div id="pagina-prodotto">
            <div class="half left">
                <img src="img/<?php echo $immagine; ?>" alt="<?php echo $titolo; ?>">
                <div class="img-big">
                    <button type="button" title="Guarda immagine grande" class="text-bold"><span class="fas fa-search-plus" aria-hidden="true"></span></button>
                </div>
            </div>
            <div class="half right secondary-background-light">
                <div class="dettagli">
                    <div class="autore-titolo">
                        <h2 class="text-bold"><span>Claude Monet</span> - <span>Ninfee</span></h2>
                        <h3><a href="artista.php" title="Vai alla pagina dell'artista Claudio Monetti">Claudio Monetti</a></h3>
                    </div>
                    <p class="sku"><span>SKU: </span><span><?php echo $sku; ?></span></p>
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
                            <p class="originale scontato"><span><?php echo $prezzo; ?></span> <span class="sconto">- <?php echo $sconto; ?>%</span></p>
                            <p class="finale primary-color text-bold"><span><?php echo $finale; ?></span> <span>&euro;</span></p>
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
    <?php include("includes/template_footer.php") ?>
</body>

</html>