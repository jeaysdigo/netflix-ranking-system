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