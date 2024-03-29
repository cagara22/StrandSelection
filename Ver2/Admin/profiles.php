<?php
//Start the session and check if the admin is logged in or not
session_start();

if (!isset($_SESSION["admin"])) {
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    <span class="fs-4"><?php echo $_SESSION['role']; //Display the role ?></span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="./dashboard.php" class="nav-link link-body-emphasis">
                            <img src="./images/dashboard.png" alt="" width="16" height="16" class="bi pe-none me-2">
                            DASHBOARD
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./profiles.php" class="nav-link active" aria-current="page">
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
                                S.Y.
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
            <?php
                if(isset($_SESSION['mesType'])){
                    $mesType = $_SESSION['mesType'];
                    $mesText = $_SESSION['mesText'];

                    echo "<script>Swal.fire({
                        icon: '". $mesType ."',
                        title: '". $mesText ."',
                        toast: true,
                        position: 'top-end',
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast',
                          },
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        });</script>";
                    
                    unset($_SESSION['mesType']);
                    unset($_SESSION['mesText']);
                }
            ?>
            <section class="section-100 d-flex flex-column py-2">
                <?php include "connection.php"; //include the connection file ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title">PROFILES</h1>
                </div>
                <form class="row g-3" method="GET" action="">
                    <div class="col-10 mb-3">
                        <input type="text" class="form-control" id="searchname" name="searchname" oninput="validateSearch(this)" placeholder="Search...">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-search w-100 fw-bold" name="search">SEARCH</button>
                    </div>
                </form>
                <form class="row g-3" method="GET" action="">
                <?php
                    if($_SESSION['role'] === 'ADMIN'){
                        $adminid = $_SESSION['adminID'];
                        $sql = "SELECT * FROM section WHERE adminID = $adminid";
                    }else{
                        $sql = "SELECT * FROM section";
                    }

                    $result = $conn->query($sql);
                    ?>
                    <div class="col-12 col-md-5">
                        <div class="form-floating mb-2">
                            <select class="form-select form-select-sm" id="section" name="section" value="" required>
                                <?php
                                if(isset($_GET['filter'])){
                                    if($_SESSION['role'] != 'ADMIN'){
                                        echo '<option value="0">ALL</option>';
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        if ($_GET['section'] == $row['sectionID']) {
                                            echo '<option value="' . $row['sectionID'] . '" selected>' . $row['sectionName'] . '</option>';
                                        } else {
                                            echo '<option value="' . $row['sectionID'] . '">' . $row['sectionName'] . '</option>';
                                        }
                                    }
                                }else{
                                    if($_SESSION['role'] != 'ADMIN'){
                                        echo '<option value="0">ALL</option>';
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['sectionID'] . '">' . $row['sectionName'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <label for="section">Section</label>
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM schoolyr ORDER BY schoolyrID DESC";

                    $result = $conn->query($sql);
                    ?>
                    <div class="col-12 col-md-5">
                        <div class="form-floating mb-2">
                            <select class="form-select form-select-sm" id="schoolyr" name="schoolyr" value="">
                                <?php
                                if(isset($_GET['filter'])){
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
                    <div class="col-2 d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-view w-100 fw-bold" name="filter">FILTER</button>
                    </div>
                </form>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end py-3">
                    <a class="btn btn-add fw-bold w-100" href="addprofile.php" role="button">ADD NEW PROFILE</a>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">LRN</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Suffix</th>
                            <th scope="col">Age</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Section</th>
                            <th scope="col">School Year</th>
                            <th scope="col">Qualified Strand</th>
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

                        if(isset($_GET['filter'])){
                            if($_GET['section'] == 0){
                                $sectionIDFilter = "section.sectionID";
                            }else{
                                $sectionIDFilter = $_GET['section'];
                            }
                            
                            $schoolyrIDFilter = $_GET['schoolyr'];
                        }else{
                            $sectionIDFilter = "section.sectionID";

                            $schoolyr_sql = "SELECT * FROM schoolyr ORDER BY schoolyrID DESC LIMIT 1";
                            $schoolyr_result = $conn->query($schoolyr_sql);
                            $schoolyr_row = $schoolyr_result->fetch_assoc();
                            $current_schoolyr_ID = $schoolyr_row['schoolyrID'];
                            $schoolyrIDFilter = $current_schoolyr_ID;
                        }

                        if($_SESSION['role'] === "ADMIN"){//admin role
                            $adminID = $_SESSION['adminID'];
                            if (isset($_GET['searchname'])) {// if search is clicked
                                $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                $sql = "SELECT * FROM studentprofile
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE (CONCAT(Fname, ' ', Lname) LIKE '%$search%' OR studentprofile.lrn LIKE '%$search%') AND section.adminID = $adminID LIMIT $offset, $total_records_per_page";
                            } else {//retrive all student profiles
                                $sql = "SELECT * FROM studentprofile
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE section.adminID = $adminID AND schoolyr.schoolyrID = $schoolyrIDFilter AND section.sectionID = $sectionIDFilter LIMIT $offset, $total_records_per_page";
                            }
                        }else{//super admin role
                            if (isset($_GET['searchname'])) {// if search is clicked
                                $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                $sql = "SELECT * FROM studentprofile
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE CONCAT(Fname, ' ', Lname) LIKE '%$search%' OR studentprofile.lrn LIKE '%$search%' LIMIT $offset, $total_records_per_page";
                            } else {//retrive all student profiles
                                $sql = "SELECT * FROM studentprofile
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE schoolyr.schoolyrID = $schoolyrIDFilter AND section.sectionID = $sectionIDFilter ORDER BY studentprofile.sectionID LIMIT $offset, $total_records_per_page";
                            }
                        }

                        // Calculate the next and previous page numbers before executing the query
                        $next_page = $page_no + 1;
                        $previous_page = $page_no - 1;

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='text-center'>" . $row['lrn'] . "</td>";
                                echo "<td class='text-center'>" . $row['Fname'] . "</td>";
                                echo "<td class='text-center'>" . $row['Mname'] . "</td>";
                                echo "<td class='text-center'>" . $row['Lname'] . "</td>";
                                echo "<td class='text-center'>" . $row['suffix'] . "</td>";
                                echo "<td class='text-center'>" . $row['age'] . "</td>";
                                echo "<td class='text-center'>" . $row['sex'] . "</td>";
                                echo "<td class='text-center'>" . $row['sectionName'] . "</td>";
                                echo "<td class='text-center'>" . $row['schoolyrName'] . "</td>";
                                echo "<td class='text-center'>" . $row['MostSuitableStrand'] . "</td>";
                                $fullName = $row['Fname'] . " " . $row['Lname'];
                                echo "<td class='text-center'>
            <a href='#' onclick='deleteRecord(\"". $row['lrn'] ."\")' class ='btn btn-delete' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='DELETE'>
                <img src='./images/delete.png' alt='' width='20' height='20' class=''>
            </a> 
            <a href='viewprofile.php?lrn=" . $row['lrn'] . "&name=". $fullName ."' class='btn btn-view' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='VIEW'>
                <img src='./images/view.png' alt='' width='20' height='20' class=''>
            </a>
        </td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<tr><td colspan='12' class='text-center'>0 results</td></tr>";
                        }

                        if($_SESSION['role'] === "ADMIN"){
                            if(isset($_GET['searchname'])){
                                $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                $sql = "SELECT COUNT(*) AS total_records FROM studentprofile
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE (CONCAT(Fname, ' ', Lname) LIKE '%$search%' OR studentprofile.lrn LIKE '%$search%') AND section.adminID = $adminID";
                            }else{
                                $sql = "SELECT COUNT(*) AS total_records FROM studentprofile 
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE section.adminID = $adminID AND schoolyr.schoolyrID = $schoolyrIDFilter AND section.sectionID = $sectionIDFilter";
                            }
                        }else{
                            if(isset($_GET['searchname'])){
                                $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                $sql = "SELECT COUNT(*) AS total_records FROM studentprofile
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE CONCAT(Fname, ' ', Lname) LIKE '%$search%' OR studentprofile.lrn LIKE '%$search%'";
                            }else{
                                $sql = "SELECT COUNT(*) AS total_records FROM studentprofile
                                JOIN section ON studentprofile.sectionID = section.sectionID
                                JOIN schoolyr ON studentprofile.schoolyrID = schoolyr.schoolyrID
                                JOIN result ON studentprofile.lrn = result.lrn WHERE schoolyr.schoolyrID = $schoolyrIDFilter AND section.sectionID = $sectionIDFilter";
                            }
                        }
                        $result = $conn->query($sql);
                        $total_records = $result->fetch_assoc()['total_records'];
                        $total_no_of_pages = ceil($total_records / $total_records_per_page);
                        ?>

                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                            if(isset($_GET['searchname'])){
                                $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                $previouslink = "?searchname=" . $search . "&search=&page_no=" . $previous_page;
                                $nextlink = "?searchname=" . $search . "&search=&page_no=" . $next_page;
                            }else if(isset($_GET['filter'])){
                                $sectionIDFilter = $_GET['section'];
                                $schoolyrIDFilter = $_GET['schoolyr'];
                                $previouslink = "?section=" . $sectionIDFilter . "&schoolyr=" . $schoolyrIDFilter . "&filter=&page_no=" . $previous_page;
                                $nextlink = "?section=" . $sectionIDFilter . "&schoolyr=" . $schoolyrIDFilter . "&filter=&page_no=" . $next_page;
                            }else{
                                $previouslink = "?page_no=". $previous_page;
                                $nextlink = "?page_no=" . $next_page;
                            }
                        ?>
                        <li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=' . $previouslink : ''; ?>>Previous</a></li>
                        <?php 
                            $max_visible_buttons = 15;
                            $start = max(1, $page_no - floor($max_visible_buttons / 2));
                            $end = min($start + $max_visible_buttons - 1, $total_no_of_pages);

                            if ($end - $start + 1 < $max_visible_buttons) {
                                $start = max(1, $end - $max_visible_buttons + 1);
                            }

                            for ($counter = $start; $counter <= $end; $counter++) {
                                if(isset($_GET['searchname'])){
                                    $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                    $numberlink = "?searchname=" . $search . "&search=&page_no=" . $counter;
                                }else if(isset($_GET['filter'])){
                                    $sectionIDFilter = $_GET['section'];
                                    $schoolyrIDFilter = $_GET['schoolyr'];
                                    $numberlink = "?section=" . $sectionIDFilter . "&schoolyr=" . $schoolyrIDFilter . "&filter=&page_no=" . $counter;
                                }else{
                                    $numberlink = "?page_no=". $counter;
                                }
                        ?>
                                <li class="page-item"><a class="page-link" href="<?= $numberlink; ?>">
                                        <?= $counter; ?></a></li>
                        <?php 
                            } 
                        ?>
                        <li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?>" <?= ($page_no < $total_no_of_pages) ? 'href=' . $nextlink : ''; ?>>Next</a></li>
                    </ul>
                </nav>

                <div class="p-10">
                    <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></strong>
                </div>
            </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script>
        //for delete confirmation
        async function deleteRecord(clientNum) {
            await Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    window.location.href = `delete.php?lrn=${clientNum}`;
                } else {
                    Swal.fire("CANCELED", "Record not deleted!", "info");
                }
            });
        }

        function validateSearch(input) {
            var regex = /^[a-zA-Z0-9\sñÑ-]*$/; // Regular expression to allow only alphanumeric characters and spaces

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z0-9\sñÑ-]/g, ''); // Remove any special characters
            }
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>