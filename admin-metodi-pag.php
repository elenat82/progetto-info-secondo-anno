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
            <li class="last">Metodi di pagamento</li>
        </ol>
        <div id="pagina-amministrazione-metodi">
            <h2>Amministrazione Metodi di pagamento</h2>
            <table class="amministrazione">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Icona</th>
                        <th>Azione</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("includes/utils.php");
                    if (isset($_POST["nome"]) && $_POST["nome"] != "" && isset($_POST["icona"]) && $_POST["icona"] != "") {
                        //se c'è l'id è una modifica, se no è un inserimento
                        if (isset($_POST["id_metodo_pag"]) && $_POST["id_metodo_pag"] != "") {
                            $query_modifica = 'UPDATE metodipagamento SET nome_metodo_pag = "'.$_POST["nome"].'", icona_metodo_pag = "'.$_POST["icona"].'" WHERE id_metodo_pag = '.$_POST["id_metodo_pag"].';';
                            $risultato_modifica = mysqli_query($connTeQ, $query_modifica);
                            if ($risultato_modifica) {
                                //per evitare che dentro $_POST restino i dati dopo aver inviato il post
                                //https://en.wikipedia.org/wiki/Post/Redirect/Get
                                header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
                                exit();
                            } else {
                                echo '<p class="error text-bold text-center">Si è verificato un errore. Riprovare!</p>';
                            }
                        }
                        else {
                            $query_inserimento = 'INSERT INTO metodipagamento (nome_metodo_pag, icona_metodo_pag) VALUES ("'.$_POST["nome"].'", "'.$_POST["icona"].'");';
                            $risultato_inserimento = mysqli_query($connTeQ, $query_inserimento);
                            if ($risultato_inserimento) {
                                header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
                                exit();
                            }
                            else {
                                echo '<p class="error text-bold text-center">Si è verificato un errore, riprova!</p>';
                            }
                        }
                    }
                    $query_metodi = 'SELECT * FROM metodipagamento';
                    $risultato_metodi = mysqli_query($connTeQ, $query_metodi);
                    $num_righe_metodi = mysqli_num_rows($risultato_metodi);
                    if ($num_righe_metodi == 0) {
                        echo '<tr>';
                        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" id="new-metodo">';
                        echo '<td>';
                        echo '<input type="text" id="nome" name="nome" placeholder="Inserisci il nome del metodo di pagamento" required maxlength="255">';
                        echo '</td>';
                        echo '<td>';
                        echo '<input type="text" id="icona" name="icona" placeholder="Inserisci la classe di FontAwesome" required maxlength="255">';
                        echo '</td>';
                        echo '<td>';
                        echo '<button type="submit">Salva</button>';
                        echo '</td>';
                        echo '<td>';
                        echo '</td>';
                        echo '</form>';
                        echo '</tr>';
                    } else {
                        while ($riga = mysqli_fetch_assoc($risultato_metodi)) {
                            echo '<tr>';
                            echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" id="metodo-' . $riga["id_metodo_pag"] . '">';
                            echo '<td>';
                            echo '<input type="hidden" id="id-'.$riga["id_metodo_pag"].'" name="id_metodo_pag" value="'.$riga["id_metodo_pag"].'">';
                            echo '<input type="text" id="nome-' . $riga["id_metodo_pag"] . '" name="nome" placeholder="Inserisci il nome del metodo di pagamento" required maxlength="255" value="' . $riga["nome_metodo_pag"] . '">';
                            echo '</td>';
                            echo '<td>';
                            echo '<input type="text" id="icona-' . $riga["id_metodo_pag"] . '" name="icona" placeholder="Inserisci la classe di FontAwesome" required maxlength="255" value="' . $riga["icona_metodo_pag"] . '">';
                            echo '</td>';
                            echo '<td>';
                            echo '<button type="submit">Salva</button>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="admin-elimina.php?tabella=metodipagamento&id='.$riga["id_metodo_pag"].'">Elimina<button>';
                            echo '</td>';
                            echo '</form>';
                            echo '</tr>';
                        }
                        echo '<tr>';
                        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" id="new-metodo">';
                        echo '<td>';
                        echo '<input type="text" id="nome" name="nome" placeholder="Inserisci il nome del metodo di pagamento" required maxlength="255">';
                        echo '</td>';
                        echo '<td>';
                        echo '<input type="text" id="icona" name="icona" placeholder="Inserisci la classe di FontAwesome" required maxlength="255">';
                        echo '</td>';
                        echo '<td>';
                        echo '<button type="submit">Salva</button>';
                        echo '</td>';
                        echo '<td>';
                        echo '</td>';
                        echo '</form>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>