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
        $query_stili = 'SELECT * FROM stili WHERE id_stile = ' . $_GET["id"] . ';';
        $risultato_stili = mysqli_query($connTeQ, $query_stili);
        $num_righe_stili = mysqli_num_rows($risultato_stili);
        if ($num_righe_stili == 0) {
            $nome_stile = "nessuno";
        } else {
            while ($riga = mysqli_fetch_array($risultato_stili, MYSQLI_ASSOC)) {
                $nome_stile = $riga["nome_stile"];
            }
        }
        ?>
        <ol class="breadcrumbs">
            <li><a href="index.php" title="Vai alla Home" class="text-bold">Home</a></li>
            <li class="last"><?php echo ucfirst($nome_stile); ?></li>
        </ol>
        <h2><?php echo ucfirst($nome_stile); ?></h2>
        <ul id="stile">
            <?php
            $query_quadri = 'SELECT * FROM quadri WHERE id_stile = ' . $_GET["id"] . ' AND attivo = 1';
            $risultato_quadri = mysqli_query($connTeQ, $query_quadri);
            $num_righe_quadri = mysqli_num_rows($risultato_quadri);
            if ($num_righe_quadri == 0) {
                echo '<li><a href="#" title="Nessun quadro trovato" class="text-bold">Nessun quadro trovato</a></li>';
            } else {
                $i = 1;
                while ($riga = mysqli_fetch_array($risultato_quadri, MYSQLI_ASSOC)) {
                    $classname = "";
                    if ($riga["sconto"]) {
                        $classname = " scontato";
                    }
                    if ($i % 2 != 0) { ?>
                        <li class="mappa-sx">
                            <div class="mappa" id="map-<?php echo $i ?>">
                                <iframe src="<?php echo $riga["mappa"] ?>" width="400" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                            <div class="descrizione">
                                <p><span class="fas fa-long-arrow-alt-left" aria-hidden="true"></span> Guarda l'originale</p>
                                <a href="quadro.php?sku=<?php echo $riga['sku'] ?>" title="Vai alla pagina <?php echo ucfirst($stile); ?> - <?php echo $riga["titolo"] ?>">
                                    <h3 class="text-bold"><?php echo $riga["titolo"] ?></h3>
                                    <p><span>SKU: </span><span><?php echo $riga["sku"] ?></span></p>
                                    <div class="prices text-center">
                                        <?php
                                        if ($riga["sconto"]) { ?>
                                            <p class="originale scontato">
                                                <span><?php echo number_format($riga["prezzo"], 2) ?>&euro;</span>
                                                <span class="sconto">- <?php echo $riga["sconto"] ?>%</span>
                                            </p>
                                            <p class="finale"><?php echo number_format($riga["finale"], 2) ?>
                                                &euro;
                                            </p>
                                        <?php
                                        } else { ?>
                                            <p class="originale">
                                                <span><?php echo number_format($riga["prezzo"], 2) ?>&euro;</span>
                                                &euro;
                                            </p>
                                            <p class="finale"></p>
                                        <?php } ?>
                                    </div>
                                    <img src="img/piccole/<?php echo $riga["immagine"] ?>" alt="<?php echo $riga["titolo"] ?>">
                                </a>
                            </div>
                        </li>
                    <?php  } else { ?>
                        <li class="mappa-dx">
                            <div class="descrizione">
                                <p class="text-right">Guarda l'originale <span class="fas fa-long-arrow-alt-right" aria-hidden="true"></span></p>
                                <a href="quadro.php?sku=<?php echo $riga['sku'] ?>" title="Vai alla pagina <?php echo $stile ?> - <?php echo $riga["titolo"] ?>">
                                    <h3 class="text-bold"><?php echo $riga["titolo"] ?></h3>
                                    <p><span>SKU: </span><span><?php echo $riga["sku"] ?></span></p>
                                    <div class="prices text-center">
                                        <?php
                                        if ($riga["sconto"]) { ?>
                                            <p class="originale scontato">
                                                <span><?php echo $riga["prezzo"] ?>&euro;</span>
                                                <span class="sconto">- <?php echo $riga["sconto"] ?>%</span>
                                            </p>
                                            <p class="finale"><?php echo $riga["finale"] ?>
                                                &euro;
                                            </p>
                                        <?php
                                        } else { ?>
                                            <p class="originale">
                                                <span><?php echo $riga["prezzo"] ?>&euro;</span>
                                                &euro;
                                            </p>
                                            <p class="finale"></p>
                                        <?php } ?>
                                    </div>
                                    <img src="img/piccole/<?php echo $riga["immagine"] ?>" alt="<?php echo $riga["titolo"] ?>">
                                </a>
                            </div>
                            <div class="mappa" id="map-<?php echo $i ?>">
                                <iframe src="<?php echo $riga["mappa"] ?>" width="400" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </li>
            <?php }
                    $i++;
                }
            }
            ?>
        </ul>
    </main>
    <?php include("includes/template_footer.php") ?>
    <?php mysqli_close($connTeQ); ?>
</body>

</html>