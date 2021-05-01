<?php $pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.85);">
            <div class="modal-header">
                <h5 class="modal-title" id="loginTitle" style="color: white;"><strong>Authentifiez-vous</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="LoginForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="LoginEmail">Adresse Email</label>
                        <input type="email" class="form-control" id="LoginEmail" placeholder="" name="LoginEmail">
                    </div>

                    <div class="form-group">
                        <label for="LoginMDP">Mot de passe</label>
                        <input type="password" class="form-control" id="LoginMDP" placeholder="" name="LoginMDP">
                    </div>

                    <div id="error"></div>

                    <div class="modal-footer form-group">
                        <button type="submit" class="btn btn-primary" name="loginSubmit" id="btnAuth">S'authentifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //Si l'email et/ou le mdp sont incorrects.
    //if ($('#WrongLogin').length > 0)
    //  $('#loginModal').modal('show');

    $(document).ready(function() {

        $('form#LoginForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "requetes/connect.php",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(connexion) {
                    if (connexion != 1) {
                        $("<span id='WrongLogin' style='color: red;'>Email et/ou mot de passe incorrect(s)</span>").appendTo("#error");
                    } else {
                        location.reload();
                    }
                }
            });

        });

        $('#loginModal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
            $('#error').empty();
        })

    });
</script>