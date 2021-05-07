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
    <h3 style="color:white;"><strong>Ajouter une Scéance</strong></h3>
    <form id="data" method="post" enctype="multipart/form-data">
        <select id="liste" class="browser-default custom-select" style="margin-bottom:2%;">
            <option value="default" selected="">Choisir le film auquel ajouter une date</option>
        </select>
        <input type="hidden" id="idMovie" name="idMovie"></input>
        <div class="form-group">
            <label for="newPostTitle">Choisir une date: </label>
            <input type="date" name="dateSession" class="form-control" id="dateSession" required="required">
        </div>

        <div class="form-group">
            <label for="newPostTitle">Choisir une séance: </label>
            <input type="time" name="timeSession" class="form-control" id="timeSession" required="required">
        </div>

        <div class="form-group" style="float: right;">
            <button class="btn btn-primary" name="submitFilm" id="btn_ajout" type="submit">Ajouter une nouvelle scéance </button>
        </div>
    </form>
    <br><br>
    <div id="errors">

    </div>
</div>
<?php include "../include/footer.php"; ?>

<script>
    $(document).ready(function() {
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

        $('#liste').on("change", function() {
            $('#idMovie').val($("#liste").val());
        });

        $("form#data").submit(function(e) {
            e.preventDefault();
            $(".error").remove();
            var formData = new FormData(this);
            $.ajax({
                url: "../requetes/postSession.php",
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(errors) {
                    console.log(errors);
                    if (errors == null) {
                        $('#data')[0].reset();
                        alert("La séance a bien été ajoutée")
                    } else {
                        $("<p class ='error' style='color:red;'>" + errors + "</p>").appendTo("#errors");
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
    });
</script>