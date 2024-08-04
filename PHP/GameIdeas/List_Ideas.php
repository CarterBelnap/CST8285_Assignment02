<?php

include 'PHP/config.php'; // Use the correct absolute path

// Retrieve the query and genres from the request
$queryText = isset($_GET['query']) ? $_GET['query'] : '';
$genres = isset($_GET['genres']) ? $_GET['genres'] : [];

// Base SQL query
$sql = "SELECT gi.id, gi.title, gi.cover_image_url 
        FROM GameIdeas gi";

// Array to hold SQL parameters
$params = [];

// Check if genres are selected
if (!empty($genres)) {
    // Join with GameIdeaGenres table and filter by genres
    $placeholders = implode(',', array_fill(0, count($genres), '?'));
    $sql .= " JOIN GameIdeaGenres gig ON gi.id = gig.game_idea_id 
              WHERE gig.genre_id IN ($placeholders)";
    $params = $genres;
} else {
    // No genres selected, no genre filtering
    $sql .= " WHERE 1=1"; // Adjust this if you have other filters
}

// Check if there's a search query
if (!empty($queryText)) {
    // Add search query to the SQL
    $sql .= " AND gi.title LIKE ?";
    $params[] = "%$queryText%";
}

// Prepare and execute the query
$stmt = mysqli_prepare($connection, $sql);

// Bind parameters
if (!empty($params)) {
    // Bind parameters based on their type
    $types = str_repeat('i', count($genres)); // Assuming genre_id is an integer
    if (!empty($queryText)) {
        $types .= 's'; // Adding type for the search query
    }
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

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
    echo "<p>No game ideas found for the selected filters.</p>";
}

mysqli_close($connection);
?>