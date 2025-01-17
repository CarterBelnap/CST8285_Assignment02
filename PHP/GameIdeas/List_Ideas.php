<?php
include 'config.php'; // Include the database configuration file

// Fetch all game ideas from the database
$query = "SELECT id, title, cover_image_url, user_id FROM GameIdeas";
$result = mysqli_query($connection, $query);

echo "<h2>All Game Ideas</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<img src='" . htmlspecialchars($row['cover_image_url']) . "' alt='" . htmlspecialchars($row['title']) . "' width='100'>";
        echo "<p><a href='view_idea.php?id=" . $row['id'] . "'>View Details</a></p>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No game ideas found.</p>";
}

mysqli_close($connection);
