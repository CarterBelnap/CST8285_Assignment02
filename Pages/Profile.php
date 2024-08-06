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
    <link rel="stylesheet" href="../CSS/General_Styling.css" />
    <link rel="stylesheet" href="../CSS/Idea_List.css">
    <title>Profile</title>
</head>
<body>

    <header class="header active" id="signed-in">
            <div class="navbar">
            <a href="../index.php"><img src="..\Images\logoimg.jpg" alt="Joystick Logo" width="50px" height="50px"></a>
                <h1>JOYSTICK</h1>
                <span class="username">
                <?php
                    // Check if a session is not already started
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start(); // Start the session
                    }
                    if (isset($_SESSION['username'])) {
                        echo htmlspecialchars($_SESSION['username']); // Echo the username
                    }
                ?>
                </span>
                <a href="../PHP/Login/Logout.php">Logout</a>
                <a href="./Create_Idea_Page.html">Create Idea</a>
            </div>
        </header>
    <div class="idea_list">
        <h2>My Game Ideas</h2>
        <?php require "../PHP/GameIdeas/Profile_ideas.php" ?>
    </div>
</body>
</html>
