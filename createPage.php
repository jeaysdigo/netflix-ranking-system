<script src="assets/js/createPage.js"></script>


<!--  CREATE MODAL-->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form method="POST" action="createProcess.php" id="createForm" onsubmit="return validateForm()">
          <div class="form-floating mb-3 d-none">
            <input type="text" class="form-control" id="idcode" name="idcode" value="<?php echo uniqid() ?>"
              readonly="readonly">
            <label for="idcode">Email </label>
          </div>
          <div class="form-floating mb-3">
            <input id="inputTitle" onkeyup="checkTitle()" type="text" class="form-control" name="netflixTitle"
              required="required" placeholder="Title" autocomplete="off">
            <label for="inputTitle" class="form-label">Title</label>
            <div id="titlePrompt">

            </div>

          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="directedBy" name="directedBy" required="required"
              autocomplete="off" placeholder="Director/s">
            <label for="directedBy" class="form-label">Director</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="mainCast" name="mainCast" required="required" autocomplete="off"
              placeholder="Cast">
            <label for="mainCast" class="form-label">Cast</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="dateReleased" name="dateReleased" required="required"
              autocomplete="off" placeholder="Date Released">
            <label for="dateReleased" class="form-label">Date Release:</label>
          </div>
          <div class="input-group mb-3">

            <input id="hoursViewed" name="hoursViewed" type="number" min="1" class="form-control" required="required"
              autocomplete="off" placeholder="Views">

            <span class="input-group-text">hours</span>
          </div>

          <!-- genre div -->
          <div class="form-floating mb-3">
            <div class="mb-3">
              <input type="hidden" id="selected-genres-input" class="d-none" name="selectedGenres" required="required">

              <label for="selected-genres" class="form-label">Genres:</label>
              <div id="selected-genres" class="form-control">
                <button class="btn float-end outline-0 border-0" type="button" id="resetBtn"><i
                    class="fa-solid fa-xmark"></i></button>
              </div>

            </div>
            <div class="mb-3">
              <div id="genres" class="">
                <?php
                $genres = array(
                  "Drama",
                  "Thriller",
                  "Comedy",
                  "Fantasy",
                  "Romance",
                  "Science Fiction",
                  "Adventure",
                  "Sports",
                  "Action",
                  "Western",
                  "Horror",
                  "Musical",
                  "Mystery"
                );

                foreach ($genres as $genre) {
                  echo '<span class="badge rounded-pill bg-primary me-1" data-value="' . $genre . '">' . $genre . '</span>';
                }
                ?>

              </div>
            </div>
          </div>
          <!-- end genre div -->

          <div class="input-group mb-3">
            <input type="file" class="form-control" id="picture" name="picture" required="required"
              placeholder="Upload">
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" id="createBtn" class="btn btn-danger w-100"><i class="fa-solid fa-plus"></i> Add
          Record</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!--  END OF CREATE MODAL-->