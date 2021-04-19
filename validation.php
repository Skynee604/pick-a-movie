<?php
 session_start();
 include("include/header.php");

$dateSeance = $_POST['dateS'];

if(empty($_POST['nbAdulte']) && empty($_POST['nbEnfant']) &&  empty($_POST['nbEtudiant'])){
    header('location: .');
}else if(empty($_POST['idMovie']) || empty($_POST['dateS']) || empty($_POST['heureS']) || empty($_SESSION['auth']->nickNameClient)) {
    header('location: .');
}else {
    $idCient = $_SESSION['auth']->idClient;
    $idMovie= $_POST['idMovie'];
    $heureSeance = $_POST['heureS'];
    $dateSeance = $_POST['dateS'];

    if(empty($_POST['nbAdulte'])){
       $quantAdulte = ""; 
    }else {
       $quantAdulte = $_POST['nbAdulte']; 
    }

    if(empty($_POST['nbEnfant'])){
       $quantEnfant = ""; 
    }else {
       $quantEnfant = $_POST['nbEnfant']; 
    }

    if(empty($_POST['nbEtudiant'])){
       $quantEtudiant = ""; 
    }else {
       $quantEtudiant = $_POST['nbEtudiant']; 
    }
}

?>
<div class="container">

    <div class="row">

        <div class="col-lg-15 w-100">

            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title">
                        Récapitulatif
                    </h3>

                    <div id='movieName'>
                        <h6>Date : <?= $dateSeance ?></h6>
                        <h6>Séance : <?= $heureSeance ?></h6>
                    </div>

                    <table class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre de tickets</th>
                                <th scope="col">Type de ticket</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="tablePrix">
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary"style="margin-top:5px;">Procéder au paiement</button>
                    <input type="button" value="Annuler" class="btn btn-secondary" style="margin-top:5px;" onclick="javascript:history.back()">


                </div>


            </div>
        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>

<script>
    $(document).ready(function () {
        var idMovie = <?=$idMovie ?>;

        <?php if ($quantAdulte != "") : ?>
            var quantAdulte = <?=$quantAdulte ?>;
        <?php else : ?>
            var quantAdulte = "";
        <?php endif; ?>

        <?php if ($quantEnfant !="") : ?>
            var quantEnfant = <?=$quantEnfant ?>;
        <?php else : ?>
            var quantEnfant = "";
        <?php endif; ?>

        <?php if ($quantEtudiant !="") : ?>
            var quantEtudiant = <?=$quantEtudiant ?>;
        <?php else : ?>
            var quantEtudiant = "";
        <?php endif; ?>

        $.ajax({
            url: "requetes/getMovieById.php",
            method: "GET",
            data: { idMovie: idMovie },
            dataType: "json",
            success: function (movie) {
                $("<h5>" + movie[0].titleMovie + "</h5>").prependTo("#movieName");

            }
        });

       $.ajax({
            url: "requetes/getPrices.php",
            method: "GET",
            dataType: "json",
            success: function (prices) {
                contenu = "";
                var total = 0.0;

               if(quantAdulte != ""){
                    for( var i in prices){
                        if(prices[i].namePrix == "Adulte"){
                            var prix = Number.parseFloat(prices[i].prix).toFixed(2);
                            var totalTicket = prix * quantAdulte;
                            totalTicket = Number.parseFloat(totalTicket).toFixed(2);
                            contenu += "<td>"+ quantAdulte + "</td>"
                            + "<td>" + prices[i].namePrix + " (" + prix + "€)" + "</td>"
                            + "<td>" + totalTicket + "€</td>";

                            $("<tr>" + contenu + "</tr>").appendTo("#tablePrix");
                            total += parseFloat(totalTicket);
                            contenu = "";
                        }
                    }
               }

                if(quantEnfant != ""){
                    for( var i in prices){
                        if(prices[i].namePrix == "Enfant"){
                            var prix = Number.parseFloat(prices[i].prix).toFixed(2);
                            var totalTicket = prix * quantEnfant;
                            totalTicket = Number.parseFloat(totalTicket).toFixed(2);
                            contenu += "<td>"+ quantEnfant + "</td>"
                            + "<td>" + prices[i].namePrix + " (" + prix + "€)" + "</td>"
                            + "<td>" + totalTicket + "€</td>";

                            $("<tr>" + contenu + "</tr>").appendTo("#tablePrix");
                            total += parseFloat(totalTicket);
                            contenu = "";
                        }
                    }
               }

                if(quantEtudiant != ""){
                    for( var i in prices){
                        if(prices[i].namePrix == "Etudiant"){
                            var prix = Number.parseFloat(prices[i].prix).toFixed(2);
                            var totalTicket = prix * quantEtudiant;
                            totalTicket = Number.parseFloat(totalTicket).toFixed(2);
                            contenu += "<td>"+ quantEtudiant + "</td>"
                            + "<td>" + prices[i].namePrix + " (" + prix + "€)" + "</td>"
                            + "<td>" + totalTicket + "€</td>";

                            $("<tr>" + contenu + "</tr>").appendTo("#tablePrix");
                            total += parseFloat(totalTicket);
                            contenu = "";
                        }
                    }
               }

                total = Number.parseFloat(total).toFixed(2);
               $("<tr><th scope='row' colspan='2'>Total</th><td>" + total +"€</td></tr>").appendTo("#tablePrix");
            }
        });

    });
</script>