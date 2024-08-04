<!-- 
	Name: Ahmed Al-Zaher
	File Name: Profile-ideas.php
	Date: 08-04-2024
	Purpose: PHP to list the ideas made by a specific user in their profile -->
<?php
include '../PHP/config.php'; 
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Pages/Login-Page.html");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch all game ideas created by the signed-in user from the database
$query = "SELECT id, title, cover_image_url FROM GameIdeas WHERE user_id = $userId";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='ideas'>";
        echo "<img src='" . htmlspecialchars($row['cover_image_url']) . "' alt='" . htmlspecialchars($row['title']) . "'";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p><a href='view_idea.php?id=" . $row['id'] . "'>View Details</a></p>";
        echo "</div>";
    }
} else {
    echo "<p>No game ideas found.</p>";
}

mysqli_close($connection);
