<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="About me and my assignments">
    <meta name="author" content="Wayne Herridge">
    <title>Home: All About Me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Stylesheet Links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/normalize.css">

</head>

<body>

  <!-- nav.php -->
  <?php include 'shared/nav.php' ?>

<main>
  <!-- Site title -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-5 text-info">Singer/Songwriter</h1>
    <p class="lead text-dark">I like music and when I have time I sometimes write my own songs</p>
  </div>
</div>

<div id="carouselSlidesOnly" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
  <div class="carousel-item active">
      <img src="images/guitar.jpg" class="d-block w-75" alt="Guitar">
  </div>
  <div class="carousel-item">
    <img src="images/headphones.jpg" class="d-block w-75" alt="Headphones">
  </div>
  <div class="carousel-item">
    <img src="images/mixer.jpg" class="d-block w-75" alt="Sound Mixer">
  </div>
  <div class="carousel-item">
      <img src="images/speaker.jpg" class="d-block w-75" alt="Speaker">
  </div>
</div>
</div>
</main>

  <!-- footer.php -->
  <?php include 'shared/footer.php';?>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
