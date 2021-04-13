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
                    
                    <!--<span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                    4.0 stars!-->
                    <select  id = "listeDate" class="form-control" style="margin-top:3px;max-width: 200px;" >
                    </select>
                    <script>
                        $(document).ready(function(){
                                $.get( "../requetes/selectDate.php", function() {},"json")
                                .done(
                                function(data) {
                                    for(var i in data)
                                        {$("#listeDate").append('<option value="'+data[i].idSession+'">'+data[i].dateTimeSession+'</option>');}
                                })
                        });
                    </script>
                    <select id = "listeSession" class="form-control" style="margin-top:3px;max-width: 200px;">
                    </select>
                    <script>
                        $(document).ready(function(){
                                $.get( "../requetes/selectDate.php", function() {},"json")
                                .done(
                                function(data) {
                                    for(var i in data)
                                        {$("#listeSession").append('<option value="'+data[i].idSession+'">'+data[i].dateTimeSession+'</option>');}
                                })
                        });
                    </script>
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
                <button data-toggle="modal" data-target="#reviewModal" class="btn btn-success" style="margin-bottom:3px;">Laisser un avis</button>
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

    $(document).ready(function() {
        var idMovie = <?= $_GET['id'] ?>;

        $.ajax({
            url:"requetes/getMovieById.php",
            method:"GET",
            data: {idMovie: idMovie},
            dataType:"json",
            success : function(movie){
                $("<strong>" + movie[0].titleMovie + "</strong>").appendTo("#title");
                $("<h5> Réalisé par : " + movie[0].director + "</h5>").appendTo("#realisateur");
                $("<p class='card-text'>" + movie[0].summaryMovie + "</p>").appendTo("#resume");
                $("<img class='card-img-top img-fluid' src='"+ movie[0].poster +"' alt='"+movie[0].titleMovie+"'>").appendTo("#image");
                
                
            }
        });

        $.ajax({
            url:"requetes/getReviews.php",
            method:"GET",
            data: {idMovie: idMovie},
            dataType:"json",
            success : function(reviews){
                
                if(reviews == ""){
                    $("<div><small class='text-muted'>Aucun avis</span><div>").appendTo("#reviews");
                }

                for(var i in reviews){

                    star ="";

                    for(var j=0 ; j< reviews[i].noteReview ; j++){
                        star += "<span class='fas fa-star' style='color: orange;'></span>"
                    }

                    for(var j=0 ; j< 5-reviews[i].noteReview ; j++ ){
                         star += "<span class='fas fa-star' style='color: grey;'></span>"
                    }

                    contenu ="";

                    contenu += "<div>"+ star + "</div>"
                            + "<p>" + reviews[i].textReview + "</p>"
                            + "<small class='text-muted'> Posté par " + reviews[i].nickNameClient + " le " + reviews[i].dateReview + "</small>";

                    $("<div>" + contenu + "</div><hr>").appendTo("#reviews");

                }
                
                
            }
        });
        
        

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