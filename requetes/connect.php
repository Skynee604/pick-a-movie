<?php
require("../include/connectDB.php");
require_once("../class/Session.php");
require_once("../class/Authentication.php");


// Instancie la session
$session = Session::getInstance();
$authentication = new Authentication($session);

// authentification
if (!empty($_POST['LoginEmail']) && !empty($_POST['LoginMDP'])) {
    $connexion = $authentication->login($db, $_POST['LoginEmail'], $_POST['LoginMDP']);
}

echo $connexion;
