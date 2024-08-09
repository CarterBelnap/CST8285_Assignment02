    <!-- Name: Ahmed Al-Zaher
	File Name: Submit_Edit.php
	Date: 08-04-2024
	Purpose: Submits an Idea to the database 
                used prepared statements to protect against sql injections as an extra layer of security-->
<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Pages/Login_Page.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ideaId = $_POST['idea_id'];
    $title = $_POST['title'];
    $coverImageUrl = $_POST['cover_image_url'];
    $genres = $_POST['genres']; // This should be an array of genre names
    $sectionTitles = $_POST['section_titles'];
    $sectionTexts = $_POST['section_texts'];
    $sectionImages = isset($_POST['section_urls']) ? $_POST['section_urls'] : [];
    $userId = $_SESSION['user_id'];

    // Check if the user owns the idea
    $query = "SELECT * FROM GameIdeas WHERE id = ? AND user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $ideaId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Idea not found or you do not have permission to edit this idea.";
        exit();
    }

    // Update the main game idea in the GameIdeas table
    $query = "UPDATE GameIdeas SET title = ?, cover_image_url = ? WHERE id = ? AND user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ssii", $title, $coverImageUrl, $ideaId, $userId);
    if ($stmt->execute()) {

        // Delete existing genres and sections to handle updates
        // First, delete dependent rows in sectionimages
        $deleteImagesQuery = "DELETE FROM SectionImages WHERE section_id IN (SELECT id FROM Sections WHERE game_idea_id = ?)";
        $stmt = $connection->prepare($deleteImagesQuery);
        $stmt->bind_param("i", $ideaId);
        if (!$stmt->execute()) {
            echo "Error deleting images: " . $stmt->error;
            exit();
        }

        // Now, delete rows in sections
        $deleteSectionsQuery = "DELETE FROM Sections WHERE game_idea_id = ?";
        $stmt = $connection->prepare($deleteSectionsQuery);
        $stmt->bind_param("i", $ideaId);
        if (!$stmt->execute()) {
            echo "Error deleting sections: " . $stmt->error;
            exit();
        }

        // Delete existing genres
        $deleteGenresQuery = "DELETE FROM GameIdeaGenres WHERE game_idea_id = ?";
        $stmt = $connection->prepare($deleteGenresQuery);
        $stmt->bind_param("i", $ideaId);
        if (!$stmt->execute()) {
            echo "Error deleting genres: " . $stmt->error;
            exit();
        }

        // Insert genres into the GameIdeaGenres table
        foreach ($genres as $genreName) {
            $genreQuery = "SELECT id FROM Genres WHERE name = ?";
            $stmt = $connection->prepare($genreQuery);
            $stmt->bind_param("s", $genreName);
            $stmt->execute();
            $genreResult = $stmt->get_result();

            if ($genreResult && $genreResult->num_rows > 0) {
                $row = $genreResult->fetch_assoc();
                $genreId = $row['id'];

                $insertGenreQuery = "INSERT INTO GameIdeaGenres (game_idea_id, genre_id) VALUES (?, ?)";
                $stmt = $connection->prepare($insertGenreQuery);
                $stmt->bind_param("ii", $ideaId, $genreId);
                if (!$stmt->execute()) {
                    echo "Error inserting genre: " . $stmt->error;
                    exit();
                }
            } else {
                echo "Genre not found: $genreName";
                exit();
            }
        }

        // Insert sections and their images
        foreach ($sectionTitles as $index => $sectionTitle) {
            $sectionText = $sectionTexts[$index];

            $insertSectionQuery = "INSERT INTO Sections (game_idea_id, section_title, section_text) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($insertSectionQuery);
            $stmt->bind_param("iss", $ideaId, $sectionTitle, $sectionText);
            if ($stmt->execute()) {
                $sectionId = $stmt->insert_id;
                if (!empty($sectionImages[$index])) {
                    $imageUrl = $sectionImages[$index];
                    $insertImageQuery = "INSERT INTO SectionImages (section_id, image_url) VALUES (?, ?)";
                    $stmt = $connection->prepare($insertImageQuery);
                    $stmt->bind_param("is", $sectionId, $imageUrl);
                    if (!$stmt->execute()) {
                        echo "Error inserting image: " . $stmt->error;
                        exit();
                    }
                }
            } else {
                echo "Error inserting section: " . $stmt->error;
                exit();
            }
        }

        header("Location: ../../Pages/Profile.php");
    } else {
        echo "Error updating idea: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($connection);
}
