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
        $query_quadro = 'SELECT * FROM quadri q JOIN stili s ON q.id_stile = s.id_stile JOIN artisti a ON q.id_artista = a.id_artista WHERE q.sku = "' . $_GET['sku'] . '"';
        $risultato_quadri = mysqli_query($connTeQ, $query_quadro);
        while ($riga = mysqli_fetch_array($risultato_quadri, MYSQLI_ASSOC)) { ?>
            <ol class="breadcrumbs">
                <li><a href="index.php" title="Vai alla Home" class="text-bold">Home</a></li>
                <li><a href="stile.php?id=<?php echo $riga["id_stile"]; ?>" title="Vai alla pagina <?php echo ucfirst($riga["nome_stile"]); ?>" class="text-bold"><?php echo ucfirst($riga["nome_stile"]); ?></a></li>
                <li class="last"><?php echo $riga["titolo"]; ?></li>
            </ol>
            <div id="pagina-quadro">
                <div class="half left">
                    <img src="img/<?php echo $riga["immagine"]; ?>" alt="<?php echo $riga["titolo"]; ?>">
                    <div class="img-big">
                        <button type="button" title="Guarda immagine grande" class="text-bold"><span class="fas fa-search-plus" aria-hidden="true"></span></button>
                    </div>
                </div>
                <div class="half right secondary-background-light">
                    <div class="dettagli">
                        <div class="autore-titolo">
                            <h2 class="text-bold"><?php echo $riga["titolo"]; ?></h2>
                            <h3><a href="artista.php?id=<?php echo $riga["id_artista"]; ?>" title="Vai alla pagina dell'artista <?php echo $riga["nome_artista"]; ?> <?php echo $riga["cognome_artista"]; ?>"><?php echo $riga["nome_artista"]; ?> <?php echo $riga["cognome_artista"]; ?></a></h3>
                        </div>
                        <p class="sku"><span>SKU: </span><span><?php echo $riga["sku"]; ?></span></p>
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
                            <p class="originale <?php if ($riga["sconto"]) echo 'scontato'; ?>"><span><?php echo number_format($riga["prezzo"], 2); ?>&euro;</span> <?php if ($riga["sconto"]) echo '<span class="sconto">- ' . $riga["sconto"] . '%</span>'; ?></p>
                                <?php if ($riga["finale"])  echo '<p class="finale">' . $riga["finale"] . '&euro;</p>'; ?>
                            </div>
                        </div>
                        <div class="bottoni">
                            <p id="wishlist" class="text-bold text-center"><a href="#" title="Aggiungi alla wishlist"><span class="fas fa-heart" aria-hidden="true"></span> Aggiungi alla wishlist</a></p>
                            <?php 
                            //guardo se il prodotto è già nel carello
                            if (isset($_SESSION["carrello"]) && $_SESSION["carrello"] != []) {
                                //https://www.php.net/manual/en/function.in-array.php
                                if (in_array($riga["sku"], $_SESSION["carrello"])) {
                                    echo '<p id="cta" class="text-bold text-center"><a href="carrello.php?id='.$riga["sku"].'" title="Già nel carrello" class="primary-background"><span class="fas fa-shopping-cart" aria-hidden="true"></span> GIA\' NEL CARRELLO</a></p>';
                                }
                                else {
                                    echo '<p id="cta" class="text-bold text-center"><a href="carrello.php?id='.$riga["sku"].'" title="Aggiungi al carrello" class="primary-background"><span class="fas fa-shopping-cart" aria-hidden="true"></span> ACQUISTA ORA</a></p>';
                                }

                            }
                            else {
                                echo '<p id="cta" class="text-bold text-center"><a href="carrello.php?id='.$riga["sku"].'" title="Aggiungi al carrello" class="primary-background"><span class="fas fa-shopping-cart" aria-hidden="true"></span> ACQUISTA ORA</a></p>';
                            }
                             ?>
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
        <?php } ?>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>