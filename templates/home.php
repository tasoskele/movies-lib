
<div class="logo-container">
  <img src="images/mylogo.png" width="300" height="200" alt="logo" class="logo" />
</div>

<div class="search">
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

  <form action="search-movie.php" method="post" onsubmit="return sbmForm();"
    enctype="application/x-www-form-urlencoded">
    <div class="input-group">
      <input type="text" id="search" name="search" class="form-control" 
        placeholder="Search Movie">
      <button class="btn btn-primary" type="submit">Go</button>
    </div>
  </form>
</div>


<script>
function sbmForm() {
  if ($('#search').val().length < 2) {
    alert('Type at least 2 characters.');
    return false;
  }
  return true;
}
</script>