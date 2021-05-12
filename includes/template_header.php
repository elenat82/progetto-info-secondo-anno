<?php
//If the filename ends in suffix this will also be cut off.
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<header>
    <div id="topbar">
        <form action="#" method="get" id="cerca" role="search">
            <label for="keyword">Cerca</label>
            <input type="search" name="keyword" id="keyword" maxlength="50" aria-label="Cerca per artista, titolo o parola chiave" aria-placeholder="Cerca" placeholder="Cerca..."> <button class="primary-background text-bold"><span class="fas fa-search secondary-color-light" aria-hidden="true"></span></button>
        </form>
        <div id="logo" class="text-center">
            <a href="index.php" title="Home">
                <img src="img/logo.svg" alt="Logo" width="100">
                <h1 class="primary-color text-right text-bold">Tali e Quadri<span>FALSI D'AUTORE</span></h1>
            </a>
        </div>
        <ul id="user-menu">
            <?php 
            if (isset($_SESSION['loggato']) && $_SESSION['loggato'] == true) {
                echo '<li><a href="account.php" title="Vai alla pagina Account"><span class="far fa-user primary-color" aria-hidden="true"></span> Account</a></li>';
            }
            else {
                echo '<li><a href="accedi.php" title="Vai alla pagina Registrati"><span class="far fa-user primary-color" aria-hidden="true"></span> Accedi</a></li>';
            }
            ?>
            <li><a href="carrello.php" title="Vai alla pagina Carrello"><span class="fas fa-shopping-cart primary-color" aria-hidden="true"></span> Carrello</a></li>
        </ul>
    </div>
    <nav>
        <ul>
            <li><a href="index.php" title="Vai alla pagina Home" accesskey="h" class="primary-color text-bold <?php if ($activePage == 'index') {echo 'menu-active';} ?>">HOME</a></li>
            <li><a href="#" title="Vai alla pagina Chi siamo" accesskey="s" class="primary-color text-bold <?php if ($activePage == 'chisiamo') {echo 'menu-active';} ?>">CHI SIAMO</a></li>
            <li><a href="#" title="Vai alla pagina Stili Pittorici" accesskey="p" class="primary-color text-bold <?php if ($activePage == 'stili') {echo 'menu-active';} ?>">STILI PITTORICI</a></li>
            <li><a href="#" title="Vai alla pagina Artisti" accesskey="a" class="primary-color text-bold <?php if ($activePage == 'artisti') {echo 'menu-active';} ?>">ARTISTI</a></li>
            <li><a href="contatti.php" title="Vai alla pagina Contatti" accesskey="c" class="primary-color text-bold <?php if ($activePage == 'contatti') {echo 'menu-active';} ?>">CONTATTI</a></li>
            <li><a href="lavora-con-noi.php" title="Vai alla pagina Lavora con noi" accesskey="l" class="primary-color text-bold <?php if ($activePage == 'lavora-con-noi') {echo 'menu-active';} ?>">LAVORA CON NOI</a></li>
            <?php  
                if ($_SESSION["ruolo"] == 'a') {
                    echo '<li><a href="amministrazione.php" title="Vai alla pagina Amministrazione" accesskey="z" class="primary-color text-bold"><span class="fas fa-cogs fa-spin"></span> AMMINISTRAZIONE</a></li>';
                }
            ?>
            <li><a href="ricerca.php" title="Vai alla pagina Ricerca" accesskey="r" class="secondary-background-dark text-bold">Partecipa alla ricerca!</a></li>
        </ul>
    </nav>
</header>