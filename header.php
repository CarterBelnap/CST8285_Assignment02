
<?php
include 'PHP/config.php';
session_start();
?>
<!-- Check user login status and display the appropriate header -->
<?php if (isset($_SESSION['user_id'])): ?>
    <!-- Header for logged-in users -->
    <header class="header active" id="signed-in">
        <div class="navbar">
            <button><img src="./logoimg.jpg" onClick="window.location.href='./index.php';" alt="Joystick Logo" width="50px" height="50px"></button>
            <h1>JOYSTICK</h1>
            <a href="./Pages/Create-Idea-Page.html">Create Idea</a>
            <a href="./Pages/My-Ideas-Page.html">My Ideas</a>
        </div>
    </header>
<?php else: ?>
   <!-- Header for non-logged-in users -->
    <header class="header active" id="signed-out">
        <div class="navbar">
            <button><img src="./logoimg.jpg" onClick="window.location.reload();" alt="Joystick Logo" width="50px" height="50px"></button>
            <h1>JOYSTICK</h1>
            <a class="links" href="./Pages/Register-Page.php">Register</a>
            <a class="links" href="./Pages/Login-Page.php">Login</a>   
        </div>
    </header>
<?php endif; ?> 