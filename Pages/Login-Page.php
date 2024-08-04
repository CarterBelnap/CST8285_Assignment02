<!-- 
	Name: Ahmed Al-Zaher
	File Name: Login-Page.html
	Date: 08-04-2024
	Purpose: HTML for the Login page of the website. -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/General-Styling.css" />
    <link rel="stylesheet" href="../CSS/Login.css" />
    <script defer src="../JS/Login.js"></script>
    <title>Login</title>
  </head>
  <body>
    <div id="x-pos">
      <a href="../index.php" id="return">X</a>
    </div>
    <form class="form" method="post" action="../PHP/Login/Login.php" id="login-page-form">
      <div id="form-border">
        <h1>Login</h1>
        <div id="input">
          <input type="text" name="username" id="username" placeholder="Username"/>
          <input type="password" name="password" id="password" placeholder="Password"/>
        </div>
        <?php
          if (isset($_GET['error'])) {
            echo "<div class='error'>" . htmlspecialchars($_GET['error']) . "</div>";
          }
        ?>
        <div id="buttons">
          <button type="submit" id="login-button">Login</button>
          <a href="./Register-Page.html">Register</a>
        </div>
      </div>
    </form>
  </body>
</html>
