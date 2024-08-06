<?php
session_start();
include '../config.php';

// Check if the user is signed in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Pages/Login_Page.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ideaId = $_POST['idea_id'];
    $userId = $_SESSION['user_id'];

    // Check if the user owns the idea
    $query = "SELECT * FROM GameIdeas WHERE id = ? AND user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $ideaId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Idea not found or you do not have permission to delete this idea.";
        exit();
    }

    // Delete dependent rows in SectionImages
    $deleteImagesQuery = "DELETE FROM SectionImages WHERE section_id IN (SELECT id FROM Sections WHERE game_idea_id = ?)";
    $stmt = $connection->prepare($deleteImagesQuery);
    $stmt->bind_param("i", $ideaId);
    if (!$stmt->execute()) {
        echo "Error deleting images: " . $stmt->error;
        exit();
    }

    // Delete rows in Sections
    $deleteSectionsQuery = "DELETE FROM Sections WHERE game_idea_id = ?";
    $stmt = $connection->prepare($deleteSectionsQuery);
    $stmt->bind_param("i", $ideaId);
    if (!$stmt->execute()) {
        echo "Error deleting sections: " . $stmt->error;
        exit();
    }

    // Delete rows in GameIdeaGenres
    $deleteGenresQuery = "DELETE FROM GameIdeaGenres WHERE game_idea_id = ?";
    $stmt = $connection->prepare($deleteGenresQuery);
    $stmt->bind_param("i", $ideaId);
    if (!$stmt->execute()) {
        echo "Error deleting genres: " . $stmt->error;
        exit();
    }

    // Delete the main game idea
    $deleteIdeaQuery = "DELETE FROM GameIdeas WHERE id = ? AND user_id = ?";
    $stmt = $connection->prepare($deleteIdeaQuery);
    $stmt->bind_param("ii", $ideaId, $userId);
    if ($stmt->execute()) {
        header("Location: ../../Pages/Profile.php");
    } else {
        echo "Error deleting idea: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($connection);
} else {
    echo "<b>Warning</b>: Invalid request.";
    exit();
}
