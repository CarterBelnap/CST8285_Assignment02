<?php
session_start(); // Start the session to manage user login state
include '../config.php'; // Include the database configuration file

// Check if the user is signed in
if (!isset($_SESSION['user_id'])) {
    // Redirect to sign-in page if the user is not signed in
    header("Location: ../../Pages/Login_Page.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $coverImageUrl = mysqli_real_escape_string($connection, $_POST['cover_image_url']);
    $genres = $_POST['genres']; // This should be an array of genre names
    $sectionTitles = $_POST['section_titles'];
    $sectionTexts = $_POST['section_texts'];
    $sectionImages = isset($_POST['section_urls']) ? $_POST['section_urls'] : [];
    $userid = $_SESSION['user_id'];

    // Insert the main game idea into the GameIdeas table
    $query = "INSERT INTO GameIdeas (user_id, title, cover_image_url) VALUES ('$userid', '$title', '$coverImageUrl')";
    if (mysqli_query($connection, $query)) {
        $gameIdeaId = mysqli_insert_id($connection); // Get the ID of the inserted game idea

        // Insert genres into the GameIdeaGenres table
        foreach ($genres as $genreName) {
            // Retrieve genre ID from the database based on the genre name
            $genreName = mysqli_real_escape_string($connection, $genreName);
            $genreQuery = "SELECT id FROM Genres WHERE name = '$genreName'";
            $genreResult = mysqli_query($connection, $genreQuery);

            if ($genreResult && mysqli_num_rows($genreResult) > 0) {
                $row = mysqli_fetch_assoc($genreResult);
                $genreId = $row['id'];

                // Insert into GameIdeaGenres
                $insertGenreQuery = "INSERT INTO gameideagenres (game_idea_id, genre_id) VALUES ($gameIdeaId, $genreId)";
                mysqli_query($connection, $insertGenreQuery);
            } else {
                echo "Genre not found: $genreName";
            }
        }

        // Insert sections and their images
        foreach ($sectionTitles as $index => $sectionTitle) {
            $sectionTitle = mysqli_real_escape_string($connection, $sectionTitle);
            $sectionText = mysqli_real_escape_string($connection, $sectionTexts[$index]);

            $query = "INSERT INTO sections (game_idea_id, section_title, section_text) VALUES ($gameIdeaId, '$sectionTitle', '$sectionText')";
            if (mysqli_query($connection, $query)) {
                $sectionId = mysqli_insert_id($connection);
                if (!empty($sectionImages[$index])) {
                    $imageUrl = mysqli_real_escape_string($connection, $sectionImages[$index]);
                    $imageQuery = "INSERT INTO sectionimages (section_id, image_url) VALUES ($sectionId, '$imageUrl')";
                    mysqli_query($connection, $imageQuery);
                }
            }
        }
        
        header("Location: ../../index.php");
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
