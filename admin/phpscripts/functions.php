<?php
	
function redirect_to($location) {
	if($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}
	
function addComment($commentTitle,$commentContent,$commentUser) {
	include('connect.php');
			
			$qstring = "INSERT INTO tbl_comments VALUES(NULL,'{$commentTitle}','{$commentContent}','{$commentUser}')";
			$result = mysqli_query($link,$qstring);
			
			redirect_to("index.php");
	
	mysqli_close($link);
}

?>