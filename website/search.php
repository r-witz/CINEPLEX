<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINEPLEX</title>
    <link rel="stylesheet" href="styles/search.css">
</head>

<?php include_once 'shared/header.php'; ?>

<body>
    <div id="container">

        <div id="background">
            <img src="img/films/large/forrest_gump.webp">
        </div>

        <div id="content">

            <div id="title">
                <h1>FORREST GUMP</h1>
                <p>Drama | Romantism</p>
            </div>

            <div id="buttons">
                <button class="play-button">PLAY NOW</button>
                <button class="buy-button">ADD TO CART</button>
            </div>

            <div id="actors">
                <div class="actor-container">
                    <img src="img/directors_actor/tom_hanks.webp" alt="" class="actor">
                    <span class="actor-name">Tom Hanks</span>
                </div>
                <div class="actor-container">
                    <img src="img/directors_actor/robert_zemeckis.webp" alt="" class="actor">
                    <span class="actor-name">Robert Zemeckis</span>
                </div>
            </div>

            <div id="description">
                <p>
                    Forrest Gump, a simple-minded man with a big heart, recounts his extraordinary life and the key moments in American history through his encounters with famous people and his unlikely adventures.
                </p>
            </div>

            <div id="results">
                <img src="img/films/vertical/forrest_gump.webp" alt="" class="selected">
                <img src="img/films/vertical/forrest_gump.webp" alt="" class="not_selected">
                <img src="img/films/vertical/forrest_gump.webp" alt="" class="not_selected">
                <img src="img/films/vertical/forrest_gump.webp" alt="" class="not_selected">
                <img src="img/films/vertical/forrest_gump.webp" alt="" class="not_selected">
                <img src="img/films/vertical/forrest_gump.webp" alt="" class="not_selected">
                <img src="img/films/vertical/forrest_gump.webp" alt="" class="not_selected">
            </div>

        </div>
    </div>

    <script src="script/search.js"></script>
</body>

<?php include_once 'shared/footer.php'; ?>

</html>