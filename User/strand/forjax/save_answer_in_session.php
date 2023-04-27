<?php
session_start();

if (isset($_GET['questionno']) && isset($_GET['value1'])) {
    $questionno = $_GET['questionno'];
    $value1 = $_GET['value1'];
    $_SESSION['answer'][$questionno] = $value1;
}

?>