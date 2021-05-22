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
        <h2>Lavora con noi</h2>
        <p class="hint">Sei un artista? Vuoi lavorare con noi? Allora compila il form!</p>
        <form action="thankyou-page.php" method="post" id="job">
            <div>
                <label for="nome">Nome <span>*</span></label>
                <input type="text" name="nome" id="nome" placeholder="Inserisci il tuo nome" required maxlength="50">
                <label for="cognome">Cognome <span>*</span></label>
                <input type="text" name="cognome" id="cognome" placeholder="Inserisci il tuo cognome" required maxlength="50">
            </div>
            <div>
                <label for="nascita">Data di nascita <span>*</span></label>
                <input type="date" name="nascita" id="nascita" value="2000-01-01"
                    required>
            </div>
            <div>
                <label for="email">E-mail <span>*</span></label>
                <input type="email" name="email" id="email" placeholder="Inserisci il tuo indirizzo e-mail" required maxlength="50">
            </div>
            <div>
                <label for="telefono">Telefono <span>*</span></label>
                <input type="text" name="telefono" id="telefono" placeholder="Inserisci il tuo numero di telefono" required maxlength="50">
            </div>
            <div>
                <label for="sito">Sito web</label>
                <input type="url" name="sito" id="sito" placeholder="Inserisci il tuo sito web" maxlength="50">
                <label for="linkedin">Profilo Linkedin</label>
                <div class="prefix"><span>https://www.linkedin.com/in/</span><input type="text" name="linkedin" id="linkedin" placeholder="Completa il tuo profilo Linkedin" maxlength="50"></div>
            </div>
            <div>
                <p class="hint">Attenzione, puoi caricare solo il formato PDF. Il file può essere grande al massimo 500KB</p>
                <label for="cv">Curriculum Vitae <span>*</span></label>
                <input type="file" name="cv" id="cv" accept=".pdf">
            </div>
            <div>
                <label for="descrizione">Parlaci un po' di te</label>
                <textarea name="descrizione" id="descrizione" rows="5" placeholder="Scrivi qualcosa su di te"></textarea>
            </div>
            <input type="hidden" id="hidden" name="hidden" value="lavora-con-noi">
            <div class="form-buttons">
                <button type="submit" class="primary-background secondary-color-light text-bold">INVIA</button>
            </div>
        </form>
        
    </main>
    <?php include("includes/template_footer.php") ?>
    <?php mysqli_close($connTeQ); ?>
</body>
</html>