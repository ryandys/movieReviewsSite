<?php
	include 'phpscripts/connect.php';

	$link->set_charset("utf8");

	// set some post stuff up here
	$vidNumber = $_GET["gallery_id"];	

	$videoQuery = "SELECT * FROM tbl_movies WHERE gallery_id = '$vidNumber'";
	$result = mysqli_query($link, $videoQuery);
	$row = mysqli_fetch_assoc($result);

	echo json_encode($row);
	//echo mysqli_num_rows($result);
?>