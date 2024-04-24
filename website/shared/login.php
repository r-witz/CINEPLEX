<div class="login-container" id="login">
    <img src="/img/icons/cross.webp" class="cross">
    <div class="header">
        <h1>Login</h1>
        <h2>To CINEPLEX</h2>
    </div>
    <p class="error"></p>
    <form action="/actions/logging.php" method="post">
        <label for="email">Email :</label>
        <input type="email" class="email" name="email" required placeholder="Enter your email...">

        <label for="password">Password :</label>
        <input type="password" class="password" name="password" required placeholder="Enter your password...">

        <input type="submit" value="Login">
    </form>
    <p>Want to&nbsp;<strong id="register_text">register</strong>&nbsp;?</p>
    <?php
        if (isset($_SESSION['error_login'])) {
            echo "<script>document.getElementById('login').style.display = 'flex';</script>";
            echo "<script>document.querySelector('#login .error').textContent = '{$_SESSION['error_login']}';</script>";
            unset($_SESSION['error_login']);
        }
    ?>
</div>