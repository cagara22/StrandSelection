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
                    <li class="nav-item">
                        <a href="./profiles.php" class="nav-link active" aria-current="page">
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
                    <h1 class="fw-bold sub-title">PROFILES</h1>
                </div>
                <form class="row g-3" method="GET" action="">
                    <div class="col-10">
                        <input type="text" class="form-control" id="searchname" name="searchname" placeholder="Search...">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-search w-100 fw-bold" name="search">SEARCH</button>
                    </div>
                </form>
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
                            <th scope="col">Qualified Strand</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php
include "connection.php";

if (isset($_GET['page_no'])) {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$total_records_per_page = 30;
$offset = ($page_no - 1) * $total_records_per_page;

if (isset($_GET['searchname'])) {
    $search = $_GET['searchname'];
    $sql = "SELECT * FROM studentprofile
            JOIN result ON studentprofile.lrn = result.lrn 
            JOIN section ON studentprofile.sectionID = section.sectionID 
            WHERE Fname LIKE '%$search%' OR Mname LIKE '%$search%' OR Lname LIKE '%$search%' OR CONCAT(Fname, ' ', Lname) LIKE '%$search%' OR studentprofile.lrn LIKE '%$search%'
            LIMIT $offset, $total_records_per_page";
} else {
    $sql = "SELECT * FROM studentprofile
            JOIN section ON studentprofile.sectionID = section.sectionID
            JOIN result ON studentprofile.lrn = result.lrn
            LIMIT $offset, $total_records_per_page";
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
        echo "<td class='text-center'>" . $row['MostSuitableStrand'] . "</td>";

        $fullName = $row['Fname'] . " " . $row['Lname'];
        echo "<td class='text-center'>
                <a href='#' onclick='deleteRecord(". $row['lrn'] .")' class ='btn btn-delete' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='DELETE'>
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
    echo "0 results";
}

$sql = "SELECT COUNT(*) AS total_records FROM studentprofile";
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
                </table>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-add fw-bold" href="addprofile.php" role="button">ADD NEW PROFILE</a>
                </div>
            </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script>
        function deleteRecord(clientNum) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = `delete.php?lrn=${clientNum}`;
                } else {
                    swal("CANCELED", "Record not deleted!", "info");
                }
            });
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>
