<?php
session_start(); // Start or resume the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page (or another page)
header("Location: index.html");
exit();
