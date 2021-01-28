<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Books Near You</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
</head>

<body class="container">

    <?php include "inc/nav.php"; ?>

    <div class="container">

    <div class="blog_form">
    <form action="action_page.php" style = "text-align: center;">
        <label for="fname" style="color:white;">Zip Code:</label>
        <input type="text" id="zipcode" name="zipcode">
        <label for="lname" style="color:white;">Book Title:</label>
        <input type="text" id="book_title" name="book_title">
        <input type="submit" value="Search">
        <p style="color:white;">Please give it 3-6 seconds to load the map</p>
    </form>
    </div>    
    </div> 
    
    <?php include "inc/scripts.php"; ?>
    

</body>

</html>

