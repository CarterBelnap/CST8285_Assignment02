<!--
	Name: Carter Belnap
	File Name: View_Idea.php
	Date: 08-04-2024
	Purpose: using SQL select statements to view a specific idea when clicked, 
    also allows comments to be made on posts
-->

<?php
// Include your database connection file
require '../Config.php';
include '../Commenting/Comments.php';

// Start a session if not already started (this is important for user authentication)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $ideaId = $_GET['id'];

    // Prepare a SQL statement to join tables and prevent SQL injection
    $stmt = $connection->prepare("
        SELECT 
            gi.title, gi.cover_image_url, gi.post_date, u.username as author,
            g.name as genre_name,
            s.section_title, s.section_text, si.image_url,
            c.comment_text, c.comment_date, cu.username as commenter, c.id as comment_id
        FROM gameideas gi
        LEFT JOIN users u ON gi.user_id = u.id
        LEFT JOIN gameideagenres gig ON gi.id = gig.game_idea_id
        LEFT JOIN genres g ON gig.genre_id = g.id
        LEFT JOIN sections s ON gi.id = s.game_idea_id
        LEFT JOIN sectionimages si ON s.id = si.section_id
        LEFT JOIN comments c ON gi.id = c.game_idea_id
        LEFT JOIN users cu ON c.user_id = cu.id
        WHERE gi.id = ?
        ORDER BY s.id, si.id, c.comment_date DESC
    ");
    $stmt->bind_param("i", $ideaId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='idea-details'>";
        $ideaInfo = $result->fetch_assoc();
        echo "<h1>" . htmlspecialchars($ideaInfo['title']) . "</h1>";
        echo "<img src='" . htmlspecialchars($ideaInfo['cover_image_url']) . "' alt='" . htmlspecialchars($ideaInfo['title']) . "' width='200'>";
        echo "<p>Posted by: " . htmlspecialchars($ideaInfo['author']) . " on " . date('F j, Y', strtotime($ideaInfo['post_date'])) . "</p>";
        echo "<p>Genres: " . htmlspecialchars($ideaInfo['genre_name']) . "</p>";

        // Reset pointer to the first result
        $result->data_seek(0);

        $currentSection = null;
        $sections = [];
        $commentIds = [];
        $comments = []; // Initialize comments array to avoid undefined variable error

        while ($row = $result->fetch_assoc()) {
            if ($currentSection !== $row['section_title']) {
                if ($currentSection !== null) {
                    displaySection($currentSection, $sections);
                }
                $currentSection = $row['section_title'];
                $sections[$currentSection] = [
                    'text' => $row['section_text'],
                    'images' => []
                ];
            }
            if (!empty($row['image_url']) && !in_array($row['image_url'], $sections[$currentSection]['images'])) {
                $sections[$currentSection]['images'][] = $row['image_url'];
            }
            if (!empty($row['comment_id']) && !in_array($row['comment_id'], $commentIds)) {
                $comments[] = htmlspecialchars($row['commenter']) . ": " . htmlspecialchars($row['comment_text']) . " on " . date('F j, Y', strtotime($row['comment_date']));
                $commentIds[] = $row['comment_id'];
            }
        }

        // Output the last section
        if ($currentSection !== null) {
            displaySection($currentSection, $sections);
        }

        echo "<h3>Comments:</h3>";
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                echo "<p>" . $comment . "</p>";
            }
        } else {
            echo "<p>No comments to display.</p>";
        }

        // Add the comment form
        echo "<h3>Add a Comment:</h3>";
        if (isset($_SESSION['user_id'])) {
            echo "<form id='commentpost' action='/CST8285_Assignment02/PHP/Commenting/Comments.php' method='post'>
                    <input type='hidden' name='idea_id' value='" . htmlspecialchars($ideaId) . "'>
                    <textarea name='comment_text' rows='4' cols='50' placeholder='Write your comment here...' required></textarea>
                    <br>
                    <input type='submit' value='Submit Comment'>
                </form>";
        } else {
            echo "<p>Please <a href='login.php'>login</a> to post a comment.</p>";
        }

        echo "<a href='./index.php'>Back</a>";
        echo "</div>";
    } else {
        echo "Idea not found.";
    }
} else {
    echo "No idea specified.";
}

function displaySection($sectionTitle, $sections) {
    echo "<div class='section'>";
    echo "<h3>" . htmlspecialchars($sectionTitle) . "</h3>";
    echo "<p>" . htmlspecialchars($sections[$sectionTitle]['text']) . "</p>";
    foreach ($sections[$sectionTitle]['images'] as $image) {
        echo "<img src='" . htmlspecialchars($image) . "' alt='Section Image' width='200'>";
    }
    echo "</div>";
}