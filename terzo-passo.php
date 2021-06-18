<?php session_start(); ?>
<?php
include("includes/utils.php");
?>
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
            <li class="last">Ricerca avanzata - scegli il quadro</li>
        </ol>
        <div id="terzo-passo">
            <h2>Scegli il quadro</h2>
            <form action="quadro.php" method="get" id="terzo-passo">
                <?php
                //$_POST["stile"] contiene al suo interno un array di id_stile
                if (!isset($_POST["stile"]) || sizeof($_POST["stile"]) == 0) {
                    printErrorMessage();
                } else {
                    $query_quadri = "SELECT sku, titolo FROM quadri WHERE id_stile = " . $_POST["stile"][0];
                    if (sizeof($_POST["stile"]) > 1) {
                        //il for deve cominciare da 1 perchè il primo elemento l'abbiamo aggiunto prima
                        for ($i = 1; $i < sizeof($_POST["stile"]); $i++) {
                            $query_quadri = $query_quadri . " OR id_stile = " . $_POST["stile"][$i];
                        }
                    }
                    $query_quadri = $query_quadri . ";";
                    $risultato_quadri = mysqli_query($connTeQ, $query_quadri);
                    $num_righe_quadri = mysqli_num_rows($risultato_quadri);
                    if ($num_righe_quadri == 0) {
                        //caso che non capiterà mai perchè già ho scelto solo stili che hanno quadri associati
                        echo 'Nessun quadro trovato';
                    } else {
                        foreach ($risultato_quadri as $key => $value) { ?>
                            <fieldset>
                                <input type="radio" name="sku" id="sku-<?php echo $value["sku"]; ?>" value="<?php echo $value["sku"]; ?>">
                                <label for="sku-<?php echo $value["sku"]; ?>"><?php echo $value["titolo"]; ?></label>
                            </fieldset>
                    <?php }
                    } ?>
                    <button type="submit" class="primary-background secondary-color-light text-bold">INVIA</button>
            </form>
        <?php } ?>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
    <?php mysqli_close($connTeQ); ?>
</body>

</html>