<?php
include './PHP/Config.php'; // Include the database configuration file

// Check if there is a search query in the URL parameters
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($connection, $_GET['query']) : '';

// Initialize the SQL query to select id, title, cover image URL, and user ID from the GameIdeas table
$query = "SELECT id, title, cover_image_url, user_id FROM GameIdeas WHERE 1=1";

// If a search query exists, modify the query to filter results by title
if ($search_query) {
    $query .= " AND title LIKE '%$search_query%'";
}

// Prepare the SQL statement for execution
$stmt = mysqli_prepare($connection, $query);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Get the result set from the executed statement
$result = mysqli_stmt_get_result($stmt);

// Check if there are any results returned from the query
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='ideas'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<img src='" . htmlspecialchars($row['cover_image_url']) . "' alt='" . htmlspecialchars($row['title']) . "' width='100'>";
        echo "<form method='GET' action='./Edit_Idea_Page.php'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<button type='submit' class='view'>View</button>";
        echo "</form>";
        echo "</div>";
    }
} else {
    // If no game ideas are found, display a message
    echo "<p>No game ideas found.</p>";
}