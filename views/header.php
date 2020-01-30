
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous">
    </script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="?page=">Twitter Clone</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="?page=timeline">Your Timeline</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=yourTweet">Your Tweets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=publicprofile">Public Profile</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
    <?php  if (isset($_SESSION['id'])) {?>
      <a class="btn btn-outline-success my-2 my-sm-0" href="?function=logout">Logout</a>
     <?php } else { ?>  
      <button class="btn btn-outline-success my-2 my-sm-0"   data-toggle="modal" data-target="#exampleModal">Login/SignUp</button>
     <?php }?>
    </div>
  </div>
</nav>      

