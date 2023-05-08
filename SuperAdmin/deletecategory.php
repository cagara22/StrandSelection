<?php
include "connection.php";

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql = "DELETE FROM `exam_category` WHERE `id`='$user_id'";

     $result = $link->query($sql);

     if ($result == TRUE) {

        echo "Record deleted successfully.";

    }else{

        echo "Error:" . $sql . "<br>" . $link->error;

    }

} 

?>

<script type ="text/javascript">
    window.location="exam_category.php"
    </script>