<?php
	
	// Declare all variables
	$db = $searchString = $quoteList = $getVideos = $runVideos = "";

	include "core/init/dbConnect.php";

	if(isset($_GET['term'])){
		$searchString  = $_GET['term'];
		$searchString  = mysqli_real_escape_string($db, $searchString);
		$quotesList    = array();
		$getVideos     = "SELECT * FROM transcript WHERE quote LIKE '%".$searchString."%' ";
		$runVideos     = mysqli_query($db, $getVideos);

		while($row = mysqli_fetch_array($runVideos)){
			// Add quotes returned by the query to the array
			$quoteList[] = $row['quote'];
		}
		// Return the array of quotes as a JSON object
		echo json_encode($quoteList);	
	}
	
?>
