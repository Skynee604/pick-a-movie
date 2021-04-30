<?php
include "header.php";
include "nav.php";
?>
<style>
    small {
        color: white;
    }

    figure {
        display: inline-block;
        margin-right: 1%;
    }
</style>

<div class="container" style="max-width: 800px;margin-top:10%;">
    <h3 style="color:white;"><strong>Supprimer un film</strong></h3>
    <select id="liste" class="browser-default custom-select" style="margin-bottom:2%;">
        <option value="default" selected="">Choisir le film à supprimer</option>
    </select>
    <form id="data" method="post" enctype="multipart/form-data">
        <input type="hidden" id="idMovie" name="idMovie"></input>
        <div class="form-group">
            <label for="newPostTitle">Titre du film : </label>
            <input type="text" name="title" class="form-control" id="title" required="required">
        </div>
        <div class="form-group">
            <label for="newPostTitle">Réalisateur du film : </label>
            <input type="text" name="director" class="form-control" id="director" required="required">
        </div>
        <div class="form-group">
            <label for="newPostText">Résumé du film : </label>
            <textarea class="form-control" id="summary" name="summary" rows="3" style="box-shadow: 3px 10px 20px black;resize:none;" required="required"></textarea>
        </div>
        <div id="image">

        </div>
        <div class="form-group" style="float: right;">
            <button class="btn btn-primary" name="submitFilm" id="btn_ajout" type="submit">Modifier le film</button>
        </div>
    </form>
    <br><br>
</div>

<?php include "../include/footer.php" ?>