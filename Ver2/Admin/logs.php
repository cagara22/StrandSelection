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
    <link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="custom_css.css">
</head>

<body>
    <header class="navbar sticky-top flex-md-nowrap p-0 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./images/SystemBrandWhiteVer2.png" alt="Logo" width="200" height="34" class="d-inline-block align-text-top">
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
                        <li>
                            <a href="./backup.php" class="nav-link link-body-emphasis">
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
                        <li class="nav-item">
                            <a href="./logs.php" class="nav-link active" aria-current="page">
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
                        <li><a class="dropdown-item" href="#">Profile</a></li>
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
                    <h1 class="fw-bold sub-title">LOGS</h1>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Timestamp</th>
                            <th scope="col">Action</th>
                            <th scope="col">Details</th>
                            <th scope="col">Doer</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">xx:xx:xx xx/xx/xx</td>
                            <td class="text-center">Adding</td>
                            <td class="text-center">Added new User</td>
                            <td class="text-center">Admin01</td>
                            <td class="text-center">
                                <a href="" class="btn btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="DELETE">
                                    <img src="./images/delete.png" alt="" width="20" height="20" class="">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">xx:xx:xx xx/xx/xx</td>
                            <td class="text-center">Adding</td>
                            <td class="text-center">Added new User</td>
                            <td class="text-center">Admin01</td>
                            <td class="text-center">
                                <a href="" class="btn btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="DELETE">
                                    <img src="./images/delete.png" alt="" width="20" height="20" class="">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">xx:xx:xx xx/xx/xx</td>
                            <td class="text-center">Adding</td>
                            <td class="text-center">Added new User</td>
                            <td class="text-center">Admin01</td>
                            <td class="text-center">
                                <a href="" class="btn btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="DELETE">
                                    <img src="./images/delete.png" alt="" width="20" height="20" class="">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">xx:xx:xx xx/xx/xx</td>
                            <td class="text-center">Adding</td>
                            <td class="text-center">Added new User</td>
                            <td class="text-center">Admin01</td>
                            <td class="text-center">
                                <a href="" class="btn btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="DELETE">
                                    <img src="./images/delete.png" alt="" width="20" height="20" class="">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">xx:xx:xx xx/xx/xx</td>
                            <td class="text-center">Adding</td>
                            <td class="text-center">Added new User</td>
                            <td class="text-center">Admin01</td>
                            <td class="text-center">
                                <a href="" class="btn btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="DELETE">
                                    <img src="./images/delete.png" alt="" width="20" height="20" class="">
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>