<?php
include "header.php";
include "nav.php";


?>

<style>
    h1,
    h4 {
        text-align: center;
        color: white;
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
                <h4>Gestion des films</h4>
            </div>
            <button type="button" class="btn btn-primary btn-block" onclick="document.location.href='addMovie.php'">Ajouter</button>
            <button type=" button" class="btn btn-primary btn-block" onclick="document.location.href='modifyMovie.php'">Modifier</button>
            <button type="button" class="btn btn-primary btn-block" onclick="document.location.href='deleteMovie.php'">Supprimer</button>
        </div>
    </div>

</div>

<?php include "../include/footer.php"; ?>

<script>
    $(function() {
        $(document).scroll(function() {
            var $nav = $(".navbar");
            $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
    });
</script>