<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINEPLEX</title>
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="icon" type="image/x-icon" href="/img/icons/popcorn-icon.png">
</head>
<body>
    <?php include_once 'shared/header.php' ?>
    <div id="mainview">
        <h1>CINEPLEX</h1>
        <img src="img/3d/camera.webp" alt="Camera" class="camera">
        <img src="img/3d/glasses.webp" alt="Glasses" class="glasses">
        <img src="img/3d/spectator_chair.webp" alt="Spectator Chair" class="chair">
        <img src="img/3d/clap.webp" alt="Clap" class="clap">
        <img src="img/3d/popcorn_cup.webp" alt="Popcorn Cup" class="popcorn_cup">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_1">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_2">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_3">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_4">
        <img src="img/icons/arrow.webp" alt="Arrow" class="down_arrow" id="scroll-down-arrow1">
    </div>
    <div id="presentation">
        <h2>Welcome to cineplex</h2>
        <p>Discover a <strong>world of movies</strong> effortlessly with our <strong>user-friendly</strong> platform. Explore <strong>trailers</strong>, <strong>synopses</strong>, and more, browse by title or director, and  dive into curated genres like action and drama. Delve deeper into each <strong>film's details</strong> and enjoy a seamless <strong>shopping</strong> experience with our responsive, <strong>secure</strong> website. Join our <strong>community</strong> today and redefine the  way you <strong>experience cinema</strong>. Welcome to <strong>CINEPLEX</strong> - where every click brings you closer to cinematic brilliance.</p>
        <img src="img/3d/ticket.webp" alt="Ticket" class="ticket">
        <img src="img/3d/camera.webp" alt="Camera" class="camera">
        <img src="img/3d/glasses.webp" alt="Glasses" class="glasses">
        <img src="img/3d/clap.webp" alt="Clap" class="clap">
        <img src="img/3d/director_chair.webp" alt="Director Chair" class="chair">
        <img src="img/3d/launch.webp" alt="Launch Screen" class="launch">
        <img src="img/3d/popcorn_cup.webp" alt="Popcorn Cup" class="popcorn_cup">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_1">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_2">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_3">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_4">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_5">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_6">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_7">
        <img src="img/3d/popcorn.webp" alt="Popcorn" class="pop_8">
        <img src="img/icons/arrow.webp" alt="Arrow" class="down_arrow" id="scroll-down-arrow2">
    </div>
    <div id="fade"></div>
    <div id="cinema_room">
        <div id="screen">
            <div class="carousel-content">
                <img src="img/films/homepage_image/vintage_movie_effect.webp" alt="Vintage Movie Screen Effect" id="layer-effect">
                <img src="img/films/homepage_image/forrest_gump.webp" alt="Forrest Gump" class="carousel-item">
                <img src="img/films/homepage_image/the_godfather.webp" alt="The Godfather" class="carousel-item">
                <img src="img/films/homepage_image/fight_club.webp" alt="Fight Club" class="carousel-item">
                <img src="img/films/homepage_image/inception.webp" alt="Inception" class="carousel-item">
            </div>
            <div class="selection-container">
                    <div class="selection-circle selected"></div>
                    <div class="selection-circle"></div>
                    <div class="selection-circle"></div>
                    <div class="selection-circle"></div>
            </div>
            <div class="buy-button-container">
                <a id="buy-button-redirect" href="search.php?search=forrest">
                <button class="buy-button">Buy Now</button>
                </a>
            </div>
        </div>
        <img src="img/3d/cinema-seats.webp" alt="Cinema Seats Rows" id=seat-rows>
    </div>

    <script src="script/carousel.js"></script>
    <script src="script/homepage.js"></script>
</body>

<?php include_once 'shared/footer.php'; ?>


</html>