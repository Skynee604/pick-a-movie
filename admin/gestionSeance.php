<?php
include "header.php";
include "nav.php";

if(empty($_SESSION['admin'])){
    header("location: login.php");
}



?>

<style>
    h1,
    h4 {
        color: white;
        text-align: center;
    }

    .title {
        margin-top: 20%;
    }
</style>


<div class="container" style="margin-left: auto;margin-right: auto;max-width: 500px;height: 100%;">
    <div class="title">
        <h1><strong>Portail administrateur</strong></h1>
    </div>
    <div class="container" style="margin-top: 50%;margin-bottom: auto;">
        <div class="container">
            <div class="subtitle" style="margin-bottom: 8%;">
                <h4>Gestion des séances</h4>
            </div>
            <button type="button" class="btn btn-primary btn-block"
                onclick="document.location.href='../.'">Ajouter</button>
            <button type=" button" class="btn btn-primary btn-block">Modifier</button>
            <button type="button" class="btn btn-primary btn-block">Supprimer</button>
        </div>
    </div>

</div>

<?php include "../include/footer.php"; ?>

<script>
    $(function () {
        $(document).scroll(function () {
            var $nav = $(".navbar");
            $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
    });
</script>