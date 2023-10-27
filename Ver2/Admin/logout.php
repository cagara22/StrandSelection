<?php
session_start();
include "connection.php";

if (isset($_SESSION['fullname'])) {
    $admin_username = $_SESSION['fullname'];
    $username = $_SESSION['admin'];
    $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Logged out', '$username logged out', '$admin_username')";
    $conn->query($log);
} else {
    // Handle the case when the admin username is not set in the session
    echo "Admin username not found in the session.";
}

// Unset the specific session variable holding login information
unset($_SESSION['admin']);
unset($_SESSION['role']);
unset($_SESSION['fullname']);
unset($_SESSION['adminID']);

// Redirect the user to the appropriate page
header("Location: index.php");
?>
