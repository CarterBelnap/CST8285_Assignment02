<?php
include '../config.php'; // Include the database configuration file

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $coverImageUrl = $_POST['cover_image_url'];
    $genres = $_POST['genres']; // String with comma-separated genre IDs
    $sections = $_POST['sections']; // Plain text

    // Basic validation remove after client side validation is implemented
    if (empty($title) || empty($coverImageUrl) || empty($genres) || empty($sections)) {
        die("All fields are required.");
    }

    // Insert the main game idea into the GameIdeas table
    $query = "INSERT INTO GameIdeas (title, cover_image_url) VALUES ('$title', '$coverImageUrl')";
    if (mysqli_query($connection, $query)) {
        $gameIdeaId = mysqli_insert_id($connection); // Get the ID of the inserted game idea

        // Insert genres into the GameIdeaGenres table
        $genreIds = explode(',', $genres);
        foreach ($genreIds as $genreId) {
            $query = "INSERT INTO GameIdeaGenres (game_idea_id, genre_id) VALUES ($gameIdeaId, $genreId)";
            mysqli_query($connection, $query);
        }

        // Insert sections as a plain text entry into the Sections table
        $query = "INSERT INTO Sections (game_idea_id, section_content) VALUES ($gameIdeaId, '$sections')";
        mysqli_query($connection, $query);

        echo "Game idea submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
