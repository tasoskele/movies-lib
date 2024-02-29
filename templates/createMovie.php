
<div class="container">

  <!-- New Data -->
  <div class="left mt-5">
    <div class="form-title">
      Add any information needed
      <div class="form-specif">
        (First check the selections on the right)
      </div>
    </div>

    <div class="input-group mb-3">
      <input type="text" name="newActor" id="newActor" class="form-control"
        placeholder="Add a new actor">
      <button id="actorBtn" onclick="addActor(event)" class="btn btn-primary" type="button"
      >Add</button>
    </div>
    <div class="input-group mb-3">
      <input type="text" name="newGenre" id="newGenre" class="form-control"
        placeholder="Add a new genre">
      <button id="genreBtn" onclick="addGenre(event)" class="btn btn-primary" type="button"
      >Add</button>
    </div>
    <div class="input-group mb-3">
      <input type="text" name="newDirector" id="newDirector" class="form-control"
        placeholder="Add a new director">
      <button id="directorBtn" onclick="addDirector(event)" class="btn btn-primary"
        type="button">Add</button>
    </div>
    <div class="form-title" id="addok"></div>
  </div>

  <!-- New movie -->
  <div class="right mt-5">

    <div class="form-title">
      Add movie information
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

  <form action="movie-save.php" method="post" 
    enctype="multipart/form-data" onsubmit="return sbmForm();">
      <div class="input-group mb-3">
        <span class="input-group-text">Title</span>
        <input type="text" name="title" id="title" class="form-control">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text">Year</span>
        <input type="text" name="year" id="year" class="form-control">
      </div>
      <p><label for="description">Description</label></p>
      <div class="input-group mb-3">
        <textarea name="description" id="description" class="form-control"></textarea>
      </div>
      <div class="input-group mb-3">
        <select name="genre_id" id="genre_id" class="form-select">
          <option disabled selected>Select Genre</option>
          <?php 
          foreach ($genres_arr as $genre) {
          ?>
            <option value="<?=$genre->id;?>" ><?=$genre->name;?></option>
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
          <option value="<?=$director->id;?>" ><?=$director->name;?></option>
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
          foreach ($actors_arr as $actor) {
          ?>
          <option value="<?=$actor->id;?>" ><?=$actor->name;?></option>
          <?php 
          }
          ?>
        </select>
      </div>
      <div class="input-group mb-3">
        <input type="file" name="image" id="image" class="form-control">
      </div>
      <input type="submit" name="sbm" id="sbm" value="Save" class="btn btn-success" />
      <span>All fields are required</span>
    </form>
  </div>

</div>


<!-- Script -->
<script>
const baseUrl = location.href.slice(0, location.href.lastIndexOf('/'));

function sbmForm() {
  if ($('#title').val() == '' ||
      $('#year').val() == '' ||
      $('#description').val() == '' ||
      $('#genre_id').val() == '' ||
      $('#director_id').val() == '' ||
      $('#actors').val() == '' ||
      $('#image').val() == ''
  ) {
    alert('All fields are required.');
    return false;
  }
  return true;
}

//  Actor
function addActor(e) {
  e.preventDefault();
  e.target.disable = true;
  let newActorName = document.querySelector('#newActor').value;
  $.ajax({
    type: "POST",
    url: baseUrl+ '/actor-save.php',
    data: {'name': newActorName},
    dataType: "text",
  })
  .done(function (response) {
    e.target.disable = false;
    let res = JSON.parse(response);
    console.log('res', res);
    if (res.inserted_id) {
      $("select#actors").append($('<option>', { 
        value: res.inserted_id,
        text : newActorName 
      }));
      document.querySelector('#newActor').value = null;
      $('div#addok').append(
        $('<div>', {
          text: 'Actor added in list.',
          css: {'font-size':'1rem', 'font-weight':'normal'}
        })
        .addClass('alert')
        .addClass('alert-success')
      );
    }
  })
  .fail(function (err) {
    e.target.disable = false;
    console.log('err', err);
    alert('Error saving new actor.');
  });
  return false;
}

// Genre
function addGenre(e) {
  e.preventDefault();
  e.target.disable = true;
  let newGenre = document.querySelector('#newGenre').value;
  $.ajax({
    type: "POST",
    url: baseUrl+ '/genre-save.php',
    data: {'name': newGenre},
    dataType: "text",
  })
  .done(function (response) {
    e.target.disable = false;
    let res = JSON.parse(response);
    console.log('res', res);
    if (res.inserted_id) {
      $("select#genre_id").append($('<option>', { 
        value: res.inserted_id,
        text : newGenre 
      }));
      document.querySelector('#newGenre').value = null;
      $('div#addok').append(
        $('<div>', {
          text: 'Genre added in list.',
          css: {'font-size':'1rem', 'font-weight':'normal'}
        })
        .addClass('alert')
        .addClass('alert-success')
      );
    }
  })
  .fail(function (err) {
    e.target.disable = false;
    console.log('err', err);
    alert('Error saving new genre.');
  });
  return false;
}

// Director
function addDirector(e) {
  e.preventDefault();
  e.target.disable = true;
  let newDirector = document.querySelector('#newDirector').value;
  $.ajax({
    type: "POST",
    url: baseUrl+ '/director-save.php',
    data: {'name': newDirector},
    dataType: "text",
  })
  .done(function (response) {
    e.target.disable = false;
    let res = JSON.parse(response);
    console.log('res', res);
    if (res.inserted_id) {
      $("select#director_id").append($('<option>', { 
        value: res.inserted_id,
        text : newDirector 
      }));
      document.querySelector('#newDirector').value = null;
      $('div#addok').append(
        $('<div>', {
          text: 'Director added in list.',
          css: {'font-size':'1rem', 'font-weight':'normal'}
        })
        .addClass('alert')
        .addClass('alert-success')
      );
    }
  })
  .fail(function (err) {
    e.target.disable = false;
    console.log('err', err);
    alert('Error saving new director.');
  });
  return false;
}
</script>