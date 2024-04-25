<div id="message-container">
    <img src="/img/icons/cross.webp" id="cross-message">
    <p class="message">Film added to cart</p>
    <?php
        if (isset($_SESSION['message_cart'])) {
            echo "<script>document.querySelector('#message-container').style.display = 'grid';</script>";
            echo "<script>document.querySelector('.message').textContent = '{$_SESSION['message_cart']}';</script>";
            unset($_SESSION['message_cart']);
        }
    ?>
</div>