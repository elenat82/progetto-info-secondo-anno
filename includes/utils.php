<?php

//versione php: 7.3.10

// host, username, password, nome db (li ho messi uguali)
$connessione = mysqli_connect("localhost", "taliequadri", "taliequadri", "taliequadri") or die("impossibile connettersi al database");

function queryGet($campi, $tabella, $condizioni, $orderby) {
    if(is_array($campi)) {
        if(count($campi)) {
            $elements = implode(",", $campi);
            $query = "SELECT ".$elements." FROM ".$tabella;
        }
        else {
            $query = "SELECT * FROM ".$tabella;
        }
    }
    //print_r($query);
    return $query;
}

?>
