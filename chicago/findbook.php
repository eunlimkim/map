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
    Map goes here

    <button type="button">search</button>
    </div>
    
    <?php include "inc/scripts.php"; ?>


</body>

</html>

<?php
 $url = 'http://localhost:7000/getbook?book_title=Obama';
 $data = array('kwy1' => 'value1', 'key2' => 'value2');

 $options = array(
     'http' => array(
         'header' => "Content-type : application/x-www.form-urlencoded\r\n",
         'method' => 'GET',
         'content' => http_build_query($data)
     )
     );

     $context = stream_context_create($options);
     $result = file_get_contents($url, false, $context);
     
     var_dump($result);
?>