<?php
    if (!isset($_POST['search'])) {
        header("Location: /search.php?search=");
    } else {
        $querry = str_replace(' ', '+', $_POST['search']);
        header("Location: /search.php?search=$querry");
    }
    exit();
?>