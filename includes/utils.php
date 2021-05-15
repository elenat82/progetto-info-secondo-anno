<?php

//versione php: 7.3.10

// host, username, password, nome db (li ho messi uguali)
$connTeQ = mysqli_connect("localhost", "taliequadri", "taliequadri", "taliequadri") or die("impossibile connettersi al database");

//per connettersi ad un altro database
//$connAltro = mysqli_connect("host", "username", "password", "nomedb") or die("impossibile connettersi al database");

//array di campi o null, tabella, array di condizioni o null, ordinamento o null, limite o null
function getData($campi, $tabella, $condizioni, $ordinamento, $limite) {
    $str = "SELECT ";
    //https://www.php.net/manual/en/function.is-array.php
    if (is_array($campi)) {
        $str = $str + implode(",", $campi);
    }
    else {
        $str = $str + "* ";
    }
    print_r($str);
}

?>
