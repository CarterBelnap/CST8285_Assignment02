<?php
session_start();
include '../config.php'; // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate inputs (server-side validation)
    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT id, password FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user with the provided username exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a new session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            echo "Login successful!"; // Redirect or send to a logged-in page
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "No user found with that username.";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
