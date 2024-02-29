<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="favicon.ico">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="css/simplePagination.css"/>
  <title>
    <?= $title;?>
  </title>
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/jquery.simplePagination.js"></script>
</head>
<body> 
  <div id = "boxes" class="row">
    <div id = "leftbox" class="col-md-3 box-div">
      <h2><a href="index.php" class="clickable">Home</a></h2> 
    </div> 
    <div id = "middlebox" class="col-md-3 box-div">
      <div class="dropdown">
        <h2><a class="dropbtn">Menu</a></h2>
        <div class="dropdown-content">
          <a href="create-movie.php" style="border:1px solid black;">Create a movie</a>
          <a href="top-ratings.php" style="border:1px solid black;">Top Ratings</a>
        </div>
      </div>
    </div>
    <div id = "Home" class="col-md-3 box-div">
      <h2><a href="my-ratings.php" class="clickable">My Ratings</a></h2>
    </div>
    <div id = "rightbox" class="col-md-3 box-div">
      <h2><a href="logout.php" class="clickable">Logout</a></h2>        
    </div>
  </div>

  <div class="bg">
    <div class="shade">
    <?php
      require_once($page);
    ?>
    </div>
  </div>
</body>
</html>