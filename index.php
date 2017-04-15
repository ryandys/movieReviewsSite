<?php
	
	ini_set('display_errors',1);
    error_reporting(E_ALL);
	
	require_once('admin/phpscripts/init.php');
	
	if(isset($_POST['submit'])) {
		$commentTitle = $_POST['comment_title'];
		$commentContent = $_POST['comment_content'];
		$commentUser = $_POST['comment_user'];
		
		$uploadComment = addComment($commentTitle,$commentContent, $commentUser);
		$message = $uploadComment;
	}

	$tbl_comments = "tbl_comments";
	$getComments = getAllComments($tbl_comments);

    if(isset($_GET['filter'])) {
		$tbl1 = "tbl_movies";
		$tbl2 = "tbl_cat";
		$tbl3 = "tbl_l_mc";
		$col1 = "movies_id";
		$col2 = "cat_id";
		$col3 = "cat_name";
		$filter = $_GET['filter'];
		$getMovies = filterType($tbl1, $tbl2, $tbl3, $col1, $col2, $col3, $filter);
	}else{
		$tbl = "tbl_movies";
		$getMovies = getAll($tbl);
	}
	
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Movie Reviews</title>
<link rel="stylesheet" href="css/foundation.css">
<link rel="stylesheet" href="css/app.css">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link href="https://fonts.googleapis.com/css?family=Overpass:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<script src="js/ScrollToPlugin.min.js"></script>
<script src="js/TweenMax.min.js"></script>
</head>
<body>

	<!-- start off canvas -->
	<div class="off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
      <div class="off-canvas position-left reveal-for-large" id="offCanvas" data-off-canvas>

        <!-- Close button -->
        <button id="closeButtonColor" class="close-button" aria-label="Close menu" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>

        <?php
			include('layout/sideBar.php');
		?>

       </div>
    </div>

    <div class="off-canvas-content" data-off-canvas-content>
	<!-- close off canvas -->


	<!-- START PAGE CONTENT -->

	<h1 class="hide">Movie Reviews</h1>

	<div class="row expanded" id="con">

		<div class="small-12 medium-2 columns">
			<div id="moviesIcon">
				<img data-toggle="offCanvas" src="images/movie_reel_icon.svg" alt="reel icon" id="moviesIconImg">
			</div>
		</div>

		<div class="small-12 medium-10 columns">

			<ul class="filterNav">
				<li><a href="index.php?filter=action">Action</a></li>
				<li><a href="index.php?filter=comedy">Comedy</a></li>
				<li><a href="index.php?filter=family">Family</a></li>
				<li><a href="index.php?filter=horror">Horror</a></li>
				<li><a href="index.php">All</a></li>
			</ul>

			<div class="small-12 columns">
				<form action="" method="">
	  				<input id="searchBar" type="search" name="search" placeholder="Search...">
				</form>
			</div>
		</div>

		<div class="small-12 columns" id="vidCon">
			
			<div id="videoContainer"><!--start videoContainer div-->
				<div class="flex-video vimeo widescreen"><!--start flex-video div-->
					<video id="vidPlayer" controls>
						<source src="videos/tremors.mp4" type="video/mp4"/>
					    <!-- omitted webm to save space -->
					    <!-- omitted ogv to save space -->
					    Your browser does not support HTML5 video.
					</video>
				</div><!--end flex-video div-->

				<div id="controls"><!--start controls-->
					<img src="images/play.svg" id="pausePlay" alt="Pause/Play">
					<input type="range" id="seekBar" value="0">
					<img src="images/unmute.svg" id="muteButton" alt="Toggle Mute">
					<input type="range" id="volumeBar" min="0" max="1" step="0.1" value="1">
					<img src="images/full_screen.svg" id="fullScreen" alt="Toggle Full Screen">
				</div><!--end controls-->
			</div><!--end videoContainer div-->
		</div>


		<?php if(!empty($message)){echo $message;} ?>
			<form action="index.php" method="post" enctype="multipart/form-data">
				<input class="" type="text" name="comment_title" value="" placeholder="Title">
				<input class="" type="text" name="comment_user" value="" placeholder="Name">
				<input class="" type="text" name="comment_content" value="" placeholder="Message">
				<input type="submit" name="submit" value="Post" id="addEditSubmit">
			</form>


		<?php
			if(!is_string($getComments)){
				while($row = mysqli_fetch_array($getComments)){
					echo "<div class=\"newsWrapper\">";
					echo "<div class=\"row\">";

						echo "<div class=\"small-12 columns\">";
						echo "<h2>{$row['comment_title']}</h2>";
						echo "<p>{$row['comment_content']}</p>";
						echo "<p>{$row['comment_user']}</p>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
				}
			}else{
				echo "<p>{$getComments}</p>";
			}
		?>


	</div>

	<!-- CLOSE PAGE CONTENT -->


	<!-- close off canvas (divs below) -->
      </div>
    </div>


<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
</body>
</html>