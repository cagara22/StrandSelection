<?php
session_start();

// Unset the specific session variable holding login information
unset($_SESSION['student']);

// Redirect the user to the appropriate page
header("Location: index.php");
?>