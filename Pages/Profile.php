<!-- 
	Name: Ahmed Al-Zaher
	File Name: Profile.html
	Date: 08-04-2024
	Purpose: HTML for the Profile page of the website. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/General-Styling.css" />
    <link rel="stylesheet" href="../CSS/Idea-List.css">
    <title>Profile</title>
</head>
<body>
    <header class="header" id="signed-in">
        <div class="navbar">
            <button><img src="../logoimg.jpg" href="../index.php" alt="Joystick Logo" width="50px" height="50px"></button>
            <h1>JOYSTICK</h1>
            <a href="./Pages/Create-Idea-Page.html">Create Idea</a>
            <a href="./Pages/Create-Idea-Page.html">My Ideas</a>
        </div>
    </header>
    <div class="idea-list">
        <h2>My Game Ideas</h2>
        <?php include "../PHP/GameIdeas/Profile-ideas.php" ?>
    </div>
</body>
</html>