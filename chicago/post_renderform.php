<?php
// creates the edit record form
function renderForm($id, $firstname, $lastname, $img, $blurb, $link, $error) {
?>
<!doctype html>
	<body>
		<header>
		</header>
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
			<div class="form-group">
				<label for="title">Title:</label> <input type="text" name="title" id="title">
                
			</div>

			<div class="form-group">
				<label for= "content">content:</label> <input type="text" name="content" id="content">
			</div>
			
			<div class="custom-file form-group">
				<label for ="img" class="custom-file-label">Upload your headshot:</label> <input  type="file" name="img" id="img" value="<?php echo $img; ?>" class="custom-file-input" >
			</div>
			
			<input  type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">
			<div>
        	</div>
		</form>
	 	</div>

	    
        
	</body>
</html>
<?php
}
?>