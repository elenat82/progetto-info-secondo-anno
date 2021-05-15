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
            <li class="last">Amministrazione</li>
        </ol>
        <div id="pagina-amministrazione">
            <h2>Amministrazione</h2>
            <ul>
                <li>
                    <a href="admin-artisti.php"><span class="fas fa-chalkboard-teacher"></span> Artisti</a>
                </li>
                <li>
                    <a href="admin-metodi-pag.php"><span class="fas fa-cash-register"></span> Pagamenti</a>
                </li>
                <li>
                    <a href="admin-quadri.php"><span class="fas fa-palette"></span> Quadri</a>
                </li>
                <li>
                    <a href="admin-stili.php"><span class="fas fa-brush"></span> Stili</a>
                </li>
                <li>
                    <a href="admin-utenti.php"><span class="fas fa-users"></span> Utenti</a>
                </li>
            </ul>
        </div>
    </main>
    <?php include("includes/template_footer.php") ?>
</body>

</html>