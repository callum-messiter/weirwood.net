<?php

	// Declare all variables 
	$db = $postVarName = $db = $column = $searchString = $characterList = $getVideos = $runVideos = $row = $video_id = "";

	include "core/dbConnect.php";
	include "core/functions/functions.php";

	// Search by character
	if(isset($_POST['character'])){
		getResults($_POST['character'], $db, 'characters');
	// Search by quote
	}elseif(isset($_POST['quote'])){
		getResults($_POST['quote'], $db, 'transcript');
	}#elseif(isset($_POST['x'])){
		#getResults($_POST['x'], $db, 'y');	
	#}

	// Autocomplete suggestion list for character search
	if(isset($_GET['term'])){
		$searchString  = $_GET['term'];
		$characterList = array();
		// Database contains character nicknames so nickname searches will return results
		$getVideos = "SELECT * FROM characters WHERE 
				   name  LIKE '%".$searchString."%'
				OR name2 LIKE '%".$searchString."%' 
				OR name3 LIKE '%".$searchString."%' ";
		$runVideos = mysqli_query($db, $getVideos);

		while($row = mysqli_fetch_array($runVideos)){
			$characterList[] = $row['name'];
		}

		echo json_encode($characterList);	
	}

?>
