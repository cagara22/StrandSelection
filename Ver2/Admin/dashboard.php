<?php
//Start the session and check if the admin is logged in or not
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                    <span class="fs-4"><?php echo $_SESSION['role']; //Display the role ?></span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="./dashboard.php" class="nav-link active" aria-current="page">
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
                    
                    if($_SESSION['role'] == 'SUPER ADMIN'){ //Restrict the rest of the page to Super Admin only
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
                        <strong><?php echo $_SESSION['admin']; //Display the admin username ?></strong>
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
                    <h1 class="fw-bold sub-title">DASHBOARD</h1>
                </div>
                <div class="row">
                    <div class="col-4 d-flex justify-content-center align-items-center py-1">
                        <div class="card w-100 text-bg-yellow">
                            <div class="card-body">
                                <h5 class="card-title">No. of Profiles:</h5>
                                <div class="text-center">
                                <?php
                                //get the count of all profiles
								$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
								$query = "SELECT lrn FROM studentprofile ORDER BY lname";
								$query_run = mysqli_query($conn, $query);
								$row = mysqli_num_rows($query_run);
								echo "<p class='card-text fs-1 fw-bold'>$row</p>";
								?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center py-1">
                        <div class="card w-100 text-bg-blue">
                            <div class="card-body">
                                <h5 class="card-title">No. of Admins:</h5>
                                <div class="text-center">
                                <?php
                                //get the count of all the admins
								$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
								$query = "SELECT fname FROM adminprofile ORDER BY lname";
								$query_run = mysqli_query($conn, $query);
								$row = mysqli_num_rows($query_run);
								echo "<p class='card-text fs-1 fw-bold'>$row</p>";
								?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center py-1">
                        <div class="card w-100 text-bg-red">
                            <div class="card-body">
                                <h5 class="card-title">No. of Logs:</h5>
                                <div class="text-center">
                                <?php
                                //get the count of all the logs
								$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
								$query = "SELECT id FROM logs ORDER BY `timestamp`";
								$query_run = mysqli_query($conn, $query);
								$row = mysqli_num_rows($query_run);
								echo "<p class='card-text fs-1 fw-bold'>$row</p>";
								?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <canvas id="graph1"></canvas>
                        <p>LEGENDS:
                            <small class="fw-bold" style="color: rgba(112,214,255,1.0);">STEM</small> -
                            <small class="fw-bold" style="color: rgba(255,112,166,1.0);">HUMSS</small> -
                            <small class="fw-bold" style="color: rgba(255,151,112,1.0);">ABM</small> -
                            <small class="fw-bold" style="color: rgba(255,214,112,1.0);">GAS</small> -
                            <small class="fw-bold" style="color: rgba(233,255,112,1.0);">TVL-ICT</small> -
                            <small class="fw-bold" style="color: rgba(104,122,0,1.0);">TVL-HE</small>
                        </p>
                    </div>
                    <div class="col-6">
                        <canvas id="graph2"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        const schyr = ["0", "2023-2024", "2024-2025", "2025-2026", "2026-2027"];

        new Chart("graph1", {
            type: "line",
            data: {
                labels: schyr,
                datasets: [{
                    data: [0, 100, 150, 150, 250],
                    borderColor: "rgba(112,214,255,1.0)",
                    fill: false
                }, {
                    data: [0, 25, 100, 150, 200],
                    borderColor: "rgba(255,112,166,1.0)",
                    fill: false
                }, {
                    data: [0, 10, 50, 30, 50],
                    borderColor: "rgba(255,151,112,1.0)",
                    fill: false
                }, {
                    data: [0, 20, 50, 10, 250],
                    borderColor: "rgba(255,214,112,1.0)",
                    fill: false
                }, {
                    data: [0, 10, 15, 10, 25],
                    borderColor: "rgba(233,255,112,1.0)",
                    fill: false
                }, {
                    data: [0, 40, 50, 15, 25],
                    borderColor: "rgba(104,122,0,1.0)",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Strand Suggestions per School Year"
                },
                legend: {
                    display: false
                }
            }
        });

        var labels = ["STEM", "HUMSS", "ABM", "GAS", "TVL-ICT", "TVL-HE"];
        var values = [100, 25, 10, 20, 10, 40];
        var barColors = [
            "rgba(112,214,255,1.0)",
            "rgba(255,112,166,1.0)",
            "rgba(255,151,112,1.0)",
            "rgba(255,214,112,1.0)",
            "rgba(233,255,112,1.0)",
            "rgba(104,122,0,1.0)",
        ];

        new Chart("graph2", {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    backgroundColor: barColors,
                    data: values
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Strand Suggestions for Current School Year"
                }
            }
        });
    </script>
</body>

</html>