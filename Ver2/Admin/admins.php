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
                    <li>
                        <a href="./profiles.php" class="nav-link link-body-emphasis">
                            <img src="./images/profiles.png" alt="" width="16" height="16" class="bi pe-none me-2">
                            PROFILES
                        </a>
                    </li>
                    <?php

                    if ($_SESSION['role'] == 'SUPER ADMIN') { //Restrict the rest of the page to Super Admin only
                        echo '
                        <li class="nav-item">
                            <a href="./admins.php" class="nav-link active" aria-current="page">
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
            <section class="section-100 d-flex flex-column py-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title">ADMINS</h1>
                </div>
                <form class="row g-3" method="GET" action="">
                    <div class="col-10">
                        <input type="text" class="form-control" id="searchname" name="searchname" oninput="validateSearch(this)" placeholder="Search...">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-search w-100 fw-bold" name="search">SEARCH</button>
                    </div>
                </form>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end py-3">
                    <a class="btn btn-add fw-bold w-100" href="addadmin.php" role="button">ADD NEW ADMIN</a>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Suffix</th>
                            <th scope="col">Age</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Role</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        include "connection.php"; //include the connection file

                        //for pagination
                        if (isset($_GET['page_no'])) {
                            $page_no = $_GET['page_no'];
                        } else {
                            $page_no = 1;
                        }

                        $total_records_per_page = 30;
                        $offset = ($page_no - 1) * $total_records_per_page;

                        $previous_page = $page_no - 1;
                        $next_page = $page_no + 1;

                        $cur_Admin = $_SESSION['admin'];
                        if(isset($_GET['searchname'])){
                            $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                            $result_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM adminprofile WHERE (CONCAT(fname, ' ', lname) LIKE '%$search%' OR username LIKE '%$search%') AND username != '$cur_Admin'") or die('Unable to get total records.');
                        }else{
                            $result_count = mysqli_query($conn, "SELECT COUNT(*) AS total_records FROM adminprofile WHERE username != '$cur_Admin'") or die('Unable to get total records.');
                        }

                        $records = mysqli_fetch_array($result_count);
                        $total_records = $records['total_records'];

                        $total_no_of_pages = ceil($total_records / $total_records_per_page);

                        //retrieve all admin records exept for the current admin
                        if (isset($_GET['searchname'])) {
                            $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                            $sql = "SELECT * FROM adminprofile WHERE (CONCAT(fname, ' ', lname) LIKE '%$search%' OR username LIKE '%$search%') AND username != '$cur_Admin' LIMIT $offset, $total_records_per_page";
                        } else {
                            $sql = "SELECT * FROM adminprofile WHERE username != '$cur_Admin' LIMIT $offset, $total_records_per_page";
                        }

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            //display all the record in the table
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='text-center'>" . $row['username'] . "</td>";
                                echo "<td class='text-center'>" . $row['fname'] . "</td>";
                                echo "<td class='text-center'>" . $row['mname'] . "</td>";
                                echo "<td class='text-center'>" . $row['lname'] . "</td>";
                                echo "<td class='text-center'>" . $row['suffix'] . "</td>";
                                echo "<td class='text-center'>" . $row['age'] . "</td>";
                                echo "<td class='text-center'>" . $row['sex'] . "</td>";
                                echo "<td class='text-center'>" . $row['role'] . "</td>";
                                $name = $row['fname']. " " . $row['lname'];
                                echo "<td class='text-center'>
                    <a href='#' onclick='deleteRecord(". $row['adminID'] .", \"". $row['username'] ."\")' class='btn btn-delete' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='DELETE'>
                        <img src='./images/delete.png' alt='' width='20' height='20' class=''>
                    </a>
                    <a href='viewadmin.php?id=". $row['adminID'] ."&name=". $name ."' class='btn btn-view' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='VIEW'>
                        <img src='./images/view.png' alt='' width='20' height='20' class=''>
                    </a>
                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12' class='text-center'>0 results</td></tr>";
                        }
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
                            }else{
                                $previouslink = "?page_no=". $previous_page;
                                $nextlink = "?page_no=" . $next_page;
                            }
                        ?>
                        <li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=' . $previouslink : ''; ?>>Previous</a></li>
                        <?php 
                            $max_visible_buttons = 10;
                            $start = max(1, $page_no - floor($max_visible_buttons / 2));
                            $end = min($start + $max_visible_buttons - 1, $total_no_of_pages);

                            if ($end - $start + 1 < $max_visible_buttons) {
                                $start = max(1, $end - $max_visible_buttons + 1);
                            }

                            for ($counter = $start; $counter <= $end; $counter++) {
                                if(isset($_GET['searchname'])){
                                    $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                    $numberlink = "?searchname=" . $search . "&search=&page_no=" . $counter;
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
                    <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?>

                    </strong>

                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script>
        //for delete confirmation
        function deleteRecord(clientNum, clientName) {
            Swal.fire({
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
                    window.location.href = `delete.php?adminid=${clientNum}&adminname=${clientName}`;
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