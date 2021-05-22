<?php session_start(); ?>
<?php include("includes/utils.php"); ?>
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
            <li class="last">Logout</li>
        </ol>
        <?php
        $_SESSION["loggato"] = false;
        $_SESSION["email"] = null;
        $_SESSION["cognome_utente"] = null;
        $_SESSION["nome_utente"] = null;
        $_SESSION["datanascita"] = null;
        $_SESSION["sesso"] = null;
        $_SESSION["ruolo"] = null;
        $_SESSION["carrello"] = null;
        ?>
        <div class="thank-you-message">
            <p class="text-center text-bold">Sei stato sloggato con successo!</p>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
    <?php mysqli_close($connTeQ); ?>
</body>

</html>