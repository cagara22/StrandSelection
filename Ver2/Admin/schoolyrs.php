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
                        <li class="nav-item">
                            <a href="./schoolyrs.php" class="nav-link active" aria-current="page">
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
                <?php include "connection.php"; //include the conneciton file ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title">SCHOOL YEARS</h1>
                </div>
                <div class="row w-100">
                    <div class="col-8">
                        <form class="row g-3" method="GET" action="">
                            <div class="col-10">
                                <input type="text" class="form-control" id="searchname" name="searchname" oninput="validateSearch(this)" placeholder="Search...">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-search w-100 fw-bold" name="search">SEARCH</button>
                            </div>
                        </form>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">School Year</th>
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

                                if (isset($_GET['searchname'])) {//if search is clicked
                                    $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                    $sql = "SELECT * FROM schoolyr WHERE schoolyrName LIKE '%$search%' LIMIT $offset, $total_records_per_page";
                                } else {//retrieve all school year records
                                    $sql = "SELECT * FROM schoolyr LIMIT $offset, $total_records_per_page";
                                }

                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $sql_edit = "SELECT * FROM schoolyr WHERE schoolyrID = '$id'";
                                    $result = $conn->query($sql_edit);
                                    if($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()) {
                                            $schoolyrName = $row['schoolyrName'];
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
                                        echo "<td class='text-center'>" . $row['schoolyrName'] . "</td>";

                                        echo "<td class='text-center'>
                    <a <a href='#' onclick='deleteRecord(". $row['schoolyrID'] .", \"". $row['schoolyrName'] ."\")' class ='btn btn-delete' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='DELETE'>
                    <img src='./images/delete.png' alt='' width='20' height='20' class=''></a> 
                    <a href='schoolyrs.php?id=". $row['schoolyrID'] ."' class='btn btn-view' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-title='VIEW'>
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
                                    $search = mysqli_real_escape_string($conn, $_GET['searchname']);
                                    $sql = "SELECT COUNT(*) AS total_records FROM schoolyr WHERE schoolyrName LIKE '%$search%'";
                                } else {//retrieve all section record
                                    $sql = "SELECT COUNT(*) AS total_records FROM schoolyr";
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
                            <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></strong>
                        </div>
                        </table>
                    </div>
                    <div class="col-4">
                        <div class="card custcard border-light text-center" style="width: 100%;">
                            <div class="card-header">
                                <h4 class="fw-bold card-text-header">School Year Details</h4>
                            </div>
                            <div class="card-body">
                                <?php

                                //check if the add button is clicked
                                if (isset($_POST['addBtn'])) {
                                    
                                    //retrive the schoolyr info from the form
                                    $startYear = mysqli_real_escape_string($conn, $_POST['startYear']);
                                    $endYear = mysqli_real_escape_string($conn, $_POST['endYear']);
                                    $schoolyrName = $startYear . '-' . $endYear;

                                    //check if the schoolyr is already in the database
                                    $query = "SELECT schoolyrID FROM schoolyr WHERE schoolyrName = '$schoolyrName'";

                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) { //already exists
                                        echo "<script>Swal.fire({
                                            title: 'INVALID SCHOOL YEAR!',
                                            text: 'SCHOOL YEAR already exists in the database!',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 5000
                                            });</script>";
                                    } else { //school yr does not exist
                                        //prep add sql statement
                                        $sql_schlyr = "INSERT INTO schoolyr (`schoolyrName`)
                                                                VALUES ('$schoolyrName')";

                                        if(mysqli_query($conn, $sql_schlyr)){
                                            //log the adding
                                            $role = $_SESSION['role'];
                                            $username = $_SESSION['admin'];
                                            $admin_username = $_SESSION['fullname'];
                                            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Added', '$role with Username $username added $schoolyrName School Year', '$admin_username')";
                                            $conn->query($log);

                                            echo "<script>Swal.fire({
                                                title: 'Successfully Added',
                                                text: 'New school year added successfully!',
                                                icon: 'success',
                                                buttons: {
                                                  confirm: true,
                                                },
                                              }).then((value) => {
                                                if (value) {
                                                  document.location='schoolyrs.php';
                                                } else {
                                                  document.location='schoolyrs.php';
                                                }
                                              });</script>";
                                        }else{
                                            echo "Error inserting record: " . mysqli_error($conn);
                                        }  
                                    }
                                }

                                //check if the update button is clicked
                                if(isset($_POST['updateBtn'])){
                                    //retreive the data from the form
                                    $startYear = mysqli_real_escape_string($conn, $_POST['startYear']);
                                    $endYear = mysqli_real_escape_string($conn, $_POST['endYear']);
                                    $schoolyrName = $startYear . '-' . $endYear;
                                    $schoolyrID = $_POST['schoolyrID'];

                                    //check if the schoolyr already exists
                                    $query = "SELECT schoolyrID FROM schoolyr WHERE schoolyrName = '$schoolyrName'";

                                    $result = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($result) > 0) { //already exists
                                        echo "<script>Swal.fire({
                                            title: 'INVALID SCHOOL YEAR!',
                                            text: 'SCHOOL YEAR already exists in the database!',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 5000
                                            });</script>";
                                    } else {//does not yet exist
                                        //prepare the update sqp statement
                                        $sql_schlyr = "UPDATE schoolyr SET schoolyrName='$schoolyrName' WHERE schoolyrID = '$schoolyrID'";

                                        if(mysqli_query($conn, $sql_schlyr)){
                                            //log the update
                                            $role = $_SESSION['role'];
                                            $username = $_SESSION['admin'];
                                            $admin_username = $_SESSION['fullname'];
                                            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', '$role with Username $username updated $schoolyrName School Year', '$admin_username')";
                                            $conn->query($log);

                                            echo "<script>Swal.fire({
                                                title: 'Successfully Updated',
                                                text: 'School year updated successfully!',
                                                icon: 'success',
                                                buttons: {
                                                  confirm: true,
                                                },
                                              }).then((value) => {
                                                if (value) {
                                                  document.location='schoolyrs.php';
                                                } else {
                                                  document.location='schoolyrs.php';
                                                }
                                              });</script>";
                                        }else{
                                            echo "Error inserting record: " . mysqli_error($conn);
                                        }  
                                    }
                                }
                                ?>
                                <form class="row" action="" method="post">
                                    <p>NOTE: If you add a new school year, it will be the current school year...</p>
                                    <input type="hidden" name="schoolyrID" id="schoolyrID" value="<?php if(isset($_GET['id'])){echo $id;} ?>">
                                    <?php
                                        if(isset($_GET['id'])){
                                            $year = $schoolyrName;
                                            // Split the string into an array using the hyphen as a delimiter
                                            $years = explode('-', $year);

                                            // Access the first element of the array
                                            $firstYear = $years[0];
                                            $secondYear = $years[1];
                                        } 
                                    ?>
                                    <div class="col-6 mb-1">
                                        <div class="form-floating mb-3">
                                            <!-- Input field for the starting year -->
                                            <input type="text" class="form-control" id="startYear" name="startYear" placeholder="Start Year" pattern="\d{4}" title="Please enter a valid 4-digit year (e.g., 2023)" value="<?php if(isset($_GET['id'])){echo $firstYear;} ?>" required>
                                            <label for="startYear">Start Year</label>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-1" id="schlyrform">
                                        <div class="form-floating mb-3">
                                            <!-- Input field for the ending year -->
                                            <input type="text" class="form-control" id="endYear" name="endYear" placeholder="End Year" pattern="\d{4}" title="Please enter a valid 4-digit year (e.g., 2024)" value="<?php if(isset($_GET['id'])){echo $secondYear;} ?>" required readonly>
                                            <label for="endYear">End Year</label>
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
                    window.location.href = `delete.php?schoolyrid=${clientNum}&schoolyrname=${clientName}`;
                } else {
                    Swal.fire("CANCELED", "Record not deleted!", "info");
                }
            });
        }

        // JavaScript for custom validation
        document.getElementById('startYear').addEventListener('input', function(event) {
            validateYear(event);

            // Automatically set endYear to one year ahead or clear if startYear is empty
            var startYear = event.target.value.trim(); // Trim to handle whitespace
            var endYearInput = document.getElementById('endYear');

            if (!startYear) {
                endYearInput.value = ""; // Clear endYear if startYear is empty
            } else {
                startYear = parseInt(startYear);
                endYearInput.value = (startYear + 1).toString();  // Convert to string
                validateYear({ target: endYearInput });
            } 
        });
        document.getElementById('endYear').addEventListener('input', validateYear);

        // Add event listeners to form submission
        document.getElementById('schlyrform').addEventListener('submit', function(event) {
            // Trigger the validation before form submission
            validateYear({ target: document.getElementById('startYear') });
            validateYear({ target: document.getElementById('endYear') });

            // Prevent form submission if there are validation errors
            if (!this.checkValidity()) {
                event.preventDefault();
            }
        });

        function validateYear(event) {
            var yearInput = event.target;
            var year = parseInt(yearInput.value);
            var currentYear = new Date().getFullYear();

            // Additional validation logic if needed
            if (isNaN(year) || year < currentYear || year > 9999) {
                yearInput.setCustomValidity('Invalid year. Please enter a year from the current year onwards.');
            } else {
                yearInput.setCustomValidity('');

                // Check if it's the endYear and if it's 1 year greater than the startYear
                if (yearInput.id === 'endYear') {
                    var startYear = parseInt(document.getElementById('startYear').value);
                    if (year <= startYear || year - startYear > 1) {
                        yearInput.setCustomValidity('End Year must be 1 year greater than Start Year.');
                    } else {
                        yearInput.setCustomValidity('');
                    }
                }
            }
        }

        function validateSearch(input) {
            var regex = /^[0-9\s-]*$/; // Regular expression to allow only alphanumeric characters and spaces

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9\s-]/g, ''); // Remove any special characters
            }
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>