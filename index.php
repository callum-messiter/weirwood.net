<?php include "includes/header.php"; ?>

    <body background="resources/images/weirwood.png">

        <div class="container-fluid">
            <!-- Search elements -->
            <div class="row" style="margin-top: 20px; margin-bottom: 70px">
                <div id="form" class="col-lg-6 col-lg-offset-3">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <!-- Search=by dropdown button -->
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search by <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li id="quoteSearchLi"><a href="#">quote</a></li>
                                <li id="charSearchLi"><a href="#">character</a></li>
                            </ul>
                        </div>
                        <!-- Search field -->
                        <input id="searchInput" type="text" class="form-control quote" placeholder="Search by quote" aria-label="...">
                    </div></br>
                    <!-- Submit button -->
                    <button id="SearchBtn" type="button" class="btn btn-default" type="submit">Go</button> 
                </div>
            </div>

            <!-- Search results -->
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 ">
                    <div id="searchResults"></div>
                </div>
            </div>

        </div>

<?php include "includes/footer.html"; ?>