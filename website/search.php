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
    <?php
        $query;
        if (isset($_GET['search'])) {
            $query = "?search=" . $_GET['search'];
            $query = str_replace(' ', '+', $query);
        } else {
            $query = '';
        }
        $url = 'http://php-api/film' . $query;
            
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['message'])) {
            echo "<div id=result-container>";
            echo "<div>";
            echo "<h1>No movie found</h1>";
            echo "<p>Sorry, we couldn't find any movies matching your search criteria.</p>";
            echo "</div>";
            echo "</div>";
        } else {
            $titles = [];
            $plots = [];
            $images = [];
            $peoples = [];
            $categories = [];
            $prices = [];

            foreach ($result as $film) {
                array_push($titles, $film['title']);
                array_push($plots, $film['plot']);
                array_push($images, $film['image_name']);
                
                $cast_name = [$film['director_name']];
                foreach (explode(',', $film['actor_names']) as $actor) {
                    array_push($cast_name, $actor);
                }

                $cast = [];
                foreach ($cast_name as $person) {
                    $url = 'http://php-api/people?search=' . str_replace(' ', '+', $person);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $people = json_decode($response, true);
                    $people = $people[0];

                    $cast_temp = [];
                    $cast_temp['name'] = $people['name'];
                    $cast_temp['image_name'] = $people['image_name'];
                    array_push($cast, $cast_temp);
                }

                array_push($peoples, $cast);
                array_push($categories, str_replace(',', ' | ', $film['categories']));
                array_push($prices, $film['price']);
            }
            
            echo "<div id='container'>";
            for ($i = 0; $i < count($titles); $i++) {
                echo "<div class='film-container'>";
                echo "<img src='/img/films/large/" . $images[$i] . ".webp'>";
                echo "<div class='content'>";
                echo "<h1>" . $titles[$i] . "</h1>";
                echo "<p>" . $categories[$i] . "</p>";
                echo "<div class='button'>";
                echo "<button class='buy-button' data-tooltip='$" . $prices[$i] . "'>ADD TO CART</button>";
                echo "</div>";
                echo "<div class='cast'>";
                foreach ($peoples[$i] as $person) {
                    echo "<div class='actor-container' data-tooltip='". $person['name'] ."'>";
                    echo "<img src='/img/directors_actor/" . $person['image_name'] . ".webp' alt='' class='actor'>";
                    echo "</div>";
                }
                echo "</div>";
                echo "<p>" . $plots[$i] . "</p>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            
            echo "<div id='film-carousel'>";
            for ($i = 0; $i < count($titles); $i++) {
                echo "<img src='/img/films/vertical/" . $images[$i] . ".webp'>";   
            }
            echo "</div>";
        }
    ?>
    <script src="/script/search.js"></script>
</body>
<?php include_once 'shared/footer.php'; ?>
</html>