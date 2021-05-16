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
            <li class="last">Account</li>
        </ol>
        <h2>Benvenuto, <?php echo $_SESSION["nome_utente"]; ?>!</h2>
        <div id="pagina-account">
            <section>
                <h3>Informazioni personali</h3>
                <form action="thankyou-page.php" method="post" id="info">
                    <div>
                        <label for="email">E-mail <span>*</span></label>
                        <input type="email" name="email" id="email" value="<?php echo $_SESSION["email"]; ?>" placeholder="Inserisci il tuo indirizzo e-mail" required maxlength="50">
                    </div>
                    <div>
                        <label for="nome">Nome <span>*</span></label>
                        <input type="text" name="nome_utente" id="nome" value="<?php echo $_SESSION["nome_utente"]; ?>" placeholder="Inserisci il tuo nome" maxlength="50" required>
                        <label for="cognome">Cognome <span>*</span></label>
                        <input type="text" name="cognome_utente" id="cognome" value="<?php echo $_SESSION["cognome_utente"]; ?>" placeholder="Inserisci il tuo cognome" maxlength="50" required>
                    </div>
                    <div>
                        <label for="nascita">Data di nascita <span>*</span></label>
                        <input type="date" name="nascita" id="nascita" value="<?php echo $_SESSION["datanascita"]; ?>">
                    </div>
                    <fieldset>
                        <legend>Sesso <span>*</span></legend>
                        <input type="radio" id="maschio" name="sesso" value="m" <?php if ($_SESSION["sesso"] == "m") echo 'checked'; ?>>
                        <label for="maschio">Maschio</label>
                        <input type="radio" id="femmina" name="sesso" value="f" <?php if ($_SESSION["sesso"] == "f") echo 'checked'; ?>>
                        <label for="femmina">Femmina</label>
                        <input type="radio" id="altro" name="sesso" value="a" <?php if ($_SESSION["sesso"] == "a") echo 'checked'; ?>>
                        <label for="altro">Altro</label>
                    </fieldset>
                    <hr>
                    <div>
                        <p class="hint">Se desideri modificare la tua password compila i campi sottostanti:</p>
                        <label for="oldpassword">Password attuale</label>
                        <input type="password" name="oldpassword" id="oldpassword" placeholder="Inserisci la tua password corrente" maxlength="50">
                        <label for="newpassword">Nuova password</label>
                        <input type="password" name="newpassword" id="newpassword" placeholder="Inserisci la tua nuova password" maxlength="50">
                    </div>
                    <div class="form-buttons">
                        <button type="reset" class="text-bold">Annulla Modifiche</button>
                        <button type="submit" class="primary-background secondary-color-light text-bold">SALVA MODIFICHE</button>
                    </div>
                </form>
            </section>
            <section>
                <h3>Storico ordini</h3>
                <table id="ordini">
                    <thead>
                        <tr>
                            <th class="text-bold text-center">Numero ordine</th>
                            <th class="text-bold text-center">Data</th>
                            <th class="text-bold text-center">Importo totale</th>
                            <th class="text-bold text-center">Pagamento</th>
                            <th class="text-bold text-center">Stato</th>
                            <th class="text-bold text-center">Fattura</th>
                            <th class="text-bold text-center">Dettaglio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("includes/utils.php");
                        $query_ordini = 'SELECT * FROM ordini o JOIN stati_ordine s ON o.id_stato_ord = s.id_stato_ordine JOIN metodipagamento m ON m.id_metodo_pag = o.tipo_pag_ord WHERE o.id_utente = "' . $_SESSION["email"] . '"';
                        $risultato_ordini = mysqli_query($connTeQ, $query_ordini);
                        $num_righe_ordini = mysqli_num_rows($risultato_ordini);
                        if ($num_righe_ordini == 0) { ?>
                            <tr>
                                <td colspan="7" class="text-center">Nessun ordine</td>
                            </tr>
                            <?php
                        } else {
                            while ($riga = mysqli_fetch_assoc($risultato_ordini)) { ?>
                                <tr>
                                    <td class="n-ordine text-center"><?php $riga["numero_ordine"] ?></td>
                                    <td class="data-ordine text-center"><?php $riga["data_ordine"] ?></td>
                                    <td class="total-price primary-color text-center text-bold"><?php $riga["totale_ordine"] ?></td>
                                    <td class="metodo-pagamento text-center"><span class="<?php $riga["nome_metodo_pag"] ?>"><span class="<?php $riga["icona_metodo_pag"] ?> primary-color" aria-hidden="true"></span> <?php $riga["nome_metodo_pag"] ?></span></td>
                                    <td class="stato-ordine text-center"><span class="<?php $riga["nome_stato_ordine"] ?>"> <?php ucfirst($riga["nome_stato_ordine"]) ?></span></td>
                                    <td class="text-center"><a href="fattura-<?php $riga["numero_ordine"] ?>.pdf" title="Visualizza la fattura"><span class="fas fa-file-download" aria-hidden="true"></span></a></td>
                                    <td class="text-center"><a href="dettaglio.php" title="Visualizza il dettaglio">+ info</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </section>
            <section>
                <h3>Indirizzi</h3>
                <ul id="indirizzi">
                    <?php
                    $query_indirizzi = 'SELECT * FROM indirizzi WHERE id_utente = "' . $_SESSION["email"] . '"';
                    $risultato_indirizzi = mysqli_query($connTeQ, $query_indirizzi);
                    $num_righe_indirizzi = mysqli_num_rows($risultato_indirizzi);
                    if ($num_righe_indirizzi == 0) { ?>
                        <li>
                            <p class="indirizzo"><a href="#" title="Aggiungi un indirizzo">Aggiungi un indirizzo</a></p>
                        </li>
                        <?php
                    } else {
                        while ($riga = mysqli_fetch_assoc($risultato_indirizzi)) {
                            if ($riga["tipo_indirizzo"] == "f") {
                                $tipo_ind = "fatturazione";
                            } else if ($riga["tipo_indirizzo"] == "s") {
                                $tipo_ind = "spedizione";
                            } else {
                                $tipo_ind = "altro";
                            } ?>
                            <li>
                                <p class="tipo <?php echo $tipo_ind ?>"> <?php echo ucfirst($tipo_ind) ?>:</p>
                                <p><strong class="primary-color text-bold"><?php echo $riga["nome_indirizzo"] ?></strong></p>
                                <p class="indirizzo"><?php echo $riga["via"] ?>, <?php echo $riga["civico"] ?> <br><?php echo $riga["cap"] ?> <?php $riga["comune"] ?> (<?php echo $riga["provincia"] ?>) <br><?php echo $riga["stato_indirizzo"] ?></p>
                                <p class="telefono"><?php echo $riga["telefono"] ?></p>
                                <p><a href="#" title="Modifica l'indirizzo di <?php echo $tipo_ind ?>">Modifica</a></p>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </section>
            <section>
                <h3>Wishlist</h3>
                <?php
                $query_wishlist = 'SELECT * FROM wishlist w JOIN quadri q ON w.sku_quadro = q.sku WHERE id_utente = "' . $_SESSION["email"] . '"';
                $risultato_wishlist = mysqli_query($connTeQ, $query_wishlist);
                $num_righe_wishlist = mysqli_num_rows($risultato_wishlist);
                if ($num_righe_wishlist == 0) {
                    echo '<p class="wishlist"><a href="#" title="Aggiungi una wishlist">Aggiungi una wishlist</a></p>';
                } else {
                    while ($riga = mysqli_fetch_assoc($risultato_wishlist)) { ?>
                        <details>
                            <summary class="primary-color"><?php echo $riga["nome_wishlist"] ?></summary>
                            <ul class="wishlist">
                                <li>
                                    <h3><a href="#" title="Vai al quadro"><?php echo $riga["titolo"] ?></a></h3>
                                </li>
                            </ul>
                        </details>
                <?php
                    }
                }
                ?>
            </section>
            <section>
                <ul id="user-menu-2">
                    <?php
                    if (isset($_SESSION['loggato']) && $_SESSION['loggato'] == true) {
                        echo '<li><a href="logout.php" title="Vai alla pagina Logout"><span class="fas fa-sign-out-alt primary-color" aria-hidden="true"></span> Logout</a></li>';
                    } else {
                        echo '<li>Nessun logout</li>';
                    }
                    ?>
                </ul>
            </section>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>