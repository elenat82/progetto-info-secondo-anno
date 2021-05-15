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
            <li class="last">Esito invio form</li>
        </ol>
        <div class="thank-you-message">
            <?php
            if (isset($_POST["hidden"]) && $_POST["hidden"] == "contatti") {
                if (isset($_POST["nome"]) && $_POST["nome"] != "" && isset($_POST["cognome"]) && $_POST["cognome"] != "" && isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["messaggio"]) && $_POST["messaggio"] != "") {
                    echo '<p class="text-center text-bold">Il tuo form è stato inviato con successo!</p>';
                } else {
                    echo '<p class="error text-center text-bold">Si è verificato un errore. Riprovare!</p>';
                }
            }
            else if (isset($_POST["hidden"]) && $_POST["hidden"] == "lavora-con-noi") {
                if (isset($_POST["nome"]) && $_POST["nome"] != "" && isset($_POST["cognome"]) && $_POST["cognome"] != "" && isset($_POST["nascita"]) && $_POST["nascita"] != "" && isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["telefono"]) && $_POST["telefono"] != "" && isset($_POST["cv"]) && $_POST["cv"] != "") {
                    echo '<p class="text-center text-bold">Il tuo form è stato inviato con successo!</p>';
                } else {
                    echo '<p class="error text-center text-bold">Si è verificato un errore. Riprovare!</p>';
                }
            }

            ?>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>
</html>