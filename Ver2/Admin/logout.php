<?php
session_start();

// Unset the specific session variable holding login information
unset($_SESSION['admin']);
unset($_SESSION['role']);

// Redirect the user to the appropriate page
header("Location: index.php");
?>