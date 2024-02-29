<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="favicon.ico">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <title><?=$title;?></title>
  <script src="./js/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
</head>
<body> 
  <div class="bg">
    <div class="shade">
    <?php
      require_once($page);
    ?>
    </div>
  </div>
</body>
</html>