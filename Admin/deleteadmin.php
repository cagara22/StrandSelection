<?php
include "connection.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    if(isset($_POST['confirm'])) {

        $sql = "DELETE FROM `admin` WHERE id = '$user_id'";
        $result = $link->query($sql);

        if ($result == TRUE) {
            echo "<script type ='text/javascript'>
            window.location='admins.php'
            </script>";
        } else {
            echo "Error:" . $sql . "<br>" . $link->error;
        }
    } else {
        // Display a confirmation prompt
        echo "Are you sure you want to delete this record? <br>";
        echo "<form method='POST'><input type='submit' name='confirm' value='Yes'> ";
        echo "<a href='admins.php'>No</a></form>";
    }
}
?>
