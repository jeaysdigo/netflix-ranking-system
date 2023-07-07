<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Fonts CSS -->
    <link rel="stylesheet" href="assets/css/netflix-fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    
    <script src="assets/js/script.js"></script> 

    <title>Netflix</title>
  </head>

<style>
  .badge-dragging {
  opacity: 0.5;
}

#selected-genres {
  height: auto;
  min-height: 50px;
}

.badge-selected {
  cursor: pointer;
}
.top-movies  {
  padding: 25px;
}
    .image {
      transition: transform 0.2s;
    }
    .image.zoom {
      transform: scale(1.3);
      z-index: 1;
    }
    </style>

  <script>
    $(document).ready(function() {
      $('.image').hover(function() {
        $(this).addClass('zoom');
        
      }, function() {
        $(this).removeClass('zoom');
      });
    });
  </script>
  <body>
    <div class="container">
     
      <!-- navbar -->
      <div class="row pt-5">
        <div class="col-4 d-flex justify-content-center mt-4">
          <img class="" width="200px"src="logo.png" alt="netflix logo">
        </div>
        <div class="col-4 pt-5">
             <!-- SEARCH --> 
             <form action="searchProcess.php" method="POST">
                <div class="input-group">
                <input id="searchBox" type="text" name="code" class="form-control bg-dark rounded-pill border-0 text-white" onkeyup="showHint(this.value)" required="required" autocomplete="off" placeholder="Search any movie/series title">
 
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

    <style>
    /* search icon */
      .ms-n5 {
    margin-left: -40px;
    color: gray;
} 

    </style>
        </div>
       
     
          <div class="col">
            <div class="d-flex justify-content-start mt-5">
            <!-- CREATE -->
            <a href="manage.php" type="button" class="btn btn-danger" ><i class="fa-solid fa-gear" style="color: #ffffff;"></i>&nbsp  Manage </a>
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
              <div class="card image rounded outline-0 border-0" data-genre="<?php echo $genre; ?>" data-hours-viewed="<?php echo $hoursViewed; ?>" data-directed-by="<?php echo $directedBy; ?>" data-main-cast="<?php echo $mainCast; ?>" data-date-released="<?php echo date('F j, Y', strtotime($dateReleased)); ?>" data-top="<?php echo $top; ?>">



                  <span id="topNumber"class="position-absolute top-0 start-70 translate-middle badge">#<?php echo $top; ?></span>
                  <img class="card-img-top rounded-3" src="data:image;base64,<?php echo $picture; ?>" alt="<?php echo $netflixTitle; ?>">
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

</div>

<script>
 $(document).ready(function() {
  // Add click event listener to each movie card
  $('.card').click(function() {
    // Extract movie data from data attributes
    var netflixTitle = $(this).find('img').attr('alt');
    var genre = $(this).data('genre');
    var hoursViewed = $(this).data('hours-viewed');
    var directedBy = $(this).data('directed-by');
    var mainCast = $(this).data('main-cast');
    var dateReleased = $(this).data('date-released');
    var top = $(this).data('top');

    // time formatter
    var formattedHoursViewed = (hoursViewed >= 1e3 && hoursViewed < 1e6) ? (hoursViewed / 1e3).toLocaleString(undefined, {maximumFractionDigits:1}) + 'K' : (hoursViewed >= 1e6 && hoursViewed < 1e9) ? (hoursViewed / 1e6).toLocaleString(undefined, {maximumFractionDigits:1}) + 'M' : (hoursViewed >= 1e9) ? (hoursViewed / 1e9).toLocaleString(undefined, {maximumFractionDigits:1}) + 'B' : hoursViewed.toLocaleString();

// Create HTML to display movie details
var html = '<h6 class="font-weight-bold"> Rank #' + top + '</h6>'+
          '<h1 id="top_title">' + netflixTitle + '</h1>' +
           '<p>' + genre + ' | '+ formattedHoursViewed + ' hours views' +'</p>' +
          
           '<p> Starring ' + mainCast + '</p>' +
           '<p> Directed by: ' + directedBy + '</p>' +
           '<p> Released on ' + dateReleased + '</p>';
          


    
    // Display movie details in movie details div
    $('#movie-details').hide().html(html).fadeIn("fast");
    
    // Update body background image
   $('body').css('background-image', 'linear-gradient(90deg, rgba(0, 0, 0, 0.999) 40%, rgba(0,0,0,0) 90%, rgba(0,212,255,0) 100%), url(' + $(this).find('img').attr('src') + ')').fadeIn(1000);

  });

  // Get the first card and trigger a click event on it
  $('.card').first().trigger('click');
 });

</script>

<script>

//   // function that shows suggestion kapag nag type ka sa search box.
//   function showHint(title) {
//     // if textbox is empty
//    {
//         // create an object
//         // XMLHttpRequest() is a javascript function that is responsible for communication of client and server asyncrhonously.
//         http = new XMLHttpRequest();

//         http.onreadystatechange = function() {
           
//             if (http.readyState == 4 && http.status == 200) {
 
//                 $("#suggestion_div").html(http.responseText); 
                
           


//             } else {
//                 $("#suggestion_div").html("Loading...");


//             }
//         };
//         http.open("GET", "getMovies.php?q=" + title, true);
//         http.send();
//     }
// }
  </script>

    <?php

    include('createPage.php');
    // include('update.php');
    // include('delete.php');
    ?>
    
    </div>

<!-- 
    <h1>NETFLIX</h1>
<div class="wrapper">
  <section id="section1">
    <div class=" col-8 item">
    <img src="https://occ-0-1567-1123.1.nflxso.net/dnm/api/v5/rendition/412e4119fb212e3ca9f1add558e2e7fed42f8fb4/AAAABRvngexxF8H1-OzRWFSj6ddD-aB93tTBP9kMNz3cIVfuIfLEP1E_0saiNAwOtrM6xSOXvoiSCMsihWSkW0dq808-R7_lBnr6WHbjkKBX6I3sD0uCcS8kSPbRjEDdG8CeeVXEAEV6spQ.webp" alt="Describe Image">
  </div>
    <div class="item">
    <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/412e4119fb212e3ca9f1add558e2e7fed42f8fb4/AAAABZEK-7pZ1H5FD4cTyUb9qB_KeyJGz5p-kfPhCFv4GU_3mbdm8Xfsy4IBchlG9PFNdGff8cBNPaeMra72VFnot41nt0y3e8RLgaVwwh3UvyM2H2_MkmadWbQUeGuf811K7-cxJJh7gA.jpg" alt="Describe Image">
  </div>
    <div class="item">
    <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/412e4119fb212e3ca9f1add558e2e7fed42f8fb4/AAAABQCoK53qihwVPLRxPEDX98nyYpGbxgi5cc0ZOM4iHQu7KQvtgNyaNM5PsgI0vy5g3rLPZdjGCFr1EggrCPXpL77p2H08jV0tNEmIfs_e8KUfvBJ6Ay5nM4UM1dl-58xA6t1swmautOM.webp" alt="Describe Image">
  </div>
    <div class="item">
    <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/412e4119fb212e3ca9f1add558e2e7fed42f8fb4/AAAABdYtAqj8CyaJTWq5taD8Ro_UgwH3nne9QpFGVps-2J3IG-leqrfqXFii4jzZn48nPYTkrlwKQEV0R7_cEKlYBPRzdKqNODc-Oz26IL3LlLgFboXibIWXwxzeYxzuqn0I9TpARjeByw.jpg" alt="Describe Image">
  </div>
    <div class="item">
    <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/412e4119fb212e3ca9f1add558e2e7fed42f8fb4/AAAABbcCX42tsqGbBvO2y9CQv5-7QvYbCfoHtXsuc6NPCtZaKa4l4fBX3XWvUwG9F2A3CTsNpHVmulxBbdXKwK8Q6xGjejd9FoadGkZ7CnGrSl601TOQjzSHJ23NuIPC8j0QMGORL4uRIA.jpg" alt="Describe Image">
  </div>
  <div class="item">
    <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/412e4119fb212e3ca9f1add558e2e7fed42f8fb4/AAAABbcCX42tsqGbBvO2y9CQv5-7QvYbCfoHtXsuc6NPCtZaKa4l4fBX3XWvUwG9F2A3CTsNpHVmulxBbdXKwK8Q6xGjejd9FoadGkZ7CnGrSl601TOQjzSHJ23NuIPC8j0QMGORL4uRIA.jpg" alt="Describe Image">
  </div>
  </section>
</div> -->


<!-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/a76057bcfd003711a76fb3985b1f2cf74beee3b8/AAAABVxuRB932hvre-XP0gh6ar5ztoR3Oe3QjKHkyvcDnRak2MKXOrx5H7mFQSvggefMFOppwEs7ZCCpiqrJ_CYGvtvYB9NpU4SWUtNO6uV2u-DTID267AcHjHcGvGBQJ1ufddDkxcGOZyi5MlOQ5QUmBun4652FbYUnib3zMYQDgcna_Pvz8y_HO5fbokxezrRR1JZAAiqFSQ.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/a76057bcfd003711a76fb3985b1f2cf74beee3b8/AAAABVxuRB932hvre-XP0gh6ar5ztoR3Oe3QjKHkyvcDnRak2MKXOrx5H7mFQSvggefMFOppwEs7ZCCpiqrJ_CYGvtvYB9NpU4SWUtNO6uV2u-DTID267AcHjHcGvGBQJ1ufddDkxcGOZyi5MlOQ5QUmBun4652FbYUnib3zMYQDgcna_Pvz8y_HO5fbokxezrRR1JZAAiqFSQ.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://occ-0-243-299.1.nflxso.net/dnm/api/v5/rendition/a76057bcfd003711a76fb3985b1f2cf74beee3b8/AAAABVxuRB932hvre-XP0gh6ar5ztoR3Oe3QjKHkyvcDnRak2MKXOrx5H7mFQSvggefMFOppwEs7ZCCpiqrJ_CYGvtvYB9NpU4SWUtNO6uV2u-DTID267AcHjHcGvGBQJ1ufddDkxcGOZyi5MlOQ5QUmBun4652FbYUnib3zMYQDgcna_Pvz8y_HO5fbokxezrRR1JZAAiqFSQ.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
       $(document).ready(function() {
      // Add hover effect to card
      $('.card').hover(function() {
        $(this).find('.card-body').removeClass('d-none');
        $(this).addClass('card-hovered');
      }, function() {
        $(this).find('.card-body').addClass('d-none')
        $(this).removeClass('card-hovered');
      });
      $('.card').hover(function() {
      $(this).find('.card-body').css('background-color', 'rgba(0, 0, 0, 0.7)');
    });
    $('.accordion-trigger').click(function() {
      $('.accordion-content').show();
      
    });
    $('#filter').click(function() {
      $('.displayCards').removeClass('col-md-12').addClass('col-md-4',1000);
    });
    $('#filter2').click(function() {
      $('.displayCards').removeClass('col-md-4').addClass('col-md-12',1000);
    });
    });  
    </script>
  </body>
</html>