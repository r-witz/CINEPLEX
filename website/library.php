<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINEPLEX</title>
    <link rel="stylesheet" href="styles/search.css">
</head>
<body>
    <?php include_once 'shared/header.php'; ?>
    <?php
        if (!isset($_SESSION['account'])) {
            echo "<div id=result-container>";
            echo "<div>";
            echo "<h1>You are not Connected</h1>";
            echo "<p>Please Login or Register to view your library.</p>";
            echo "</div>";
            echo "</div>";
        } else {
            $userEmail = $_SESSION['account'];

            $ch = curl_init('http://php-api/library');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["user_email" => $userEmail]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($response, true);

            if (isset($response['message'])) {
                if ($response['message'] === 'Library is empty') {
                    echo "<div id=result-container>";
                    echo "<div>";
                    echo "<h1>Your CINEPLEX Library is empty</h1>";
                    echo "<p>Start building your library today! Browse and discover your next film.</p>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div id=result-container>";
                    echo "<div>";
                    echo "<h1>Unknown Error</h1>";
                    echo "<p>Sorry, contact the support for more informations.</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                $ids = [];
                $titles = [];
                $plots = [];
                $images = [];
                $peoples = [];
                $categories = [];
                $prices = [];

                foreach ($response as $film) {
                    array_push($ids, $film['id']);
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
                    echo "<button class='play-button'>PLAY NOW</button>";
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
        }
    ?>
    <script src="/script/search.js"></script>
</body>
<?php include_once 'shared/footer.php'; ?>
</html>