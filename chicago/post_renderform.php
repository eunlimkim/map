<?php
// creates the edit record form
function renderForm($id, $title, $content, $img, $blurb, $link, $error) {
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/post.css">

</head>

	<body>

		<?php
		// if there are any errors, display them
		if ($error != '') {
			echo '<div style="padding:4px; border:1px solid red; color:red; text-align:center; max-width: 1040px;
			width: 100%;
			margin-right: auto;
			margin-left: auto;">'.$error.'</div>';
		}
		?>
		<div class="container">
					<form action="#" method="post" enctype="multipart/form-data" class="form-inline">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<label for="title">Title:</label> 
							<input type="text" name="title" id="title">	

						<label for= "content">content:</label> 
							<input type="text" name="content" id="content" size="40">
			
						<label for ="img" class="custom-file-label">Upload file (ONLY .jpg):</label> 
							<input  type="file" name="img" id="img" value="<?php echo $img; ?>" class="custom-file-input" >

				<div class="submit">
						<input  type="submit" name="submit" value="Submit" class="button">
				</div>
					</form>
		</div>

		<script>
			document.getElementById('content').style.padding="5px 5px 100px 5px";
		</script>
	    
        
	</body>
</html>
<?php
}
?>