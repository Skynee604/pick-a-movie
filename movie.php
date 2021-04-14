<?php
include("include/header.php");
include("include/nav.php");

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: .");
}

?>

<!-- Page Content -->
<div id="containerMovie" class="container">

    <div class="row">

        <div class="col-lg-15 w-100">

            <div class="card mt-4">
                <div id="image">

                </div>
                <div class="card-body">
                    <h3 class="card-title">
                        <div id="title">

                        </div>
                    </h3>
                    <div id="realisateur">

                    </div>
                    <div id="resume">

                    </div>

                     <select id="dateSeance" class="browser-default custom-select" style="margin-top:3px;max-width: 200px;">
                        <option selected="">Choisir une date</option>
                    </select>

                    <select id="heureSeance" class="browser-default custom-select" style="margin-top:3px;max-width: 200px;">
                        <option selected="">Choisir séance</option>
                    </select>
                    <button type="button" class="btn btn-primary"
                        style="margin-top:3px;max-width: 100px;">Réserver</button>

                </div>


            </div>
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary w-100" style="margin-top:3%;">
            <div class="card-header d-flex justify-content-end" style="border-bottom-color: #333333;">
                <div class="mr-auto" style="margin-top:4px;color: white;"><strong>Avis des spectateurs</strong></div>
                <?php if (!empty($_SESSION['auth']->nickNameClient)) : ?>
                <button data-toggle="modal" data-target="#reviewModal" class="btn btn-success"
                    style="margin-bottom:3px;">Laisser un avis</button>
                <?php else : ?>
                <a href="#loginModal" data-toggle="modal" data-target="#loginModal">
                    <small class='text-muted'>Connectez-vous pour laisser un avis</small>
                </a>
                <?php endif ; ?>
            </div>
            <div class="card-body">
                <div id="reviews">
                </div>
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.col-lg-9 -->

</div>

<?php include "modalReview.php";?>
<?php include "modalConnect.php";?>
<?php include "include/footer.php"; ?>
<script>

    $(document).ready(function () {
        var idMovie = <?= $_GET['id'] ?>;

        <?php if (!empty($_SESSION['auth']->idClient)) : ?>
            var idClient = <?= $_SESSION['auth']->idClient ?>;
        <?php endif; ?>

        $.ajax({
            url: "requetes/getMovieById.php",
            method: "GET",
            data: { idMovie: idMovie },
            dataType: "json",
            success: function (movie) {
                $("<strong>" + movie[0].titleMovie + "</strong>").appendTo("#title");
                $("<h5> Réalisé par : " + movie[0].director + "</h5>").appendTo("#realisateur");
                $("<p class='card-text'>" + movie[0].summaryMovie + "</p>").appendTo("#resume");
                $("<img class='card-img-top img-fluid' src='" + movie[0].poster + "' alt='" + movie[0].titleMovie + "'>").appendTo("#image");


            }
        });

        $.ajax({
            url: "requetes/getReviews.php",
            method: "GET",
            data: { idMovie: idMovie },
            dataType: "json",
            success: function (reviews) {

                if (reviews == "") {
                    $("<div id='empty'><small class='text-muted'>Aucun avis</span><div>").appendTo("#reviews");
                }

                for (var i in reviews) {

                    star = "";

                    for (var j = 0; j < reviews[i].noteReview; j++) {
                        star += "<span class='fas fa-star' style='color: orange;'></span>"
                    }

                    for (var j = 0; j < 5 - reviews[i].noteReview; j++) {
                        star += "<span class='fas fa-star' style='color: grey;'></span>"
                    }

                    contenu = "";

                    contenu += "<div>" + star + "</div>"
                        + "<p>" + reviews[i].textReview + "</p>"
                        + "<small class='text-muted'> Posté par " + reviews[i].nickNameClient + " le " + reviews[i].dateReview + "</small>";

                    $("<div>" + contenu + "</div><hr>").appendTo("#reviews");

                }


            }
        });

        /*---------------------CHOIX DES SEACANCES-------------------------*/
         $.ajax({
            url: "requetes/selectDate.php",
            method: "GET",
            data: { idMovie: idMovie },
            dataType: "json",
            success: function (seances) {
                for(var i in seances){
                    if(i>0){
                        if(seances[i].dateSession != seances[i-1].dateSession) {
                            $("<option value='"+seances[i].dateSession+"'>"+seances[i].dateSession+ "</option>").appendTo("#dateSeance");
                        }
                    }else {
                        $("<option value='"+seances[i].dateSession+"'>"+seances[i].dateSession+"</option>").appendTo("#dateSeance");
                    }  
                }
            }
        });

        $("#dateSeance").on('change', function(){
            var dateSeance = $("#dateSeance").val();
            $(".added").remove();
            $.ajax({
                url: "requetes/selectDate.php",
                method: "GET",
                data: { idMovie: idMovie },
                dataType: "json",
                success: function (seances) {
                    for(var i in seances){
                        if(seances[i].dateSession == dateSeance){
                            $("<option class='added' value='"+seances[i].timeSession+"'>"+seances[i].timeSession+ "</option>").appendTo("#heureSeance");
                        }  
                    }
                }
            });    
        });


        /*---------------------REVIEW-------------------------------------*/

        var note = 0;
        var txtReview;

        if(note == 0 || $("#newReview").val() == ""){
            $('#postReview').prop("disabled", true);
        }else {
            $('#postReview').prop("disabled", false);
        }

        $('#stars li').on('mouseover', function () {
            note = parseInt($(this).data('value'), 10); // L'étoile sur laquelle la souris est

            //mets en jaune toutes les étoiles qui sont avant l'étoile sélectionnée
            $(this).parent().children('li.star').each(function (e) {
                if (e < note) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('li.star').each(function (e) {
                $(this).removeClass('hover');
            });
        });

        $('#stars li').on('click', function () {
            note = parseInt($(this).data('value'), 10); // l'étoile sélectionnée
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < note; i++) {
                $(stars[i]).addClass('selected');
            }

            if(note == 0 || $("#newReview").val() == ""){
                $('#postReview').prop("disabled", true);
            }else {
                $('#postReview').prop("disabled", false);
            }

        });

        $("#newReview").on('keyup', function(){
            if(note == 0 || $("#newReview").val() == ""){
                $('#postReview').prop("disabled", true);
            }else {
                $('#postReview').prop("disabled", false);
            }
        });


        $("#postReview").on("click", function (event) {
             txtReview = $("#newReview").val();
             $.ajax({
                 url: "requetes/postReview.php",
                 method: "POST",
                 data: {
                     idMovie: idMovie,
                     idClient: idClient,
                     textReview: txtReview,
                     noteReview: note
                 },
                 dataType: "json",
                 success: function (review) {
                     $("#empty").remove();
 
                     star = "";
 
                     for (var i = 0; i < review[0].noteReview; i++) {
                         star += "<span class='fas fa-star' style='color: orange;'></span>"
                     }
 
                     for (var i = 0; i < 5 - review[0].noteReview; i++) {
                         star += "<span class='fas fa-star' style='color: grey;'></span>"
                     }
 
                     contenu = "";
 
                     contenu += "<div>" + star + "</div>"
                         + "<p>" + review[0].textReview + "</p>"
                         + "<small class='text-muted'> Posté par " + review[0].nickNameClient + " le " + review[0].dateReview + "</small>";
 
                     $("<div>" + contenu + "</div><hr>").appendTo("#reviews");
 
                 }
             });

             $('#reviewModal').modal('hide');
         });

        $('#reviewModal').on('hidden.bs.modal', function () {
            stars = $('#stars').children('li.star');
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            $(this).find('form').trigger('reset');

            $('#postReview').prop("disabled", true);


        })


    });

    //change l'apparence de la barre de naviagation quand on scroll sur la page
    $(function () {
        $(document).scroll(function () {
            var $nav = $(".navbar");
            $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
    });
</script>
</body>

</html>