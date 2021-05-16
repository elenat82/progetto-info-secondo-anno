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
            <li class="last">Quadri</li>
        </ol>
        <div id="pagina-amministrazione-utenti">
            <h2>Amministrazione Quadri</h2>
            <table class="amministrazione">
                <tbody>
                    <?php
                    include("includes/utils.php");
                    if (isset($_POST["sku"]) && $_POST["sku"] != "" && isset($_POST["titolo"]) && $_POST["titolo"] != "" && isset($_POST["prezzo"]) && $_POST["prezzo"] != "" && isset($_POST["immagine"]) && $_POST["immagine"] != "" && isset($_POST["mappa"]) && $_POST["mappa"] != "" && isset($_POST["id_artista"]) && $_POST["id_artista"] != "" && isset($_POST["id_stile"]) && $_POST["id_stile"] != "") {
                        $sconto = 0;
                        if ($_POST["sconto"]) {
                            $sconto = $_POST["sconto"];
                        }
                        $finale = 0;
                        if ($_POST["finale"]) {
                            $finale = $_POST["finale"];
                        }
                        //guardo il campo hidden azione
                        if (isset($_POST["azione"]) && $_POST["azione"] == "modifica") {
                            $query_modifica = 'UPDATE quadri SET sku = "' . $_POST["sku"] . '", titolo = "' . $_POST["titolo"] . '", prezzo = ' . $_POST["prezzo"] . ', sconto = ' . $sconto . ', finale = ' . $finale . ', immagine = "' . $_POST["immagine"] . '", mappa = "' . $_POST["mappa"] . '", id_artista = ' . $_POST["id_artista"] . ', id_stile = ' . $_POST["id_stile"] . ' WHERE sku = "' . $_POST["sku"] . '";';
                            $risultato_modifica = mysqli_query($connTeQ, $query_modifica);
                            if ($risultato_modifica) {
                                //per evitare che dentro $_POST restino i dati dopo aver inviato il post
                                //https://en.wikipedia.org/wiki/Post/Redirect/Get
                                /* header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit(); */
                            } else {
                                echo '<p class="error text-bold text-center">Si è verificato un errore. Riprovare!</p>';
                            }
                        } else {
                            //attivo è di default a true
                            $query_inserimento = 'INSERT INTO quadri (sku, titolo, prezzo, sconto, finale, immagine, mappa, id_artista, id_stile, attivo) VALUES ("' . $_POST["sku"] . '", "' . $_POST["titolo"] . '", ' . $_POST["prezzo"] . ', ' . $sconto . ', ' . $finale . ', "' . $_POST["immagine"] . '", "' . $_POST["mappa"] . '", ' . $_POST["id_artista"] . ', ' . $_POST["id_stile"] . ', 1);';
                            $risultato_inserimento = mysqli_query($connTeQ, $query_inserimento);
                            if ($risultato_inserimento) {
                                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit();
                            } else {
                                echo '<p class="error text-bold text-center">Si è verificato un errore, riprova!</p>';
                            }
                        }
                    }
                    $query_artisti = "SELECT * FROM artisti";
                    $risultato_artisti = mysqli_query($connTeQ, $query_artisti);
                    $query_stili = "SELECT * FROM stili";
                    $risultato_stili = mysqli_query($connTeQ, $query_stili);
                    $query_quadri = 'SELECT * FROM quadri WHERE attivo = 1';
                    $risultato_quadri = mysqli_query($connTeQ, $query_quadri);
                    $num_righe_quadri = mysqli_num_rows($risultato_quadri);
                    if ($num_righe_quadri == 0) { ?>
                        <tr>
                            <th>Sku</th>
                            <th>Titolo</th>
                            <th>Prezzo</th>
                            <th>Sconto</th>
                            <th>Finale</th>
                            <th>Immagine</th>
                        </tr>
                        <tr>
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="new-quadro">
                                <td>
                                    <input type="hidden" id="azione" name="azione" value="inserisci">
                                    <input type="text" id="sku" name="sku" placeholder="Inserisci l'sku del quadro" required maxlength="5">
                                </td>
                                <td>
                                    <input type="text" id="titolo" name="titolo" placeholder="Inserisci il titolo del quadro" required maxlength="255">
                                </td>
                                <td>
                                    <input type="number" id="prezzo" name="prezzo" placeholder="Inserisci il prezzo del quadro" required>
                                </td>
                                <td>
                                    <input type="number" id="sconto" name="sconto" placeholder="Inserisci lo sconto del quadro">
                                </td>
                                <td>
                                    <input type="number" id="finale" name="finale" placeholder="Inserisci il prezzo finale del quadro">
                                </td>
                                <td>
                                    <input type="text" id="immagine" name="immagine" placeholder="Inserisci l'immagine del quadro" required>
                                </td>
                        </tr>
                        <tr>
                            <th colspan="2">Mappa</th>
                            <th>Artista</th>
                            <th>Stile</th>
                            <th>Azione</th>
                            <th>Elimina</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="mappa" name="mappa" placeholder="Inserisci l'url della mappa" required maxlength="500"></textarea>
                            </td>
                            <td>
                                <select id="id_artista" name="id_artista">
                                    <option value="">Scegli un artista</option>
                                    <?php
                                    foreach ($risultato_artisti as $key => $art) {
                                        echo '<option value="' . $art["id_artista"] . '" required>' . $art["nome_artista"] . ' ' . $art["cognome_artista"] . '</option>';
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <select id="id_stile" name="id_stile">
                                    <option value="">Scegli uno stile</option>
                                    <?php
                                    foreach ($risultato_stili as $key => $stile) {
                                        echo '<option value="' . $stile["id_stile"] . '" required>' . $stile["nome_stile"] . '</option>';
                                    } ?>
                                </select>
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
                        foreach ($risultato_quadri as $key => $value) { ?>
                            <tr>
                                <th>Sku</th>
                                <th>Titolo</th>
                                <th>Prezzo</th>
                                <th>Sconto</th>
                                <th>Finale</th>
                                <th>Immagine</th>
                            </tr>
                            <tr>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="quadro-<?php echo  $key ?>">
                                    <td>
                                        <input type="hidden" id="azione" name="azione" value="modifica">
                                        <input type="text" id="sku-<?php echo $key ?>" name="sku" placeholder="Inserisci l'sku del quadro" required maxlength="255" value="<?php echo $value["sku"] ?>">
                                    </td>
                                    <td>
                                        <input type="text" id="titolo-<?php echo $key ?>" name="titolo" placeholder="Inserisci il titolo del quadro" required maxlength="255" value="<?php echo $value["titolo"] ?>">
                                    </td>
                                    <td>
                                        <input type="number" id="prezzo-<?php echo $key ?>" name="prezzo" placeholder="Inserisci il prezzo del quadro" required maxlength="255" value="<?php echo $value["prezzo"] ?>">
                                    </td>
                                    <td>
                                        <input type="number" id="sconto-<?php echo $key ?>" name="sconto" placeholder="Inserisci lo sconto del quadro" value="<?php echo $value["sconto"] ?>">
                                    </td>
                                    <td>
                                        <input type="number" id="finale-<?php echo $key ?>" name="finale" placeholder="Inserisci il prezzo finale del quadro" value="<?php echo $value["finale"] ?>">
                                    </td>
                                    <td>
                                        <input type="text" id="immagine-<?php echo $key ?>" name="immagine" placeholder="Inserisci l'immagine del quadro" required maxlength="255" value="<?php echo $value["immagine"] ?>">
                                    </td>
                            </tr>
                            <tr>
                                <th colspan="2">Mappa</th>
                                <th>Artista</th>
                                <th>Stile</th>
                                <th>Azione</th>
                                <th>Elimina</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea id="mappa-<?php echo $key ?>" name="mappa" placeholder="Inserisci l'url della mappa" required maxlength="500"><?php echo $value["mappa"] ?></textarea>
                                </td>
                                <td>
                                    <select id="id_artista" name="id_artista">
                                        <?php
                                        foreach ($risultato_artisti as $key => $art) {
                                            echo '<option value="' . $art["id_artista"] . '" required ';
                                            if ($art["id_artista"] == $value['id_artista']) echo 'selected';
                                            echo '>' . $art["nome_artista"] . ' ' . $art["cognome_artista"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td>
                                    <select id="id_stile" name="id_stile">
                                        <?php
                                        foreach ($risultato_stili as $key => $stile) {
                                            echo '<option value="' . $stile["id_stile"] . '" required ';
                                            if ($stile["id_stile"] == $value['id_stile']) echo 'selected';
                                            echo '>' . $stile["nome_stile"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit">Salva</button>
                                </td>
                                <td>
                                    <a href="admin-elimina.php?tabella=quadri&id=<?php echo $value["sku"] ?>&action=elimina">Elimina<button>
                                </td>
                                </form>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th>Sku</th>
                            <th>Titolo</th>
                            <th>Prezzo</th>
                            <th>Sconto</th>
                            <th>Finale</th>
                            <th>Immagine</th>
                        </tr>
                        <tr>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="new-quadro">
                                <td>
                                    <input type="hidden" id="azione" name="azione" value="inserisci">
                                    <input type="text" id="sku" name="sku" placeholder="Inserisci l'sku del quadro" required maxlength="5">
                                </td>
                                <td>
                                    <input type="text" id="titolo" name="titolo" placeholder="Inserisci il titolo del quadro" required maxlength="255">
                                </td>
                                <td>
                                    <input type="number" id="prezzo" name="prezzo" placeholder="Inserisci il prezzo del quadro" required>
                                </td>
                                <td>
                                    <input type="number" id="sconto" name="sconto" placeholder="Inserisci lo sconto del quadro">
                                </td>
                                <td>
                                    <input type="number" id="finale" name="finale" placeholder="Inserisci il prezzo finale del quadro">
                                </td>
                                <td>
                                    <input type="text" id="immagine" name="immagine" placeholder="Inserisci l'immagine del quadro" required>
                                </td>
                        </tr>
                        <tr>
                            <th colspan="2">Mappa</th>
                            <th>Artista</th>
                            <th>Stile</th>
                            <th>Azione</th>
                            <th>Elimina</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="mappa" name="mappa" placeholder="Inserisci l'url della mappa" required maxlength="500"></textarea>
                            </td>
                            <td>
                                <select id="id_artista" name="id_artista">
                                    <option value="">Scegli un artista</option>
                                    <?php
                                    foreach ($risultato_artisti as $key => $art) {
                                        echo '<option value="' . $art["id_artista"] . '" required>' . $art["nome_artista"] . ' ' . $art["cognome_artista"] . '</option>';
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <select id="id_stile" name="id_stile">
                                    <option value="">Scegli uno stile</option>
                                    <?php
                                    foreach ($risultato_stili as $key => $stile) {
                                        echo '<option value="' . $stile["id_stile"] . '" required>' . $stile["nome_stile"] . '</option>';
                                    } ?>
                                </select>
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

            <h2>Quadri fuori catalogo</h2>
            <ul>
                <?php
                $query_disab = 'SELECT * FROM quadri WHERE attivo = 0';
                $risultato_disab = mysqli_query($connTeQ, $query_disab);
                $num_righe_disab = mysqli_num_rows($risultato_disab);
                if ($num_righe_disab == 0) {
                    echo '<li><p>Nessun quadro fuori catalogo</p></li>';
                } else {
                    while ($riga = mysqli_fetch_assoc($risultato_disab)) {
                        echo '<li><p>' . $riga["sku"] . ' ' . $riga["titolo"] . '<a href="admin-elimina.php?tabella=quadri&id=' . $riga["sku"] . '&action=riabilita"><span class="fas fa-door-open"></span> Rimetti in catalogo</a></p></li>';
                    }
                }
                ?>
            </ul>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>