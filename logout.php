<?php
    // Start the session
    session_start();

    // Destroy the session to log out the user
    session_destroy();

    // Optionally, unset session variables to ensure complete logout
    unset($_SESSION);

    // Redirect to login page or any other page
    header("location:http://localhost/newspaper_agency_system/login.php");
    exit;
?>
