<?php $pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0'; 

?>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="ticketModal">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.95);">
            <div class=" modal-header">
                <h5 class="modal-title" style="color: white;"><strong>Choix des tickets</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body-ticket">
                <form action="validation.php" method="post" id="prix">
                    <input type="hidden" id="dateS" name="dateS"></input>
                    <input type="hidden" id="heureS" name="heureS"></input>
                    <input type="hidden" id="idMovie" name="idMovie"></input>

                </form>
            </div>
            <div class=" modal-footer">
                <button type="submit" class="btn btn-primary" id="validerReser">Valider la réservation</button>
            </div>
        </div>
    </div>
</div>

<script>


</script>