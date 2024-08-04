<!-- 
	Name: Ahmed Al-Zaher
	File Name: Login.php
	Date: 08-04-2024
	Purpose: PHP for the Login page of the website. -->


<?php
session_start();
include '../config.php'; // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
     // Prepare an SQL statement to prevent SQL injection
    $checkDuplicate = $connection->prepare("SELECT id, password FROM Users WHERE username = ?");
    $checkDuplicate->bind_param("s", $username);
    $checkDuplicate->execute();
    $checkDuplicate->store_result();

    // Check if a user with the provided username exists
    if ($checkDuplicate->num_rows > 0) {
        $checkDuplicate->bind_result($user_id, $hashed_password);
        $checkDuplicate->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a new session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: ../../index.php");
        } else {
            $errorMessage = "Incorrect password. Please try again.";
            header("Location: ../../Pages/Login_Page.php?error=" . urlencode($errorMessage));
        }
    } else {
        $errorMessage = "No user found with that username.";
        header("Location: ../../Pages/Login_Page.php?error=" . urlencode($errorMessage));
    }

    // Close the statement and connection
    $checkDuplicate->close();
    $connection->close();
}
