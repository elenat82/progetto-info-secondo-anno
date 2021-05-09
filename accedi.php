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
            <li class="last">Accedi</li>
        </ol>
        <div id="pagina-accedi">
            <div class="half left">
                <h2>Accedi</h2>
                <div class="container_form">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="accedi">
                        <label for="email-accedi">E-mail <span>*</span></label>
                        <input type="email" id="email-accedi" name="email-accedi" placeholder="Inserisci la tua email" required maxlength="255">
                        <label for="password-accedi">Password <span>*</span></label>
                        <input type="password" id="password-accedi" name="password-accedi" placeholder="Inserisci la tua password" required maxlength="16">
                        <button type="submit" class="primary-background secondary-color-light text-bold">INVIA</button>
                    </form>
                    <?php
                    include("includes/utils.php");
                    if (isset($_POST["email-accedi"]) && $_POST["email-accedi"] != "" && isset($_POST["password-accedi"]) && $_POST["password-accedi"] != "") {
                        $query_utente_accedi = "SELECT * FROM utenti WHERE email = '" . $_POST['email-accedi'] . "' AND password = '" . $_POST["password-accedi"] . "'";
                        $risultato_accedi = mysqli_query($connTeQ, $query_utente_accedi);
                        $num_righe_accedi = mysqli_num_rows($risultato_accedi);
                        if ($num_righe_accedi == 0) {
                            echo "<p>Username o password errate.</p>";
                        } else {
                            foreach ($risultato_accedi as $riga) {
                                $_SESSION["loggato"] = true;
                                $_SESSION["email"] = $riga["email"];
                                $_SESSION["cognome"] = $riga["cognome"];
                                $_SESSION["nome"] = $riga["nome"];
                                $_SESSION["datanascita"] = $riga["datanascita"];
                                $_SESSION["sesso"] = $riga["sesso"];
                                $_SESSION["ruolo"] = $riga["ruolo"];
                            }
                            header("location: account.php");
                        }
                    }
                    ?>
                </div>
                <div class="half right">
                    <h2>Registrati</h2>
                    <div class="container_form">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="registrati">
                            <label for="email-registrati">E-mail <span>*</span></label>
                            <input type="email" id="email-registrati" name="email-registrati" placeholder="Inserisci la tua email" required maxlength="255">
                            <label for="password-registrati">Password <span>*</span></label>
                            <input type="password" id="password-registrati" name="password-registrati" placeholder="Inserisci la tua password" required maxlength="16">
                            <label for="nome">Nome <span>*</span></label>
                            <input type="text" id="nome" name="nome" placeholder="Inserisci il tuo nome" required maxlength="255">
                            <label for="cognome">Cognome <span>*</span></label>
                            <input type="text" id="cognome" name="cognome" placeholder="Inserisci il tuo cognome" required maxlength="255">
                            <label for="nascita">Data di nascita <span>*</span></label>
                            <input type="date" id="nascita" name="nascita" required>
                            <fieldset>
                                <legend>Sesso <span>*</span></legend>
                                <input type="radio" id="maschio" name="sesso" value="m" required>
                                <label for="maschio">Maschio</label>
                                <input type="radio" id="femmina" name="sesso" value="f" required>
                                <label for="femmina">Femmina</label>
                                <input type="radio" id="altro" name="sesso" value="a" required>
                                <label for="altro">Altro</label>
                            </fieldset>
                            <button type="submit" class="primary-background secondary-color-light text-bold">INVIA</button>
                        </form>
                        <?php
                        if (isset($_POST["email-registrati"]) && $_POST["email-registrati"] != "" && isset($_POST["password-registrati"]) && $_POST["password-registrati"] != "" && isset($_POST["nome"]) && $_POST["nome"] != "" && isset($_POST["cognome"]) && $_POST["cognome"] != "" && isset($_POST["nascita"]) && $_POST["nascita"] != "" && isset($_POST["sesso"]) && $_POST["sesso"] != "") {
                            //guardo se a db esiste già questa mail
                            $query_utente_controllo = "SELECT * FROM utenti WHERE email = '" . $_POST['email-registrati'] . "'";
                            $risultato_controllo = mysqli_query($connTeQ, $query_utente_controllo);
                            $num_righe_controllo = mysqli_num_rows($risultato_controllo);
                            if ($num_righe_controllo == 0) {
                                $query_registrazione = "INSERT INTO utenti (email, nome, cognome, password, datanascita, sesso, ruolo) VALUES ('" . $_POST["email-registrati"] . "','" . $_POST["nome"] . "','" . $_POST["cognome"] . "', '" . $_POST["password-registrati"] . "', '" . $_POST["nascita"] . "', '" . $_POST["sesso"] . "', 'u')";
                                $risultato_registrazione = mysqli_query($connTeQ, $query_registrazione);
                                //For successful SELECT, SHOW, DESCRIBE or EXPLAIN queries, mysqli_query() will return a mysqli_result object. For other successful queries mysqli_query() will return TRUE. Returns FALSE on failure.
                                if ($risultato_registrazione) {
                                    echo '<p>Sei stato registrato con successo!</p>';
                                } else {
                                    echo '<p>Si è verificato un errore, riprova!</p>';
                                }
                            }
                            else {
                                echo '<p>Esiste già un utente con questa email!</p>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>