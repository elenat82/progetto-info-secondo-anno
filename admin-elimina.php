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
            <li><a href="amministrazione.php" title="Vai alla pagina Amministrazione" class="text-bold">Amministrazione</a></li>
            <?php
            switch ($_GET["tabella"]) {
                case 'artisti':
                    echo '<li><a href="admin-artisti.php" title="Vai alla pagina amministrazione Artisti" class="text-bold">Artisti</a></li>';
                    break;
                case 'metodipagamento':
                    echo '<li><a href="admin-metodi-pag.php" title="Vai alla pagina amministrazione Metodi di pagamento" class="text-bold">Metodi di pagamento</a></li>';
                    break;
                case 'stili':
                    echo '<li><a href="admin-stili.php" title="Vai alla pagina amministrazione Stili" class="text-bold">Stili</a></li>';
                    break;
                case 'quadri':
                    echo '<li><a href="admin-quadri.php" title="Vai alla pagina amministrazione Quadri" class="text-bold">Quadri</a></li>';
                    break;
                case 'utenti':
                    echo '<li><a href="admin-utenti.php" title="Vai alla pagina amministrazione Utenti" class="text-bold">Utenti</a></li>';
                    break;
                default:
                    break;
            }
            ?>
            <li class="last">Elimina</li>
        </ol>
        <div id="pagina-amministrazione-elimina">
            <h2>Eliminazione</h2>
            <?php
            include("includes/utils.php");
            //per gli utenti e i quadri non faccio veramente la cancellazione ma uso un campo attivo/non attivo, per le altre tabelle faccio proprio la delete del record
            if ($_GET["tabella"] == 'utenti' || $_GET["tabella"] == 'quadri') {
                if ($_GET["action"] == "elimina") {
                    $value = 0;
                } else {
                    $value = 1;
                }
                if ($_GET["tabella"] == 'utenti') {
                    $key = 'email';
                } else {
                    $key = 'sku';
                }
                $query_modifica = 'UPDATE ' . $_GET["tabella"] . ' SET attivo = ' . $value . ' WHERE ' . $key . ' = "' . $_GET["id"] . '";';
                $risultato_modifica = mysqli_query($connTeQ, $query_modifica);
                if ($risultato_modifica) {
                    echo '<div class="thank-you-message">';
                    echo '<p class="text-center text-bold">L\'operazione è avvenuta con successo!</p>';
                    echo '</div>';
                } else {
                    echo '<div class="thank-you-message">';
                    echo '<p class="error text-bold text-center">Si è verificato un errore. Riprovare!</p>';
                    echo '</div>';
                }
            } else {
                $key;
                switch ($_GET["tabella"]) {
                    case 'artisti':
                        $key = 'id_artista';
                        break;
                    case 'metodipagamento':
                        $key = 'id_metodo_pag';
                        break;
                    case 'stili':
                        $key = 'id_stile';
                        break;
                    default:
                        break;
                }
                $query_eliminazione = 'DELETE FROM ' . $_GET["tabella"] . ' WHERE ' . $key . ' = ' . $_GET["id"] . ';';
                $risultato_eliminazione = mysqli_query($connTeQ, $query_eliminazione);
                if ($risultato_eliminazione) {
                    echo '<div class="thank-you-message">';
                    echo '<p class="text-center text-bold">L\'eliminazione è avvenuta con successo!</p>';
                    echo '</div>';
                } else {
                    echo '<div class="thank-you-message">';
                    echo '<p class="error text-bold text-center">Si è verificato un errore. Riprovare!</p>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>