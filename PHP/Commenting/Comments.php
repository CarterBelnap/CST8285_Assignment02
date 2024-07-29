<?php
include 'config.php'; // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $gameIdeaId = $_POST['game_idea_id'];
    $userId = 1; // Example user ID, replace with actual logged-in user's ID
    $commentText = $_POST['comment_text'];

    // Basic validation
    if (empty($gameIdeaId) || empty($commentText)) {
        die("Invalid request. Game idea ID and comment text are required.");
    }

    // Insert the comment into the Comments table
    $query = "INSERT INTO Comments (game_idea_id, user_id, comment_text, created_at) VALUES ($gameIdeaId, $userId, '$commentText', NOW())";
    mysqli_query($connection, $query);

    echo "Comment added successfully.";

    mysqli_close($connection);
} else {
    die("Invalid request method.");
}
