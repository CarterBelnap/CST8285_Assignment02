<?php
include 'config.php'; // Include the database configuration file

// Retrieve the game idea ID from the query parameter
if (isset($_GET['id'])) {
    $gameIdeaId = $_GET['id'];

    // Fetch game idea details
    $query = "SELECT title, cover_image_url FROM GameIdeas WHERE id=$gameIdeaId";
    $result = mysqli_query($connection, $query);

    if ($gameIdea = mysqli_fetch_assoc($result)) {
        echo "<h2>" . htmlspecialchars($gameIdea['title']) . "</h2>";
        echo "<img src='" . htmlspecialchars($gameIdea['cover_image_url']) . "' alt='" . htmlspecialchars($gameIdea['title']) . "' width='200'>";
        
        // Fetch sections
        $query = "SELECT section_content FROM Sections WHERE game_idea_id=$gameIdeaId";
        $sectionsResult = mysqli_query($connection, $query);
        echo "<h3>Sections</h3>";
        echo "<div>";
        while ($section = mysqli_fetch_assoc($sectionsResult)) {
            echo "<p>" . nl2br(htmlspecialchars($section['section_content'])) . "</p>";
        }
        echo "</div>";

        // Fetch comments
        $query = "SELECT comment_text, created_at FROM Comments WHERE game_idea_id=$gameIdeaId ORDER BY created_at DESC";
        $commentsResult = mysqli_query($connection, $query);
        echo "<h3>Comments</h3>";
        if (mysqli_num_rows($commentsResult) > 0) {
            echo "<ul>";
            while ($comment = mysqli_fetch_assoc($commentsResult)) {
                echo "<li>" . htmlspecialchars($comment['comment_text']) . " - <em>Posted on " . $comment['created_at'] . "</em></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No comments yet.</p>";
        }
    } else {
        echo "<p>Game idea not found.</p>";
    }

    mysqli_close($connection);
} else {
    echo "<p>Invalid game idea ID.</p>";
}
