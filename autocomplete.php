<?php
	
	// Declare all variables
	$db = $searchString = $characterList = $getVideos = "";

	include "core/dbConnect.php";

	// Autocomplete suggestion list for character search
	if(isset($_GET['term'])){
		$searchString  = $_GET['term'];
		$quotesList = array();
		// Database contains character nicknames so nickname searches will return results
		$getVideos = "SELECT * FROM transcript WHERE quote LIKE '%".$searchString."%' ";
		$runVideos = mysqli_query($db, $getVideos);

		while($row = mysqli_fetch_array($runVideos)){
			$quoteList[] = $row['quote'];
		}

		echo json_encode($quoteList);	
	}
	
?>