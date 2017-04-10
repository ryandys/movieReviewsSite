<div class="small-12" id="sideBar">

	<?php
		if(!is_string($getMovies)){
			while($row = mysqli_fetch_array($getMovies)){
		  		echo "<div class=\"movieThumbCon\">
		  			  <img src=\"images/{$row['movies_thumb']}\" alt=\"{$row['movies_title']}\" class=\"movieThumb\">
					  <h2 class=\"movieThumbTitle\">{$row['movies_title']}</h2>
					  <p><a id=\"{$row['movies_id']}\">Trailer and Reviews</a></p>
					  </div>";
					}
			}else{
		echo "<p>{$getMovies}</p>";
		}	
	?>

</div>