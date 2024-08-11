<!--
	Name: Carter Belnap
	File Name: Comments.php
	Date: 08-04-2024
	Purpose: allows users to comment, using a post method then rediriecting back to main page
-->

<?php
require '../Config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $ideaId = $_POST['idea_id'] ?? null;
        $commentText = $_POST['comment_text'] ?? null;

        if (!empty($commentText) && !empty($ideaId)) {
            $stmt = $connection->prepare("INSERT INTO comments (game_idea_id, user_id, comment_text, comment_date) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iis", $ideaId, $userId, $commentText);

            if ($stmt->execute()) {
                header("Location: /CST8285_Assignment02/index.php");
                exit();
            } else {
                echo "Error adding comment: " . $stmt->error;
            }
        } else {
            echo "Comment cannot be empty.";
        }
    } else {
        echo "You must be logged in to post a comment.";
    }
}