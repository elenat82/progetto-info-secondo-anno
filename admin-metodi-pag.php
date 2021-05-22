<?php session_start(); ?>
<?php
include("includes/utils.php");
checkAccesso($_SERVER["REQUEST_URI"]);
function printEmptyForm()
{
    $string = '<tr>';
    $string .= '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" id="new-metodo">';
    $string .= '<td>';
    $string .= '<input type="text" id="nome" name="nome" placeholder="Inserisci il nome del metodo di pagamento" required maxlength="255">';
    $string .= '</td>';
    $string .= '<td>';
    $string .= '<input type="text" id="icona" name="icona" placeholder="Inserisci la classe di FontAwesome" required maxlength="255">';
    $string .= '</td>';
    $string .= '<td class="text-center">';
    $string .= '<button type="submit" class="primary-background secondary-color-light text-bold">Aggiungi</button>';
    $string .= '</td>';
    $string .= '<td>';
    $string .= '</td>';
    $string .= '</form>';
    $string .= '</tr>';
    echo $string;
}
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
                        <th class="text-center">Azione</th>
                        <th class="text-center">Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST["nome"]) && $_POST["nome"] != "" && isset($_POST["icona"]) && $_POST["icona"] != "") {
                        //se c'è l'id è una modifica, se no è un inserimento
                        if (isset($_POST["id_metodo_pag"]) && $_POST["id_metodo_pag"] != "") {
                            $query_modifica = 'UPDATE metodipagamento SET nome_metodo_pag = "' . $_POST["nome"] . '", icona_metodo_pag = "' . $_POST["icona"] . '" WHERE id_metodo_pag = ' . $_POST["id_metodo_pag"] . ';';
                            $risultato_modifica = mysqli_query($connTeQ, $query_modifica);
                            if ($risultato_modifica) {
                                //per evitare che dentro $_POST restino i dati dopo aver inviato il post
                                //https://en.wikipedia.org/wiki/Post/Redirect/Get
                                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit();
                            } else {
                                printErrorMessage();
                            }
                        } else {
                            $query_inserimento = 'INSERT INTO metodipagamento (nome_metodo_pag, icona_metodo_pag) VALUES ("' . $_POST["nome"] . '", "' . $_POST["icona"] . '");';
                            $risultato_inserimento = mysqli_query($connTeQ, $query_inserimento);
                            if ($risultato_inserimento) {
                                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit();
                            } else {
                                printErrorMessage();
                            }
                        }
                    }
                    $query_metodi = 'SELECT * FROM metodipagamento';
                    $risultato_metodi = mysqli_query($connTeQ, $query_metodi);
                    $num_righe_metodi = mysqli_num_rows($risultato_metodi);
                    if ($num_righe_metodi == 0) {
                        printEmptyForm();
                    } else {
                        while ($riga = mysqli_fetch_assoc($risultato_metodi)) { ?>
                            <tr>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="metodo-<?php echo $riga["id_metodo_pag"] ?>">
                                    <td>
                                        <input type="hidden" id="id-<?php echo $riga["id_metodo_pag"] ?>" name="id_metodo_pag" value="<?php echo $riga["id_metodo_pag"] ?>">
                                        <input type="text" id="nome-<?php echo $riga["id_metodo_pag"] ?>" name="nome" placeholder="Inserisci il nome del metodo di pagamento" required maxlength="255" value="<?php echo $riga["nome_metodo_pag"] ?>">
                                    </td>
                                    <td>
                                        <input type="text" id="icona-<?php echo $riga["id_metodo_pag"] ?>" name="icona" placeholder="Inserisci la classe di FontAwesome" required maxlength="255" value="<?php echo $riga["icona_metodo_pag"] ?>">
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="primary-background secondary-color-light text-bold">Salva</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="admin-elimina.php?tabella=metodipagamento&id=<?php echo $riga["id_metodo_pag"] ?>"><span class="fas fa-trash-alt"></span></a>
                                    </td>
                                </form>
                            </tr>
                    <?php
                        }
                        printEmptyForm();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
    <?php mysqli_close($connTeQ); ?>
</body>

</html>