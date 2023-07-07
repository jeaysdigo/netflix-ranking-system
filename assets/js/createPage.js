
    // Update the selected genres
function updateSelectedGenres() {
  var selectedGenres = [];
  $('.badge-selected').each(function() {
    selectedGenres.push($(this).data('value'));
  });
  $('#movie-genres').val(selectedGenres.join(', '));
  console.log(selectedGenres);
}

// Remove a genre from the available genres
function removeGenre(genre) {
  $('#genres span[data-value="' + genre + '"]').remove();
}
// Add a genre back to the available genres
function addGenre(genre) {
  // Check if the genre is already present in the available genres list
  var existingBadge = $('#genres span[data-value="' + genre + '"]');
  if (existingBadge.length > 0) {
    // If the genre is already present, just remove the badge-selected class and return
    existingBadge.removeClass('badge-selected');
    return;
  }

  // If the genre is not already present, create a new badge and add it to the available genres list
  var badge = $('<span class="badge rounded-pill bg-primary me-1" data-value="' + genre + '">' + genre + '</span>');
  badge.draggable({
    containment: 'document',
    helper: 'clone',
    zIndex: 100,
    revert: true,
    start: function() {
      $(this).addClass('badge-dragging');
    },
    stop: function() {
      $(this).removeClass('badge-dragging');
    }
  });
  $('#genres').append(badge);
}


// Make the badges droppable
$('.badge').draggable({
  containment: 'document',
  helper: 'clone',
  zIndex: 100,
  revert: true,
  start: function() {
    $(this).addClass('badge-dragging');
  },
  stop: function() {
    $(this).removeClass('badge-dragging');
  }
});
$('#selected-genres').droppable({
  accept: '.badge',
  drop: function(event, ui) {
    var badge = ui.draggable.clone();
    badge.removeClass('badge-primary');
    badge.addClass('badge-secondary badge-selected');
    badge.appendTo($(this));
    ui.draggable.draggable('option', 'revert', false);
    updateSelectedGenres();
    removeGenre(ui.draggable.data('value'));
    updateSelectedGenresInput();
  }
});

function updateSelectedGenresInput() {
  var selectedGenres = $('.badge-selected').map(function() {
    return $(this).data('value');
  }).get().join(',');
  $('#selected-genres-input').val(selectedGenres);
}

function updateSelectedGenres() {
  updateSelectedGenresInput();
}


// Make the selected genres removable
$('#selected-genres').on('click', '.badge-selected', function() {
  var genre = $(this).data('value');
  $(this).remove();
  addGenre(genre);
  updateSelectedGenres();
});

// Clear selected genre options
$('#resetBtn').click(function() {
  // Remove selected genres from the selected list and add them back to the available list
  $('.badge-selected').each(function() {
    var genre = $(this).data('value');
    $(this).remove();
    addGenre(genre);
  });
  // Clear the selected genre input field
  $('#movie-genres').val('');
});

function validateForm() {
  var selectedGenres = $("#selected-genres-input").val();
  if (selectedGenres.trim() == "") {
    $("#selected-genres").tooltip({
      title: "Please select at least one genre. Drag the genre here.",
      placement: "bottom",
      trigger: "manual"
    }).tooltip("show");
    setTimeout(function() {
      $("#selected-genres").tooltip("hide");
    }, 2000);
    return false;
  }
  return true;
}



// validate title existence using AJAX
function checkTitle() {
    var netflixTitle = document.getElementById("inputTitle").value;
    if (netflixTitle.length == 0) {
      document.getElementById("titlePrompt").innerHTML = "";
    } else {
      http = new XMLHttpRequest();
      http.onreadystatechange = function() {  
        if (http.readyState == 4 && http.status == 200) {
          var titlePrompt = document.getElementById("titlePrompt");
          titlePrompt.innerHTML = http.responseText;
          var existingTitle = document.getElementById("existingTitle");
          var submitButton = document.getElementById("createBtn");
          if (existingTitle) {
            // Disable the form's submit button if an existing title is found
            
            // console.log('form disabled');
            $('#createBtn').addClass('disabled');
            $('#inputTitle').addClass('border-danger');
          
          }
          else {
            // console.log('form enable');
            $('#createBtn').removeClass('disabled');
            $('#inputTitle').removeClass('border-danger');
         
          }
          
        }
      };
      http.open("GET", "validateTitle.php?q=" + netflixTitle, true);
      http.send();
    }
  }