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
    <h3 style="color:white;"><strong>Modifier un film</strong></h3>
    <select id="liste" class="browser-default custom-select" style="margin-bottom:2%;">
        <option value="default" selected="">Choisir le film à modifier</option>
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
        <div class="form-group" style="box-shadow: 0px;">
            <label for="thumbnail" class="custom-file-upload">
                Modifier la miniature :
                <input type="file" id="thumbnail" name="thumbnail" style="box-shadow: 0px 0px 0px red;">
            </label>
            <small class="text-muted" style="float: right; margin-top: 9px;">.png ou .jpeg - 400 x 225 - 8 Mo max</small>
            <span id="file-selected"></span>
        </div>
        <div class="form-group" style="box-shadow: 0px;">
            <label for="poster" class="custom-file-upload">
                Modifier l'affiche :
                <input type="file" id="poster" name="poster" style="box-shadow: 0px 0px 0px red;">
            </label>
            <small class="text-muted" style="float: right; margin-top: 9px;">.png ou .jpeg - 900 x 400 - 8 Mo max</small>
            <span id="file-selected"></span>
        </div>
        <div class="form-group" style="box-shadow: 0px;">
            <label for="header" class="custom-file-upload">
                Modifier le header :
                <input type="file" id="header" name="header" style="box-shadow: 0px 0px 0px red;">
            </label>
            <small class="text-muted" style="float: right; margin-top: 9px;">.png ou .jpeg - 2000 x 500 - 8 Mo max</small>
            <span id="file-selected"></span>
        </div>
        <div class="form-group" style="float: right;">
            <button class="btn btn-primary" name="submitFilm" id="btn_ajout" type="submit">Modifier le film</button>
        </div>
    </form>
    <br><br>
    <div id="errors">

    </div>
</div>

<?php include "../include/footer.php" ?>

<script>
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#' + id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function decodeHTMLEntities(text) {
        var e = document.createElement('textarea');
        e.innerHTML = text;
        // handle case of empty input
        return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue
    }
    $(document).ready(function() {

        $("#data :input").prop("disabled", true);

        $("#thumbnail").change(function() {
            readURL(this, 'th');
        });

        $("#poster").change(function() {
            readURL(this, 'po');
        });

        $("#header").change(function() {
            readURL(this, 'he');
        });

        $.ajax({
            url: "../requetes/getMovies.php",
            method: "GET",
            dataType: "json",
            success: function(movies) {
                for (var i in movies) {
                    $("<option value='" + movies[i].idMovie + "'>" + movies[i].titleMovie + "</option>").appendTo('#liste')
                }
            }
        });

        $("#liste").on("change", function() {
            var idMovie = $("#liste").val();
            $('#image').empty();
            if (idMovie == "default") {
                $("#data").get(0).reset();
                $("#data :input").prop("disabled", true);
            } else {
                $("#data :input").prop("disabled", false);
                $.ajax({
                    url: "../requetes/getMovieById.php",
                    method: "GET",
                    data: {
                        idMovie: idMovie
                    },
                    dataType: "json",
                    success: function(movie) {
                        var title = decodeHTMLEntities(String(movie[0].titleMovie));
                        var director = decodeHTMLEntities(movie[0].director);
                        var summary = decodeHTMLEntities(movie[0].summaryMovie);
                        $("#title").val(title);
                        $("#director").val(director);
                        $("#summary").val(summary);
                        $("#idMovie").val(movie[0].idMovie);

                        $("<figure><figcaption><small>Miniature :</small></figcaption><img id='th' src='../" + movie[0].thumbnail + "' width=150 height=90> </figure>").appendTo("#image");

                        $("<figure><figcaption><small>Poster :</small></figcaption><img id='po' src='../" + movie[0].poster + "' width=170 height=90></figure>").appendTo("#image");

                        if (movie[0].header != null) {
                            $("<figure><figcaption><small>Header :</small></figcaption><img id='he' src='../" + movie[0].header + "' width=300 height=90></figure>").appendTo("#image");
                        } else {
                            $("<figure><figcaption><small>Header :</small></figcaption><img id='he' src='#' alt='pas de header' width=300 height=90></figure>").appendTo("#image");
                        }

                    }
                });
            }

        });


    });

    $("form#data").submit(function(e) {
        e.preventDefault();
        $(".error").remove();
        var formData = new FormData(this);

        $.ajax({
            url: "../requetes/updateMovie.php",
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(errors) {

                if (errors == null) {
                    $("#liste").val("default");
                    $("#data :input").prop("disabled", true);
                    $('#image').empty();
                    $('#data')[0].reset();
                    alert("le film a bien été modifié");
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

    $(function() {
        $(document).scroll(function() {
            var $nav = $(".navbar");
            $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
    });
</script>