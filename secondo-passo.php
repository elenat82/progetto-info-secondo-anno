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
            <li class="last">Ricerca avanzata - scegli lo stile</li>
        </ol>
        <div id="secondo-passo">
        <h2>Scegli lo stile</h2>
            <form action="terzo-passo.php" method="post" id="secondo-passo">
                <?php
                //non mettere select * perchè se no le righe sono tutte diverse e la distinc non funziona più
                $query_quadri = 'SELECT DISTINCT s.id_stile, s.nome_stile FROM quadri q JOIN stili s ON q.id_stile = s.id_stile WHERE q.attivo = 1';
                $risultato_quadri = mysqli_query($connTeQ, $query_quadri);
                $num_righe_quadri = mysqli_num_rows($risultato_quadri);
                if ($num_righe_quadri == 0) {
                    echo 'Nessun risultato';
                } else {
                    foreach ($risultato_quadri as $key => $value) { ?>
                        <fieldset>
                        <!-- https://stackoverflow.com/a/10655696 -->
                            <input type="checkbox" name="stile[]" id="stile-<?php echo $value["id_stile"]; ?>" value="<?php echo $value["id_stile"]; ?>">
                            <label for="stile-<?php echo $value["id_stile"]; ?>"><?php echo $value["nome_stile"]; ?></label>
                            <!-- aggiungere required, non l'ho fatto per fare lo use case dell'errore -->
                        </fieldset>
                <?php }
                }

                ?>
                <button type="submit" class="primary-background secondary-color-light text-bold">INVIA</button>
            </form>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
    <?php mysqli_close($connTeQ); ?>
</body>

</html>