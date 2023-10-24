<?php
session_start();
include "connection.php";

if (isset($_GET['lrn'])) {
    $user_id = $_GET['lrn'];

    $sql_result = "DELETE FROM result WHERE lrn = '$user_id'";
    $sql_studentacad = "DELETE FROM studentacad WHERE lrn = '$user_id'";
    $sql_studentinterest = "DELETE FROM studentinterest WHERE lrn = '$user_id'";
    $sql_studentskill = "DELETE FROM studentskill WHERE lrn = '$user_id'";
    $sql_studentsocioeco = "DELETE FROM studentsocioeco WHERE lrn = '$user_id'";
    $sql_studentcareer = "DELETE FROM studentcareer WHERE lrn = '$user_id'";
    $sql_stemresult = "DELETE FROM stemresult WHERE lrn = '$user_id'";
    $sql_humssresult = "DELETE FROM humssresult WHERE lrn = '$user_id'";
    $sql_abmresult = "DELETE FROM abmresult WHERE lrn = '$user_id'";
    $sql_gasresult = "DELETE FROM gasresult WHERE lrn = '$user_id'";
    $sql_tvlictresult = "DELETE FROM tvlictresult WHERE lrn = '$user_id'";
    $sql_tvlheresult = "DELETE FROM tvlheresult WHERE lrn = '$user_id'";

    mysqli_autocommit($conn, false);
    if (
        mysqli_query($conn, $sql_result) &&
        mysqli_query($conn, $sql_studentacad) &&
        mysqli_query($conn, $sql_studentinterest) &&
        mysqli_query($conn, $sql_studentskill) &&
        mysqli_query($conn, $sql_studentcareer) &&
        mysqli_query($conn, $sql_studentsocioeco) &&
        mysqli_query($conn, $sql_stemresult) &&
        mysqli_query($conn, $sql_humssresult) &&
        mysqli_query($conn, $sql_abmresult) &&
        mysqli_query($conn, $sql_gasresult) &&
        mysqli_query($conn, $sql_tvlictresult) &&
        mysqli_query($conn, $sql_tvlheresult)
    ) {
        mysqli_commit($conn);
        mysqli_autocommit($conn, true);

        // Deletion of the studentprofile
        $sql = "DELETE FROM studentprofile WHERE lrn = '$user_id'";
        $result = $conn->query($sql);

        if ($result == TRUE) {
            // Logging the 'deleted' action in the logs table
            if (isset($_SESSION['fullname'])) {
                $admin_username = $_SESSION['fullname'];
                $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Deleted', 'Student with LRN $user_id was deleted', '$admin_username')";
                $conn->query($log);
            } else {
                // Handle the case when the admin username is not set in the session
                echo "Admin username not found in the session.";
            }

            echo "<script type ='text/javascript'>
            window.location='profiles.php'
            </script>";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
}
}

?>