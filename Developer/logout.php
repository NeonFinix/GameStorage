<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['did'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other appropriate page
    header("Location: ../Guest/login.php");
    exit();
} else {
    // If the user is not logged in, you may redirect them to the login page or display an error message
    echo "You are not logged in.";
}
?>