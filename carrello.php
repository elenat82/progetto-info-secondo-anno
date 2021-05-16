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
        <ol class="breadcrumbs">
            <li><a href="index.php" title="Vai alla Home" class="text-bold">Home</a></li>
            <li class="last">Carrello</li>
        </ol>
        <h2>Carrello</h2>
        <ol id="checkout-progress">
            <li class="current"><a href="carrello.php" title="Vai alla pagina del carrello" class="text-bold">Carrello</a></li>
            <li><a href="indirizzi.php" title="Vai alla pagina degli indirizzi">Indirizzi</a></li>
            <li><a href="pagamento.php" title="Vai alla pagina del pagamento">Pagamento</a></li>
        </ol>
        <table id="carrello">
            <thead>
                <tr>
                    <th class="text-bold text-center">QUADRO</th>
                    <th class="text-bold text-center">DESCRIZIONE</th>
                    <th class="text-bold text-center">PREZZO UNITARIO</th>
                    <th class="text-bold text-center">QUANTITA'</th>
                    <th class="text-bold text-center">TOTALE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("includes/utils.php");
                //se non viene passato il parametro vuol dire che sono andata nella pagina 
                //del carrello solo per visualizzarlo
                if (isset($_GET["id"]) && $_GET["id"] != "") {
                    if (isset($_SESSION["carrello"])) {
                        //se non c'è già lo metto nel carrello
                        if (!in_array($_GET["id"], $_SESSION["carrello"])) {
                            //oppure usare array_push($arr, $el)
                            $_SESSION["carrello"][] = $_GET["id"];
                        }
                    } else {
                        $_SESSION["carrello"] = [];
                        $_SESSION["carrello"][] = $_GET["id"];
                    }
                }
                //https://stackoverflow.com/questions/6102398/php-implode-101-with-quotes
                $query_quadri = 'SELECT * FROM quadri WHERE sku in ("' . implode('","', isset($_SESSION["carrello"]) ? $_SESSION["carrello"] : []) . '");';
                $risultato_quadri = mysqli_query($connTeQ, $query_quadri);
                $num_righe_quadri = mysqli_num_rows($risultato_quadri);
                $totale_carrello = 0;
                if ($num_righe_quadri == 0) {
                    echo '<tr><td colspan="5"><p class="text-center">Nessun quadro nel carrello</p></td></tr>';
                } else {
                    while ($riga = mysqli_fetch_assoc($risultato_quadri)) {
                        //https://www.php.net/manual/en/function.file-exists.php
                        if (file_exists("img/thumbs/" . $riga["immagine"])) {
                            $path = "img/thumbs/" . $riga["immagine"];
                        } else {
                            $path = "https://placekitten.com/150/100";
                        }
                ?>
                        <tr id="quadro-<?php echo $riga["sku"]; ?>">
                            <td class="thumb text-center"><a href="quadro.php?id=<?php echo $riga["sku"]; ?>" title="Vai al quadro <?php echo $riga["titolo"]; ?>"><img src="<?php echo $path; ?>" alt="<?php echo $riga["titolo"]; ?>"></a></td>
                            <td>
                                <h3><a href="quadro.php?sku=<?php echo $riga["sku"]; ?>" title="Vai al quadro <?php echo $riga["titolo"]; ?>"><?php echo $riga["titolo"]; ?></a></h3>
                                <p><span>SKU: </span><span><?php echo $riga["sku"]; ?></span></p>
                            </td>
                            <td class="prices text-center">
                                <p class="originale <?php if ($riga["sconto"]) echo 'scontato'; ?>"><span><?php echo number_format($riga["prezzo"], 2); ?>&euro;</span> <?php if ($riga["sconto"]) echo '<span class="sconto">- ' . $riga["sconto"] . '%</span>'; ?></p>
                                <?php if ($riga["finale"])  echo '<p class="finale">' . $riga["finale"] . '&euro;</p>'; ?>
                            </td>
                            <td><label for="quantita-<?php echo $riga["sku"]; ?>">N. </label><input type="number" name="quantita-<?php echo $riga["sku"]; ?>" id="quantita-<?php echo $riga["sku"]; ?>" value="1" min="1" max="5"><a href="aggiorna-carrello.php?sku=<?php echo $riga["sku"]; ?>" title="Rimuovi quadro"><span class="fas fa-trash-alt" aria-hidden="true"></span></a></td>
                            <!-- https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary -->
                            <td class="total-price primary-color text-bold"><?php echo $riga["finale"] ? $riga["finale"] : number_format($riga["prezzo"], 2); ?>&euro;</td>
                        </tr>
                <?php
                        $totale_carrello += $riga["finale"] ? $riga["finale"] : $riga["prezzo"];
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td class="text-right">Totale prodotti (iva incl.)</td>
                    <td class="text-right"><?php echo number_format($totale_carrello, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td class="text-right">Totale spedizione</td>
                    <td class="text-right">80.00</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td class="text-right">Totale</td>
                    <td class="text-right total-price primary-color secondary-background-light text-bold"><strong><?php echo number_format($totale_carrello + 80, 2); ?></strong> &euro;</span></td>
                </tr>
            </tfoot>
        </table>
        <ul id="checkout-navigation">
            <li><a href="index.php" title="Torna alla home"><span class="fas fa-arrow-left" aria-hidden="true"></span> Continua lo shopping</a></li>
            <li><a href="indirizzi.php" title="Vai alla pagina degli indirizzi">Indirizzi <span class="fas fa-arrow-right" aria-hidden="true"></span></a></li>
        </ul>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>