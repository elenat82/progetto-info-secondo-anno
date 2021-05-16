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
            <li class="last">Stili</li>
        </ol>
        <div id="pagina-amministrazione-stili">
            <h2>Amministrazione Stili</h2>
            <table class="amministrazione">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Azione</th>
                        <th>Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("includes/utils.php");
                    if (isset($_POST["nome"]) && $_POST["nome"] != "") {
                        //se c'è l'id è una modifica, se no è un inserimento
                        if (isset($_POST["id_stile"]) && $_POST["id_stile"] != "") {
                            $query_modifica = 'UPDATE stili SET nome_stile = "' . $_POST["nome"] . '" WHERE id_stile = ' . $_POST["id_stile"] . ';';
                            $risultato_modifica = mysqli_query($connTeQ, $query_modifica);
                            if ($risultato_modifica) {
                                //per evitare che dentro $_POST restino i dati dopo aver inviato il post
                                //https://en.wikipedia.org/wiki/Post/Redirect/Get
                                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit();
                            } else {
                                echo '<p class="error text-bold text-center">Si è verificato un errore. Riprovare!</p>';
                            }
                        } else {
                            $query_inserimento = 'INSERT INTO stili (nome_stile) VALUES ("' . $_POST["nome"] . '");';
                            $risultato_inserimento = mysqli_query($connTeQ, $query_inserimento);
                            if ($risultato_inserimento) {
                                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit();
                            } else {
                                echo '<p class="error text-bold text-center">Si è verificato un errore, riprova!</p>';
                            }
                        }
                    }
                    $query_stili = 'SELECT * FROM stili';
                    $risultato_stili = mysqli_query($connTeQ, $query_stili);
                    $num_righe_stili = mysqli_num_rows($risultato_stili);
                    if ($num_righe_stili == 0) { ?>
                        <tr>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="new-stile">
                                <td>
                                    <input type="text" id="nome" name="nome" placeholder="Inserisci il nome dello stile" required maxlength="255">
                                </td>
                                <td>
                                    <button type="submit">Salva</button>
                                </td>
                                <td>
                                </td>
                            </form>
                        </tr>
                        <?php
                    } else {
                        while ($riga = mysqli_fetch_assoc($risultato_stili)) { ?>
                            <tr>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="stile-<?php echo $riga["id_stile"] ?>">
                                    <td>
                                        <input type="hidden" id="id-<?php echo $riga["id_stile"] ?>" name="id_stile" value="<?php echo $riga["id_stile"] ?>">
                                        <input type="text" id="nome-<?php echo $riga["id_stile"] ?>" name="nome" placeholder="Inserisci il nome dello stile" required maxlength="255" value="<?php echo $riga["nome_stile"] ?>">
                                    </td>
                                    <td>
                                        <button type="submit">Salva</button>
                                    </td>
                                    <td>
                                        <a href="admin-elimina.php?tabella=stili&id=<?php echo $riga["id_stile"] ?>">Elimina<button>
                                    </td>
                                </form>
                            </tr>
                        <?php
                        } ?>
                        <tr>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="new-stile">
                                <td>
                                    <input type="text" id="nome" name="nome" placeholder="Inserisci il nome dello stile" required maxlength="255">
                                </td>
                                <td>
                                    <button type="submit">Salva</button>
                                </td>
                                <td>
                                </td>
                            </form>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>