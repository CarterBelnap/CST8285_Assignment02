<?php
include 'config.php'; // Include the database configuration file

// This script assumes the user is already logged in and their user ID is available
$userId = 1; // For example purposes, replace with the actual logged-in user's ID

// Fetch game ideas created by the logged-in user
$query = "SELECT id, title, cover_image_url FROM GameIdeas WHERE user_id=$userId";
$result = mysqli_query($connection, $query);

// Display the game ideas
echo "<h2>My Game Ideas</h2>";
if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<img src='" . htmlspecialchars($row['cover_image_url']) . "' alt='" . htmlspecialchars($row['title']) . "' width='100'>";
        echo "<p><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='delete_idea.php?id=" . $row['id'] . "'>Delete</a></p>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>You have not created any game ideas yet.</p>";
}

mysqli_close($connection);
