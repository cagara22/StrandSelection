<?php
include "connection.php";

if (isset($_GET['id1'])) {

    $id1 = $_GET['id1'];

    $id = $_GET['id'];

    $user_id = $_GET['id'];

    $sql = "DELETE FROM `questions` WHERE `id`='$id'";

    $result = $link->query($sql);

    if ($result == TRUE) {

        echo "Record deleted successfully.";
    } else {

        echo "Error:" . $sql . "<br>" . $link->error;
    }
}
?>

<script type="text/javascript">
    window.location = "add_edit_questions.php? &id=<?php echo $id1; ?>"
</script>