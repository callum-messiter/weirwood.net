<?php include "includes/header.php"; ?>

<body background="resources/images/weirwood.png">
  <div class="container-fluid">
    <!-- Search elements -->
    <div id="topRow" class="row">
      <div id="form" class="col-lg-6 col-lg-offset-3">
        <div class="input-group">
          <div class="input-group-btn">
            <!-- Search-category dropdown button -->
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search by <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li id="quote" class="searchCategoryLi"><a href="#">quote</a></li>
              <!-- Add search categories here -->
            </ul>
          </div>
          <!-- Search field -->
          <input id="searchInput" class="form-control quote" type="text" placeholder="Search by quote" aria-label="...">
        </div></br>
        <!-- Submit button -->
        <button id="SearchBtn" class="btn btn-default" type="button" type="submit">Go</button> 
      </div>
    </div>

    <!-- Search results -->
    <div class="row">
      <!-- Change the col spans to change the size of the videos (iframes) -->
      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div id="searchResults"></div>
      </div>
    </div>
  </div>

<?php include "includes/footer.html"; ?>