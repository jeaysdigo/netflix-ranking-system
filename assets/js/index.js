$(document).ready(function () {
  $(".image").hover(
    function () {
      $(this).addClass("zoom");
    },
    function () {
      $(this).removeClass("zoom");
    }
  );
});

$(document).ready(function () {
  // Add click event listener to each movie card
  $(".card").click(function () {
    // Extract movie data from data attributes
    var netflixTitle = $(this).find("img").attr("alt");
    var genre = $(this).data("genre");
    var hoursViewed = $(this).data("hours-viewed");
    var directedBy = $(this).data("directed-by");
    var mainCast = $(this).data("main-cast");
    var dateReleased = $(this).data("date-released");
    var top = $(this).data("top");

    // time formatter
    var formattedHoursViewed =
      hoursViewed >= 1e3 && hoursViewed < 1e6
        ? (hoursViewed / 1e3).toLocaleString(undefined, {
            maximumFractionDigits: 1,
          }) + "K"
        : hoursViewed >= 1e6 && hoursViewed < 1e9
        ? (hoursViewed / 1e6).toLocaleString(undefined, {
            maximumFractionDigits: 1,
          }) + "M"
        : hoursViewed >= 1e9
        ? (hoursViewed / 1e9).toLocaleString(undefined, {
            maximumFractionDigits: 1,
          }) + "B"
        : hoursViewed.toLocaleString();

    // Create HTML to display movie details
    var html =
      '<h6 class="font-weight-bold"> Rank #' +
      top +
      "</h6>" +
      '<h1 id="top_title">' +
      netflixTitle +
      "</h1>" +
      "<p>" +
      genre +
      " | " +
      formattedHoursViewed +
      " hours views" +
      "</p>" +
      "<p> Starring " +
      mainCast +
      "</p>" +
      "<p> Directed by: " +
      directedBy +
      "</p>" +
      "<p> Released on " +
      dateReleased +
      "</p>";

      // Add hover effect to image
    $(".card").hover(
      function () {
        $(this).find(".card-body").removeClass("d-none");
        $(this).addClass("card-hovered");
      },
      function () {
        $(this).find(".card-body").addClass("d-none");
        $(this).removeClass("card-hovered");
      }
    );
    $(".card").hover(function () {
      $(this).find(".card-body").css("background-color", "rgba(0, 0, 0, 0.7)");
    });
    $(".accordion-trigger").click(function () {
      $(".accordion-content").show();
    });

    // Clicked an image
    $("#filter").click(function () {
      $(".displayCards").removeClass("col-md-12").addClass("col-md-4", 1000);
    });
    $("#filter2").click(function () {
      $(".displayCards").removeClass("col-md-4").addClass("col-md-12", 1000);
    });  

    // Display movie details in movie details div
    $("#movie-details").hide().html(html).fadeIn("fast");

    // Update body background image
    $("body")
      .css(
        "background-image",
        "linear-gradient(90deg, rgba(0, 0, 0, 0.999) 40%, rgba(0,0,0,0) 90%, rgba(0,212,255,0) 100%), url(" +
          $(this).find("img").attr("src") +
          ")"
      )
      .fadeIn(1000);
  });

  // Get the first card and trigger a click event on it
  $(".card").first().trigger("click");


});

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