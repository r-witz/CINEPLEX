<link rel="stylesheet" href="/styles/header.css">
<link rel="stylesheet" href="/styles/log_reg.css">
<link rel="stylesheet" href="/styles/message.css">

<?php include_once 'shared/login.php' ?>
<?php include_once 'shared/register.php' ?>
<?php include_once 'shared/message.php' ?>

<header>
    <div class="navbar">
        <div class="left">        
            <a href="/index.php"><img src="/img/icons/accueil.webp" class="imgheader" alt=""></a>
            <div class="dropdown-container">
                <p class="headerp">CATEGORIES</p>
                <img src="/img/icons/plain_arrow.webp" id="plainarrow" class="imgheader" alt="">
                <div class="dropdown-menu grid">
                <a href="/search.php?search=Drama"><span>Drama</span></a>
                <a href="/search.php?search=Action"><span>Action</span></a>
                <a href="/search.php?search=Crime"><span>Crime</span></a>
                <a href="/search.php?search=Sci-Fi"><span>Sci-Fi</span></a>
                <a href="/search.php?search=Romance"><span>Romance</span></a>
                <a href="/search.php?search=Thriller"><span>Thriller</span></a>
                </div>
                </div>
            </div>

        <div class="right">
            <input class="checkbox" type="checkbox">
            <div class="search">
                <form action="/actions/search.php" method="post">
                    <input class="search_input" name="search" type="text">
                    <img id="searchIcon" src="/img/icons/loupe.webp" class="imgheader" alt="">
                </form>
            </div>
            <a href="#"><img src="/img/icons/library.webp" class="imgheader" alt=""></a>

            <?php if (isset($_SESSION['account'])): ?>
                <a href="actions/disconnecting.php"><img src="/img/icons/logout.webp" class="imgheader" alt=""></a>
            <?php else: ?>
                <img src="/img/icons/utilisateur.webp" class="imgheader" id="login-button" alt="">
            <?php endif ?>

            <a href="#"><img src="/img/icons/chariot-intelligent.webp" class="imgheader" alt=""></a>
        </div>
    </div>
    <script src="/script/header.js"></script>
    <script src="/script/login.js"></script>
</header>