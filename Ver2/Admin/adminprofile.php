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
    <title>Strand Selection Admin Ver2</title>
    <link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    <h1 class="fw-bold sub-title"><?php echo $_SESSION['fullname']; //display the name of the admin ?></h1>
                </div>
                <div class="card custcard border-light text-center" style="width: 100%;">
                    <div class="card-header">
                        <h4 class="fw-bold card-text-header">Admin Details</h4>
                    </div>
                    <div class="card-body">

                        <?php

                        include "connection.php"; //include the connection file

                        //check if the update button is clicked
                        if (isset($_POST['update'])) {
                            $sql = '';
                            //retrieve form data
                            $id = $_SESSION['admin'];
                            $fname = strtoupper(mysqli_real_escape_string($conn, $_POST['fname']));
                            $mname = strtoupper(mysqli_real_escape_string($conn, $_POST['mname']));
                            $lname = strtoupper(mysqli_real_escape_string($conn, $_POST['lname']));
                            $suffix = strtoupper(mysqli_real_escape_string($conn, $_POST['suffix']));
                            $age = mysqli_real_escape_string($conn, $_POST['age']);
                            $role = mysqli_real_escape_string($conn, $_POST['role']);
                            $sex = mysqli_real_escape_string($conn, $_POST['sex']);
                            $email = mysqli_real_escape_string($conn, $_POST['email']);
                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
                            $password = md5($_POST['pass1']);
						    $cpassword = md5($_POST['pass2']);

                            //check if the username is already taken
                            $query = "SELECT adminID FROM adminprofile WHERE username = '$username' AND adminID <> '$id'";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) { //username already taken
                                echo "<script>Swal.fire({
                                    title: 'INVALID USERNAME!',
                                    text: 'USERNAME already exists in the database!',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 5000
                                    });</script>";
                            }else{ //username not taken
                                if (!empty($_POST['pass1'])) { //password not empty
                                    if (!empty($_POST['pass2'])) { //confirm password not empty
                                        if ($password !== $cpassword) { //password and confirm password do not match
                                            echo "<script>Swal.fire({
                                                title: 'PASSWORDS DO NOT MATCH!',
                                                text: 'Password and Confirm Password do not match!',
                                                icon: 'error',
                                                showConfirmButton: false,
                                                timer: 5000
                                                });</script>";
                                        }else{ //passwrod and confirm password matches
                                            //prepare the update sql statement with password
                                            $sql = "UPDATE adminprofile SET username='$username', fname='$fname', mname='$mname', lname='$lname', 
                                            address='$address', age='$age', sex='$sex', suffix='$suffix', email='$email', role='$role' password='$password' WHERE adminID='$id'";
                                        }
                                    }else{ //confirm password empty
                                        echo "<script>Swal.fire({
                                            title: 'CONFIRM PASSWORD',
                                            text: 'Please confirm the password.',
                                            icon: 'info',
                                            showConfirmButton: false,
                                            timer: 5000
                                            });</script>";
                                    }
                                }else{ //password empty
                                    //prepare update sql statement without password
                                    $sql = "UPDATE adminprofile SET username='$username', fname='$fname', mname='$mname', lname='$lname', 
                                    address='$address', age='$age', sex='$sex', suffix='$suffix', email='$email' WHERE adminID='$id'";
                                }

                                if(!empty($sql)){ //if everything is set, update
                                    if (mysqli_query($conn, $sql)) {
                                        //log the update
                                        $_SESSION['admin'] = $username;
									    $_SESSION['role'] = $role;

                                        //concatenate fname, mname, and lname to create the full name
                                        $fullname = $fname; // Initialize with the first name

                                        if (!empty($mname)) {
                                            $fullname .= ' ' . $mname; // Add the middle name if it exists
                                        }

                                        if (!empty($lname)) {
                                            $fullname .= ' ' . $lname; // Add the last name if it exists
                                        }

                                        $_SESSION['fullname'] = $fullname;

                                        $admin_username = $_SESSION['fullname'];
                                        $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', '$role with Username $username has updated his account', '$admin_username')";
                                        $conn->query($log);

                                        echo "<script>Swal.fire({
                                            title: 'Successfully Updated',
                                            text: 'Student profile updated successfully!',
                                            icon: 'success',
                                            buttons: {
                                              confirm: true,
                                            },
                                          }).then((value) => {
                                            if (value) {
                                              document.location='adminprofile.php';
                                            } else {
                                              document.location='adminprofile.php';
                                            }
                                          });</script>";
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                }
                            }
                        }

                        //check id the admin is log in
                        if (isset($_SESSION['admin'])) {
                            $user_id = $_SESSION['admin'];

                            //retrieve the admin's info
                            $sql1 = "SELECT * FROM `adminprofile` WHERE username = '$user_id';";

                            $result = $conn->query($sql1);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $fname1 = $row['fname'];
                                    $mname1 = $row['mname'];
                                    $lname1 = $row['lname'];
                                    $suffix1 = $row['suffix'];
                                    $age1 = $row['age'];
                                    $role1 = $row['role'];
                                    $sex1 = $row['sex'];
                                    $email1 = $row['email'];
                                    $username1 = $row['username'];
                                    $address1 = $row['address'];
                                }
                            }
                        }
                        ?>

                        <form class="row" action="" method="post">
                            <div class="col-12 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username1; ?>" oninput="validateName(this)" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname1; ?>" oninput="validateName(this)" placeholder="First Name" required>
                                    <label for="fname">First Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $mname1; ?>" oninput="validateName(this)" placeholder="Middle Name">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname1; ?>" oninput="validateName(this)" placeholder="Last Name" required>
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo $suffix1; ?>" oninput="validateName(this)" placeholder="Suffix">
                                    <label for="suffix">Suffix</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address1; ?>" oninput="validateAddress(this)" placeholder="Address" required>
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="sex" name="sex">
                                        <option value="M" <?php if ($sex1 == "M") {
                                                                echo "selected";
                                                            } ?>>Male</option>
                                        <option value="F" <?php if ($sex1 == "F") {
                                                                echo "selected";
                                                            } ?>>Female</option>
                                    </select>
                                    <label for="sex">Sex</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="age" name="age" value="<?php echo $age1; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Age" required>
                                    <label for="age">Age</label>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="role" name="role" value="">
                                        <option value="ADMIN" <?php if ($role1 == "ADMIN") {
                                                                    echo "selected";
                                                                } ?>>ADMIN</option>
                                        <option value="SUPER ADMIN" <?php if ($role1 == "SUPER ADMIN") {
                                                                        echo "selected";
                                                                    } ?>>SUPER ADMIN</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email1; ?>" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass1" name="password" placeholder="Password">
                                    <label for="pass1">PASSWORD</label>
                                </div>
                                <div class="col-sm-6" id="passstrength" style="font-weight:bold;padding:6px 12px;">

                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass2" name="cpassword" placeholder="Confirm Password">
                                    <label for="pass2">CONFIRM PASSWORD</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-end">
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
    <script type="text/javascript" src="./js/password-score.js"></script>
    <script type="text/javascript" src="./js/password-score-options.js"></script>
    <script type="text/javascript" src="./js/bootstrap-strength-meter.js"></script>
    <script>
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

        function validateAddress(input) {
            var regex = /^[a-zA-Z0-9\s.,]*$/; // Regular expression to allow alphanumeric characters, spaces, periods, and commas

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z0-9\s.,]/g, ''); // Remove any special characters except periods and commas
            }
        }

        function validateName(input) {
            var regex = /^[a-zA-Z0-9\sñÑ-]*$/; // Regular expression to allow alphanumeric characters, spaces, ñ, Ñ, and dash

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^a-zA-Z0-9\sñÑ-]/g, ''); // Remove any characters that do not match the allowed set
            }
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>