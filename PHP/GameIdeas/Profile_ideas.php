<!-- 
    Name: Ahmed Al-Zaher
    File Name: Profile-ideas.php
    Date: 08-04-2024
    Purpose: PHP to list the ideas made by a specific user in their profile 
-->
<?php
include '../PHP/config.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Pages/Login_Page.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch all game ideas created by the signed-in user from the database
$query = "SELECT id, title, cover_image_url FROM GameIdeas WHERE user_id = $userId";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='ideas'>";
        echo "<img src='" . htmlspecialchars($row['cover_image_url']) . "' alt='XImage could not be loaded.' '>";
        echo "<h3 class='idea_title'>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<form method='GET' action='./Edit_Idea_Page.php'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<button type='submit' class='view'>View / Edit</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p>You don't have any ideas yet.</p>";
}

mysqli_close($connection);
?>