<?php
include 'C:\Users\carte\OneDrive\Documents\XAMPP Files\htdocs\CST8285_Assignment02\PHP\Config.php'; // Include the database configuration file

// Check if there is a search query
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($connection, $_GET['query']) : '';

$query = "SELECT id, title, cover_image_url, user_id FROM GameIdeas WHERE 1=1";

if ($search_query) {
    $query .= " AND title LIKE '%$search_query%'";
}

$stmt = mysqli_prepare($connection, $query);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

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
?>
