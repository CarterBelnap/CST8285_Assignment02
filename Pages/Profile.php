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
    <?php include '../PHP/Header/header.php'; ?>
    <div class="idea_list">
        <h2>My Game Ideas</h2>
        <?php include "../PHP/GameIdeas/Profile_ideas.php" ?>
    </div>
</body>
</html>