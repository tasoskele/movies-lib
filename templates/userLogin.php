<div class="container auth-container col-md-6 mt-5">
  <form action="login.php" method="post" novalidate onsubmit="return sbmForm();">
    <h3>User Login</h3>

    <div class="input-group mb-3">
      <span class="input-group-text">Email</span>
      <input type="text" name="email" id="email" class="form-control">
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">Password</span>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-dark mt-2">Submit</button>
  </form>
  <div class="mt-3">
    <h5>Not registered? <a href="register.php">Register</a></h5>
  </div>
  <div class="form-title">
    <?php 
      // Message
      if (isset($_SESSION['msg'])) {
        echo '<div class="alert alert-success">';
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
</div>


<!-- SCRIPT -->
<script>
function sbmForm() {
  if ($('#email').val() == '' ||
      $('#password').val() == ''
  ) {
    alert('All fields are required.');
    return false;
  }
  return true;
}
</script>