<?php
include('inc/protect.php');
// connect to the database
include('inc/connect-db.php');

// check if the 'id' variable is set in URL, and check that it is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	// get id value
	$id = $_GET['id'];

	//Delete Img from within directory
	$result = mysqli_query($connection, "SELECT * FROM student_index WHERE id=$id");
	$row = mysqli_fetch_array( $result );
	$imgToDelete = $row['img'];
	if (file_exists($imgToDelete)) {
		unlink($imgToDelete);
	}

	// delete the entry
	$result = mysqli_query($connection, "DELETE FROM student_index WHERE id=$id");

	

	// redirect back to the homepage to see the results
	header("Location: list.php");

} else {
	// if id isn't set, or isn't valid, redirect back to homepage
	header("Location: list.php");
}
?>