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
        <!-- https://html.spec.whatwg.org/multipage/grouping-content.php#the-blockquote-element -->
        <blockquote>
            <p>La pittura è una lunga fatica di imitazione di ciò che si ama.</p>
        </blockquote>
        <p class="autore-citazione">— Renato Guttuso</p>
        <h2 class="primary-color">I nostri stili pittorici</h2>
        <ul id="categorie">
            <?php
            include("includes/utils.php");
            $query_stili = "SELECT * FROM stili";
            $risultato = mysqli_query($connTeQ, $query_stili);
            $num_righe = mysqli_num_rows($risultato);
            if ($num_righe == 0) {
                echo '<li><a href="#" title="Nessuno stile trovato" class="text-bold">Nessuno stile trovato</a></li>';
            } else {
                foreach ($risultato as $riga) {
                    $no_spaces = str_replace(" ", "-", $riga['nome_stile']);
                    echo '<li class="' . $no_spaces . '"><a href="stile.php?id=' . $riga["id_stile"] . '" title="Vai alla pagina ' . ucfirst($riga["nome_stile"]) . '" class="text-bold">' . strtoupper($riga["nome_stile"]) . '</a></li>';
                }
            }
            ?>
        </ul>

        <h2 class="primary-color">I nostri artisti</h2>
        <ul id="artisti">
        <?php
            $query_artisti = "SELECT * FROM artisti ORDER BY rand() LIMIT 3";
            $risultato = mysqli_query($connTeQ, $query_artisti);
            $num_righe = mysqli_num_rows($risultato);
            if ($num_righe == 0) {
                echo '<li><a href="#" title="Nessun artista trovato" class="text-bold">Nessun artista trovato</a></li>';
            } else {
                foreach ($risultato as $riga) {
                    echo '<li class="'.strtolower($riga["cognome_artista"]).'"><a href="#" title="Vai alla pagina di '.$riga["nome_artista"].' '.$riga["cognome_artista"].' " class="text-bold">'.$riga["nome_artista"].' '.$riga["cognome_artista"].'</a></li>';
                }
            }
            mysqli_close($connTeQ);
            ?>
        </ul>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>