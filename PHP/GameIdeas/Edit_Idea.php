<?php
include 'config.php'; // Include the database configuration file

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // Handle form submission (update the database)
        $gameIdeaId = $_POST['game_idea_id'];
        $title = $_POST['title'];
        $coverImageUrl = $_POST['cover_image_url'];
        $sections = $_POST['sections']; // Plain text data

        // Process selected genres
        $selectedGenres = $_POST['genres']; // Array of selected genre IDs

        // Basic validation
        if (empty($title) || empty($coverImageUrl) || empty($selectedGenres)) {
            die("Title, cover image, and at least one genre are required.");
        }

        // Update the main game idea in the GameIdeas table
        $query = "UPDATE GameIdeas SET title='$title', cover_image_url='$coverImageUrl' WHERE id=$gameIdeaId";
        if (mysqli_query($connection, $query)) {
            // Remove old genre associations
            $query = "DELETE FROM GameIdeaGenres WHERE game_idea_id=$gameIdeaId";
            mysqli_query($connection, $query);

            // Insert updated genres into the GameIdeaGenres table
            foreach ($selectedGenres as $genreId) {
                $query = "INSERT INTO GameIdeaGenres (game_idea_id, genre_id) VALUES ($gameIdeaId, $genreId)";
                mysqli_query($connection, $query);
            }

            // Update sections
            $query = "UPDATE Sections SET section_content='$sections' WHERE game_idea_id=$gameIdeaId";
            mysqli_query($connection, $query);

            echo "Game idea updated successfully!";
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        mysqli_close($connection);
        break;

    case 'GET':
        // Retrieve the existing game idea data for display in the form
        $gameIdeaId = $_GET['id']; // Assume the ID is passed as a query parameter
        $query = "SELECT * FROM GameIdeas WHERE id=$gameIdeaId";
        $result = mysqli_query($connection, $query);
        $gameIdea = mysqli_fetch_assoc($result);

        // Fetch genres associated with the game idea
        $query = "SELECT genre_id FROM GameIdeaGenres WHERE game_idea_id=$gameIdeaId";
        $genresResult = mysqli_query($connection, $query);
        $selectedGenres = [];
        while ($row = mysqli_fetch_assoc($genresResult)) {
            $selectedGenres[] = $row['genre_id'];
        }

        // Fetch all available genres for checkboxes
        $query = "SELECT * FROM Genres";
        $genresResult = mysqli_query($connection, $query);
        $allGenres = [];
        while ($row = mysqli_fetch_assoc($genresResult)) {
            $allGenres[$row['id']] = $row['name']; // Assuming the genre table has 'id' and 'name' columns
        }

        // Fetch sections
        $query = "SELECT section_content FROM Sections WHERE game_idea_id=$gameIdeaId";
        $sectionsResult = mysqli_query($connection, $query);
        $sections = mysqli_fetch_assoc($sectionsResult)['section_content'];

        mysqli_close($connection);
        break;

    default:
        // Handle other request methods if necessary
        echo "Invalid request method.";
        break;
}
