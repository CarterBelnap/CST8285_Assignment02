<?php
include '../config.php'; // Include the database configuration file

// If the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username']; // stores username from form into variable
    $email = $_POST['email']; // stores email from form into variable
    $password = $_POST['password']; // stores password from form into variable
    
    // Check if username or email already exists
    $checkStmt = $connection->prepare("SELECT id FROM Users WHERE username = ? OR email = ?"); //query the username and email the user input against the database
    $checkStmt->bind_param("ss", $username, $email); // bind the username and email the userer input into the 2 ? in above statement
    $checkStmt->execute(); // execute the query command
    $checkStmt->store_result(); // store the result of the query

    if ($checkStmt->num_rows > 0) { // check if the above query had any results, if so it is a duplicate
        echo "Username or email already exists. Please choose another.";
        $checkStmt->close();
        $connection->close();
        exit();
    }
    $checkStmt->close();
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // hides the password in the database
    
    // Prepare an SQL statement to prevent SQL injection
    $stmt = $connection->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    
    // Execute the statement and check if the insertion was successful
    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
