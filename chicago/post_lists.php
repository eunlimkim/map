<?php session_start(); ?>
  <body class="container-fluid">
      <header class="full-width">

      </header>
      <?php
      // connect to the database
      include('connect-db.php');

      // get results from database
      $result = mysqli_query($connection, "SELECT * FROM myBlog.post ORDER BY created_at desc");
      ?>
      
      <ul>
      <?php
      // loop through results of database query, displaying them in the table
      while($row = mysqli_fetch_array( $result )) {
      ?>
       <li>
          <div class="grid-container">
            <h3 class="full-width"> <?php echo $row['created_at']; ?>
              <?php echo $row['title']; ?> 
            </h3>
            <figure> <img src="<?php echo $row['image_link'];?>" style="height:400px; width:400px;" alt="<?php echo $row["title"], " ", $row["content"];?>"> </figure>
            <p></p>
            <div>
<!-- if logged in -->



            </div>
            </div>
          </div>
        </li>
      <?php
      // close the loop
      }
      ?>
      </ul>

      
      <div>
        <a href="index.php" class="btn btn-info">Return Home</a>
        <!-- if logged in, show -->
        <a href="new.php" class="nav-link btn btn-primary">Add your info to this webpage</a> 
     </div>
     <script src="js/dropdown-menu.js"></script>
  </body>
</html>
<?php
  mysqli_free_result($result);
  mysqli_close($connection);
?>
