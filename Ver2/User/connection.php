<?php
    //Database creds
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'dss_db';

    // Establish database connection
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name) or die('Unable to connect to database');

    //Inportant Variables
    // Define the R script path
    $r_scriptexe_path = '"C:\Program Files\R\R-4.2.2\bin\Rscript.exe"';
    $r_script_path = '"C:\xampp\htdocs\StrandSelection\Ver2\Model\predictStrand.R"';
    $jsonfile_path = '"C:\xampp\htdocs\StrandSelection\Ver2\Model\\';

    //GPT API Key
    $apiKey = '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';
?>