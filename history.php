<?php
include("include/header.php");
include("include/nav.php");

if(empty($_SESSION['auth'])){
    header("location: .");
}

?>
<div class="py-5" style="margin-top:3%;">
    <div class="container" id="data">
        <h1 style="color:white;"><strong>Historique des achats</strong></h1>
        <br>
        <div class="row hidden-md-up" id="ticketList">
           
        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>
<script>
    $(document).ready(function () {
        var idClient = <?=$_SESSION['auth']->idClient ?>;
        var image;
        var MovieTitle;
        var dateSeance;
        var heureSeance;
        var namePrix;
        var prix;
        var quant;
        var total;

        $.ajax({
            url: "requetes/getTickets.php",
            method: "GET",
            data:{idClient : idClient},
            dataType: "json",
            success: function (tickets) {

                if(tickets == ""){
                    $("<h4 style='color: white;text-align:center;' id='noTicket'>Vous n'avez encore aucun achats.</h4>").appendTo('#data'); 
                }

                for (var i in tickets) {
                    image = tickets[i].thumbnail;
                    MovieTitle = tickets[i].titleMovie;
                    heureSeance = tickets[i].timeSession;
                    dateSeance = tickets[i].dateSession;
                    namePrix = tickets[i].namePrix;
                    prix =  Number.parseFloat(tickets[i].prix).toFixed(2);
                    quant = tickets[i].quant;
                    total =  Number.parseFloat(quant * prix).toFixed(2);

                    contenu = "<a href='/ticket.php?id=" + tickets[i].idTicket + "'>"
                        + "<div class='card h-100'>"
                        + "<div class='card-block'>"
                        + "<img class='card-img-top' src='" + image + "'>"
                        + "<h4 class='card-title' style='text-align: center;color:white;'><strong>" + MovieTitle + "</strong></h4>"
                        + "<p class='card-text py-15' style='text-align: center;color:white;margin-bottom:30px;'>"
                        + dateSeance + " - " + heureSeance + "<br>"
                        + namePrix + " (" + prix + "€)"
                        + "</p>"
                        + "<small style='color:white;position:absolute;bottom:0;'>Quantité : " + quant + " - Total : " + total + "€</small>"
                        + "</div>"
                        + "</div>"

                    $("<div class='col-md-4' style='margin-top:3%;'>" + contenu + "</div>").appendTo('#ticketList');
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