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
    <h3 style="color:white;"><strong>Modifier une Scéance</strong></h3>
    <form id="data" method="post" enctype="multipart/form-data">

        <select id="listMovies" class="browser-default custom-select" style="margin-bottom:2%;">
            <option value="default" selected="">Choisir le film auquel modifier une date</option>
        </select>

        <input type="hidden" id="idMovie" name="idMovie"></input>

        <select name="dateSeance" id="dateSeance" class="browser-default custom-select" style="margin-top:3px;max-width: 200px;">
            <option selected="">Choisir une date</option>
        </select>

        <select name="heureSeance" id="heureSeance" class="browser-default custom-select" style="margin-top:3px;max-width: 200px;">
            <option selected="">Choisir une séance</option>
        </select>

        <div class="form-group">
            <label for="newPostTitle">Nouvelle date: </label>
            <input type="date" name="dateSession" class="form-control" id="dateSession" required="required">
        </div>

        <div class="form-group">
            <label for="newPostTitle">Nouvelle heure: </label>
            <input type="time" name="hourSession" class="form-control" id="hourSession" required="required">
        </div>

        <div class="form-group" style="float: right;">
            <button class="btn btn-primary" name="submitFilm" id="btn_ajout" type="submit">Modifier</button>
        </div>
    </form>
    <br><br>
    <div id="errors">

    </div>
</div>
<?php include "../include/footer.php"; ?>

<script>
    $(document).ready(function() {
        // add all movies to the <select>
        $.ajax({
            url: "../requetes/getMovies.php",
            method: "GET",
            dataType: "json",
            success: function(movies) {
                for (var i in movies) {
                    $("<option value='" + movies[i].idMovie + "'>" + movies[i].titleMovie + "</option>").appendTo('#listMovies')
                }
            }
        });

        $("form#data").submit(function(e) {
            e.preventDefault();
            $(".error").remove();
            var formData = new FormData(this);

            $.ajax({
                url: "../requetes/modifySessionReq.php",
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(errors) {
                    console.log(errors);
                    if (errors == null) {
                        $('#data')[0].reset();
                        alert("la séance a bien été modifiée")
                    } else {  
                            $("<p class ='error' style='color:red;'>" + errors + "</p>").appendTo("#errors");
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $("#listMovies").on("change", function() {
                $(".date").remove();
                $('.added').remove();
                var idMovie = $("#listMovies").val();
                $('#idMovie').val($("#listMovies").val());
                $.ajax({
                    url: "../requetes/getSessions.php",
                    method: "GET",
                    data: {
                        idMovie: idMovie
                    },
                    dataType: "json",
                    success: function(seances) {
                        console.log("test");
                        for (var i in seances) {

                            if (i > 0) {
                                if (seances[i].dateSession != seances[i - 1].dateSession) {
                                    $("<option class='date' value='" + seances[i].dateSession + "'>" + seances[i].dateSession + "</option>").appendTo("#dateSeance");
                                }
                            } else {
                                $("<option class='date' value='" + seances[i].dateSession + "'>" + seances[i].dateSession + "</option>").appendTo("#dateSeance");
                            }
                        }

                    }
                });
        });

        $("#dateSeance").on('change', function() {
            var idMovie = $("#listMovies").val();
            var dateSeance = $("#dateSeance").val();
            $(".added").remove();
            $.ajax({
                url: "../requetes/getSessions.php",
                method: "GET",
                data: {
                    idMovie: idMovie
                },
                dataType: "json",
                success: function(seances) {
                    for (var i in seances) {
                        if (seances[i].dateSession == dateSeance) {
                            $("<option class='added' value='" + seances[i].timeSession + "'>" + seances[i].timeSession + "</option>").appendTo("#heureSeance");
                        }
                    }
                }
            });
        });
    });
</script>