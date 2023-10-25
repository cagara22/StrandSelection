<?php
session_start();
include "connection.php";

// Unset the specific session variable holding login information
unset($_SESSION['admin']);
unset($_SESSION['role']);

if (isset($_SESSION['fullname'])) {
    $admin_username = $_SESSION['fullname'];
    $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Logged out', '$admin_username logged out', '$admin_username')";
    $conn->query($log);
} else {
    // Handle the case when the admin username is not set in the session
    echo "Admin username not found in the session.";
}

// Redirect the user to the appropriate page
header("Location: index.php");
?>