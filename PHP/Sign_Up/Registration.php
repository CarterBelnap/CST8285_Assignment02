<!-- 
	Name: Ahmed Al-Zaher
	File Name: Registration.php
	Date: 08-04-2024
	Purpose: PHP script for user registration -->


<?php
include '../config.php'; // Include the database configuration file

// If the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username']; // stores username from form into variable
    $email = $_POST['email']; // stores email from form into variable
    $password = $_POST['password']; // stores password from form into variable
    
    // Check if username or email already exists
    $checkDuplicate = $connection->prepare("SELECT username, email FROM Users WHERE username = ? OR email = ?"); //query the username and email the user input against the database
    $checkDuplicate->bind_param("ss", $username, $email); // bind the username and email the user input into the 2 ? in above statement
    $checkDuplicate->execute(); // execute the query command
    $checkDuplicate->store_result(); // store the result of the query

    if ($checkDuplicate->num_rows > 0) {
        // Check which field is a duplicate
        $checkDuplicate->bind_result($duplicate_username, $duplicate_email);
        $checkDuplicate->fetch();
        
        if ($duplicate_username === $username) {
            $errorMessage = "Username is already taken.";
        } else if ($duplicate_email === $email) {
            $errorMessage = "Email is already in use.";
        }
        
        $checkDuplicate->close();
        $connection->close();
        
        //redirect to the registration page while including the error message
        header("Location: ../../Pages/Register_Page.php?error=" . urlencode($errorMessage));
        exit();
    }
    $checkDuplicate->close();
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // hides the password in the database
    
    // Prepare an SQL statement to prevent SQL injection
    $createUser = $connection->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
    $createUser->bind_param("sss", $username, $email, $hashed_password);
    
    // Execute the statement and check if the insertion was successful
    if ($createUser->execute()) {
        header("Location: ../../Pages/Login_Page.php");
    }
    else {
        echo "Error: " . $createUser->error;
        }
    
    // Close the statement and connection
    $createUser->close();
    $connection->close();
}
