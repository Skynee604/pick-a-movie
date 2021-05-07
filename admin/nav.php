<?php
require("../include/connectDB.php");
require_once("../class/Session.php");
require_once("../class/Authentication.php");



// check si la page a été refreshed
$pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// Instancie la session
$session = Session::getInstance();
$authentication = new Authentication($session);

if (empty($_SESSION['admin'])) {
    header("location: login.php");
}

// authentification
if (!empty($_POST['LoginEmail']) && !empty($_POST['LoginMDP'])) {
    $connexion = $authentication->login($db, $_POST['LoginEmail'], $_POST['LoginMDP']);
}

// déconnexion
if (isset($_POST['btnDeco'])) $authentication->logout("login.php");


?>
<nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand" href="../."><img src="../assets/logo_large.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="btn-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="." style="color:white;" id="film">Gestion des films</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gestionSeance.php" style="color:white;" id="seance">Gestion des
                    séances</a>
            </li>
        </ul>
    </div>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong>
                        <?= $_SESSION['admin']->nickNameClient ?>
                    </strong>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <?php if (!empty($_SESSION['admin'])) : ?>
                        <a class="dropdown-item" href="../.">Site principal</a>
                    <?php endif; ?>

                    <div class="dropdown-divider"></div>
                    <form method='POST'>
                        <button id='btnDeco' name="btnDeco" class="dropdown-item" type="submit">Déconnexion</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>

    <script>
        $('#btn-collapse').on('click', function() {
            var $nav = $(".navbar");
            if ($nav.attr('class') != 'navbar fixed-top navbar-dark bg-dark navbar-expand-lg scrolled')
                $nav.toggleClass('scrolled');
        });
    </script>
</nav>