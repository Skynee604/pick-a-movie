<?php
include "header.php";
include "nav.php";


?>

<div class="container" style="max-width: 800px;margin-top:10%;">
    <h3 style="color:white;"><strong>Ajouter un film</strong></h3>
    <form id="data" method="post" enctype="multipart/form-data">
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
        <div class="form-group" style="box-shadow: 0px;">
            <label for="thumbnail" class="custom-file-upload">
                Uploader une miniature :
                <input type="file" id="thumbnail" name="thumbnail" style="box-shadow: 0px 0px 0px red;" required="required">
            </label>
            <small class="text-muted" style="float: right; margin-top: 9px;">.png ou .jpeg - 400 x 225 - 8 Mo max</small>
            <span id="file-selected"></span>
        </div>
        <div class="form-group" style="box-shadow: 0px;">
            <label for="poster" class="custom-file-upload">
                Uploader une affiche :
                <input type="file" id="poster" name="poster" style="box-shadow: 0px 0px 0px red;" required="required">
            </label>
            <small class="text-muted" style="float: right; margin-top: 9px;">.png ou .jpeg - 900 x 400 - 8 Mo max</small>
            <span id="file-selected"></span>
        </div>
        <div class="form-group" style="box-shadow: 0px;">
            <label for="header" class="custom-file-upload">
                Uploader un header (facultatif) :
                <input type="file" id="header" name="header" style="box-shadow: 0px 0px 0px red;">
            </label>
            <small class="text-muted" style="float: right; margin-top: 9px;">.png ou .jpeg - 2000 x 500 - 8 Mo max</small>
            <span id="file-selected"></span>
        </div>
        <div class="form-group" style="float: right;">
            <button class="btn btn-primary" name="submitFilm" id="btn_ajout" type="submit">Ajouter un nouveau film</button>
        </div>
    </form>
    <br><br>
    <div id="errors">

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

    $("form#data").submit(function(e) {
        e.preventDefault();
        $(".error").remove();
        var formData = new FormData(this);

        $.ajax({
            url: "../requetes/postFilm.php",
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(errors) {

                if (errors == null) {
                    $('#data')[0].reset();
                    alert("le film a bien été ajouté")
                } else {
                    for (var i in errors) {
                        $("<p class ='error' style='color:red;'>" + errors[i] + "</p>").appendTo("#errors");
                    }
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>