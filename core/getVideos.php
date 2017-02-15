<?php

	// Declare all variables 
	$db = $searchString = $characterList = $getVideos = $runVideos = $row = $start_time = $video_id = '';

	include 'init/dbConnect.php';

	if(isset($_POST['quote'])) {
		$searchString = $_POST['quote'];
		$stmt = $db->prepare("SELECT * FROM transcript WHERE quote LIKE concat('%', :searchString, '%')");
		$stmt->bindParam(':searchString', $searchString);
		$stmt->execute();
		
		if($stmt->rowCount() > 0) {
			while($res = $stmt->fetch(PDO::FETCH_OBJ)) {
				$video_id   = $res->video_id;
				$start_time = floor($res->start_time);

				// The loadVideo function in showVideos.js will grab the data-id and start-time and display the relevant video
				echo '<div class="youtube-container">';
					echo '<div class="youtube-player" data-id="'.$video_id.'" start-time="'.$start_time.'"></div>';
				echo '</div>';
			}
		} else {
			echo 'nothing';
		}
	}
	# elseif(isset($_POST[newSearchCategory])){
	#     execute queries and logic for newSearchCategory
	# }

?>
