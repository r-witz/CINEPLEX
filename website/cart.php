<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINEPLEX</title>
    <link rel="stylesheet" href="styles/cart.css">
</head>
<?php include_once 'shared/header.php'; ?>
<body>
    <?php
        if (!isset($_SESSION['account'])) {
            echo "<div id=result-container>";
            echo "<div>";
            echo "<h1>You are not Connected</h1>";
            echo "<p>Please&nbsp;<strong class='link' id='login-link'>Login</strong>&nbsp;or&nbsp;<strong class='link' id='register-link'>Register</strong>&nbsp;to add items to your cart.</p>";
            echo "</div>";
            echo "</div>";
        } else {
            $userEmail = $_SESSION['account'];

            $ch = curl_init('http://php-api/cart');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["user_email" => $userEmail]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            $response = json_decode($response, true);

            if (isset($response['message'])) {
                if ($response['message'] === 'Cart is empty') {
                    echo "<div id=result-container>";
                    echo "<div>";
                    echo "<h1>Your CINEPLEX Cart is empty</h1>";
                    echo "<p>Start adding new films to your cart ! You should see them appear here.</p>";
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
                $images = [];
                $directors = [];
                $categories = [];
                $prices = [];

                foreach ($response as $film) {
                    array_push($ids, $film['id']);
                    array_push($titles, $film['title']);
                    array_push($images, $film['image_name']);
                    array_push($directors, $film['director_name']);
                    array_push($categories, str_replace(',', ', ', $film['categories']));
                    array_push($prices, $film['price']);
                }

                $total = array_sum($prices);

                echo "<div class='cart'>";
                echo "<div class='cart-container'>";
                echo "<div class='left'>";
                echo "<div class='cart-items'>";
                for ($i = 0; $i < count($ids); $i++) {
                    echo "<div class='cart-item'>";
                    echo "<img src='/img/films/large/" . $images[$i] . ".webp' alt=''>";
                    echo "<div class='info'>";
                    echo "<div class='left-infos'>";
                    echo "<h1 class='title'>" . $titles[$i] . "</h1>";
                    echo "<div class='list-infos'>";
                    echo "<p class='category'>Category: " . $categories[$i] . "</p>";
                    echo "<p class='director'>Director: ". $directors[$i] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='right-infos'>";
                    echo "<p class='price'>$" . $prices[$i] . "</p>";
                    echo "<form action='/actions/remove.php' method='post'>";
                    echo "<input type='hidden' name='film-id' value='" . $ids[$i] . "'>";
                    echo "<button type='submit' class='remove-button'>";
                    echo "<img src='/img/icons/trash.webp' class='trash'>";
                    echo "</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
                echo "<div class='total'>";
                echo "<p>Total: $" . $total . "</p>";
                echo "</div>";
                echo "</div>";
                echo "<div class='right'>";
                echo "<div class='card'>";
                echo "<div class='flip-card'>";
                echo "<div class='flip-card-inner'>";
                echo "<div class='flip-card-front'>";
                echo "<p class='heading_8264'>MASTERCARD</p>";
                echo "<svg class='logo' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='36' height='36' viewBox='0 0 48 48'>";
                echo "<path fill='#ff9800' d='M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z'></path><path fill='#d50000' d='M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z'></path><path fill='#ff3d00' d='M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z'></path>";
                echo "</svg>";
                echo "<svg version='1.1' class='chip' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='30px' height='30px' viewBox='0 0 50 50' xml:space='preserve'>";
                echo "<image id='image0' width='50' height='50' x='0' y='0' ref='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB6VBMVEUAAACNcTiVeUKVeUOYfEaafEeUeUSYfEWZfEaykleyklaXe0SWekSZZjOYfEWYe0WXfUWXe0WcgEicfkiXe0SVekSXekSWekKYe0a9nF67m12ZfUWUeEaXfESVekOdgEmVeUWWekSniU+VeUKVeUOrjFKYfEWliE6WeESZe0GSe0WYfES7ml2Xe0WXeESUeEOWfEWcf0eWfESXe0SXfEWYekSVeUKXfEWxklawkVaZfEWWekOUekOWekSYfESZe0eXekWYfEWZe0WZe0eVeUSWeETAnmDCoWLJpmbxy4P1zoXwyoLIpWbjvXjivnjgu3bfu3beunWvkFWxkle/nmDivXiWekTnwXvkwHrCoWOuj1SXe0TEo2TDo2PlwHratnKZfEbQrWvPrWuafUfbt3PJp2agg0v0zYX0zYSfgkvKp2frxX7mwHrlv3rsxn/yzIPgvHfduXWXe0XuyIDzzISsjVO1lVm0lFitjVPzzIPqxX7duna0lVncuHTLqGjvyIHeuXXxyYGZfUayk1iyk1e2lln1zYTEomO2llrbtnOafkjFpGSbfkfZtXLhvHfkv3nqxH3mwXujhU3KqWizlFilh06khk2fgkqsjlPHpWXJp2erjVOhg0yWe0SliE+XekShhEvAn2D///+gx8TWAAAARnRSTlMACVCTtsRl7Pv7+vxkBab7pZv5+ZlL/UnU/f3SJCVe+Fx39naA9/75XSMh0/3SSkia+pil/KRj7Pr662JPkrbP7OLQ0JFOijI1MwAAAAFiS0dEorDd34wAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IDx2lsiuJAAACLElEQVRIx2NgGAXkAUYmZhZWPICFmYkRVQcbOwenmzse4MbFzc6DpIGXj8PD04sA8PbhF+CFaxEU8iWkAQT8hEVgOkTF/InR4eUVICYO1SIhCRMLDAoKDvFDVhUaEhwUFAjjSUlDdMiEhcOEItzdI6OiYxA6YqODIt3dI2DcuDBZsBY5eVTr4xMSYcyk5BRUOXkFsBZFJTQnp6alQxgZmVloUkrKYC0qqmji2WE5EEZuWB6alKoKdi35YQUQRkFYPpFaCouKIYzi6EDitJSUlsGY5RWVRGjJLyxNy4ZxqtIqqvOxaVELQwZFZdkIJVU1RSiSalAt6rUwUBdWG1CP6pT6gNqwOrgCdQyHNYR5YQFhDXj8MiK1IAeyN6aORiyBjByVTc0FqBoKWpqwRCVSgilOaY2OaUPw29qjOzqLvTAchpos47u6EZyYnngUSRwpuTe6D+6qaFQdOPNLRzOM1dzhRZyW+CZouHk3dWLXglFcFIflQhj9YWjJGlZcaKAVSvjyPrRQ0oQVKDAQHlYFYUwIm4gqExGmBSkutaVQJeomwViTJqPK6OhCy2Q9sQBk8cY0DxjTJw0lAQWK6cOKfgNhpKK7ZMpUeF3jPa28BCETamiEqJKM+X1gxvWXpoUjVIVPnwErw71nmpgiqiQGBjNzbgs3j1nus+fMndc+Cwm0T52/oNR9lsdCS24ra7Tq1cbWjpXV3sHRCb1idXZ0sGdltXNxRateRwHRAACYHutzk/2I5QAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMy0wMi0xM1QwODoxNToyOSswMDowMEUnN7UAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjMtMDItMTNUMDg6MTU6MjkrMDA6MDA0eo8JAAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIzLTAyLTEzVDA4OjE1OjI5KzAwOjAwY2+u1gAAAABJRU5ErkJggg=='></image>";
                echo "</svg>";
                echo "<svg version='1.1' class='contactless' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='20px' height='20px' viewBox='0 0 50 50' xml:space='preserve'>";
                echo "<image id='image0' width='50' height='50' x='0' y='0' href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAQAAAC0NkA6AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IEzgIwaKTAAADDklEQVRYw+1XS0iUURQ+f5qPyjQflGRFEEFK76koKGxRbWyVVLSOgsCgwjZBJJYuKogSIoOonUK4q3U0WVBWFPZYiIE6kuArG3VGzK/FfPeMM/MLt99/NuHdfPd888/57jn3nvsQWWj/VcMlvMMd5KRTogqx9iCdIjUUmcGR9ImUYowyP3xNGQJoRLVaZ2DaZf8kyjEJALhI28ELioyiwC+Rc3QZwRYyO/DH51hQgWm6DMIh10KmD4u9O16K49itVoPOAmcGAWWOepXIRScAoJZ2Frro8oN+EyTT6lWkkg6msZfMSR35QTJmjU0g15tIGSJ08ZZMJkJkHpNZgSkyXosS13TkJpZ62mPIJvOSzC1bp8vRhhCakEk7G9/o4gmZdbpsTcKu0m63FbnBP9Qrc15zbkbemfgNDtEOI8NO5L5O9VYyRYgmJayZ9nPaxZrSjW4+F6Uw9yQqIiIZwhp2huQTf6OIvCZyGM6gDJBZbyXifJXr7FZjGXsdxADxI7HUJFB6iWvsIhFpkoiIiGTJfjJfiCuJg2ZEspq9EHGVpYgzKqwJqSAOEwuJQ/pxPvE3cYltJCLdxBLiSKKIE5HxJKcTRNeadxfhDiuYw44zVs1dxKwRk/uCxIiQkxKBsSctRVAge9g1E15EHE6yRUaJecRxcWlukdRIbGFOSZCMWQA/iWauIP3slREHXPyliqBcrrD71AmzZ+rD1Mt2Yr8TZc/UR4/YtFnbijnHi3UrN9vKQ9rPaJf867ZiaqDB+czeKYmd3pNa6fuI75MiC0uXXSR5aEMf7s7a6r/PudVXkjFb/SsrCRfROk0Fx6+H1i9kkTGn/E1vEmt1m089fh+RKdQ5O+xNJPUicUIjO0Dm7HwvErEr0YxeibL1StSh37STafE4I7zcBdRq1DiOkdmlTJVnkQTBTS7X1FYyvfO4piaInKbDCDaT2anLudYXCRFsQBgAcIF2/Okwgvz5+Z4tsw118dzruvIvjhTB+HOuWy8UvovEH6beitBKxDyxm9MmISKCWrzB7bSlaqGlsf0FC0gMjzTg6GgAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjMtMDItMTNUMDg6MTk6NTYrMDA6MDCjlq7LAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDIzLTAyLTEzVDA4OjE5OjU2KzAwOjAw0ssWdwAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyMy0wMi0xM1QwODoxOTo1NiswMDowMIXeN6gAAAAASUVORK5CYII='></image>";
                echo "</svg>";
                echo "<p class='number'></p>";
                echo "<p class='valid_thru'>VALID THRU</p>";
                echo "<p class='date_8264'></p>";
                echo "<p class='name'></p>";
                echo "</div>";
                echo "<div class='flip-card-back'>";
                echo "<div class='strip'></div>";
                echo "<div class='mstrip'></div>";
                echo "<div class='sstrip'>";
                echo "<p class='code'></p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "<form action='/actions/buy.php' method='post'>";
                echo "<div>";
                echo "<label for='card-number'>Card Number</label>";
                echo "<input type='text' id='card-number' name='card-number' required maxlength='19' placeholder='Enter the card number...'>";
                echo "</div>";
                echo "<div>";
                echo "<label for='name'>Name</label>";
                echo "<input type='text' id='name' name='name' required placeholder='Enter the name...'>";
                echo "</div>";
                echo "<div id='double-input'>";
                echo "<div id='exp'>";
                echo "<label for='expiration-date'>Expiration Date</label>";
                echo "<input type='text' id='expiration-date' name='expiration-date' required maxlength='5' placeholder='Enter the date...'>";
                echo "</div>";
                echo "<div id='cvc'>";
                echo "<label for='cvc'>CVC</label>";
                echo "<input type='password' id='cvc-nb' name='cvc' required maxlength='3' placeholder='Enter the CVC...'>";
                echo "</div>";
                echo "</div>";
                echo "<button type='submit' id='pay-button'>";
                echo "Pay";
                echo "<svg class='svgIcon' viewBox='0 0 576 512'><path d='M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z'></path></svg>";
                echo "</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
    ?>
    <script src="/script/cart.js"></script>
    <script src="/script/link.js"></script>
</body>
<?php include_once 'shared/footer.php'; ?>
</html>