<?php
include('post_renderform.php');

// connect to the database
include('connect-db.php');
// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {
    // get form data, making sure it is valid
    error_log ( "Start " );
    
	$title = mysqli_real_escape_string($connection, htmlspecialchars($_POST['title']));
    $content = mysqli_real_escape_string($connection, htmlspecialchars($_POST['content']));

	$img = $_FILES['img'];
    	error_log($img['name']);
    	error_log($img);

	//$video_link = mysqli_real_escape_string($connection, htmlspecialchars($_POST['video_link']));
    //
    //print($title);
    //print($content);
	// check to make sure both fields are entered
	if ($title == '' || $content == '') {
		// generate error message
		$error = 'ERROR: Please fill in all required fields!';
		error_log("inside if statement ");
		// if either field is blank, display the form again
		renderForm($id, $title, $content, $img , '', '', $error) ;


	}

	if ($img['name'] ==''){
		error_log("image is empty");
	}

	else {


//Handling of Image upload
		error_log("image handling ~~");
		$fileName = $img['name'];
		error_log($fileName);
		$fileTmpName = $img['tmp_name'];
		error_log($fileTmpName);
		$fileExt = explode('.', $fileName);
		error_log($fileExt);
		$fileActualExt = strtolower(end($fileExt));
		error_log($fileActualExt);
		//when images with the same names are uploaded to the server, to avoid the same file name crash, give the unique id
		$fileNameNew = uniqid('',true).".".$fileActualExt;
		$img = 'images/'.$fileNameNew;

		//after asign each image a unique id, move the file from tmp place to image directory 
		move_uploaded_file($fileTmpName, $img);
		error_log("Start Inser DB");
		// save the data to the database
		$query = "INSERT INTO myBlog.post (title, content, image_link) VALUES ('$title', '$content', '$img')";
		error_log($query);

		$result = mysqli_query($connection, $query);
		error_log($result);
		
		if ( false===$result ){
			error_log(mysqli_error($connection));
		}

		header("Location: blog.php");
	}
} else {
	// if the form hasn't been submitted, display the form
	renderForm('','','','','','','');
}
?>
