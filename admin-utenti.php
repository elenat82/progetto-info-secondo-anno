<?php session_start(); ?>
<?php
include("includes/utils.php");
checkAccesso($_SERVER["REQUEST_URI"]);
function printEmptyForm()
{
    $string = '<tr>';
    $string .= '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" id="new-utente">';
    $string .= '<td>';
    $string .= '<input type="hidden" id="azione" name="azione" value="inserisci">';
    $string .= '<input type="email" id="email" name="email" placeholder="Inserisci l\'email dell\'utente" required maxlength="255">';
    $string .= '</td>';
    $string .= '<td>';
    $string .= '<input type="text" id="nome" name="nome_utente" placeholder="Inserisci il nome dell\'utente" required maxlength="255">';
    $string .= '</td>';
    $string .= '<td>';
    $string .= '<input type="text" id="cognome" name="cognome_utente" placeholder="Inserisci il cognome dell\'utente" required maxlength="255">';
    $string .= '</td>';
    $string .= '<td>';
    $string .= '<input type="radio" id="ruolo-a" name="ruolo" value="a" required> Admin <input type="radio" id="ruolo-u" name="ruolo" value="u" required> User';
    $string .= '</td>';
    $string .= '<td class="text-center">';
    $string .= '<button type="submit"  class="primary-background secondary-color-light text-bold">Aggiungi</button>';
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
            <li class="last">Utenti</li>
        </ol>
        <div id="pagina-amministrazione-utenti">
            <h2>Amministrazione Utenti</h2>
            <table class="amministrazione">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Ruolo</th>
                        <th class="text-center">Azioni</th>
                        <th class="text-center">Elimina</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["nome_utente"]) && $_POST["nome_utente"] != "" && isset($_POST["cognome_utente"]) && $_POST["cognome_utente"] != "" && isset($_POST["ruolo"]) && $_POST["ruolo"] != "") {
                        //guardo il campo hidden azione
                        if (isset($_POST["azione"]) && $_POST["azione"] == "modifica") {
                            //password, data nascita e sesso ogni utente se li cambia da solo, il campo attivo si cambia con Elimina
                            $query_modifica = 'UPDATE utenti SET nome_utente = "' . $_POST["nome_utente"] . '", cognome_utente = "' . $_POST["cognome_utente"] . '", ruolo = "' . $_POST["ruolo"] . '" WHERE email = "' . $_POST["email"] . '";';
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
                            //l'utente appena inserito è attivo di default, la password di default è nomecognome
                            $query_inserimento = 'INSERT INTO utenti (email, nome_utente, cognome_utente, password, ruolo, attivo) VALUES ("' . $_POST["email"] . '", "' . $_POST["nome_utente"] . '", "' . $_POST["cognome_utente"] . '", "' . $_POST["nome_utente"] . $_POST["cognome_utente"] . '", "' . $_POST["ruolo"] . '", 1);';
                            $risultato_inserimento = mysqli_query($connTeQ, $query_inserimento);
                            if ($risultato_inserimento) {
                                header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
                                exit();
                            } else {
                                printErrorMessage();
                            }
                        }
                    }
                    //seleziono tutti gli utenti attivi tranne quello loggato, se vuole modificarsi le sue informazioni lo fa nella pagina del suo account
                    $query_utenti = 'SELECT * FROM utenti WHERE attivo = 1 AND email != "'.$_SESSION["email"].'"';
                    $risultato_utenti = mysqli_query($connTeQ, $query_utenti);
                    $num_righe_utenti = mysqli_num_rows($risultato_utenti);
                    if ($num_righe_utenti == 0) {
                        printEmptyForm();
                    } else {
                        foreach ($risultato_utenti as $key => $value) {
                            $isAdmin = false;
                            if ($value["ruolo"] == "a") {
                                $isAdmin = true;
                            } ?>
                            <tr>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="utente-<?php echo $key ?>">
                                    <td>
                                        <input type="hidden" id="azione" name="azione" value="modifica">
                                        <input type="email" id="email-<?php echo $key ?>" name="email" placeholder="Inserisci l'email dell'utente" required maxlength="255" value="<?php echo $value["email"] ?>" readonly>
                                    </td>
                                    <td>
                                        <input type="text" id="nome-<?php echo $key ?>" name="nome_utente" placeholder="Inserisci il nome dell'utente" required maxlength="255" value="<?php echo $value["nome_utente"] ?>">
                                    </td>
                                    <td>
                                        <input type="text" id="cognome-<?php echo $key ?>" name="cognome_utente" placeholder="Inserisci il cognome dell'utente" required maxlength="255" value="<?php echo $value["cognome_utente"] ?>">
                                    </td>
                                    <td>
                                        <?php
                                        if ($isAdmin) {
                                            echo '<input type="radio" id="ruolo-a" name="ruolo" value="a" required checked> Admin <input type="radio" id="ruolo-u" name="ruolo" value="u" required> User';
                                        } else {
                                            echo '<input type="radio" id="ruolo-a" name="ruolo" value="a" required> Admin <input type="radio" id="ruolo-u" name="ruolo" value="u" required checked> User';
                                        } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="primary-background secondary-color-light text-bold">Salva</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="admin-elimina.php?tabella=utenti&id=<?php echo $value["email"] ?>&action=elimina"><span class="fas fa-trash-alt"></span></a>
                                    </td>
                                </form>
                            </tr>
                    <?php }
                        printEmptyForm();
                    }
                    ?>
                </tbody>
            </table>

            <h2>Utenti disabilitati</h2>
            <ul>
                <?php
                $query_disab = 'SELECT * FROM utenti WHERE attivo = 0';
                $risultato_disab = mysqli_query($connTeQ, $query_disab);
                $num_righe_disab = mysqli_num_rows($risultato_disab);
                if ($num_righe_disab == 0) {
                    echo '<li><p>Nessun utente disabilitato</p></li>';
                } else {
                    while ($riga = mysqli_fetch_assoc($risultato_disab)) {
                        echo '<li><p>' . $riga["nome_utente"] . ' ' . $riga["cognome_utente"] . '<a href="admin-elimina.php?tabella=utenti&id=' . $riga["email"] . '&action=riabilita"><span class="fas fa-door-open"></span> Ri-abilita</a></p></li>';
                    }
                }
                ?>
            </ul>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
    <?php mysqli_close($connTeQ); ?>
</body>

</html>