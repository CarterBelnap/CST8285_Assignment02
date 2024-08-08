<?php
// Include your database connection file
require '../config.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query the database for the specific ID
    $sql = "SELECT 
                gameideas.title,
                gameideas.coverimage,
                sections.sectiontitle,
                sections.sectiontext
            FROM 
                gameideas
            JOIN 
                sections ON gameideas.id = sections.game_idea_id
            WHERE 
                gameideas.id = '$id'";
    
    // Execute the SQL query
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Fetch the data as an associative array
        $row = mysqli_fetch_assoc($result);

        // Assign the fetched data to variables
        $title = htmlspecialchars($row['title']);
        $coverimage = htmlspecialchars($row['coverimage']);
        $sectitle = htmlspecialchars($row['sectiontitle']);
        $sectext = htmlspecialchars($row['sectiontext']);

    } else {
        echo "<p>No details found for this idea.</p>";
        exit;
    }
} else {
    echo "<p>Invalid request. No ID specified.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Idea Details</title>
    <link rel="stylesheet" href="css/styles1.css"> <!-- Link to your CSS file for styling -->
</head>
<body>

    <div class="content">
        <div class="game-idea">
            <h1 class="game-idea__title"><?php echo $title; ?></h1> <!-- Display the game idea title -->

            <div class="game-idea__image">
                <img src="<?php echo $coverimage; ?>" alt="Cover Image" width="300"> <!-- Display the cover image -->
            </div>

            <div class="game-idea__section">
                <h2 class="game-idea__section-title"><?php echo $sectitle; ?></h2> <!-- Display the section title -->
                <p class="game-idea__section-text"><?php echo $sectext; ?></p> <!-- Display the section text -->
            </div>
        </div>
    </div>

</body>
</html>