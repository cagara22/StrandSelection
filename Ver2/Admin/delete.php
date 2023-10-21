<?php
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
        $sql = "DELETE FROM studentprofile WHERE lrn = '$user_id'";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            echo "<script type ='text/javascript'>
            window.location='profiles.php'
            </script>";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }else{
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        echo "Error updating record: R" . mysqli_error($conn);
    }

    if(isset($_POST['confirm'])) {
        // Delete child records first
        $sql = "DELETE FROM studentsocioeco WHERE lrn = '$user_id'";
        $conn->query($sql);

        $sql = "DELETE FROM studentinterest WHERE lrn = '$user_id'";
        $conn->query($sql);

        $sql = "DELETE FROM studentskill WHERE lrn = '$user_id'";
        $conn->query($sql);

        $sql = "DELETE FROM studentacad WHERE lrn = '$user_id'";
        $conn->query($sql);

        $sql = "DELETE FROM studentcareer WHERE lrn = '$user_id'";
        $conn->query($sql);

        $sql = "DELETE FROM result WHERE lrn = '$user_id'";
        $conn->query($sql);

        $sql = "DELETE FROM exam_score WHERE lrn = '$user_id'";
        $conn->query($sql);

        // Finally, delete the record from the student table
        $sql = "DELETE FROM studentprofile WHERE lrn = '$user_id'";
        $result = $conn->query($sql);

        if ($result == TRUE) {
            echo "<script type ='text/javascript'>
            window.location='profiles.php'
            </script>";
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    } else {
        // Display a confirmation prompt
        echo "Are you sure you want to delete this record? <br>";
        echo "<form method='POST'><input type='submit' name='confirm' value='Yes'> ";
        echo "<a href='profiles.php'>No</a></form>";
    }
}
?>
