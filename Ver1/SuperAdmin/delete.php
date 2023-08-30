<?php
include "connection.php";

if (isset($_GET['lrn'])) {
    $user_id = $_GET['lrn'];

    if(isset($_POST['confirm'])) {
        // Delete child records first
        $sql = "DELETE FROM socioeconomic_background WHERE lrn = '$user_id'";
        $link->query($sql);

        $sql = "DELETE FROM interests WHERE lrn = '$user_id'";
        $link->query($sql);

        $sql = "DELETE FROM skills WHERE lrn = '$user_id'";
        $link->query($sql);

        $sql = "DELETE FROM academic_performance WHERE lrn = '$user_id'";
        $link->query($sql);

        $sql = "DELETE FROM career WHERE lrn = '$user_id'";
        $link->query($sql);

        $sql = "DELETE FROM exam_score WHERE lrn = '$user_id'";
        $link->query($sql);

        // Finally, delete the record from the student table
        $sql = "DELETE FROM student WHERE lrn = '$user_id'";
        $result = $link->query($sql);

        if ($result == TRUE) {
            echo "<script type ='text/javascript'>
            window.location='profiles.php'
            </script>";
        } else {
            echo "Error:" . $sql . "<br>" . $link->error;
        }
    } else {
        // Display a confirmation prompt
        echo "Are you sure you want to delete this record? <br>";
        echo "<form method='POST'><input type='submit' name='confirm' value='Yes'> ";
        echo "<a href='profiles.php'>No</a></form>";
    }
}
?>
