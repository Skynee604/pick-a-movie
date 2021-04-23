<?php
include("include/header.php");
include("include/nav.php");

if(empty($_SESSION['auth'])){
    header("location: .");
}

?>

<div class="jumbotron text-center" style="margin-left:20%;margin-top: 20vh;transform: translateY(-20%);background:transparent; margin-left: auto;
  margin-right: auto;
  max-width: 500px; ">
    <img src="assets/logo_small_icon_only.png" class='img-fluid' style="position:relative;max-width: 200px;"></img>
    <h1 class="display-3" style="color:white">Merci!</h1>
    <p class="lead" style="color:white">Vos tickets ont bien été enregistrés.</p>
    <hr>
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="." role="button">Retour à la page d'accueil</a>
    </p>
</div>

<?php include "include/footer.php"; ?>