<?php
include "connection.php";

if (isset($_GET['id'])) {
    $logs_id = $_GET['id'];

    // Deletion of the student profile
    $sql = "DELETE FROM logs WHERE id = '$logs_id'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "<script type ='text/javascript'>
        window.location='logs.php'
        </script>";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}
?>