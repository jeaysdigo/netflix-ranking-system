
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
    $(this).find('.card-body').css('background-color', 'rgba(0, 0, 0, 0.8)');
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
  
  $('.delete-btn').click(function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'lightgray',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "deleteProcess.php",
                data: { id: id },
                success: function(data) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your item has been deleted.',
                        icon: 'success',
                        confirmButtonColor: 'red',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reload page after success message
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error deleting your item.',
                        icon: 'error',
                        confirmButtonColor: 'red',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    })
});

});





function validateForm() {
  var selectedGenres = $("#selected-genres-input").val();
  if (selectedGenres.trim() == "") {
    $("#selected-genres").tooltip({
      title: "Please select at least one genre.",
      placement: "top",
      trigger: "manual"
    }).tooltip("show");
    setTimeout(function() {
      $("#selected-genres").tooltip("hide");
    }, 2000);
    return false;
  }
  return true;
}



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