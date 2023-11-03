<?php
session_start();

if (!isset($_SESSION["admin"])) {

?>
    <script type="text/javascript">
        window.location = "index.php";
    </script>
<?php

}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GUIDE Admin</title>
    <link rel="icon" type="images/x-icon" href="images/GUIDE_Logo_2.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="custom_css.css">
</head>

<body>
    <header class="navbar sticky-top flex-md-nowrap p-0 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./images/GUIDE_Logo_3.png" alt="Logo" width="150" height="37" class="d-inline-block align-text-top">
            </a>
        </div>
    </header>

    <main class="row section-100">
        <div class="col-2">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 100%; height: 100%;" id="sidebarMenu">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <span class="fs-4"><?php echo $_SESSION['role']; ?></span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="./dashboard.php" class="nav-link link-body-emphasis">
                            <img src="./images/dashboard.png" alt="" width="16" height="16" class="bi pe-none me-2">
                            DASHBOARD
                        </a>
                    </li>
                    <li>
                        <a href="./profiles.php" class="nav-link link-body-emphasis">
                            <img src="./images/profiles.png" alt="" width="16" height="16" class="bi pe-none me-2">
                            PROFILES
                        </a>
                    </li>
                    <?php
                    
                    if($_SESSION['role'] == 'SUPER ADMIN'){
                        echo '
                        <li>
                            <a href="./admins.php" class="nav-link link-body-emphasis">
                                <img src="./images/admins.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                ADMINS
                            </a>
                        </li>
                        <li>
                            <a href="./sections.php" class="nav-link link-body-emphasis">
                                <img src="./images/section.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                SECTIONS
                            </a>
                        </li>
                        <li>
                            <a href="./schoolyrs.php" class="nav-link link-body-emphasis">
                                <img src="./images/schoolyr.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                SCHLYRS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./backup.php" class="nav-link active" aria-current="page">
                                <img src="./images/backup.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                BACKUP
                            </a>
                        </li>
                        <li>
                            <a href="./reports.php" class="nav-link link-body-emphasis">
                                <img src="./images/reports.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                REPORTS
                            </a>
                        </li>
                        <li>
                            <a href="./logs.php" class="nav-link link-body-emphasis">
                                <img src="./images/logs.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                LOGS
                            </a>
                        </li>
                        ';
                    }
                    
                    ?>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./images/man.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?php echo $_SESSION['admin']; ?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li><a class="dropdown-item" href="adminprofile.php">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-10">
            <section class="section-100 d-flex flex-column py-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title">BACKUP & RESTORE</h1>
                </div>
                <div class="row w-100">
                    <div class="col-6">
                        <div class="card custcard border-light text-center" style="width: 100%;">
                            <div class="card-header">
                                <h4 class="fw-bold card-text-header">CREATE BACKUP FILE</h4>
                            </div>
                            <div class="card-body">
                                <img src="./images/recovery.png" class="cust-img-50 rounded-start" alt="...">
                                <p>This button creates a backup SQL file that stores all the data in the database that you can use to restore the databse. Please take note where the file will be downloaded.</p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a class="btn btn-add btn-lg fw-bold" href="./backup_temp/backupscript.php" role="button">CREATE NEW BACKUP</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <?php
                            include "connection.php";

                            if(isset($_POST['restore'])){
                                $conn->query("SET foreign_key_checks = 0");
                
                                if (isset($_FILES['backupFile'])) {
                                    $clearTablesQuery = "SHOW TABLES";
                                    $tableresult = mysqli_query($conn, $clearTablesQuery);
                                    if($tableresult->num_rows > 0){
                                        while ($row = mysqli_fetch_row($tableresult)) {
                                            $tableName = $row[0];
                                            $clearQuery = "DROP TABLE IF EXISTS $tableName";
                                            mysqli_query($conn, $clearQuery);
                                        }
                                    }
                
                                    $backup_file = $_FILES["backupFile"]["tmp_name"];
                
                                    if ($backup_file !== "") {
                                        $sql_content = file_get_contents($backup_file);
                
                                        $sql_array = explode(";", $sql_content);
                
                                        $error_message = "";
                
                                        foreach ($sql_array as $sql) {
                                            if (trim($sql) != "") {
                                                $result = $conn->query($sql);
                                                if (!$result) {
                                                    $error_message = $conn->error;
                                                    break;
                                                }
                                            }
                                        }
                                        
                                        if (empty($error_message)) {
                                            $role = $_SESSION['role'];
                                            $username = $_SESSION['admin'];
                                            $admin_username = $_SESSION['fullname'];
                                            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Restore', '$role with Username $username restored the database', '$admin_username')";
                                            $conn->query($log);
                                            
                                            echo "<script>Swal.fire({
                                                title: 'DATABASE SUCCESSFULLY RESTORED',
                                                icon: 'success',
                                                showConfirmButton: false,
                                                timer: 5000
                                                });</script>";
                                        } else {
                                            echo "<script>alert('Error restoring database: $error_message');</script>";
                                        }
                                    }
                                    $conn->query("SET foreign_key_checks = 1");
                                }
                            }
                        ?>
                        <div class="card custcard border-light text-center" style="width: 100%;">
                            <div class="card-header">
                                <h4 class="fw-bold card-text-header">RESTORE POINT</h4>
                            </div>
                            <div class="card-body">
                                <img src="./images/restore.png" class="cust-img-50 rounded-start" alt="...">
                                <form class="row g-3" method="post" action="" enctype="multipart/form-data" onsubmit="return confirmRestore()">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <div class="mb-3">
                                            <label for="backupFile" class="form-label">Input Backup .sql file</label>
                                            <input class="form-control" type="file" id="backupFile" name="backupFile" accept=".sql">
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button type="submit" class="btn btn-search w-25 fw-bold" name="restore">RESTORE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script>
        function confirmRestore() {
            if (confirm('Restoring the database will delete all current data. Cick OK if you know the consequences of the action and you want to proceed?')) {
                return true;
            } else {
                return false;
            }
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>