<?php 
if (!$_SESSION['user']['admin']) {  
  // User is normal user
  $query = "SELECT rating, note 
    FROM movies_ratings
    WHERE movie_id= ? AND user_id= ?";
  $prep = $db_conn->prepare($query);
  $params = [$_GET['movie_id'], $_SESSION['user']['id']];
  $prep->execute($params);
  $rating = $prep->fetchObject();
}
?>

<div class="container-sng">
  <div class="form-title form-title-sng mb-3" style="display: grid;">
    Movie Details
    <?php 
      // Message
      if (isset($_SESSION['msg'])) {
        echo '<div class="alert alert-success p-1">';
        echo '<h6>Message: '. $_SESSION['msg']. '</h6>';
        echo '</div>';
        unset($_SESSION['msg']);
      }
      // Error
      if (isset($_SESSION['err'])) {
        echo '<div class="card bg-warning text-error">';
        echo '<h6>Error: '. $_SESSION['err']. '</h6>';
        echo '</div>';
        unset($_SESSION['err']);
      }
    ?>
  </div>

  <div class="container-sng-inner">
  <!-- Image -->
  <div class="left left-sng mt-2">
    <div class="card images-grid images-grid-sng" >
      <img class="card-img-top card-img-top-sng" src="<?=$movie->image?>">
      <div class="card-body card-body-sng text-center">
        <span class="text-white"><?=$movie->title?></span>
        <br />
        <span class="rate-span rate-span-sng">
          <?=number_format($rating->rating ?? '0.0', 1)?>
        </span>
      </div>
    </div>
  </div>

  <!-- Details -->
  <div class="right right-sng mt-2">
  <form action="movie-update.php" method="post" 
    enctype="application/x-www-form-urlencoded" onsubmit="return sbmForm();">
    <input type="hidden" id="id" name="id" value="<?=$_GET['movie_id']?>" />
      <div class="mb-3">
        <label>Title</label>
        <div class="text-body"><?=$movie->title?></div>
      </div>
      <div class="mb-3">
        <label>Year</label>
        <span class="text-body"><?=$movie->year?></span>
      </div>
      <div class="mb-3">
        <label>Description</label>
        <div class="text-body"><?=$movie->description?></div>
      </div>
      <div class="mb-3">
        <label>Genre</label>
        <span class="text-body"><?=$movie->g_name?></span>
      </div>
      <div class="mb-3">
        <label>Director</label>
        <span class="text-body"><?=$movie->d_name?></span>
      </div>
      <div class="mb-3">
        <label>Actors</label>
        <div class="text-body">
          <?php 
          foreach ($actors as $a) {
            echo $a->name. "<br />";
          }
          ?>
        </div>
      </div>
      <p><label for="description">Personal Notes</label></p>
      <div class="input-group mb-3">
        <textarea name="note" id="note" class="form-control"
          placeholder="Type your personal notes..."><?=$rating->note ?? '';?></textarea>
      </div>
      <div class="input-group mb-3">
        <?php $rt = $rating->rating ?? 0;?>
        <select name="rating" id="rating" class="form-select">
          <option disabled selected>Rate Movie</option>
          <option <?=($rt == 1) ? ' selected ' : ''?> value="1">1</option>
          <option <?=($rt == 2) ? ' selected ' : ''?> value="2">2</option>
          <option <?=($rt == 3) ? ' selected ' : ''?> value="3">3</option>
          <option <?=($rt == 4) ? ' selected ' : ''?> value="4">4</option>
          <option <?=($rt == 5) ? ' selected ' : ''?> value="5">5</option>
          <option <?=($rt == 6) ? ' selected ' : ''?> value="6">6</option>
          <option <?=($rt == 7) ? ' selected ' : ''?> value="7">7</option>
          <option <?=($rt == 8) ? ' selected ' : ''?> value="8">8</option>
          <option <?=($rt == 9) ? ' selected ' : ''?> value="9">9</option>
          <option <?=($rt == 10) ? ' selected ' : ''?> value="10">10</option>
        </select>
      </div>

      <input type="submit" name="sbm" id="sbm" value="Save" class="btn btn-success" />
    </form>
  </div>

  </div>
</div>


<!-- Script -->
<script>
function sbmForm() {
}
</script>