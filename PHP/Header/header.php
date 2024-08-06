
<?php
include 'PHP\Config.php';
session_start();
?>
<!-- Check user login status and display the appropriate header -->
<?php if (isset($_SESSION['user_id'])): ?>
    
    <!-- Header for logged-in users -->
    <header class="header active" id="signed-in">
        <div class="navbar">
        <a href="./index.php"><img src="./Images/logoimg.jpg" alt="Joystick Logo" width="50px" height="50px"></a>
            <h1>JOYSTICK</h1>
            <span class="username">
                <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>
            </span>
            <a href="PHP/Login/Logout.php">Logout</a>
            <a href="Pages/Create_Idea_Page.html">Create Idea</a>
            <a href="Pages/Profile.php">My Ideas</a>
        </div>
    </header>
<?php else: ?>
   <!-- Header for non-logged-in users -->
    <header class="header active" id="signed-out">
        <div class="navbar">
        <a href="./index.php"><img src="./Images/logoimg.jpg" alt="Joystick Logo" width="50px" height="50px"></a>
            <h1>JOYSTICK</h1>
            <a class="links" href="./Pages/Register_Page.php">Register</a>
            <a class="links" href="./Pages/Login_Page.php">Login</a>   
        </div>
    </header>
<?php endif; ?> 