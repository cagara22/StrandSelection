<?php
//Start the session and check if the admin is logged in or not
session_start();

if (!isset($_SESSION["admin"]) || $_SESSION['role'] === "ADMIN") {
    header("Location: index.php");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="custom_css.css">
</head>

<body>
    <header class="navbar sticky-top flex-md-nowrap p-0 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="./dashboard.php">
                <img src="./images/GUIDE_Logo_3.png" alt="Logo" width="150" height="37" class="d-inline-block align-text-top">
            </a>
        </div>
    </header>

    <main class="row section-100">
        <div class="col-2">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 100%; height: 100%;" id="sidebarMenu">
                <a href="adminprofile.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
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
                                S.Y.
                            </a>
                        </li>
                        <li>
                            <a href="./backup.php" class="nav-link link-body-emphasis">
                                <img src="./images/backup.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                BACKUP
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./reports.php" class="nav-link active" aria-current="page">
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
                <?php include "connection.php"; //include the conneciton file ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title">REPORTS</h1>
                </div>
                <div class="row w-100">
                    <div class="col-12">
                        <div class="row w-100">
                            <div class="col-5">
                                <?php
                                $sql = "SELECT * FROM schoolyr ORDER BY schoolyrID DESC";

                                $result = $conn->query($sql);
                                ?>
                                <form class="row g-3" method="GET" action="">
                                    <div class="col-12 col-md-9">
                                        <div class="form-floating mb-2">
                                            <select class="form-select form-select-sm" id="schoolyr" name="schoolyr" value="">
                                                <?php
                                                if(isset($_GET['show'])){
                                                    while ($row = $result->fetch_assoc()) {
                                                        if ($_GET['schoolyr'] == $row['schoolyrID']) {
                                                            echo '<option value="' . $row['schoolyrID'] . '" selected>' . $row['schoolyrName'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $row['schoolyrID'] . '">' . $row['schoolyrName'] . '</option>';
                                                        }
                                                    }
                                                }else{
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row['schoolyrID'] . '">' . $row['schoolyrName'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label for="schoolyr">School Year</label>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-view w-100 fw-bold" name="show">SHOW</button>
                                    </div>
                                </form>
                                <?php
                                if(isset($_GET['show'])){
                                    $current_schoolyr_ID = $_GET['schoolyr'];
                                }else{
                                    $schoolyr_sql = "SELECT * FROM schoolyr ORDER BY schoolyrID DESC LIMIT 1";
                                    $schoolyr_result = $conn->query($schoolyr_sql);
                                    $schoolyr_row = $schoolyr_result->fetch_assoc();
                                    $current_schoolyr_ID = $schoolyr_row['schoolyrID'];
                                    $current_schoolyr_Name = $schoolyr_row['schoolyrName'];
                                }
                    
                                $countStrand_sql = "SELECT 
                                        schoolyrID, 
                                        SUM(CASE WHEN result.MostSuitableStrand = 'STEM' THEN 1 ELSE 0 END) AS STEM_count, 
                                        SUM(CASE WHEN result.MostSuitableStrand = 'HUMSS' THEN 1 ELSE 0 END) AS HUMSS_count, 
                                        SUM(CASE WHEN result.MostSuitableStrand = 'ABM' THEN 1 ELSE 0 END) AS ABM_count, 
                                        SUM(CASE WHEN result.MostSuitableStrand = 'GAS' THEN 1 ELSE 0 END) AS GAS_count, 
                                        SUM(CASE WHEN result.MostSuitableStrand = 'TVL-ICT' THEN 1 ELSE 0 END) AS TVLICT_count, 
                                        SUM(CASE WHEN result.MostSuitableStrand = 'TVL-HE' THEN 1 ELSE 0 END) AS TVLHE_count 
                                    FROM 
                                        studentprofile
                                    JOIN
                                        result ON studentprofile.lrn = result.lrn
                                    WHERE 
                                        schoolyrID = '". $current_schoolyr_ID ."'
                                    GROUP BY 
                                        schoolyrID";
                                
                                $countStrand_result = $conn->query($countStrand_sql);
                                if($countStrand_result->num_rows > 0){
                                    $countStrand_row = $countStrand_result->fetch_assoc();
                                    $count_stem = $countStrand_row['STEM_count'];
                                    $count_humss = $countStrand_row['HUMSS_count'];
                                    $count_abm = $countStrand_row['ABM_count'];
                                    $count_gas = $countStrand_row['GAS_count'];
                                    $count_tvlict = $countStrand_row['TVLICT_count'];
                                    $count_tvlhe = $countStrand_row['TVLHE_count'];
                                }else{
                                    $count_stem = 0;
                                    $count_humss = 0;
                                    $count_abm = 0;
                                    $count_gas = 0;
                                    $count_tvlict = 0;
                                    $count_tvlhe = 0;
                                }
                                ?>
                                <div class="row w-100">
                                    <div class="col-6 d-flex justify-content-center align-items-center py-1">
                                        <div class="card w-75 text-STEM-bg">
                                            <div class="card-body">
                                                <h5 class="card-title">STEM</h5>
                                                <div class="text-center">
                                                    <p class='card-text fs-1 fw-bold'><?php echo $count_stem ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-center py-1">
                                        <div class="card w-75 text-HUMSS-bg">
                                            <div class="card-body">
                                                <h5 class="card-title">HUMSS</h5>
                                                <div class="text-center">
                                                    <p class='card-text fs-1 fw-bold'><?php echo $count_humss ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-center py-1">
                                        <div class="card w-75 text-ABM-bg">
                                            <div class="card-body">
                                                <h5 class="card-title">ABM</h5>
                                                <div class="text-center">
                                                    <p class='card-text fs-1 fw-bold'><?php echo $count_abm ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-center py-1">
                                        <div class="card w-75 text-GAS-bg">
                                            <div class="card-body">
                                                <h5 class="card-title">GAS</h5>
                                                <div class="text-center">
                                                    <p class='card-text fs-1 fw-bold'><?php echo $count_gas ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-center py-1">
                                        <div class="card w-75 text-TVLICT-bg">
                                            <div class="card-body">
                                                <h5 class="card-title">TVL-ICT</h5>
                                                <div class="text-center">
                                                    <p class='card-text fs-1 fw-bold'><?php echo $count_tvlict ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-center py-1">
                                        <div class="card w-75 text-TVLHE-bg">
                                            <div class="card-body">
                                                <h5 class="card-title">TVL-HE</h5>
                                                <div class="text-center">
                                                    <p class='card-text fs-1 fw-bold'><?php echo $count_tvlhe ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 d-flex justify-content-between align-items-center">
                                <div class="row">
                                    <div class="col-12"><canvas id="graph1"></canvas></div>
                                    <p>LEGENDS:
                                        <small class="fw-bold" style="color: rgba(112,214,255,1.0);">STEM</small> -
                                        <small class="fw-bold" style="color: rgba(255,112,166,1.0);">HUMSS</small> -
                                        <small class="fw-bold" style="color: rgba(255,151,112,1.0);">ABM</small> -
                                        <small class="fw-bold" style="color: rgba(255,214,112,1.0);">GAS</small> -
                                        <small class="fw-bold" style="color: rgba(91,95,151,1.0);">TVL-ICT</small> -
                                        <small class="fw-bold" style="color: rgba(104,122,0,1.0);">TVL-HE</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-4">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">ID</th>
                                    <th scope="col">School Year</th>
                                    <th scope="col">No. of STEM</th>
                                    <th scope="col">No. of HUMSS</th>
                                    <th scope="col">No. of ABM</th>
                                    <th scope="col">No. of GAS</th>
                                    <th scope="col">No. of TVL-ICT</th>
                                    <th scope="col">No. of TVL-HE</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                                <?php

                                //for pagination
                                if (isset($_GET['page_no'])) {
                                    $page_no = $_GET['page_no'];
                                } else {
                                    $page_no = 1;
                                }

                                $total_records_per_page = 30;
                                $offset = ($page_no - 1) * $total_records_per_page;

                                $sql = "SELECT 
                                    studentprofile.schoolyrID,
                                    schoolyr.schoolyrName,
                                    SUM(CASE WHEN result.MostSuitableStrand = 'STEM' THEN 1 ELSE 0 END) AS STEM_count, 
                                    SUM(CASE WHEN result.MostSuitableStrand = 'HUMSS' THEN 1 ELSE 0 END) AS HUMSS_count, 
                                    SUM(CASE WHEN result.MostSuitableStrand = 'ABM' THEN 1 ELSE 0 END) AS ABM_count, 
                                    SUM(CASE WHEN result.MostSuitableStrand = 'GAS' THEN 1 ELSE 0 END) AS GAS_count, 
                                    SUM(CASE WHEN result.MostSuitableStrand = 'TVL-ICT' THEN 1 ELSE 0 END) AS TVLICT_count, 
                                    SUM(CASE WHEN result.MostSuitableStrand = 'TVL-HE' THEN 1 ELSE 0 END) AS TVLHE_count 
                                FROM 
                                    studentprofile
                                JOIN
                                    result ON studentprofile.lrn = result.lrn
                                JOIN
                                    schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                GROUP BY 
                                    schoolyrID";


                                // Calculate the next and previous page numbers before executing the query
                                $next_page = $page_no + 1;
                                $previous_page = $page_no - 1;

                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>". $row['schoolyrID'] ."</td>";
                                        echo "<td class='text-center'>". $row['schoolyrName'] ."</td>";
                                        echo "<td class='text-center'>". $row['STEM_count'] ."</td>";
                                        echo "<td class='text-center'>". $row['HUMSS_count'] ."</td>";
                                        echo "<td class='text-center'>". $row['ABM_count'] ."</td>";
                                        echo "<td class='text-center'>". $row['GAS_count'] ."</td>";
                                        echo "<td class='text-center'>". $row['TVLICT_count'] ."</td>";
                                        echo "<td class='text-center'>". $row['TVLHE_count'] ."</td>";
                                        echo "<td class='text-center'>";
                                        echo "<a href='printpdf.php?schoolyrID=". $row['schoolyrID'] ."&schoolyrName=". $row['schoolyrName'] ."'  target='_blank' class='btn btn-view' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='PRINT'>
                                        <img src='./images/print.png' alt='' width='20' height='20' class=''>
                                        </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='9' class='text-center'>0 results</td></tr>";
                                }

                                $sql = "SELECT COUNT(*) AS total_records FROM schoolyr";
                                $result = $conn->query($sql);
                                $total_records = $result->fetch_assoc()['total_records'];
                                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                ?>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>>Previous</a></li>
                                <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
                                    <li class="page-item"><a class="page-link" href="?page_no=<?= $counter; ?>">
                                            <?= $counter; ?></a></li>
                                <?php } ?>
                                <li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page : ''; ?>>Next</a></li>
                            </ul>
                        </nav>

                        <div class="p-10">
                            <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></strong>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        <?php
        $schoolyr_sql = "SELECT * FROM schoolyr";
        $schoolyr_result = $conn->query($schoolyr_sql);
        $schlyr = array("0");
        $stemcount = array(0);
        $humsscount = array(0);
        $abmcount = array(0);
        $gascount = array(0);
        $tvlictcount = array(0);
        $tvlhecount = array(0);
        if($schoolyr_result->num_rows > 0){
            while($schoolyr_row = $schoolyr_result->fetch_assoc()){
                array_push($schlyr, $schoolyr_row['schoolyrName']);
            }

            $countStrand_sql = "SELECT 
                    schoolyrID, 
                    SUM(CASE WHEN result.MostSuitableStrand = 'STEM' THEN 1 ELSE 0 END) AS STEM_count, 
                    SUM(CASE WHEN result.MostSuitableStrand = 'HUMSS' THEN 1 ELSE 0 END) AS HUMSS_count, 
                    SUM(CASE WHEN result.MostSuitableStrand = 'ABM' THEN 1 ELSE 0 END) AS ABM_count, 
                    SUM(CASE WHEN result.MostSuitableStrand = 'GAS' THEN 1 ELSE 0 END) AS GAS_count, 
                    SUM(CASE WHEN result.MostSuitableStrand = 'TVL-ICT' THEN 1 ELSE 0 END) AS TVLICT_count, 
                    SUM(CASE WHEN result.MostSuitableStrand = 'TVL-HE' THEN 1 ELSE 0 END) AS TVLHE_count 
                FROM 
                    studentprofile
                JOIN
                    result ON studentprofile.lrn = result.lrn
                GROUP BY 
                    schoolyrID";
            
            $countStrand_result = $conn->query($countStrand_sql);
            if($countStrand_result->num_rows > 0){
                while($countStrand_row = $countStrand_result->fetch_assoc()){
                    array_push($stemcount, $countStrand_row['STEM_count']);
                    array_push($humsscount, $countStrand_row['HUMSS_count']);
                    array_push($abmcount, $countStrand_row['ABM_count']);
                    array_push($gascount, $countStrand_row['GAS_count']);
                    array_push($tvlictcount, $countStrand_row['TVLICT_count']);
                    array_push($tvlhecount, $countStrand_row['TVLHE_count']);
                }
            }
        }

        $schlyrJSON = json_encode($schlyr);
        $stemcountJSON = json_encode($stemcount);
        $humsscountJSON = json_encode($humsscount);
        $abmcountJSON = json_encode($abmcount);
        $gascountJSON = json_encode($gascount);
        $tvlictcountJSON = json_encode($tvlictcount);
        $tvlhecountJSON = json_encode($tvlhecount);
        ?>

        var schyr = <?php echo $schlyrJSON; ?>;
        var stem = <?php echo $stemcountJSON; ?>;
        var humss = <?php echo $humsscountJSON; ?>;
        var abm = <?php echo $abmcountJSON; ?>;
        var gas = <?php echo $gascountJSON; ?>;
        var tvlict = <?php echo $tvlictcountJSON; ?>;
        var tvlhe = <?php echo $tvlhecountJSON; ?>;

        new Chart("graph1", {
            type: "line",
            data: {
                labels: schyr,
                datasets: [{
                    data: stem,
                    borderColor: "rgba(112,214,255,1.0)",
                    fill: false
                }, {
                    data: humss,
                    borderColor: "rgba(255,112,166,1.0)",
                    fill: false
                }, {
                    data: abm,
                    borderColor: "rgba(255,151,112,1.0)",
                    fill: false
                }, {
                    data: gas,
                    borderColor: "rgba(255,214,112,1.0)",
                    fill: false
                }, {
                    data: tvlict,
                    borderColor: "rgba(91,95,151,1.0)",
                    fill: false
                }, {
                    data: tvlhe,
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

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>