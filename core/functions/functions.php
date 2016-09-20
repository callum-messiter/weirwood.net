<?php

function getResults($postVarName, $db, $column){
	$searchString = mysqli_real_escape_string($db, $postVarName);
	$getVideos 	  = "SELECT * FROM videos WHERE $column LIKE '%".$searchString."%' ";
	$runVideos 	  = mysqli_query($db, $getVideos);

	if(mysqli_num_rows($runVideos) == 0){
		echo 'nothing';
	}else{
		while($row = mysqli_fetch_array($runVideos)){
			$video_id = $row['yt_id'];
			
			echo '<div class="youtube-container">';
				echo '<div class="youtube-player" data-id="'.$video_id.'"></div>';
			echo '</div>';
		}
	}
}

?>