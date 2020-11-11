<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/blog.css">
</head>

<body class="container">

    <?php include "inc/nav.php"; ?>
    <header>
            <h1>EunLim's Blog</h1>
    </header>

    <?php include "inc/scripts.php"; ?>

    <a href="insert.php" class="nav-link btn btn-primary">Create New Post</a> 


    <div>
        <?php
      // connect to the database
	error_log("start selecting");
      include('connect-db.php');
      // get results from database
      $result = mysqli_query($connection, "SELECT * FROM myBlog.post ORDER BY created_at desc");
      ?>
	<?php
	      if ( false===$result ){

		error_log(mysqli_error($connection));
	}
      ?>

      <div class="container">

      <?php
      // loop through results of database query, displaying them in the table
      while($row = mysqli_fetch_array( $result )) {
      ?>

          <div class="flex each">
              <div class="card">
              <img src="<?php echo $row['image_link'];?>">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $row['title']; ?></h4>
                  <p class="card-text"><?php echo $row["content"];?></p>
                </div>
                <div class="card-footer">
                  <div class="views">Date: <?php echo $row['created_at']; ?></div>
                </div>
              </div>
          </div>        
      <?php
      // close the loop
      }
      ?>
  
  </div>

    </div>

</body>

</html>

