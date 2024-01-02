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

if($_SESSION['role'] === "ADMIN"){
    $userType = 1;
}else{
    $userType = 2;
}

// Unset the specific session variable holding login information
unset($_SESSION['admin']);
unset($_SESSION['role']);
unset($_SESSION['fullname']);
unset($_SESSION['adminID']);

// Redirect the user to the appropriate page
if($userType == 1){
    header("Location: index.php?role=1");
}else if($userType == 2){
    header("Location: index.php?role=2");
}else{
    header("Location: index.php");
}
?>
