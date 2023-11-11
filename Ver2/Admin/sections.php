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
                    
                    if($_SESSION['role'] == 'SUPER ADMIN'){ //Restrict the rest of the page to Super Admin only
                        echo '
                        <li>
                            <a href="./admins.php" class="nav-link link-body-emphasis">
                                <img src="./images/admins.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                ADMINS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./sections.php" class="nav-link active" aria-current="page">
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
                    <h1 class="fw-bold sub-title">SECTIONS</h1>
                </div>
                <div class="row w-100">
                    <div class="col-8">
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
                                    <th scope="col">ID</th>
                                    <th scope="col">SECTION NAME</th>
                                    <th scope="col">ADVISER</th>
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

                                $total_records_per_page = 6;
                                $offset = ($page_no - 1) * $total_records_per_page;

                                if (isset($_GET['searchname'])) {//if the search button is clicked
                                    $search = $_GET['searchname'];
                                    $sql = "SELECT section.sectionID, section.sectionName, adminprofile.adminID, adminprofile.username FROM section JOIN adminprofile ON section.adminID = adminprofile.adminID WHERE sectionName LIKE '%$search%' LIMIT $offset, $total_records_per_page";
                                } else {//retrieve all section record
                                    $sql = "SELECT section.sectionID, section.sectionName, adminprofile.adminID, adminprofile.username FROM section JOIN adminprofile ON section.adminID = adminprofile.adminID LIMIT $offset, $total_records_per_page";
                                }

                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $sql_edit = "SELECT section.adminID, section.sectionName, adminprofile.fname, adminprofile.lname FROM section JOIN adminprofile ON section.adminID = adminprofile.adminID WHERE sectionID = '$id'";
                                    $result = $conn->query($sql_edit);
                                    if($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()) {
                                            $sectionName = $row['sectionName'];
                                            $adminID = $row['adminID'];
                                            $adminName = $row['fname'] . " " . $row['lname'];
                                        }
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
                                        echo "<td class='text-center'>" . $row['sectionID'] . "</td>";
                                        echo "<td class='text-center'>" . $row['sectionName'] . "</td>";
                                        echo "<td class='text-center'>" . $row['username'] . "</td>";

                                        echo "<td class='text-center'>
                    <a <a href='#' onclick='deleteRecord(". $row['sectionID'] .", \"". $row['sectionName'] ."\")' class ='btn btn-delete' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='DELETE'>
                    <img src='./images/delete.png' alt='' width='20' height='20' class=''></a> 
                    <a href='sections.php?id=". $row['sectionID'] ."' class='btn btn-view' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='VIEW'>
                        <img src='./images/view.png' alt='' width='20' height='20' class=''>
                    </a>
                </td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "<tr><td colspan='9' class='text-center'>0 results</td></tr>";
                                }

                                if (isset($_GET['searchname'])) {//if the search button is clicked
                                    $search = $_GET['searchname'];
                                    $sql = "SELECT COUNT(*) AS total_records FROM section WHERE sectionName LIKE '%$search%'";
                                } else {//retrieve all section record
                                    $sql = "SELECT COUNT(*) AS total_records FROM section";
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
                                        $search = $_GET['searchname'];
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
                                            $search = $_GET['searchname'];
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
                            <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></strong>
                        </div>
                        </table>
                    </div>
                    <div class="col-4">
                        <div class="card custcard border-light text-center" style="width: 100%;">
                            <div class="card-header">
                                <h4 class="fw-bold card-text-header">Section Details</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                include "connection.php";

                                //check if the add button is clicked
                                if (isset($_POST['addBtn'])) {
                                    
                                    //retrieve the data from the form
                                    $sectionName = strtoupper(mysqli_real_escape_string($conn, $_POST['sectionName']));
                                    $adminID = $_POST['sectionAdviser'];

                                    //check if the section already exists
                                    $query = "SELECT sectionID FROM section WHERE sectionName = '$sectionName'";

                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {//it already exists
                                        echo "<script>Swal.fire({
                                            title: 'INVALID SECTION NAME!',
                                            text: 'SECTION NAME already exists in the database!',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 5000
                                            });</script>";
                                    } else {//it does not exist yet
                                        //prepare the adding sql statement
                                        $sql_section = "INSERT INTO section (`adminID`, `sectionName`)
                                                                VALUES ('$adminID', '$sectionName')";

                                        if(mysqli_query($conn, $sql_section)){
                                            //log the adding
                                            $role = $_SESSION['role'];
                                            $username = $_SESSION['admin'];
                                            $admin_username = $_SESSION['fullname'];
                                            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Added', '$role with Username $username added $sectionName Section', '$admin_username')";
                                            $conn->query($log);

                                            echo "<script>Swal.fire({
                                                title: 'Successfully Added',
                                                text: 'New section added successfully!',
                                                icon: 'success',
                                                buttons: {
                                                  confirm: true,
                                                },
                                              }).then((value) => {
                                                if (value) {
                                                  document.location='sections.php';
                                                } else {
                                                  document.location='sections.php';
                                                }
                                              });</script>";
                                        }else{
                                            echo "Error inserting record: " . mysqli_error($conn);
                                        }  
                                    }
                                }

                                //check if the update button is clickes
                                if(isset($_POST['updateBtn'])){
                                    //retreived all the data from the form
                                    $sectionName = strtoupper(mysqli_real_escape_string($conn, $_POST['sectionName']));
                                    $adminID = $_POST['sectionAdviser'];
                                    $sectionID = $_POST['sectionID'];

                                    //check if the section already exists
                                    $query = "SELECT sectionID FROM section WHERE sectionName = '$sectionName' AND sectionID <> '$sectionID'";

                                    $result = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($result) > 0) {//it already exists
                                        echo "<script>Swal.fire({
                                            title: 'INVALID SECTION NAME!',
                                            text: 'SECTION NAME already exists in the database!',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 5000
                                            });</script>";
                                        echo "<script>document location ='sections.php?id=". $sectionID ."';</script>";
                                    } else {//it does not exist yet
                                        //prepare the update sql statement
                                        $sql_section = "UPDATE section SET sectionName='$sectionName', adminID='$adminID' WHERE sectionID = '$sectionID'";

                                        if(mysqli_query($conn, $sql_section)){
                                            //log the update
                                            $role = $_SESSION['role'];
                                            $username = $_SESSION['admin'];
                                            $admin_username = $_SESSION['fullname'];
                                            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', '$role with Username $username updated $sectionName Section', '$admin_username')";
                                            $conn->query($log);

                                            echo "<script>Swal.fire({
                                                title: 'Successfully Updated',
                                                text: 'Section updated successfully!',
                                                icon: 'success',
                                                buttons: {
                                                  confirm: true,
                                                },
                                              }).then((value) => {
                                                if (value) {
                                                  document.location='sections.php';
                                                } else {
                                                  document.location='sections.php';
                                                }
                                              });</script>";
                                        }else{
                                            echo "Error updating record: " . mysqli_error($conn);
                                        }  
                                    }
                                }
                                ?>
                                <form class="row" action="" method="post">
                                    <input type="hidden" name="sectionID" id="sectionID" value="<?php if(isset($_GET['id'])){echo $id;} ?>">
                                    <div class="col-12 mb-1">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="sectionName" name="sectionName" oninput="" placeholder="Section Name" value="<?php if(isset($_GET['id'])){echo $sectionName;} ?>" required>
                                            <label for="sectionName">Section Name</label>
                                        </div>
                                    </div>
                                    <?php
                                    $sql = "SELECT * FROM adminprofile";

                                    $result = $conn->query($sql);
                                    ?>
                                    <div class="col-12 mb-1">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="sectionAdviser" name="sectionAdviser" value="<?php echo $adminName ?>">
                                                <?php
                                                while ($row = $result->fetch_assoc()) {
                                                    $name = $row['fname'] . " " . $row['lname'];
                                                    if(isset($_GET['id'])){
                                                        if($adminID == $row['adminID']){
                                                            echo '<option value="' . $row['adminID'] . '" selected>' . $name . '</option>';
                                                        }else{
                                                            echo '<option value="' . $row['adminID'] . '">' . $name . '</option>';
                                                        }
                                                    }else{
                                                        echo '<option value="' . $row['adminID'] . '">' . $name . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label for="sectionAdviser">Adviser</label>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <?php
                                        if(isset($_GET['id'])){
                                            echo '<button type="submit" name="updateBtn" class="btn btn-update form-button-text"><span class="fw-bold">UPDATE</span></button>';
                                        }else{
                                            echo '<button type="submit" name="addBtn" class="btn btn-add form-button-text"><span class="fw-bold">ADD</span></button>';
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                    window.location.href = `delete.php?sectionid=${clientNum}&sectionname=${clientName}`;
                } else {
                    Swal.fire("CANCELED", "Record not deleted!", "info");
                }
            });
        }
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>