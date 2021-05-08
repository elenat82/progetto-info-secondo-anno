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
        <!-- https://html.spec.whatwg.org/multipage/grouping-content.html#the-blockquote-element -->
        <blockquote>
            <p>La pittura è una lunga fatica di imitazione di ciò che si ama.</p>
        </blockquote>
        <p class="autore-citazione">— Renato Guttuso</p>
        <h2 class="primary-color">I nostri stili pittorici</h2>
        <ul id="categorie">
            <?php
            include("includes/utils.php");
            $query_stili = queryGet([], 'stili', null, null);
            $risultato = mysqli_query($connessione, $query_stili);
            $num_righe = mysqli_num_rows($risultato);
            if ($num_righe == 0) {
                echo '<li><a href="#" title="Nessuno stile trovato" class="text-bold">Nessuno stile trovato</a></li>';
            } else {
                foreach ($risultato as $riga) {
                    $no_spaces = str_replace(" ", "", $riga['nome']);
                    echo '<li class="' . $no_spaces . '"><a href="' . $no_spaces . '.html" title="Vai alla pagina ' . $riga["nome"] . '" class="text-bold">' . strtoupper($riga["nome"]) . '</a></li>';
                }
            }
            ?>
        </ul>

        <h2 class="primary-color">I nostri artisti</h2>
        <ul id="artisti">
        <?php
            $query_artisti = queryGet([], 'artisti', null, null);
            $risultato = mysqli_query($connessione, $query_artisti);
            $num_righe = mysqli_num_rows($risultato);
            if ($num_righe == 0) {
                echo '<li><a href="#" title="Nessun artista trovato" class="text-bold">Nessun artista trovato</a></li>';
            } else {
                foreach ($risultato as $riga) {
                    echo '<li class="'.strtolower($riga["cognome"]).'"><a href="#" title="Vai alla pagina di '.$riga["nome"].' '.$riga["cognome"].' " class="text-bold">'.$riga["nome"].' '.$riga["cognome"].'</a></li>';
                }
            }
            ?>
            <!-- <li class="monetti"><a href="#" title="Vai alla pagina di Claudio Monetti" class="text-bold">Claudio Monetti</a></li>
            <li class="goghi"><a href="#" title="Vai alla pagina di Vincenzo Goghi" class="text-bold">Vincenzo Goghi</a></li>
            <li class="picassi"><a href="#" title="Vai alla pagina di Paolo Picassi" class="text-bold">Paolo Picassi</a></li> -->
        </ul>
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