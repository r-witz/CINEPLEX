<link rel="stylesheet" href="../styles/log_reg.css">

<body>
    <div class="container">
        <div class="header">
            <h1>Register</h1>
            <img src="../img/icons/cross.webp" alt="">
        </div>
        <h2>TO CINEPLEX</h2>
        <form action="../actions/registering.php" method="post">
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required placeholder="Enter your pseudo">

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">

            <label for="password">Password :</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password">

            <input type="submit" value="Register">
            <p>Want to&nbsp;<a href="login.php" id="register_text">login ? </a></p>
        </form>
    </div>
</body>