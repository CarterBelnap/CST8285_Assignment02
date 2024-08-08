<?php
include 'PHP/Config.php'; // Include the database configuration file to establish a connection

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

// Display a header for the list of game ideas
echo "<h2>All Game Ideas</h2>";

// Check if there are any results returned from the query
if (mysqli_num_rows($result) > 0) {
    echo "<ul>"; // Start an unordered list to display game ideas
    while ($row = mysqli_fetch_assoc($result)) { // Fetch each row as an associative array
        echo "<li>"; // Start a list item for each game idea
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>"; // Display the game title with HTML special characters converted
        echo "<img src='" . htmlspecialchars($row['cover_image_url']) . "' alt='" . htmlspecialchars($row['title']) . "' width='100'>"; // Display the cover image with HTML special characters converted
        // Form to view details of the selected game idea
        echo "<form action='./GameIdeas/View_Idea.php' method='GET'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; // Hidden input to store the game idea ID
        echo "<button type='submit'>View Details</button>"; // Button to submit the form and view details
        echo "</form>";
        echo "</li>"; // End the list item
    }
    echo "</ul>"; // End the unordered list
} else {
    // If no game ideas are found, display a message
    echo "<p>No game ideas found.</p>";
}