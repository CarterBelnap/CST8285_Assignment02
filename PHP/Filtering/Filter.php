<?php
include 'config.php'; // Include the database configuration file

// Check if a genre filter is applied
$genreFilter = isset($_GET['genre']) ? $_GET['genre'] : '';

// Construct the SQL query based on the filter
$query = "SELECT gi.id, gi.title, gi.cover_image_url FROM GameIdeas gi";

if (!empty($genreFilter)) {
    // If a genre filter is applied, join with the GameIdeaGenres table
    $query .= " JOIN GameIdeaGenres gig ON gi.id = gig.game_idea_id";
    $query .= " WHERE gig.genre_id = $genreFilter";
}

$result = mysqli_query($connection, $query);

echo "<h2>Filtered Game Ideas</h2>";

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
    echo "<p>No game ideas found for the selected genre.</p>";
}

mysqli_close($connection);
