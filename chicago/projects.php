<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
</head>

<body class="container">

    <?php include "inc/nav.php"; ?>
    <header>
            <h1>Projects</h1>

        <div class="awards">
            <div id="accordion">
                <h3>Find books near you</h3><div class="pannel">
                <ul>
                <a href="findbook.php" target="_self">
                Find books near you - click!
                </a>
                </ul></div>
                <h3>Find Hospitals near you</h3><div class="pannel">
                <ul>
                    <a href="hospitals.php" target="_self">
                    Find Hospitals near you - click!
                    </a>
                </ul></div>
                <h3>Animatoins</h3><div class="pannel">
                <ul>
                <a href="animations.php" target="_self">
                Animations - click!
                </a>
                </ul></div>
            </div>
        </div>   
    </header>

    <?php include "inc/scripts.php"; ?>

<script>
$( function() {
 $( "#accordion" ).accordion({
   collapsible: true
 });
} );
</script>

</body>

</html>