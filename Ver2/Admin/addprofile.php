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
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

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
            <section class="section-100 d-flex flex-column py-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title">ADD NEW PROFILE</h1>
                </div>
                <div class="row w-100">
                    <div class="col-7">
                        <h3>Individual Adding</h3>
                        <div class="card custcard border-light text-center" style="width: 100%;">
                            <div class="card-header">
                                <h4 class="fw-bold card-text-header">Profile Details</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                include "connection.php"; //include the connection file
                                include "../vendor/autoload.php"; //include the Phpspreadsheets

                                //check if the add buttonis clicked
                                if (isset($_POST['addBtn'])) {
                                    //get the data from the form
                                    $Fname = strtoupper(mysqli_real_escape_string($conn, $_POST['Fname']));
                                    $Mname = strtoupper(mysqli_real_escape_string($conn, $_POST['Mname']));
                                    $Lname = strtoupper(mysqli_real_escape_string($conn, $_POST['Lname']));
                                    $suffix = strtoupper(mysqli_real_escape_string($conn, $_POST['suffix']));
                                    $sectionID = $_POST['section'];
                                    $schoolyrID = $_POST['schoolyr'];

                                    //get LRN from POST data
                                    $lrn = $_POST['lrn'];

                                    //check if the LRN already exists
                                    $query = "SELECT lrn FROM studentprofile WHERE lrn = '$lrn'";

                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) { //lrn already exists
                                        echo "<script>Swal.fire({
                                            title: 'INVALID LRN!',
                                            text: 'LRN already exists in the database!',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 5000
                                          });</script>";
                                    } else { //lrn does not exist yet
                                        //prep the sql statement for profile creation
                                        $sql_studentprofile = "INSERT INTO studentprofile (`lrn`, `Fname`, `Mname`, `Lname`, `suffix`,`sectionID`, `schoolyrID`, `password`)
                                                               VALUES ('$lrn', '$Fname', '$Mname', '$Lname', '$suffix', '$sectionID', '$schoolyrID', MD5('$lrn'))";
                                            
                                        
                                        if (mysqli_query($conn, $sql_studentprofile)) {
                                                
                                            //insert LRN into other tables
                                            $sql_result = "INSERT INTO result (lrn) VALUES ('$lrn')";
                                            $sql_studentacad = "INSERT INTO studentacad (lrn) VALUES ('$lrn')";
                                            $sql_studentinterest = "INSERT INTO studentinterest (lrn) VALUES ('$lrn')";
                                            $sql_studentskill = "INSERT INTO studentskill (lrn) VALUES ('$lrn')";
                                            $sql_studentsocioeco = "INSERT INTO studentsocioeco (lrn) VALUES ('$lrn')";
                                            $sql_studentcareer = "INSERT INTO studentcareer (lrn) VALUES ('$lrn')";
                                            $sql_stemresult = "INSERT INTO stemresult (lrn) VALUES ('$lrn')";
                                            $sql_humssresult = "INSERT INTO humssresult (lrn) VALUES ('$lrn')";
                                            $sql_abmresult = "INSERT INTO abmresult (lrn) VALUES ('$lrn')";
                                            $sql_gasresult = "INSERT INTO gasresult (lrn) VALUES ('$lrn')";
                                            $sql_tvlictresult = "INSERT INTO tvlictresult (lrn) VALUES ('$lrn')";
                                            $sql_tvlheresult = "INSERT INTO tvlheresult (lrn) VALUES ('$lrn')";
                                            //use a transaction to ensure all inserts succeed or fail together
                                            mysqli_autocommit($conn, false);

                                            if (
                                                mysqli_query($conn, $sql_result) &&
                                                mysqli_query($conn, $sql_studentacad) &&
                                                mysqli_query($conn, $sql_studentinterest) &&
                                                mysqli_query($conn, $sql_studentskill) &&
                                                mysqli_query($conn, $sql_studentcareer) &&
                                                mysqli_query($conn, $sql_studentsocioeco) &&
                                                mysqli_query($conn, $sql_stemresult) &&
                                                mysqli_query($conn, $sql_humssresult) &&
                                                mysqli_query($conn, $sql_abmresult) &&
                                                mysqli_query($conn, $sql_gasresult) &&
                                                mysqli_query($conn, $sql_tvlictresult) &&
                                                mysqli_query($conn, $sql_tvlheresult)
                                            ) {
                                                mysqli_commit($conn);
                                                mysqli_autocommit($conn, true);

                                                $admin_username = $_SESSION['fullname'];
                                                //retrieve the last inserted LRN
                                                $last_inserted_lrn = $lrn;
                                                //insert log with details and doer
                                                $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Added', 'Student with LRN $last_inserted_lrn was added', '$admin_username')";
                                                $conn->query($log);

                                                echo "<script>Swal.fire({
                                                    title: 'Successfully Added',
                                                    text: 'New student profile added successfully!',
                                                    icon: 'success',
                                                    buttons: {
                                                      confirm: true,
                                                    },
                                                  }).then((value) => {
                                                    if (value) {
                                                      document.location='addprofile.php';
                                                    } else {
                                                      document.location='addprofile.php';
                                                    }
                                                  });</script>";
                                            } else {
                                                mysqli_rollback($conn);
                                                echo "Error inserting record: " . mysqli_error($conn);
                                            }

                                            // Restore autocommit mode
                                            mysqli_autocommit($conn, true);
                                        }else{
                                            echo "Error inserting record: " . mysqli_error($conn);
                                        }  
                                    }
                                }
                        
                                ?>
                                <form class="row" action="" method="post">
                                    <div class="col-12 mb-1">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="lrn" name="lrn" oninput="validateLRN(this)" pattern=".{12}" title="Please enter exactly 12 digits" placeholder="Learner's Reference Number" required>
                                            <label for="lrn">Learner's Reference Number</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-1">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="fname" name="Fname" oninput="validateName(this)" placeholder="First Name" required>
                                            <label for="fname">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-1">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="mname" name="Mname" oninput="validateName(this)" placeholder="Middle Name">
                                            <label for="mname">Middle Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-1">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="lname" name="Lname" oninput="validateName(this)" placeholder="Last Name" required>
                                            <label for="lname">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-1">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="suffix" name="suffix" oninput="validateName(this)" placeholder="Suffix">
                                            <label for="suffix">Suffix</label>
                                        </div>
                                    </div>
                                    <?php
                                    if($_SESSION['role'] === 'ADMIN'){
                                        $adminid = $_SESSION['adminID'];
                                        $sql = "SELECT * FROM section WHERE adminID = $adminid";
                                    }else{
                                        $sql = "SELECT * FROM section";
                                    }

									$result = $conn->query($sql);
									?>
									<div class="col-12 col-md-6 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="section" name="section" value="">
												<?php
												while ($row = $result->fetch_assoc()) {
													echo '<option value="' . $row['sectionID'] . '">' . $row['sectionName'] . '</option>';
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
									<div class="col-12 col-md-6 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="schoolyr" name="schoolyr" value="">
												<?php
												while ($row = $result->fetch_assoc()) {
													echo '<option value="' . $row['schoolyrID'] . '">' . $row['schoolyrName'] . '</option>';
												}
												?>
											</select>
											<label for="schoolyr">School Year</label>
										</div>
									</div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <button type="submit" name="addBtn" class="btn btn-add form-button-text"><span class="fw-bold">ADD</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <h3>Batch Adding</h3>
                        <p>Use this when adding multiple profiles at once. Follow this simple steps:</p>
                        <p>STEP 1: Download the template file where you will input the deatils of the student <a class="fw-bold" href="./template/Batch_Adding_Template.xlsx" download role="button">here.</a></p>
                        <p>STEP 2: Put the required info in the file and save it as .xls or .xlsx file.</p>
                        <p>STEP 3: Select the Section and School Year of the batch in the form below.</p>
                        <p>STEP 4: Upload the file and click ADD BATCH</p>

                        <?php
                            if (isset($_POST['addbatch'])) {
                                if (isset($_FILES['profilelist'])) {
                                    $allowed_extension = array('xls', 'xlsx');
                                    $file_array = explode(".", $_FILES["profilelist"]["name"]);
                                    $file_extension = end($file_array);
                                    
                                    if(in_array($file_extension, $allowed_extension)){
                                        $file_name = time() . '.' . $file_extension;
                                        move_uploaded_file($_FILES['profilelist']['tmp_name'], $file_name);
                                        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
                                        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

                                        $spreadsheet = $reader->load($file_name);

                                        unlink($file_name);

                                        $data = $spreadsheet->getActiveSheet()->toArray();
                                        $invalidTemplate = false;
                                        $sucessCount = 0;
                                        $invalidLRNCount = 0;
                                        $invalidNameCount = 0;
                                        $duplicateLRNCount = 0;
                                        $errorCount = 0;


                                        if(count($data) > 3){
                                            foreach ($data as $index => $row) {
                                                if ($index === 0) {
                                                    if($row[0] === 'TEMPLATE FOR BATCH ADDING'){
                                                        continue;
                                                    }else{
                                                        $invalidTemplate = true;
                                                        break;
                                                    }
                                                }else if($index === 1){
                                                    continue;
                                                }else{
                                                    if(empty($row[0]) || strlen(str_replace(' ', '', $row[0])) != 12 || !ctype_digit($row[0])){
                                                        $invalidLRNCount++;
                                                        continue;
                                                    }else{
                                                        if(empty($row[1]) || empty($row[3]) || !preg_match('/^[a-zA-Z\sñÑ-]+$/', $row[1]) || !preg_match('/^[a-zA-Z\sñÑ-]*$/', $row[2]) || !preg_match('/^[a-zA-Z\sñÑ-]+$/', $row[3]) || !preg_match('/^[a-zA-Z\sñÑ-]*$/', $row[4])){
                                                            $invalidNameCount++;
                                                            continue;
                                                        }else{
                                                            $Fname = strtoupper(mysqli_real_escape_string($conn, $row[1]));
                                                            $Mname = strtoupper(mysqli_real_escape_string($conn, $row[2]));
                                                            $Lname = strtoupper(mysqli_real_escape_string($conn, $row[3]));
                                                            $suffix = strtoupper(mysqli_real_escape_string($conn, $row[4]));
                                                            $sectionID = $_POST['section'];
                                                            $schoolyrID = $_POST['schoolyr'];

                                                            $lrn = $row[0];

                                                            $query = "SELECT lrn FROM studentprofile WHERE lrn = '$lrn'";

                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) { //lrn already exists
                                                                $duplicateLRNCount++;
                                                                continue;
                                                            }else{
                                                                $sql_studentprofile = "INSERT INTO studentprofile (`lrn`, `Fname`, `Mname`, `Lname`, `suffix`,`sectionID`, `schoolyrID`, `password`)
                                                               VALUES ('$lrn', '$Fname', '$Mname', '$Lname', '$suffix', '$sectionID', '$schoolyrID', MD5('$lrn'))";

                                                                if (mysqli_query($conn, $sql_studentprofile)) {
                                                                                                                
                                                                    //insert LRN into other tables
                                                                    $sql_result = "INSERT INTO result (lrn) VALUES ('$lrn')";
                                                                    $sql_studentacad = "INSERT INTO studentacad (lrn) VALUES ('$lrn')";
                                                                    $sql_studentinterest = "INSERT INTO studentinterest (lrn) VALUES ('$lrn')";
                                                                    $sql_studentskill = "INSERT INTO studentskill (lrn) VALUES ('$lrn')";
                                                                    $sql_studentsocioeco = "INSERT INTO studentsocioeco (lrn) VALUES ('$lrn')";
                                                                    $sql_studentcareer = "INSERT INTO studentcareer (lrn) VALUES ('$lrn')";
                                                                    $sql_stemresult = "INSERT INTO stemresult (lrn) VALUES ('$lrn')";
                                                                    $sql_humssresult = "INSERT INTO humssresult (lrn) VALUES ('$lrn')";
                                                                    $sql_abmresult = "INSERT INTO abmresult (lrn) VALUES ('$lrn')";
                                                                    $sql_gasresult = "INSERT INTO gasresult (lrn) VALUES ('$lrn')";
                                                                    $sql_tvlictresult = "INSERT INTO tvlictresult (lrn) VALUES ('$lrn')";
                                                                    $sql_tvlheresult = "INSERT INTO tvlheresult (lrn) VALUES ('$lrn')";
                                                                    //use a transaction to ensure all inserts succeed or fail together
                                                                    mysqli_autocommit($conn, false);

                                                                    if (
                                                                        mysqli_query($conn, $sql_result) &&
                                                                        mysqli_query($conn, $sql_studentacad) &&
                                                                        mysqli_query($conn, $sql_studentinterest) &&
                                                                        mysqli_query($conn, $sql_studentskill) &&
                                                                        mysqli_query($conn, $sql_studentcareer) &&
                                                                        mysqli_query($conn, $sql_studentsocioeco) &&
                                                                        mysqli_query($conn, $sql_stemresult) &&
                                                                        mysqli_query($conn, $sql_humssresult) &&
                                                                        mysqli_query($conn, $sql_abmresult) &&
                                                                        mysqli_query($conn, $sql_gasresult) &&
                                                                        mysqli_query($conn, $sql_tvlictresult) &&
                                                                        mysqli_query($conn, $sql_tvlheresult)
                                                                    ) {
                                                                        mysqli_commit($conn);
                                                                        mysqli_autocommit($conn, true);
                                                                        $sucessCount++;
                                                                    }else{
                                                                        mysqli_rollback($conn);
                                                                        mysqli_autocommit($conn, true);
                                                                        $errorCount++;
                                                                        continue;
                                                                    }
                                                                    mysqli_autocommit($conn, true);
                                                                }else{
                                                                    $errorCount++;
                                                                    continue;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
    
                                            if($invalidTemplate){
                                                echo "<script>Swal.fire({
                                                    title: 'INVALID TEMPLATE!',
                                                    text: 'Incorect template was used!',
                                                    icon: 'error',
                                                    showConfirmButton: false,
                                                    timer: 5000
                                                    });</script>";
                                            }else{
                                                $role = $_SESSION['role'];
                                                $username = $_SESSION['admin'];
                                                $admin_username = $_SESSION['fullname'];
                                                $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Added', '$role with Username $username sucessfully added $sucessCount profiles using Batch Adding', '$admin_username')";
                                                $conn->query($log);

                                                echo "<script>Swal.fire({
                                                    title: 'Successfully Added',
                                                    text: 'Multiple profiles added successfully!',
                                                    icon: 'success',
                                                    footer: 'Success: ". $sucessCount ."<br>Invalid LRN: ". $invalidLRNCount ."<br>Duplicate LRN: ". $duplicateLRNCount ."<br>Invalid Name: ". $invalidNameCount ."<br>Errors: ". $errorCount ."',
                                                    buttons: {
                                                      confirm: true,
                                                    },
                                                  }).then((value) => {
                                                    if (value) {
                                                        document.location = 'addprofile.php';
                                                    } else {
                                                        document.location = 'addprofile.php';
                                                    }
                                                  });</script>";
                                            }
                                        }else{
                                            echo "<script>Swal.fire({
                                                title: 'EMPTY TEMPLATE!',
                                                text: 'The template was empty or contains only one record!',
                                                icon: 'error',
                                                showConfirmButton: false,
                                                timer: 5000
                                                });</script>";
                                        }
                                        echo count($data);
                                        //echo $sucessCount;
                                        //echo $invalidLRNCount;
                                        //echo $emptyNameCount;
                                        //echo $duplicateLRNCount;
                                        //echo $errorCount;
                                    }else{
                                        echo "<script>Swal.fire({
                                            title: 'INCORECT FILE TYPE!',
                                            text: 'Only .xls or .xlsx file allowed',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 5000
                                            });</script>";
                                    }
                                }else{
                                    echo "No File";
                                    echo "<script>Swal.fire({
                                        title: 'NO FILE!',
                                        text: 'Please upload the corect file!',
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 5000
                                        });</script>";
                                }
                            }
                        ?>
                        <form class="row g-3" method="post" action="" enctype="multipart/form-data">
                            <?php
                            if($_SESSION['role'] === 'ADMIN'){
                                $adminid = $_SESSION['adminID'];
                                $sql = "SELECT * FROM section WHERE adminID = $adminid";
                            }else{
                                $sql = "SELECT * FROM section";
                            }

                            $result = $conn->query($sql);
                            ?>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="section" name="section" value="">
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['sectionID'] . '">' . $row['sectionName'] . '</option>';
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
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="schoolyr" name="schoolyr" value="">
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['schoolyrID'] . '">' . $row['schoolyrName'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <label for="schoolyr">School Year</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="profilelist" class="form-label">Input Backup .xls or .xlsx template file</label>
                                <input class="form-control" type="file" id="profilelist" name="profilelist" accept=".xls,.xlsx" required>
                            </div>
                            <button type="submit" class="btn btn-add w-100 fw-bold" name="addbatch">ADD BATCH</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/password-score.js"></script>
    <script type="text/javascript" src="./js/password-score-options.js"></script>
    <script type="text/javascript" src="./js/bootstrap-strength-meter.js"></script>
    <script>
        //for password strength measurement
        $(document).ready(function() {
            $('#pass1').strengthMeter('text', {
                container: $('#passstrength'),
                hierarchy: {
                    '0': ['text-danger', ' '],
                    '1': ['text-danger', 'Very Weak'],
                    '25': ['text-danger', 'Weak'],
                    '50': ['text-warning', 'Moderate'],
                    '75': ['text-warning', 'Good'],
                    '100': ['text-success', 'Strong'],
                    '125': ['text-success', 'Very Strong']
                }
            });
        });

        function validateLRN(input) {
            var regex = /^[0-9]*$/; // Regular expression to allow only numbers

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9]/g, ''); // Remove any characters that are not numeric
            }

            if (input.value.length > 12) {
                input.value = input.value.slice(0, 12); // Truncate the input value to 12 characters if it exceeds the limit
            }
        }

        //for text formatting and validation
        function validateName(input) {
            var regex = /^[a-zA-Z\sñÑ-]*$/; // Regular expression to allow alphanumeric characters, spaces, ñ, Ñ, and dash

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z\sñÑ-]/g, ''); // Remove any characters that do not match the allowed set
            }
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>