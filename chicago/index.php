<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css"href="css/slideshow.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/ui_common.js"></script>
</head>

<body class="sub image-slide step5 container">

<?php include "inc/nav.php"; ?>

<header>
    <h1>Eunlim Kim</h1>
    <p>A student of University
        of Rochester majoring in Computer Science. </p>
    <p>Take a look at my photo!</p>
</header>
        <div id="wrapper">
        
            <main id="main">
                <div class="image-slide">
                    <div class="box">
                        <ul class="slide" style="transition: left 0.3s ease 0s; left: -200%;">
                            <li style="left: 0%; display: block;"><a href="#"><img class = "image_size" alt="1" src="images/me.JPG"></a></li>
                            <li style="left: 100%; display: block;"><a href="#"><img class = "image_size" alt="2" src="images/me3.JPG"></a></li>
                            <li style="left: 200%; display: block;"><a href="#"><img class = "image_size" alt="3" src="images/me1.jpg"></a></li>
                            <li style="left: 300%; display: block;"><a href="#"><img class = "image_size" alt="4" src="images/paris1.JPG"></a></li>
                            <li style="left: 400%; display: block;"><a href="#"><img class = "image_size" alt="5" src="images/paris2.jpg"></a></li>
                            <li style="left: 500%; display: block;"><a href="#"><img class = "image_size" alt="6" src="images/abong.jpg"></a></li>
                            <li style="left: 600%; display: block;"><a href="#"><img class = "image_size" alt="7" src="images/rochester1.jpg"></a></li>
                            <li style="left: 700%; display: block;"><a href="#"><img class = "image_size" alt="8" src="images/rochester2.jpg"></a></li>
                        </ul>
                        <ul class="indicator">
<!--                             
                        <li class="on"><a href="#">1번 슬라이드</a></li>
                        <li class=""><a href="#">2번 슬라이드</a></li>
                        <li class=""><a href="#">3번 슬라이드</a></li>
                        <li class=""><a href="#">4번 슬라이드</a></li>
                        <li class=""><a href="#">5번 슬라이드</a></li>
                        <li class=""><a href="#">6번 슬라이드</a></li>
                        <li class=""><a href="#">7번 슬라이드</a></li>
                        <li class=""><a href="#">8번 슬라이드</a></li> -->

                        </ul>
                    </div>
                 
                </div>
                
            </main>
        </div> <!-- #wrapper  -->
        
<script>
'use strict';

var numSlide = $('div.image-slide ul.slide li').length;
var slideNow = 0;
var slidePrev = 0;
var slideNext = 0;
var slideFirst = 3;
var timerId = null;
var isTimerOn = true;
var timerSpeed = 3000;

// 초기화
$('div.image-slide ul.slide li').each(function(i) {
    $(this).css({'left': (i * 100) + '%', 'display': 'block'});
    $('div.image-slide ul.indicator').append('<li><a href="#">' + (i + 1) + '번 슬라이드</a></li>\n');
});
if (isTimerOn === true) {
    $('div.image-slide p.control a.play').addClass('on');
} else {
    $('div.image-slide p.control a.play').removeClass('on');
}
showSlide(slideFirst);
    
$('div.image-slide ul.indicator li a').on('click', function() {
    var index = $('div.image-slide ul.indicator li').index($(this).parent());
    showSlide(index + 1);
});
$('div.image-slide p.control a.prev').on('click', function() {
    $(this).find('img').stop(true).animate({'left': '-10px'}, 50).animate({'left': 0}, 100);
    showSlide(slidePrev);
});
$('div.image-slide p.control a.next').on('click', function() {
    $(this).find('img').stop(true).animate({'right': '-10px'}, 50).animate({'right': 0}, 100);
    showSlide(slideNext);
});
$('div.image-slide p.control a.play').on('click', function() {
    if (isTimerOn === true) {
        clearTimeout(timerId);
        $(this).removeClass('on');
        isTimerOn = false;
    } else {
        timerId = setTimeout(function() {showSlide(slideNext);}, timerSpeed);
        $(this).addClass('on');
        isTimerOn = true;
    }
});
    
function showSlide(n) {
    clearTimeout(timerId);
    if (slideNow === 0) {
        $('div.image-slide ul.slide').css({'transition': 'none', 'left': -((n - 1) * 100) + '%'});
    } else {
        $('div.image-slide ul.slide').css({'transition': 'left 0.3s', 'left': -((n - 1) * 100) + '%'});
    }
    $('div.image-slide ul.indicator li').removeClass('on');
    $('div.image-slide ul.indicator li:eq(' + (n - 1) + ')').addClass('on');
    slideNow = n;
    slidePrev = (n - 1) < 1 ? numSlide : n - 1;
    slideNext = (n + 1) > numSlide ? 1 : n + 1;
    //console.log(slidePrev + ' / ' + slideNow + ' / ' + slideNext);
    if (isTimerOn === true) {
        timerId = setTimeout(function() {showSlide(slideNext);}, timerSpeed);
    }
}
</script>
    



</body>

</html>

