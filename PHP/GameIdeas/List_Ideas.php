<!--
	Name: Carter Belnap
	File Name: List_Ideas.php
	Date: 08-04-2024
	Purpose: fetching each idea and listing them in the proper container on index.php
-->


<?php
include './PHP/Config.php'; // Include the database configuration file

// Check if there is a search query in the URL parameters
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($connection, $_GET['query']) : '';

// Initialize the SQL query to select id, title, cover image URL, and user ID from the GameIdeas table
$query = "SELECT id, title, cover_image_url, user_id FROM GameIdeas WHERE 1=1";

// If there is a search query, modify the SQL query to include a WHERE clause for searching
if ($search_query != '') {
    $query .= " AND title LIKE '%$search_query%'";
}

$result = $connection->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='ideas'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<img src='" . htmlspecialchars($row['cover_image_url']) . "' alt='" . htmlspecialchars($row['title']) . "' width='100'>";
        echo "<button onclick='showDisplayedIdea()' class='view-button' data-id='" . htmlspecialchars($row['id']) . "'>View</button>";
        echo "</div>";
    }
} else {
    echo "No ideas found.";
}