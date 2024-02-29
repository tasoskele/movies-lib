<?php 
if ($_SESSION['user']['admin']) {
  // User is Admin
  // Average rate
  $query = "SELECT AVG(rating) as rate FROM movies_ratings
    WHERE movie_id = ? GROUP BY movie_id";
  $prep = $db_conn->prepare($query);
  $params = [$_GET['movie_id']];
  $prep->execute($params);  
  $rating = $prep->fetchObject();

  // Actors
  $query = "SELECT id, name FROM actors";
  $prep = $db_conn->prepare($query);
  $prep->execute();
  while ($result = $prep->fetch(PDO::FETCH_OBJ)) {
    $actors_arr[] = $result; 
  }

  // Genres
  $query = "SELECT id, name FROM genre";
  $prep = $db_conn->prepare($query);
  $prep->execute();
  while ($result = $prep->fetch(PDO::FETCH_OBJ)) {
    $genres_arr[] = $result; 
  }

  // Directors
  $query = "SELECT id, name FROM directors";
  $prep = $db_conn->prepare($query);
  $prep->execute();
  while ($result = $prep->fetch(PDO::FETCH_OBJ)) {
    $directors_arr[] = $result; 
  }
}
?>

<div class="container-sng">
  <div class="form-title form-title-sng">
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
        <?=number_format($rating->rate ?? '0.0', 1)?>
        </span>
      </div>
    </div>
  </div>

  <!-- Details -->
  <div class="right right-sng mt-2">
  <form action="movie-update-adm.php" method="post" 
    enctype="application/x-www-form-urlencoded" onsubmit="return sbmForm();">
    <input type="hidden" id="id" name="id" value="<?=$_GET['movie_id']?>" />
      <div class="input-group mb-3">
        <span class="input-group-text">Title</span>
        <input type="text" name="title" id="title" class="form-control"
          value="<?=$movie->title?>">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Year</span>
        <input type="text" name="year" id="year" class="form-control"
          value="<?=$movie->year?>">
      </div>
      <p><label for="description">Description</label></p>
      <div class="input-group mb-3">
        <textarea name="description" id="description" class="form-control"><?=$movie->description?></textarea>
      </div>
      <div class="input-group mb-3">
        <select name="genre_id" id="genre_id" class="form-select">
          <option disabled selected>Select Genre</option>
          <?php 
          foreach ($genres_arr as $genre) {
          ?>
            <option value="<?=$genre->id;?>" 
              <?=($movie->genre_id == $genre->id) ? ' selected ' : '' ;?>
              ><?=$genre->name;?></option>
          <?php 
          }
          ?>
        </select>
      </div>
      <div class="input-group mb-3">
        <select name="director_id" id="director_id" class="form-select">
          <option disabled selected>Select Director</option>
          <?php 
          foreach ($directors_arr as $director) {
          ?>
          <option value="<?=$director->id;?>"
            <?=($movie->director_id == $director->id) ? ' selected ' : '' ;?>
            ><?=$director->name;?></option>
          <?php 
          }
          ?>
        </select>
      </div>
      (Hold CTRL for multiple actors)<br />
      <div class="input-group mb-3">
        <select multiple name="actors[]" id="actors" class="form-select">
          <option disabled>Select Actors</option>
          <?php 
          $actors_ids = [];
          foreach ($actors as $a) {
            $actors_ids[] = $a->id;
          }
          foreach ($actors_arr as $actor) {
          ?>
          <option value="<?=$actor->id;?>" 
            <?=(in_array($actor->id, $actors_ids)) ? ' selected ' : '' ;?>
            ><?=$actor->name;?></option>
          <?php 
          }
          ?>
        </select>
      </div>
      <span>All fields are required</span>
      <div>
        <button name="sbm" id="sbm" class="btn btn-success">Save</button>
      </div>
      <div>
        <button class="btn btn-danger mt-3" onclick="deleteMovie();"
          >Delete Movie</button>
      </div>

    </form>
  </div>

  </div>
</div>


<!-- Script -->
<script>
function sbmForm() {
  if ($('#title').val() == '' ||
      $('#year').val() == '' ||
      $('#description').val() == '' ||
      $('#genre_id').val() == '' ||
      $('#director_id').val() == '' ||
      $('#actors').val() == ''
  ) {
    alert('All fields are required.');
    return false;
  }
  return true;
}

function deleteMovie() {
  event.preventDefault();
  if (!confirm('This action can not be undone.')) {
    return false;
  }
  const baseUrl = location.href.slice(0, location.href.lastIndexOf('/'));
  let movieId = $('#id').val();
  $.ajax({
    type: "POST",
    url: baseUrl+ '/movie-delete-adm.php',
    data: {id: movieId},
    dataType: "text",
  })
  .done(function (response) {
    let res = JSON.parse(response);
    console.log('res', res);
    location.assign(baseUrl+ '/my-ratings.php');
  })
  .fail(function (err) {
    console.log('err', err);
    alert('Error deleting movie.');
  });
  return false;
}
</script>