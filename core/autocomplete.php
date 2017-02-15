<?php
	
	// Declare all variables
	$db = $searchString = $quoteList = $getVideos = $runVideos = '';

	include 'init/dbConnect.php';

	if(isset($_GET['quote'])){
		$searchString  = $_GET['quote'];
		$quotesList = array();
		$stmt = $db->prepare("SELECT * FROM transcript WHERE quote LIKE concat('%', :searchString, '%')");
		$stmt->bindParam(':searchString', $searchString);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_OBJ)){
			// Add quotes returned by the query to the array
			$quoteList[] = $res->quote;
		}
		// Return the array of quotes as a JSON object
		echo json_encode($quoteList);	
	}	
	# 
	# elseif(isset($_GET[newSearchCategory])){
	#     execute queries and logic for newSearchCategory
	# }
	
?>
