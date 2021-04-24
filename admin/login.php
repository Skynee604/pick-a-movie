<?php
require("../include/connectDB.php");
require_once("../class/Session.php");
require_once("../class/Authentication.php");

// check si la page a été refreshed
$pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

// Instancie la session
$session = Session::getInstance();
$authentication = new Authentication($session);

// authentification
if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword']))
{
    $connexion = $authentication->loginAdmin($db, $_POST['inputEmail'],$_POST['inputPassword']);
}

if (isset($connexion) && $connexion != false)
    header('Location: .');


// déconnexion
if (isset($_POST['btnDeco'])) $authentication->logout($_SERVER['HTTP_REFERER']);


?>


<?php include "header.php" ?>

<body class="text-center">
    <form class="form-signin" method="POST">
        <img class="mb-4" src="../assets/logo_small_icon_only.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal" style="color:white;">Se connecter en tant qu'admin</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="Adresse email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <div class="checkbox mb-3">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
</body>

</html>