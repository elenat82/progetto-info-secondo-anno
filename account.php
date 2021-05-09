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
        <h2>Benvenuto, <?php  echo $_SESSION["nome"];?>!</h2>
        <div id="pagina-account">
            <section>
                <h3>Informazioni personali</h3>
                <form action="thankyou-page.php" method="post" id="info">
                    <div>
                        <label for="email">E-mail <span>*</span></label>
                        <input type="email" name="email" id="email" value="<?php  echo $_SESSION["email"];?>"
                            placeholder="Inserisci il tuo indirizzo e-mail" required maxlength="50">
                    </div>
                    <div>
                        <label for="nome">Nome <span>*</span></label>
                        <input type="text" name="nome" id="nome" value="<?php  echo $_SESSION["nome"];?>" placeholder="Inserisci il tuo nome" maxlength="50" required>
                        <label for="cognome">Cognome <span>*</span></label>
                        <input type="text" name="cognome" id="cognome" value="<?php  echo $_SESSION["cognome"];?>" placeholder="Inserisci il tuo cognome" maxlength="50" required>
                    </div>
                    <div>
                        <label for="nascita">Data di nascita <span>*</span></label>
                        <input type="date" name="nascita" id="nascita" value="<?php  echo $_SESSION["datanascita"];?>"
                            required>
                    </div>
                    <fieldset>
                        <legend>Sesso <span>*</span></legend>
                        <input type="radio" id="maschio" name="sesso" value="m" required <?php  if ($_SESSION["sesso"] == "m") echo 'checked'; ?>>
                        <label for="maschio">Maschio</label>
                        <input type="radio" id="femmina" name="sesso" value="f" required <?php  if ($_SESSION["sesso"] == "f") echo 'checked'; ?>>
                        <label for="femmina">Femmina</label>
                        <input type="radio" id="altro" name="sesso" value="a" required <?php  if ($_SESSION["sesso"] == "a") echo 'checked'; ?>>
                        <label for="altro">Altro</label>
                    </fieldset>
                    <hr>
                    <div>
                        <p class="hint">Se desideri modificare la tua password compila i campi sottostanti:</p>
                        <label for="oldpassword">Password attuale</label>
                        <input type="password" name="oldpassword" id="oldpassword"
                            placeholder="Inserisci la tua password corrente" maxlength="50">
                        <label for="newpassword">Nuova password</label>
                        <input type="password" name="newpassword" id="newpassword"
                            placeholder="Inserisci la tua nuova password" maxlength="50">
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
                        <tr>
                            <td class="n-ordine text-center">JHAMHWDZI</td>
                            <td class="data-ordine text-center">26/07/2018</td>
                            <td class="total-price primary-color text-center text-bold">3700,00</td>
                            <td class="metodo-pagamento text-center"><span class="paypal"><span class="fab fa-paypal primary-color" aria-hidden="true"></span> PayPal</span></td>
                            <td class="stato-ordine text-center"><span class="evaso">Evaso</span></td>
                            <td class="text-center"><a href="fattura-JHAMHWDZI.pdf" title="Visualizza la fattura"><span class="fas fa-file-download" aria-hidden="true"></span></a></td>
                            <td class="text-center"><a href="dettaglio.php" title="Visualizza il dettaglio">+ info</a></td>
                        </tr>
                        <tr>
                            <td class="n-ordine text-center">UDKQVHHQR</td>
                            <td class="data-ordine text-center">13/11/2020</td>
                            <td class="total-price primary-color text-center text-bold">2400,00</td>
                            <td class="metodo-pagamento text-center"><span class="credit-card"><span class="far fa-credit-card primary-color" aria-hidden="true"></span> Carta</span></td>
                            <td class="stato-ordine text-center"><span class="in-lavorazione">In lavorazione</span></td>
                            <td class="text-center"><a href="fattura-UDKQVHHQR.pdf" title="Visualizza la fattura"><span class="fas fa-file-download" aria-hidden="true"></span></a></td>
                            <td class="text-center"><a href="dettaglio.php" title="Visualizza il dettaglio">+ info</a></td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section>
                <h3>Indirizzi</h3>
                <ul id="indirizzi">
                    <li>
                        <p class="tipo fatturazione">Fatturazione:</p>
                        <p><strong class="primary-color text-bold">Mario Rossi</strong></p>
                        <p class="indirizzo">via Roma, 1 <br>10100 Torino (TO) <br>Italia</p>
                        <p class="telefono">349-5730286</p>
                        <p><a href="#" title="Modifica l'indirizzo di fatturazione">Modifica</a></p>
                    </li>
                    <li>
                        <p class="tipo spedizione">Spedizione:</p>
                        <p><strong class="primary-color text-bold">Mario Rossi</strong></p>
                        <p class="indirizzo">via Garibaldi, 100 <br>10100 Torino (TO) <br>Italia</p>
                        <p class="telefono">011-583017</p>
                        <p><a href="#" title="Modifica l'indirizzo di spedizione">Modifica</a></p>
                    </li>
                    <li>
                        <p class="tipo altro">Altro:</p>
                        <p><strong class="primary-color text-bold">Mario Rossi c/o Azienda s.r.l.</strong></p>
                        <p class="indirizzo">piazza Castello, 10 <br>10100 Torino (TO) <br>Italia</p>
                        <p class="telefono">011-895436</p>
                        <p><a href="#" title="Modifica l'indirizzo altro">Modifica</a></p>
                    </li>
                </ul>
            </section>
            <section>
                <h3>Wishlist</h3>
                <details>
                    <summary class="primary-color">Lista nozze</summary>
                    <ul class="wishlist">
                        <li><h3><a href="#" title="Vai al prodotto">Gustav Klimt - La vergine</a></h3></li>
                    </ul>
                </details>
                <details>
                    <summary class="primary-color">Casa al mare</summary>
                    <ul  class="wishlist">
                        <li><h3><a href="#" title="Vai al prodotto">Vincent Van Gogh - Mandorlo fiorito</a></h3></li>
                    </ul>
                </details>
    
            </section>
            <section>
            <ul id="user-menu-2">
            <?php 
            if (isset($_SESSION['loggato']) && $_SESSION['loggato'] == true) {
                echo '<li><a href="logout.php" title="Vai alla pagina Logout"><span class="fas fa-sign-out-alt primary-color" aria-hidden="true"></span> Logout</a></li>';
            }
            else {
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