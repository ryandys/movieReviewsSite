<div class="small-12" id="sideBar">
<h2>Movies</h2>

	<?php
		if(!is_string($getMovies)){
			while($row = mysqli_fetch_array($getMovies)){
		  		echo "<div class=\"movieThumbCon\" id=\"{$row['movies_id']}\">
		  			  <img src=\"images/{$row['movies_thumb']}\" alt=\"{$row['movies_title']}\" class=\"movieThumb\">
					  <h3 class=\"movieThumbTitle\">{$row['movies_title']}</h3>
					  </div>";
					}
			}else{
		echo "<p>{$getMovies}</p>";
		}	
	?>

</div>