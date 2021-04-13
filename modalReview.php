<?php $pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0'; 

?>

<div class="modal fade" tabindex="-1" role="dialog" id="reviewModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: rgba(0, 0, 0, 0.78);">
      <div class=" modal-header">
        <h5 class="modal-title" style="color: white;"><strong>Rédiger un avis</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="body-review">
        <form>
          <label for="rating" style="color:white;">Note :</label>
          <div class='rating-stars' style="display:block;" name="rating">
            <ul id='stars'>
              <li class='star' title='Poor' data-value='1'>
                <i class='fa fa-star fa-fw'></i>
              </li>
              <li class='star' title='Fair' data-value='2'>
                <i class='fa fa-star fa-fw'></i>
              </li>
              <li class='star' title='Good' data-value='3'>
                <i class='fa fa-star fa-fw'></i>
              </li>
              <li class='star' title='Excellent' data-value='4'>
                <i class='fa fa-star fa-fw'></i>
              </li>
              <li class='star' title='WOW!!!' data-value='5'>
                <i class='fa fa-star fa-fw'></i>
              </li>
            </ul>
          </div>
          <label for="newReview" style="color: white;">Avis :</label>
          <textarea class="form-control" id="newReview" name="newReview" rows="3"
            placeholder="Écrivez votre avis ..."></textarea>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="postReview">Poster l'avis</button>
      </div>
    </div>
  </div>
</div>