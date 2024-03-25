<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - UrbanVogue Colective</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

<header>
<a href="index.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family: Garamond, serif; color: white;">&nbsp;&nbsp;UrbanVogue Collective</h1>
    </a>
    <nav>
    <li><a href="MainPage.php">&nbsp;&nbsp;&nbsp;&nbsp;Home</a></li>
            <li>

            <li><a href="index.php">Product&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <li>

                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<a href="profile.php">' . $_SESSION['username'] . '</a>';
                } else {
                    echo '<a href="register_login.php">Account</a>';
                }
                ?>
            </li>
            <li>
            <li><a href="previous.php">&nbsp;&nbsp;&nbsp;&nbsp;Previous</a></li>
            <li>
            <li>
                <a href="cart.php">
                    <img src="images/shopping-cart.jpg" width="30" height="30"/>
                    <span class="cart-icon"></span>
                </a>
            </li>
    </nav>
</header>

<div style="text-align: center; margin:0;"class="banner-ad">
    <img src="images/banner5.jpg" alt="Special Offer!">
</div>

<main>
    <div class="auth-container">
        <div class="tabs">
            <button class="tab-btn active" onclick="showTab('register')">Register</button>
            <button class="tab-btn" onclick="showTab('login')">Login</button>
        </div>

        <!-- Registration Form -->
        <div id="register" class="tab-content">
            <form action="register_process.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <textarea name="address" placeholder="Address" required></textarea>
                <input type="submit" value="Register">
            </form>
        </div>

        <!-- Login Form -->
        <div id="login" class="tab-content" style="display: none;">
            <form action="login_process.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</main>

<script>
    function showTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.style.display = 'none';
        });

        document.getElementById(tabName).style.display = 'block';

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        document.querySelector(`.tab-btn[onclick="showTab('${tabName}')"]`).classList.add('active');
    }
</script>

<footer>
    This business is fictitious and part of a university course.
</footer>

</body>
</html>
