<!doctype html>
<html lang="en">

<head>

  <title>Manage List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Fonts CSS -->
  <link rel="stylesheet" href="assets/css/netflix-fonts.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Script -->
  <script src="assets/bootstrap/js/jquery-3.6.0.min.js"></script>
  <script src="assets/bootstrap/js/jquery-ui.min.js"></script>
  <script src="assets/js/manage.js"></script>
  <script src="assets/js/script.js"></script>
  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
</head>

<body class="">
  <script>
      // function that shows suggestion kapag nag type ka sa search box.
  function showHint(title) {
    // if textbox is empty
   {
        // create an object
        // XMLHttpRequest() is a javascript function that is responsible for communication of client and server asyncrhonously.
        http = new XMLHttpRequest();

        http.onreadystatechange = function() {
           
            if (http.readyState == 4 && http.status == 200) {
 
                $("#suggestion_div").html(http.responseText); 
                
           


            } else {
                $("#suggestion_div").html("Loading...");


            }
        };
        http.open("GET", "getMovies.php?q=" + title, true);
        http.send();
    }
}
  </script>

  <br>

  <div class="container">

    <h1 id="top_title" class="text-left"><b>Manage List</b></h1>
    <div class="row">
      <div class="col">
      

        <div class="d-flex justify-content-end">
          <a href="index.php" type="button" class="btn btn-danger m-1"><i class="fa-solid fa-home"></i> Home</a>
          <!-- CREATE -->
          <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#create"><i
              class="fa-solid fa-plus"></i> Add</button> &nbsp;
          <!-- SEARCH -->
          <form action="searchProcess.php" method="POST">
            <div class="input-group ">
              <input id="searchBox" type="text" name="code"
                class="form-control bg-dark rounded-pill border-0 text-white" onkeyup="showHint(this.value)"
                required="required" autocomplete="off" placeholder="Search any movie/series title">
              <span class="input-group-append">
                <button id="ms-n5" class="btn btn-secondary bg-dark border-0 border rounded-pill ms-n5" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </div>

        <!-- SEARCH SUGGESTION RESULT -->
        <div id="suggestion_div">

        </div>

        <!-- READ -->
        <br>
        <div class="row">
          <?php
          $xml = new domdocument("1.0");
          $xml->load("BSIT3EG1G3.xml");
          $netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

     
          

          foreach ($netflixOriginals as $topNetflixOriginals) {
            $picture = $topNetflixOriginals->getElementsByTagName("picture")->item(0)->nodeValue;
            // $top = $topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue;
            $netflixTitle = $topNetflixOriginals->getElementsByTagName("netflixTitle")->item(0)->nodeValue;
            $genre = $topNetflixOriginals->getElementsByTagName("genre")->item(0)->nodeValue;
            $hoursViewed = $topNetflixOriginals->getElementsByTagName("hoursViewed")->item(0)->nodeValue;
            $directedBy = $topNetflixOriginals->getElementsByTagName("directedBy")->item(0)->nodeValue;
            $mainCast = $topNetflixOriginals->getElementsByTagName("mainCast")->item(0)->nodeValue;
            $dateReleased = $topNetflixOriginals->getElementsByTagName("dateReleased")->item(0)->nodeValue;
            $id = $topNetflixOriginals->getAttribute("id");
            
            ?>
            <div class="displayCards col-md-4 col-sm-6 mb-4">
              <div id="card" class="card border-0 netflix-card">

                <img src="data:image;base64,<?php echo $picture; ?>" class="card-img-top"
                  alt="<?php echo $netflixTitle; ?>">

                <div class="card-body d-none position-absolute start-0 pt-5  text-center text-white w-100 h-100">
                  <h4 class="card-title font-weight-bold ">
                    <?php echo $netflixTitle; ?>
                  </h4>
                  <p class="card-text">
                    <?php echo $genre; ?>
                  </p>

                  <div class="row">
                    <div class="col"></div>
                    <div class="col">

                      <form method="GET" action="update.php">
                        <input type="hidden" name="update_id" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-edit"
                            style="color: #fff;"></i>&nbsp;Edit</a>
                      </form>
                      <!-- <a href="#update" data-bs-toggle="modal" class="btn btn-sm btn-danger"><i class="fas fa-edit" style="color: #fff;"></i>&nbsp;Edit</a> -->

                    </div>

                    <div class="col">
                      <form method="post" id="formDelete_<?php echo $id; ?>" action="deleteProcess.php">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-sm btn-danger delete-btn" data-id="<?php echo $id; ?>"><i
                            class="fas fa-trash" style="color: #fff;"></i>&nbsp;Delete</button>
                      </form>

                    </div>
                    <div class="col"></div>
                  </div>

                </div>

              </div>
            </div>

            <?php
            //show the modal
            include('createPage.php');
            // include('update.php');
            // include('delete.php');
            ?>
            <?php
          }
          ?>
        </div>

      </div>
    </div>
  </div>

  <!-- library for table sorting -->
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>