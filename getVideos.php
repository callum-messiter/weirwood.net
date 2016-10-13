<?php

	// Declare all variables 
	$db = $postVarName = $db = $column = $searchString = $characterList = $getVideos = $runVideos = $row = $video_id = "";

	include "core/dbConnect.php";

	// Quote search with time stamp
	if(isset($_POST['quote'])){
	    $searchString = mysqli_real_escape_string($db, $_POST['quote']);
		$getVideos 	  = "SELECT * FROM transcript WHERE quote LIKE '%".$searchString."%' ";
		$runVideos 	  = mysqli_query($db, $getVideos);

		if(mysqli_num_rows($runVideos) == 0){
			echo 'nothing';
		}else{
			while($row = mysqli_fetch_array($runVideos)){
				$video_id   = $row['video_id'];
				$start_time = $row['start_time'];
				$start_time = floor($start_time);
				// The loadVideo function in showVideos.js will grab the data-id and start-time and display the relevant video
				echo '<div class="youtube-container">';
					echo '<div class="youtube-player" data-id="'.$video_id.'" start-time="'.$start_time.'"></div>';
				echo '</div>';
			}
		}
	}

?>