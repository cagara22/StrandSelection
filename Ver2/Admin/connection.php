<?php
    //Database creds
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'dss_db';

    // Establish database connection
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die('Unable to connect to database');
    
// $link =mysqli_connect("localhost","root","");
// mysqli_select_db($link, "dss_db");
?>