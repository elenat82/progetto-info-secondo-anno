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
            <li class="last">Contatti</li>
        </ol>
        <h2>Contatti</h2>
        <div class="container_form">
            <form action="thankyou-page.php" method="POST" id="contatti">
                <label for="nome">Nome <span>*</span></label>
                <input type="text" id="nome" name="nome" placeholder="Inserisci il tuo nome" required maxlength="50">
                <label for="cognome">Cognome <span>*</span></label>
                <input type="text" id="cognome" name="cognome" placeholder="Inserisci il tuo congnome" required maxlength="50">
                <label for="email">E-mail <span>*</span></label>
                <input type="email" id="email" name="email" placeholder="Inserisci la tua email" required maxlength="50">
                <label for="messaggio">Messaggio <span>*</span></label>
                <textarea id="messaggio" name="messaggio" placeholder="Inserisci il tuo messaggio" rows="5" required></textarea>
                <input type="hidden" id="hidden" name="hidden" value="contatti">
                <button type="submit" class="primary-background secondary-color-light text-bold">INVIA</button>
            </form>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>