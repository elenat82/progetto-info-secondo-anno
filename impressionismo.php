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
            <li class="last">Impressionismo</li>
        </ol>
        <h2>Impressionismo</h2>
        <ul id="impressionismo">
        <?php
            include("includes/utils.php");
            $query_quadri = "SELECT * FROM quadri";
            $risultato_quadri = mysqli_query($connTeQ, $query_quadri);
            $num_righe_quadri = mysqli_num_rows($risultato_quadri);
            if ($num_righe_quadri == 0) {
                echo '<li><a href="#" title="Nessun quadro trovato" class="text-bold">Nessun quadro trovato</a></li>';
            } else {
                $i=1;
                while($riga = mysqli_fetch_array($risultato_quadri, MYSQLI_ASSOC)){
                    $classname = "";
                    if ($riga["sconto"]) {
                        $classname = " scontato";
                    }
                    if ($i % 2 != 0) {
                        echo '<li class="mappa-sx">';
                            echo '<div class="mappa" id="map-'.$i.'">';
                                echo '<iframe src="'.$riga["mappa"].'" width="400" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
                            echo '</div>';
                            echo '<div class="descrizione">';
                                echo '<p><span class="fas fa-long-arrow-alt-left" aria-hidden="true"></span>  Guarda l\'originale</p>';
                                echo '<a href="prodotto.php?sku='.$riga['sku'].'" title="Vai alla pagina Impressionismo - '.$riga["titolo"].'">';
                                    echo '<h3 class="text-bold">'.$riga["titolo"].'</h3>';
                                    echo '<p><span>SKU: </span><span>'.$riga["sku"].'</span></p>';
                                    echo '<div class="prices text-center">';
                                    if($riga["sconto"]) {
                                        echo '<p class="originale scontato">';
                                            echo '<span>'.$riga["prezzo"].'</span> ';
                                            echo '<span class="sconto">- '.$riga["sconto"].'%</span>';
                                        echo '</p>';
                                        echo '<p class="finale">'.$riga["finale"].' ';
                                            echo '<span class="fas fa-euro-sign" aria-hidden="true"></span>';
                                        echo '</p>'; 
                                    }
                                    else {
                                        echo '<p class="originale">';
	                                        echo '<span>850,00</span> ';
	                                        echo '<span class="fas fa-euro-sign" aria-hidden="true"></span>';
                                        echo '</p>';
                                        echo '<p class="finale"></p>';
                                    }
                                    echo '</div>';
                                    echo '<img src="img/piccole/'.$riga["immagine"].'" alt="'.$riga["titolo"].'">';
                                echo '</a>';
                            echo '</div>';
                        echo '</li>';
                    }
                    else {
                        echo '<li class="mappa-dx">';
                            echo '<div class="descrizione">';
                                echo '<p class="text-right">Guarda l\'originale <span class="fas fa-long-arrow-alt-right" aria-hidden="true"></span></p>';
                                echo '<a href="prodotto.php?sku='.$riga['sku'].'" title="Vai alla pagina Impressionismo - '.$riga["titolo"].'">';
                                    echo '<h3 class="text-bold">'.$riga["titolo"].'</h3>';
                                    echo '<p><span>SKU: </span><span>'.$riga["sku"].'</span></p>';
                                    echo '<div class="prices text-center">';
                                    if($riga["sconto"]) {
                                        echo '<p class="originale scontato">';
                                            echo '<span>'.$riga["prezzo"].'</span> ';
                                            echo '<span class="sconto">- '.$riga["sconto"].'%</span>';
                                        echo '</p>';
                                        echo '<p class="finale">'.$riga["finale"].' ';
                                            echo '<span class="fas fa-euro-sign" aria-hidden="true"></span>';
                                        echo '</p>'; 
                                    }
                                    else {
                                        echo '<p class="originale">';
	                                        echo '<span>850,00</span> ';
	                                        echo '<span class="fas fa-euro-sign" aria-hidden="true"></span>';
                                        echo '</p>';
                                        echo '<p class="finale"></p>';
                                    }
                                    echo '</div>';
                                echo '<img src="img/piccole/'.$riga["immagine"].'" alt="'.$riga["titolo"].'">';
                                echo '</a>';
                            echo '</div>';
                            echo '<div class="mappa" id="map-'.$i.'">';
                                echo '<iframe src="'.$riga["mappa"].'" width="400" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
                            echo '</div>';
                        echo '</li>';
                    }
                $i++;
                }
            }
            ?>
        </ul>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>
</html>