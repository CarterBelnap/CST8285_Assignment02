    <!-- Name: Ahmed Al-Zaher
	File Name: Ger_Editable.php
	Date: 08-04-2024
	Purpose: When an idea is selected from the profile by a logged in user, A form is created and is populated by the information 
                that exists within the idea. -->

<?php
session_start();
include '../PHP/config.php';

// Check if the user is signed in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Pages/Login_Page.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $ideaId = $_GET['id'];
    $userId = $_SESSION['user_id'];

    
    $query = "SELECT * FROM GameIdeas WHERE id = ? AND user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $ideaId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $idea = $result->fetch_assoc();

    // Fetch the genres associated with this idea
    $genresQuery = "SELECT genre_id FROM GameIdeaGenres WHERE game_idea_id = ?";
    $stmt = $connection->prepare($genresQuery);
    $stmt->bind_param("i", $ideaId);
    $stmt->execute();
    $genresResult = $stmt->get_result();
    $selectedGenres = [];
    while ($row = $genresResult->fetch_assoc()) {
        $selectedGenres[] = $row['genre_id'];
    }

    // Fetch the sections associated with this idea
    $sectionsQuery = "SELECT * FROM Sections WHERE game_idea_id = ?";
    $stmt = $connection->prepare($sectionsQuery);
    $stmt->bind_param("i", $ideaId);
    $stmt->execute();
    $sectionsResult = $stmt->get_result();
    $sections = [];
    while ($row = $sectionsResult->fetch_assoc()) {
        $sections[] = $row;
    }
} else {
    echo "<b>Warning</b>: Invalid request.";
    exit();
}
?>