<?php
session_start(); //start the session
include "connection.php"; //include the connection file

//this is for student profile deletion
if (isset($_GET['lrn'])) {
    $user_id = $_GET['lrn']; //get the lrn

    //delete the child table first
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

        //deletion of the studentprofile
        $sql = "DELETE FROM studentprofile WHERE lrn = '$user_id'";
        $result = $conn->query($sql);

        if ($result == TRUE) {
            //logging the 'deleted' action in the logs table
            $admin_username = $_SESSION['fullname'];
            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Deleted', 'Student with LRN $user_id was deleted', '$admin_username')";
            $conn->query($log);

            $_SESSION['mesType'] = "success";
            $_SESSION['mesText'] = "Student Successfully Deleted!";

            //redirect back to profiles page
            header("Location: profiles.php");
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
}

//this is for logs deletion
if (isset($_GET['logid'])) {
    $filename = 'logs/archived_logs.txt'; // Name of the text file
    $file = fopen($filename, 'a+'); // Open the file in write mode
    $currentDateTime = date("Y-m-d", time());
    fwrite($file, $currentDateTime . PHP_EOL);

    $logs_id = $_GET['logid']; //get the log id

    $logsql = "SELECT * FROM logs WHERE id = '$logs_id'";
    $result = $conn->query($logsql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $logEntry = $row['id'] . "\t" . $row['timestamp'] . "\t" . $row['action'] . "\t" . $row['details'] . "\t" . $row['doer'] . "\n";
            fwrite($file, $logEntry . PHP_EOL);
        }
    }

    fclose($file);

    //deletion of the log
    $sql = "DELETE FROM logs WHERE id = '$logs_id'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        $_SESSION['mesType'] = "success";
        $_SESSION['mesText'] = "Log Successfully Deleted!";

        //redirect to logs page
        header("Location: logs.php");
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}else if(isset($_GET['logALL'])){
    $filename = 'logs/archived_logs.txt'; // Name of the text file
    $file = fopen($filename, 'a+'); // Open the file in write mode
    $currentDateTime = date("Y-m-d", time());
    fwrite($file, $currentDateTime . PHP_EOL);

    $logsql = "SELECT * FROM logs";
    $result = $conn->query($logsql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $logEntry = $row['id'] . "\t" . $row['timestamp'] . "\t" . $row['action'] . "\t" . $row['details'] . "\t" . $row['doer'] . "\n";
            fwrite($file, $logEntry . PHP_EOL);
        }
    }

    fclose($file);

    $sql = "TRUNCATE TABLE logs";

    if ($conn->query($sql) === TRUE) {
        $admin_username = $_SESSION['fullname'];
        $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Deleted', 'ALL logs was deleted', '$admin_username')";
        $conn->query($log);
        
        $_SESSION['mesType'] = "success";
        $_SESSION['mesText'] = "All Logs Successfully Deleted!";

        //redirect to logs page
        header("Location: logs.php");
    } else {
        echo "Error emptying table: " . $conn->error;
    }
}


//this is for admin profile deletion
if(isset($_GET['adminid']) && isset($_GET['adminname'])){
    $admin_id = $_GET['adminid']; //get the admin id
    $admin_name = $_GET['adminname']; //get the admin name
    $cur_admin_id = $_SESSION['adminID']; //get the current admin username

    $conn->query("SET foreign_key_checks = 0"); //disable foreign key check

    //check for the section where the admin is the adviser
    $search_sql = "SELECT sectionID FROM section WHERE adminID = $admin_id";
    $result = mysqli_query($conn, $search_sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $sectionID = $row['sectionID'];//get the section ID
            $section_sql = "UPDATE section SET adminID='$cur_admin_id' WHERE sectionID = '$sectionID'"; //transfer the section adviser to current admin
            if(mysqli_query($conn, $section_sql)){
                echo "good";
            }else{
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
    
    //prepare the delete statement
    $delete_sql = "DELETE FROM adminprofile WHERE adminID = '$admin_id'";
    $delete_result = $conn->query($delete_sql);

    if ($delete_result === TRUE) {
        $conn->query("SET foreign_key_checks = 1");
        //log the deletion
        $admin_username = $_SESSION['fullname'];
        $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Deleted', 'Admin profile with username $admin_name was deleted', '$admin_username')";
        $conn->query($log);

        $_SESSION['mesType'] = "success";
        $_SESSION['mesText'] = "Admin Successfully Deleted!";

        //redirect to admins page
        header("Location: admins.php");
    } else {
        $conn->query("SET foreign_key_checks = 1");
        
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
    $conn->query("SET foreign_key_checks = 1");
}

//this is for section deletion
if(isset($_GET['sectionid']) && isset($_GET['sectionname'])){
    $sectionID = $_GET['sectionid']; //get the section id
    $sectionName = $_GET['sectionname'];//get the section name

    //check if the section id is being referenced
    $search_sql = "SELECT lrn FROM studentprofile WHERE sectionID = '$sectionID'";
    $result = mysqli_query($conn, $search_sql);
    if(mysqli_num_rows($result) > 0){//being referenced
        //can't be deleted
        $_SESSION['mesType'] = "warning";
        $_SESSION['mesText'] = "Profiles are registered on this Section! Please delete said profiles...";

        header("Location: sections.php");
    }else{//not being referenced
        //prepare delete sql statement
        $delete_sql = "DELETE FROM section WHERE sectionID = '$sectionID'";
        $delete_result = $conn->query($delete_sql);

        if($delete_result === TRUE){
            //log the deletion of section
            $admin_username = $_SESSION['fullname'];
            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Deleted', 'Section $sectionName was deleted', '$admin_username')";
            $conn->query($log);

            $_SESSION['mesType'] = "success";
            $_SESSION['mesText'] = "Section Successfully Deleted!";

            //redirect to sections page
            header("Location: sections.php");
        }else{
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
}

//this is for schoolyr deletion
if(isset($_GET['schoolyrid']) && isset($_GET['schoolyrname'])){
    $schoolyrID = $_GET['schoolyrid']; //get the id of school yr
    $schoolyrName = $_GET['schoolyrname']; //get the name of school yr

    //check if the schoolyr is being referenced
    $search_sql = "SELECT lrn FROM studentprofile WHERE schoolyrID = '$schoolyrID'";
    $result = mysqli_query($conn, $search_sql);
    if(mysqli_num_rows($result) > 0){//being referenced
        //can't be deleted
        $_SESSION['mesType'] = "warning";
        $_SESSION['mesText'] = "Profiles are registered on this School Year! Please delete said profiles...";

        header("Location: schoolyrs.php");
    }else{//not being referenced
        //prepare deletion sql statement
        $delete_sql = "DELETE FROM schoolyr WHERE schoolyrID = '$schoolyrID'";
        $delete_result = $conn->query($delete_sql);

        if($delete_result === TRUE){
            //log the deletion of schoolyr
            $admin_username = $_SESSION['fullname'];
            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Deleted', 'School Year $schoolyrName was deleted', '$admin_username')";
            $conn->query($log);

            $_SESSION['mesType'] = "success";
            $_SESSION['mesText'] = "School Year Successfully Deleted!";

            //redirect to schoolyr page
            header("Location: schoolyrs.php");
        }else{
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
}
?>