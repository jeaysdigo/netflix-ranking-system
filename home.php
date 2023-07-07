<!doctype html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/index.css">
  <!-- Fonts CSS -->
  <link rel="stylesheet" href="assets/css/netflix-fonts.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Script -->

  <script src="assets/bootstrap/js/jquery-3.6.0.min.js"></script>
  <script src="assets/bootstrap/js/jquery-ui.min.js"></script>
  <script rel="stylesheet" src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="assets/js/script.js"></script>
  <script src="assets/js/index.js"></script>


  <title>Netflix</title>
</head>


<body>
  <div class="container">
    <!-- navbar -->
    <div class="row pt-5">
      <div class="col-4 d-flex justify-content-center mt-4">
        <img class="" width="200px" src="logo.png" alt="netflix logo">
      </div>
      <div class="col-4 pt-5">
        <!-- SEARCH -->
        <form action="searchProcess.php" method="POST">
          <div class="input-group">
            <input id="searchBox" type="text" name="code" class="form-control bg-dark rounded-pill border-0 text-white"
              onkeyup="showHint(this.value)" required="required" autocomplete="off"
              placeholder="Search any movie/series title">

            <span class="input-group-append">
              <button class="btn btn-secondary bg-dark border-0 border rounded-pill ms-n5" type="button">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- SEARCH SUGGESTION RESULT -->
        <div id="suggestion_div">

        </div>
      </div>


      <div class="col">
        <div class="d-flex justify-content-start mt-5">
          <!-- CREATE -->
          <a href="manage.php" type="button" class="btn btn-danger"><i class="fa-solid fa-gear"
              style="color: #ffffff;"></i>&nbsp Manage </a>
          <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#create"><i class="fa-solid fa-plus"></i> Add</button> -->
        </div>
        <!-- DELETE -->
        <!-- <a href="#delete" class="btn btn-danger" data-toggle="modal"></span>Delete</a> -->
        <div class="d-flex justify-content-end">
          <!-- <button id="filter" class="btn p-2 ml-2 mr-2"><i class="fa-solid fa-list fa-lg" style="color: #ffffff;"></i></button>
              <button id="filter2" class="btn p-2 ml-2 mr-2"><i class="fa-solid fa-grip fa-xl" style="color: #ffffff;"></i></button> -->

        </div>
      </div>
    </div>
    <!-- End of navbar -->
    <?php
    $xml = new domdocument("1.0");
    $xml->load("BSIT3EG1G3.xml");
    $netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

    // Create an array of netflixOriginals nodes sorted by hoursViewed
    $sortedNetflixOriginals = array();
    foreach ($netflixOriginals as $topNetflixOriginals) {
      $hoursViewed = $topNetflixOriginals->getElementsByTagName("hoursViewed")->item(0)->nodeValue;
      $sortedNetflixOriginals[$hoursViewed] = $topNetflixOriginals;
    }
    krsort($sortedNetflixOriginals);
    $rank = 1;
    ?>

    <div class="container-fluid">

      <div id="movie-details" class=" text-white p-4 m-5">
        <!-- Movie details will be displayed here -->
      </div>

      <!-- READ -->
      <div id="carousel" class="carousel slide  mb-3" data-bs-ride="carousel">
        <div class="carousel-inner top-movies" role="listbox">
          <!-- Loop through movies and create cards -->
          <?php
          $count = 0;
          foreach ($sortedNetflixOriginals as $hoursViewed => $topNetflixOriginals) {
            // Extract movie data
            $picture = $topNetflixOriginals->getElementsByTagName("picture")->item(0)->nodeValue;
            $netflixTitle = $topNetflixOriginals->getElementsByTagName("netflixTitle")->item(0)->nodeValue;
            $genre = $topNetflixOriginals->getElementsByTagName("genre")->item(0)->nodeValue;
            $hoursViewed = $topNetflixOriginals->getElementsByTagName("hoursViewed")->item(0)->nodeValue;
            $directedBy = $topNetflixOriginals->getElementsByTagName("directedBy")->item(0)->nodeValue;
            $mainCast = $topNetflixOriginals->getElementsByTagName("mainCast")->item(0)->nodeValue;
            $dateReleased = $topNetflixOriginals->getElementsByTagName("dateReleased")->item(0)->nodeValue;
            $id = $topNetflixOriginals->getAttribute("id");
            $top = $rank;
            $rank++;

            // Create movie card
            if ($count % 6 == 0) {
              echo '<div class="carousel-item';
              if ($count == 0) {
                echo ' active';
              }
              echo '"><div class="row">';
            }
            ?>
            <div class="col-6 col-md-4 col-lg-2">
              <div class="card image rounded outline-0 border-0" data-genre="<?php echo $genre; ?>"
                data-hours-viewed="<?php echo $hoursViewed; ?>" data-directed-by="<?php echo $directedBy; ?>"
                data-main-cast="<?php echo $mainCast; ?>"
                data-date-released="<?php echo date('F j, Y', strtotime($dateReleased)); ?>"
                data-top="<?php echo $top; ?>">



                <span id="topNumber" class="position-absolute top-0 start-70 translate-middle badge">#
                  <?php echo $top; ?>
                </span>
                <img class="card-img-top rounded-3" src="data:image;base64,<?php echo $picture; ?>"
                  alt="<?php echo $netflixTitle; ?>">
                <!-- Add movie data to data attributes -->

              </div>
            </div>
            <?php
            $count++;
            if ($count % 6 == 0) {
              echo '</div></div>';
            }
          }
          if ($count % 6 != 0) {
            echo '</div></div>';
          }
          ?>
        </div>

        <a class="carousel-control-prev " href="#carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next " href="#carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
      </div>
      <?php
      include('createPage.php');
      // include('update.php');
      // include('delete.php');
      ?>
    </div>
  </div>
</body>

</html>