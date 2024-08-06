<!-- 
	Name: Ahmed Al-Zaher
	File Name: Registration-Page.php
	Date: 08-04-2024
	Purpose: HTML for the Registration Page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/General_Styling.css">
    <link rel="stylesheet" href="../CSS/Registration.css">
    <script defer src="../JS/Registration.js"></script>
    <title>Registration</title>
</head>
<body>
    <div id="pos">
        <a href="../index.php" id="return">X</a>
    </div>
    <form class="form" method="post" action="../PHP/Sign_Up/Registration.php" id="registration_form">
        <div id="register_form">
            <h1>Register</h1>
            <div id="registration_input">
                <input type="text" name="email" id="email" placeholder="E-mail">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="password" name="password2" id="password2" placeholder="Confirm Password">
            </div>
            <?php
            if (isset($_GET['error'])) {
                echo "<div class='error'>" . htmlspecialchars($_GET['error']) . "</div>";
            }
            ?>
            <div id="register_buttons">
                <button type="submit" id="register_button">Register</button>
                <button type="reset" id="reset_button">Cancel</button>

            </div>
        </div>
    </form>
</body>
</html>