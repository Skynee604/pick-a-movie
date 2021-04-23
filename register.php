<?php
require("include/connectDB.php");
require_once("class/Session.php");
require_once("class/Authentication.php");
include("include/header.php");


$session = Session::getInstance();
$authentication = new Authentication($session);

//vérifie si une session auth est lancée. Si il y a une session de lancée,
//on redirige vers index.php
if($session->get('auth')){
    header("Location:.");
    exit();
}

if(!empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mdp'])) {

    $connexion = $authentication->register($db,$_POST['pseudo'],$_POST['nom'],$_POST['prenom'],$_POST['mdp'],$_POST['mdpVerif'],$_POST['email']);

}
?>

<section id="homePage">
    <div class="container">
        <div class="col-lg-12">

            <h1 style="margin-top: 100px; text-align:center"><a href="."><img src="assets/logo_small_icon_only.png"
                        style="postion:relative;"></img></a><br><br>
                <strong>Créez votre compte</strong></h1>
        </div>
    </div>
</section><br>

<div class="container" style="max-width: 500px;">
    <form method="post" action="register.php" id="registerForm">
        <div class="form-group">
            <label for="mail">Adresse Email</label>
            <input type="email" class="form-control" id="email" placeholder="" name="email"
                required="required" value="<?php if (isset($_POST['email'])){echo htmlentities($_POST['email']);} ?>">
            <span id="emailExists" style="display:none; color: red;">Cette adresse mail est déjà prise</span>
        </div>

        <div class="form-group">
            <label for="pseudo">Pseudonyme</label>
            <input type="text" class="form-control" id="pseudo" placeholder="" name="pseudo" required="required"
                value="<?php if (isset($_POST['pseudo'])){echo htmlentities($_POST['pseudo']);} ?>">
        </div>

        <div class="form-group">
            <label for="^prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" placeholder="" name="prenom" required="required"
                value="<?php if (isset($_POST['prenom'])){echo htmlentities($_POST['prenom']);} ?>">
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="" name="nom" required="required"
                value="<?php if (isset($_POST['nom'])){echo htmlentities($_POST['nom']);} ?>">
        </div>

        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <label for="mdp" id="strongMDP"></label>
            <input type="password" class="form-control" id="mdp" placeholder="Doit contenir au moins un chiffre"
                name="mdp" required="required">
            <span id="mdpNoNum" style="display:none; color: red;">Le mot de passe doit contenir au moins un
                chiffre</span>
        </div>

        <div class="form-group">
            <label for="mdpVerif">Verification du mot de passe</label>
            <input type="password" class="form-control" id="mdpVerif" placeholder="" name="mdpVerif"
                required="required">
            <span id="mdpUnmatch" style="display:none; color: red;">Les mots de passes ne correspondent pas</span><br>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit" id="submit">S'inscrire</button>
        </div>
    </form>
</div>
<script>
        $(document).ready(function(){
        var $submitBtn = $("#registerForm input[type='submit']");
        var $passwordBox = $("#mdp");
        var $confirmBox = $("#mdpVerif");
        var $errorMsg =  $('<span id="error_msg">Passwords do not match.</span>');

        $.ajax({
            url:"requetes/getEmail.php",
            method:"GET",
            data: {email: $("#email").val()},
            dataType:"json",
            success : function(email){
                test = email[0].emailClient;
                if(email[0].emailClient != null ){
                    $("#emailExists").fadeIn();
                    $('#submit').prop("disabled", true);

                }
            }
        });

        // au cas où l'utilisateur refresh la page.
        $submitBtn.removeAttr("disabled");

        function checkMatchingPasswords(){
            if($confirmBox.val() != "" && $passwordBox.val != ""){
                if( $confirmBox.val() != $passwordBox.val() ){
                    $('#submit').prop("disabled", true);
                    $('#mdpUnmatch').fadeIn();
                }
            }
        }

        function checkNumberPassword() {
            var regexNumber = new RegExp("[0-9]");
            if (!regexNumber.test($passwordBox.val())) {
                $('#mdpNoNum').fadeIn();
                $('#submit').prop("disabled", true);
            }
        }


        $('#mdp')
            .on("keydown", function(e){
                /* Ne check que quand les touches tab et enter sont pressées.
                    pour éviter que la fontion ne soit appellée inutilement*/
                if(e.keyCode == 13 || e.keyCode == 9) {
                    checkNumberPassword();
                }
             })
             .on("blur", function(){                    
                // check quand l'élément n'est plus focus.
                checkNumberPassword();
            })
            .on("focus", function(){
                // reset le message d'erreur et active le bouton lors d'un changement
                 $('#submit').prop("disabled", false);
                  $('#mdpNoNum').fadeOut();
            })


        $("#mdpVerif, #mdp")
             .on("keydown", function(e){
                /* Ne check que quand les touches tab et enter sont pressées.
                pour éviter que la fontion ne soit appellée inutilement*/
                if(e.keyCode == 13 || e.keyCode == 9) {
                    checkNumberPassword();
                    checkMatchingPasswords();
                }
             })
             .on("blur", function(){                    
                // check quand l'élément n'est plus focus.
                checkNumberPassword();
                checkMatchingPasswords();
            })
            .on("focus", function(){
                 // reset le message d'erreur et active le bouton lors d'un changement
                 $('#submit').prop("disabled", false);
                 $('#mdpNoNum').fadeOut();
                 $('#mdpUnmatch').fadeOut();
            })

            //indique la "puissance" du mot de passe en fonction de sa longueur.
        $('#mdp').on('keyup', function () {
            let mdpLen = $('#mdp').val().length;

            if (mdpLen == 0)
                $('#strongMDP').val();
            else if
                (mdpLen >= 0 && mdpLen < 6) $('#strongMDP').text("- Faible").css("color", "red");
            else if
                (mdpLen >= 6 && mdpLen < 12) $('#strongMDP').text("- Moyen").css("color", "grey");
            else
                $('#strongMDP').text("- Fort").css("color", "green");
        });

        
        $('#email')
            .on("focusout", function() {
                $.ajax({
                    url:"requetes/getEmail.php",
                    method:"GET",
                    data: {email: $("#email").val()},
                    dataType:"json",
                    success : function(email){
                        test = email[0].emailClient;
                        if(email[0].emailClient != null ){
                            $("#emailExists").fadeIn();
                           $('#submit').prop("disabled", true);

                        }
                    }
                });
            })
            .on("focus", function(){
                $("#emailExists").fadeOut();
                $('#submit').prop("disabled", false);
            });

    });
   

</script>
<?php include "include/footer.php"; ?>