<?php
// Start the session
session_start();

// Check if the user is already logged in, if yes, then log them out
if (isset($_SESSION['user_id'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session
    session_destroy();
}

// Redirect to the homepage or login page after logout
header('Location: ../../index.php'); // Adjust the path as necessary to point to your homepage or login page
exit;
?>