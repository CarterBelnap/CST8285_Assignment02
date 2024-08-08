<?php
include './PHP/Config.php'; // Include the database configuration file

// Check if there is a search query
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($connection, $_GET['query']) : '';

$query = "SELECT id, title, cover_image_url, user_id FROM GameIdeas WHERE 1=1";

if ($search_query) {
    $query .= " AND title LIKE '%$search_query%'";
}

$stmt = mysqli_prepare($connection, $query);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

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
    echo "<p>No game ideas found.</p>";
}

mysqli_close($connection);
?>
