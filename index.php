<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\General-Styling.css">
    <title>Home Page</title>
</head>
<body>
    <!-- Header for non-logged-in users -->
    <header class="header" id="signed-out active" >
        <div class="navbar">
            <button><img src="./logoimg.jpg" href="./index.php" alt="GameDrive Logo" width="50px" height="50px"></button>
            <h1>GameDrive</h1>
            <a class="links" href="./Pages/Register-Page.html">Register</a>
            <a class="links" href="./Pages/Login-Page.html">Login</a>    
        </div>
    </header>
    <!-- Header for logged-in users -->
    <header class="header" id="signed-in">
        <div class="navbar">
            <button><img src="./logoimg.jpg" href="./index.php" alt="GameDrive Logo" width="50px" height="50px"></button>
            <h1>GameDrive</h1>
            <a href="./Pages/Create-Idea-Page.html">Create Idea</a>
            <a href="./Pages/Create-Idea-Page.html">My Ideas</a>
        </div>
    </header>
</body>
</html>