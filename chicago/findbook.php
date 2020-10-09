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

    
    <form action="action_page.php">
        <label for="fname">Zip Code:</label>
        <input type="text" id="zipcode" name="zipcode">
        <label for="lname">Book Title:</label>
        <input type="text" id="book_title" name="book_title">
        <input type="submit" value="Search">
    </form>
            
    </div>
    
    <?php include "inc/scripts.php"; ?>
    

</body>

</html>

