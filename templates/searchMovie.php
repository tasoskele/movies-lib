<?php 

require_once('inc/db-connection.php');
if (isset($_GET['s_movies'])) {
  $s_movies = $_GET['s_movies'];
}

$query = "SELECT m.id, m.title, m.image, AVG(mr.rating) as rate
FROM movies m 
LEFT JOIN movies_ratings mr
ON mr.movie_id = m.id
WHERE m.id IN ($s_movies)
GROUP BY m.id";
$prep = $db_conn->prepare($query);
$prep->execute();
$movies = [];
while ($res = $prep->fetchObject()) {
  $movies[] = $res;
}

?>

<div class="form-title form-title-sng" style="display: grid;">
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

<div class="ratings-container mt-3">

  <?php 
  // No movies found
  if (count($movies) == 0) {
    echo '<h2>No movies found</h2>';
  }

  $page = 0;
  if (isset($_GET['page'])) {
    $page = $_GET['page'] - 1;
  }
  $start = $page * 8;
  for ($i=0; $i<4; $i++) { 
    if (isset($movies[$start+$i])) {
      $movie = $movies[$start+$i];
    } else {
      continue;
    }
  ?>
    <div class="card images-grid" >
      <a href="movie-details.php?movie_id=<?=$movie->id;?>">
        <img class="card-img-top" src="<?=$movie->image;?>">
      </a>
      <div class="card-body text-center">
        <a href="movie-details.php?movie_id=<?=$movie->id;?>"><?=$movie->title;?></a>
        <br />
        <span class="rate-span"><?=number_format($movie->rate ?? '0.0', 1)?></span>
      </div>
    </div>
    <?php 
  }?>
</div>

<div class="ratings-container mt-3">
  <?php 
  for ($i=4; $i<8; $i++) { 
    if (isset($movies[$start+$i])) {
      $movie = $movies[$start+$i];
    } else {
      continue;
    }
  ?>
    <div class="card images-grid" >
      <a href="movie-details.php?movie_id=<?=$movie->id;?>">
        <img class="card-img-top" src="<?=$movie->image;?>">
      </a>
      <div class="card-body text-center">
        <a href="movie-details.php?movie_id=<?=$movie->id;?>"><?=$movie->title;?></a>
        <br />
        <span class="rate-span"><?=number_format($movie->rate ?? '0.0', 1)?></span>
      </div>
    </div>
    <?php 
  }?>
</div>
<div id="pagination" class="m-5"></div>

<!-- Script -->
<script>
$(document).ready(function(){
  $(function() {
      $('#pagination').pagination({
          items: <?=count($movies);?>,
          itemsOnPage: 8,
          cssStyle: 'compact-theme',
          hrefTextPrefix: "search-movie.php?s_movies=<?=$s_movies?>&page=",
          currentPage: <?=($page+1)?>
      });
  });
});
</script>
