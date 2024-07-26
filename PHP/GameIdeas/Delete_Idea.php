<?php
include 'config.php'; // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameIdeaId = $_POST['game_idea_id']; // Get the game idea ID to delete

    // Check if the ID is provided
    if (empty($gameIdeaId)) {
        die("Invalid request.");
    }

    // Delete the game idea from the GameIdeas table
    $query = "DELETE FROM GameIdeas WHERE id=$gameIdeaId";
    mysqli_query($connection, $query);

    // Delete associated genres from the GameIdeaGenres table
    $query = "DELETE FROM GameIdeaGenres WHERE game_idea_id=$gameIdeaId";
    mysqli_query($connection, $query);

    // Delete associated sections from the Sections table
    $query = "DELETE FROM Sections WHERE game_idea_id=$gameIdeaId";
    mysqli_query($connection, $query);

    echo "Game idea deleted successfully.";

    mysqli_close($connection);
} else {
    die("Invalid request method.");
}