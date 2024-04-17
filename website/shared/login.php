<link rel="stylesheet" href="../styles/log_reg.css">

<body>
    <div class="container">
        <div class="header">
            <h1>Login</h1>
            <img src="../img/icons/cross.webp" alt="">
        </div>
        <h2>TO CINEPLEX</h2>
        <form action="/submit_registration" method="post">
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required>

            <label for="password">Password :</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
            <p>Want to&nbsp;<a href="register.php" id="register_text">register ? </a></p>
        </form>
    </div>
</body>