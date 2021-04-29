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
if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {
    $connexion = $authentication->loginAdmin($db, $_POST['inputEmail'], $_POST['inputPassword']);
}

if (isset($connexion) && $connexion != false)
    header('Location: .');



?>


<?php include "header.php" ?>
<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background: rgb(29, 38, 55);
        background: radial-gradient(circle, rgba(29, 38, 55, 1) 14%, rgba(15, 19, 29, 1) 95%);

    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<body class="text-center">
    <form class="form-signin" method="POST">
        <img class="mb-4" src="../assets/logo_small_icon_only.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal" style="color:white;"><strong>Se connecter en tant qu'administrateur</strong></h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="inputEmail" class="form-control" placeholder="Adresse email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
        <?php if (isset($connexion) && $connexion == false && !$pageRefreshed && !isset($_POST['RegisterEmail']))
            echo "<span id=\"WrongLogin\" style=\"color: red;\">L'adresse email ou le mot de passe est erroné</span>";
        ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
</body>

</html>