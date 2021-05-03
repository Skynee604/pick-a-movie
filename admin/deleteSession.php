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
    <h3 style="color:white;"><strong>Supprimer une Scéance</strong></h3>
    <form id="data" method="post" enctype="multipart/form-data">

        <select id="listMovies" class="browser-default custom-select" style="margin-bottom:2%;">
            <option value="default" selected="">Choisir le film auquel modifier une date</option>
        </select>

        <input type="hidden" id="idMovie" name="idMovie"></input>

        <select id="dateSeance" class="browser-default custom-select" style="margin-top:3px;max-width: 200px;">
            <option selected="">Choisir une date</option>
        </select>

        <select id="heureSeance" class="browser-default custom-select" style="margin-top:3px;max-width: 200px;">
            <option selected="">Choisir une séance</option>
        </select>

        <div class="form-group" style="float: right;">
            <button class="btn btn-primary" name="submitFilm" id="btn_ajout" type="submit">Supprimer</button>
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
                    $("<option value='" + movies[i].idMovie + "'>" + movies[i].titleMovie + "</option>").appendTo('#listMovies')
                }
            }
        });

        $("#listMovies").on("change", function() {
                $("#dateSeance").empty();
                var idMovie = $("#listMovies").val();
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
                                    $("<option value='" + seances[i].dateSession + "'>" + seances[i].dateSession + "</option>").appendTo("#dateSeance");
                                }
                            } else {
                                $("<option value='" + seances[i].dateSession + "'>" + seances[i].dateSession + "</option>").appendTo("#dateSeance");
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