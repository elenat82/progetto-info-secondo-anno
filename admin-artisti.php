<?php session_start(); ?>
<?php
include("includes/utils.php");
checkAccesso($_SERVER["REQUEST_URI"]);

function printEmptyForm()
{
    $string = '<tr>';
    $string .= '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" id="new-artista">';
    $string .= '<td>';
    $string .= '<input type="text" id="nome" name="nome" placeholder="Inserisci il nome dell\'artista" required maxlength="255">';
    $string .= '</td>';
    $string .= '<td>';
    $string .= '<input type="text" id="cognome" name="cognome" placeholder="Inserisci il congnome dell\'artista" required maxlength="255">';
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
            <li class="last">Artisti</li>
        </ol>
        <div id="pagina-amministrazione-artisti">
            <h2>Amministrazione Artisti</h2>
            <table class="amministrazione">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th class="text-center">Azione</th>
                        <th class="text-center">Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST["nome"]) && $_POST["nome"] != "" && isset($_POST["cognome"]) && $_POST["cognome"] != "") {
                        //se c'è l'id è una modifica, se no è un inserimento
                        if (isset($_POST["id_artista"]) && $_POST["id_artista"] != "") {
                            $query_modifica = 'UPDATE artisti SET nome_artista = "' . $_POST["nome"] . '", cognome_artista = "' . $_POST["cognome"] . '" WHERE id_artista = ' . $_POST["id_artista"] . ';';
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
                            $query_inserimento = 'INSERT INTO artisti (nome_artista, cognome_artista) VALUES ("' . $_POST["nome"] . '", "' . $_POST["cognome"] . '");';
                            $risultato_inserimento = mysqli_query($connTeQ, $query_inserimento);
                            if ($risultato_inserimento) {
                                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit();
                            } else {
                                printErrorMessage();
                            }
                        }
                    }
                    $query_artisti = 'SELECT * FROM artisti';
                    $risultato_artisti = mysqli_query($connTeQ, $query_artisti);
                    $num_righe_artisti = mysqli_num_rows($risultato_artisti);
                    if ($num_righe_artisti == 0) {
                        printEmptyForm();
                    } else {
                        while ($riga = mysqli_fetch_assoc($risultato_artisti)) { ?>
                            <tr>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="artista-<?php echo $riga["id_artista"] ?>">
                                    <td>
                                        <input type="hidden" id="id-<?php echo $riga["id_artista"] ?>" name="id_artista" value="<?php echo $riga["id_artista"] ?>">
                                        <input type="text" id="nome-<?php echo $riga["id_artista"] ?>" name="nome" placeholder="Inserisci il nome dell'artista" required maxlength="255" value="<?php echo $riga["nome_artista"] ?>">
                                    </td>
                                    <td>
                                        <input type="text" id="cognome-<?php echo $riga["id_artista"] ?>" name="cognome" placeholder="Inserisci il congnome dell'artista" required maxlength="255" value="<?php echo $riga["cognome_artista"] ?>">
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="primary-background secondary-color-light text-bold">Salva</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="admin-elimina.php?tabella=artisti&id=<?php echo $riga["id_artista"] ?>"><span class="fas fa-trash-alt"></span></a>
                                    </td>
                                </form>
                            </tr>
                    <?php }
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