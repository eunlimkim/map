<?php
// Database Variables (edit with your own server information)
$server = '3.15.184.16';
$user = 'abong';
$pass = 'abong1234';
$db = 'myBlog';
$port = '3306';


// Connect to Database
$connection = mysqli_connect($server,$user,$pass,$db, $port);
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>