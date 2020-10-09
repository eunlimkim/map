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
    <?php 

        $zipcode = $_GET['zipcode'];
        $book_title = $_GET['book_title'];

        $url = 'http://localhost:7000/getbook';
        $data = array('book_title' => $book_title, 'zipcode' => $zipcode);

        $options = array(
                'http' => array(
                    'header' => "Content-type : application/x-www.form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
                );

        $context = stream_context_create($options);
        $result = file_get_contents($url,false,$context);
            
        var_dump($result);
?>
            
    </div>
 

    <?php include "inc/scripts.php"; ?>
    

</body>

</html>
