<div class="login-container" id="register">
    <img src="/img/icons/cross.webp" id="cross-register">
    <div class="header">
        <h1>Register</h1>
        <h2>To CINEPLEX</h2>
    </div>
    <p class="error"></p>
    <form action="/actions/registering.php" method="post">
        <label for="pseudo">Pseudo :</label>
        <input type="text" class="pseudo" name="pseudo" required placeholder="Enter your pseudo...">

        <label for="email">Email :</label>
        <input type="email" class="email" name="email" required placeholder="Enter your email...">

        <label for="password">Password :</label>
        <input type="password" class="password" name="password" required placeholder="Enter your password...">

        <input type="submit" value="Register">
    </form>
    <p>Want to&nbsp;<strong id="login_text">login</strong>&nbsp;?</p>
    <?php
        if (isset($_SESSION['error_register'])) {
            echo "<script>document.getElementById('register').style.display = 'flex';</script>";
            echo "<script>document.querySelector('#register .error').textContent = '{$_SESSION['error_register']}';</script>";
            unset($_SESSION['error_register']);
        }
    ?>
</div>