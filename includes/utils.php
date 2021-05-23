<?php

//versione php: 7.3.10

// host, username, password, nome db (li ho messi uguali)
$connTeQ = mysqli_connect("localhost", "taliequadri", "taliequadri", "taliequadri") or die("impossibile connettersi al database");

//per connettersi ad un altro database
//$connAltro = mysqli_connect("host", "username", "password", "nomedb") or die("impossibile connettersi al database");

function checkAccesso($pagina)
{
    //$_SERVER is an array containing information such as headers, paths, and script locations. The entries in this array are created by the web server
    //'PHP_SELF' The filename of the currently executing script, relative to the document root.
    //'REQUEST_URI' The URI which was given in order to access this page; for instance, '/index.html'.
    if (strpos($pagina, 'account') !== false || strpos($pagina, 'carrello') !== false || strpos($pagina, 'ricerca') !== false) {
        //se l'utente non è loggato ma prova lo stesso ad accedere alla pagina 
        //lo reindirizzo alla pagina forbidden
        if (!isset($_SESSION["loggato"]) || $_SESSION["loggato"] == false) {
            header("location: forbidden.php");
        }
    }
    if (strpos($pagina, 'accedi') !== false) {
        //se l'utente è già loggato ma prova lo stesso ad accedere alla pagina 
        //lo reindirizzo alla pagina forbidden
        if (isset($_SESSION["loggato"]) && $_SESSION["loggato"] == true) {
            header("location: forbidden.php");
        }
    }
    if (strpos($pagina, 'admin') !== false || strpos($pagina, 'amministrazione') !== false) {
        //se non è loggato lo reindirizzo alla pagina forbidden
        if (!isset($_SESSION["loggato"]) || (isset($_SESSION["loggato"]) && $_SESSION["loggato"] == false)) {
            header("location: forbidden.php");
        }
        //se è loggato ma non ha il ruolo giusto lo reindirizzo alla pagina forbidden
        if (isset($_SESSION["loggato"]) && $_SESSION["loggato"] == true && $_SESSION["ruolo"] != "a") {
            header("location: forbidden.php");
        }
    }
}

function printErrorMessage() {
    echo '<p class="error text-bold text-center">Si è verificato un errore. Riprovare!</p>';
}

