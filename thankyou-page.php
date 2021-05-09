<?php 
// account
$email = $_POST["email"];
echo $email;
$nome = $_POST["nome"];
echo $nome;
$cognome = $_POST["cognome"];
echo $cognome;
$nascita = $_POST["nascita"];
echo $nascita;
$sesso = $_POST["sesso"];
echo $sesso;
$oldpassword = $_POST["oldpassword"];
echo $oldpassword;
$newpassword = $_POST["newpassword"];
echo $newpassword;


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
            <li class="last">Esito invio form</li>
        </ol>
        <div class="thank-you-message">
            <p class="text-center text-bold">Il tuo form è stato inviato con successo!</p>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>
</html>