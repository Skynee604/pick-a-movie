<?php
 session_start();
include("include/header.php");
//include("include/nav.php");

$dateSeance = $_POST['dateS'];

if(empty($_POST['nbAdulte']) && empty($_POST['nbEnfant']) &&  empty($_POST['nbEtudiant'])){
    header('location: .');
}else if(empty($_POST['idMovie']) || empty($_POST['dateS']) || empty($_POST['heureS']) || empty($_SESSION['auth']->nickNameClient)) {
    header('location: .');
}else {
    $idClient = $_SESSION['auth']->idClient;
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

<div class="container py-5">
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6" style="color:white;"><strong>Paiement</strong></h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i
                                        class="fas fa-credit-card mr-2"></i> Carte de crédit
                                </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i
                                        class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" onsubmit="event.preventDefault()">
                                <div class="form-group"> <label for="username">
                                        <h6>Nom du propriétaire</h6>
                                    </label> <input type="text" name="username" placeholder="Nom du propriétaire"
                                        required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Numéro de carte</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber"
                                            placeholder="Numéro de carte valide" class="form-control "
                                            style="box-shadow: 0px 0px 0px white;" required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i
                                                    class="fab fa-cc-visa mx-1"></i> <i
                                                    class="fab fa-cc-mastercard mx-1"></i> <i
                                                    class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Date d'expiration</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name=""
                                                    class="form-control" required> <input type="number" placeholder="AA"
                                                    name="" class="form-control" style="box-shadow: 0px 0px 0px white;"
                                                    required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip"
                                                title="Le code à 3 chiffres à l'arrière de la carte">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" required class="form-control"
                                                style="box-shadow: 0px 0px 0px white;"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <button type="button"
                                        class="subscribe btn btn-primary btn-block shadow-sm btn_confPay"> Confirmer le paiement
                                    </button>
                            </form>
                        </div>
                    </div> <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3">
                        <p> <button type="button" class="btn btn-primary btn_confPay"><i class="fab fa-paypal mr-2"></i>
                                Payer avec Paypal</button> </p>
                                
                    </div> <!-- End -->
                    <!-- End -->
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row mb-4" style="margin-top:30px;margin-left: auto;margin-right: auto;width: 70px;">
     <input type="button" value="Annuler" class="btn btn-secondary" onclick="javascript:history.back()">
</div>
</div>

<?php include "include/footer.php"; ?>

<script>
    $(document).ready(function(){
        var idMovie = <?=$idMovie ?>;
        var idClient = '<?=$idClient ?>';
        var heureS = '<?=$heureSeance ?>';
        var dateS = '<?=$dateSeance ?>';
        var idPrix = [];
        var quants = [];

        <?php if ($quantAdulte != "") : ?>
            quants.push(<?=$quantAdulte ?>);
        <?php else : ?>
            quants.push("");
        <?php endif; ?>

        <?php if ($quantEnfant !="") : ?>
            quants.push(<?=$quantEnfant ?>);
        <?php else : ?>
            quants.push("");
        <?php endif; ?>

        <?php if ($quantEtudiant !="") : ?>
            quants.push(<?=$quantEtudiant ?>);
        <?php else : ?>
            quants.push("");
        <?php endif; ?>

               $.ajax({
            url: "requetes/getPrices.php",
            method: "GET",
            dataType: "json",
            success: function (prices) {
               if(quants[0] != ""){
                    for( var i in prices){
                        if(prices[i].namePrix == "Adulte"){
                            idPrix.push(prices[i].idPrix);
  
                        }
                    }
               }else {
                   idPrix.push("");
               }

                if(quants[1] != ""){
                    for( var i in prices){
                        if(prices[i].namePrix == "Enfant"){
                           idPrix.push(prices[i].idPrix);
                        }
                    }
               }else {
                   idPrix.push("");
               }

                if(quants[2] != ""){
                    for( var i in prices){
                        if(prices[i].namePrix == "Etudiant"){
                            idPrix.push(prices[i].idPrix);
                        }
                    }
               }else {
                   idPrix.push("");
               }

            }
        });

        $('.btn_confPay').on('click', function(){

            for(var i =0 ; i<3 ; i++){
                if(quants[i] != ""){
                    $.ajax({
                        url: "requetes/createTicket.php",
                        method: "POST",
                        data: {
                            idMovie: idMovie,
                            idClient: idClient,
                            dateS: dateS,
                            heureS: heureS,
                            idPrice:idPrix[i],
                            quant:quants[i],
                        },
                        success: function(){
                            if(i==3){
                                document.location.href="confirmation.php";
                            }
                        }

                    });
                }
            }

            

           
        });




    });

</script>