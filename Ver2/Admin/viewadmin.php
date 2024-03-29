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
                <?php include "connection.php"; //include the conneciton file ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title"><?php echo $_GET['name']; //display the admin name ?></h1>
                </div>
                <div class="card custcard border-light text-center" style="width: 100%;">
                    <div class="card-header">
                        <h4 class="fw-bold card-text-header">Admin Details</h4>
                    </div>
                    <div class="card-body">
                        <?php 
                        
                        //check is the update button was clicked
                        if (isset($_POST['update'])) {
                            $update_sql = '';

                            //retrieve the data from the form
                            $adminID = $_GET['id'];
                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $fname = strtoupper(mysqli_real_escape_string($conn, $_POST['fname']));
                            $mname = strtoupper(mysqli_real_escape_string($conn, $_POST['mname']));
                            $lname = strtoupper(mysqli_real_escape_string($conn, $_POST['lname']));
                            $curName = $_GET['name'];
                            $newName = $fname . " " . $lname;
                            $suffix = strtoupper(mysqli_real_escape_string($conn, $_POST['suffix']));
                            $address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
                            if(!empty($_POST['bday'])){
                                $bday = $_POST['bday'];
                                $birthdate = new DateTime($bday);
                                $currentDate = new DateTime();
                                $age = $currentDate->diff($birthdate)->y;
                            }else{
                                $bday = '';
                                $age = 0;
                            }
                            //$age = !empty($_POST['age']) ? $_POST['age'] : 0;
                            $sex = $_POST['sex'];
                            $role = $_POST['role'];
                            $email = mysqli_real_escape_string($conn, $_POST['email']);

                            //check is the username is already in use
                            $query = "SELECT adminID FROM adminprofile WHERE username = '$username' AND adminID <> '$adminID'";

                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {//already in use
                                echo "<script>Swal.fire({
                                    title: 'INVALID USERNAME!',
                                    text: 'USERNAME already exists in the database!',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 5000
                                    });</script>";
                            } else {//not in use
                               
                                if(!empty($_POST['bday'])){
                                    $update_sql = "UPDATE adminprofile SET username='$username', fname='$fname', mname='$mname', lname='$lname', 
                                    address='$address', bday='$bday', age='$age', sex='$sex', role='$role', suffix='$suffix', email='$email' WHERE adminID='$adminID'";
                                }else{
                                    $update_sql = "UPDATE adminprofile SET username='$username', fname='$fname', mname='$mname', lname='$lname', 
                                    address='$address', sex='$sex', role='$role', suffix='$suffix', email='$email' WHERE adminID='$adminID'";
                                }

                                if(!empty($update_sql)){ //if everything is set, update
                                    if (mysqli_query($conn, $update_sql)) {
                                        $affected_rows = mysqli_affected_rows($conn);
        
                                        if ($affected_rows > 0) {
                                            //log the update
                                            $admin_username = $_SESSION['fullname'];
                                            $cur_admin = $_SESSION['admin'];
                                            $cur_admin_role = $_SESSION['role'];
                                            $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', '$cur_admin_role with Username $cur_admin has updated $username account', '$admin_username')";
                                            $conn->query($log);
                                            
                                            echo "<script>Swal.fire({
                                                title: 'Successfully Updated',
                                                text: 'Admin profile updated successfully!',
                                                icon: 'success',
                                                buttons: {
                                                  confirm: true,
                                                },
                                              }).then((value) => {
                                                if (value) {
                                                  document.location='viewadmin.php?id=". $adminID ."&name=". $newName ."';
                                                } else {
                                                  document.location='viewadmin.php?id=". $adminID ."&name=". $newName ."';
                                                }
                                              });</script>";
                                        } else {
                                            echo "<script>Swal.fire({
                                                title: 'NO CHANGES',
                                                text: 'No changes were made',
                                                icon: 'info',
                                                showConfirmButton: false,
                                                timer: 5000
                                                });</script>";
                                        }
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }
                            }
                        }

                        if (isset($_POST['resetpass'])){
                            $adminID = $_GET['id'];
                            $curName = $_GET['name'];
                            $username = mysqli_real_escape_string($conn, $_POST['username']);

                            $password = md5($username);

                            $sql = "UPDATE adminprofile SET password='$password' WHERE adminID='$adminID'";

                            if (mysqli_query($conn, $sql)) {
                                $affected_rows = mysqli_affected_rows($conn);

                                if ($affected_rows > 0) {
                                    //log the update
                                    $admin_username = $_SESSION['fullname'];
                                    $cur_admin = $_SESSION['admin'];
                                    $cur_admin_role = $_SESSION['role'];
                                    $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', '$cur_admin_role with Username $cur_admin has updated $username account', '$admin_username')";
                                    $conn->query($log);

                                    echo "<script>Swal.fire({
                                        title: 'Successfully Reset of Password',
                                        text: 'Admin Account Password Reset',
                                        icon: 'success',
                                        buttons: {
                                          confirm: true,
                                        },
                                      }).then((value) => {
                                        if (value) {
                                          document.location='viewadmin.php?id=". $adminID ."&name=". $curName ."';
                                        } else {
                                          document.location='viewadmin.php?id=". $adminID ."&name=". $curName ."';
                                        }
                                      });</script>";
                                }else {//no changes were made to the record
                                    echo "<script>Swal.fire({
                                        title: 'NO CHANGES',
                                        text: 'No changes were made',
                                        icon: 'info',
                                        showConfirmButton: false,
                                        timer: 5000
                                        });</script>";
                                }
                            }else {//error in updating the account
                                echo "Error updating record: " . mysqli_error($conn);
                            }
                        }
                        
                        //get all the admin's details
                        if (isset($_GET['id'])) {
                            $userID = $_GET['id'];
                            
                            $sql = "SELECT * FROM adminprofile WHERE adminID = '$userID'";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {
                                    $adminID1 = $row['adminID'];
                                    $username1 = $row['username'];
                                    $fname1 = $row['fname'];
                                    $mname1 = $row['mname'];
                                    $lname1 = $row['lname'];
                                    $suffix1 = $row['suffix'];
                                    $address1 = $row['address'];
                                    $sex1 = $row['sex'];
                                    $bday1 = $row['bday'];
                                    $age1 = $row['age'];
                                    $role1 = $row['role'];
                                    $email1 = $row['email'];
                                }
                            }

                        }
                        ?>
                        <form class="row" action="" method="post">
                            <div class="col-12 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" oninput="validateUsername(this)" placeholder="Username" value="<?php echo $username1; ?>" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fname" name="fname" oninput="validateName(this)" placeholder="First Name" value="<?php echo $fname1; ?>" required>
                                    <label for="fname">First Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mname" name="mname" oninput="validateName(this)" placeholder="Middle Name" value="<?php echo $mname1; ?>">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lname" name="lname" oninput="validateName(this)" placeholder="Last Name" value="<?php echo $lname1; ?>" required>
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="suffix" name="suffix" oninput="validateName(this)" placeholder="Suffix" value="<?php echo $suffix1; ?>">
                                    <label for="suffix">Suffix</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="address" name="address" oninput="validateAddress(this)" placeholder="Address" value="<?php echo $address1; ?>">
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="sex" name="sex" value="<?php echo $sex1; ?>">
                                        <option value="M" <?php if ($sex1 == "M") {
                                                                echo " selected";
                                                            } ?>>Male</option>
                                        <option value="F" <?php if ($sex1 == "F") {
                                                                echo " selected";
                                                            } ?>>Female</option>
                                    </select>
                                    <label for="sex">Sex</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="bday" name="bday" value="<?php echo $bday1; ?>" max="<?php echo date('Y-m-d'); ?>" min="1800-01-01" oninput="" placeholder="Birthday">
                                    <label for="bday">Birthday</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="age" name="age" oninput="" maxlength="3" placeholder="Age" value="<?php echo $age1; ?>" readonly>
                                    <label for="age">Age</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="role" name="role" value="<?php echo $role1; ?>">
                                        <option value="ADMIN" <?php if ($role1 == "ADMIN"){
                                            echo " selected";
                                            }?>>ADMIN</option>
                                        <option value="SUPER ADMIN" <?php if ($role1 == "SUPER ADMIN"){
                                            echo " selected";
                                            }?>>SUPER ADMIN</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email1; ?>">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-end">
                                <button type="submit" class="btn btn-view form-button-text" name="resetpass"><span class="fw-bold">RESET PASSWORD</span></button>
                                <button type="submit" name="update" class="btn btn-update form-button-text"><span class="fw-bold">UPDATE</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        function validateAddress(input) {
            var regex = /^[a-zA-Z0-9\s.,]*$/; // Regular expression to allow alphanumeric characters, spaces, periods, and commas

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z0-9\s.,]/g, ''); // Remove any special characters except periods and commas
            }
        }

        function validateUsername(input) {
            var regex = /^[a-zA-Z0-9\sñÑ-]*$/; // Regular expression to allow only alphanumeric characters and spaces

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z0-9\sñÑ-]/g, ''); // Remove any special characters
            }
        }

        function validateName(input) {
            var regex = /^[a-zA-Z\sñÑ-]*$/; // Regular expression to allow only alphanumeric characters and spaces

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z\sñÑ-]/g, ''); // Remove any special characters
            }
        }

        function calculateAge() {
			// Get the input elements
			var bdayInput = document.getElementById('bday');
			var ageInput = document.getElementById('age');

			// Get the selected date value from the birthday input
			var selectedDate = new Date(bdayInput.value);

			// Get the current date
			var currentDate = new Date();

			// Calculate the difference in years between the selected date and the current date
			var age = currentDate.getFullYear() - selectedDate.getFullYear();

			// Check if the birthday for this year has already occurred
			if (
				currentDate.getMonth() < selectedDate.getMonth() ||
				(currentDate.getMonth() === selectedDate.getMonth() && currentDate.getDate() < selectedDate.getDate())
			) {
				age--;
			}

			// Update the age input field
			ageInput.value = age;
		}

		// Attach the calculateAge function to the oninput event of the birthday input
		document.getElementById('bday').addEventListener('input', calculateAge);

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>