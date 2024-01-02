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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fw-bold sub-title">ADD NEW ADMIN</h1>
                </div>
                <div class="card custcard border-light text-center" style="width: 100%;">
                    <div class="card-header">
                        <h4 class="fw-bold card-text-header">Admin Details</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        include "connection.php"; //include the connection file

                        //check if the add button is clicked
                        if (isset($_POST['add'])) {

                            //get the data from the form
                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $fname =  strtoupper(mysqli_real_escape_string($conn, $_POST['fname']));
                            $mname = strtoupper(mysqli_real_escape_string($conn, $_POST['mname']));
                            $lname = strtoupper(mysqli_real_escape_string($conn, $_POST['lname']));
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
                            $suffix = strtoupper(mysqli_real_escape_string($conn, $_POST['suffix']));
                            $address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
                            $password = md5($_POST['password']);
                            $cpassword = md5($_POST['cpassword']);

                            //check if the username is already taken
                            $query = "SELECT * FROM `adminprofile` WHERE username = '$username'";

                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) { //if taken
                                echo "<script>Swal.fire({
                                    title: 'INVALID USERNAME!',
                                    text: 'USERNAME already exists in the database!',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 5000
                                    });</script>";
                                // echo "<script>document location ='addadmin.php';</script>";
                            }else{ //not taken
                                if (!empty($_POST['password'])) { //password not empty
                                    if (!empty($_POST['cpassword'])) { //confirm password not empty
                                        if ($password !== $cpassword) {//confirm password does not match
                                            echo "<script>Swal.fire({
                                                title: 'PASSWORDS DO NOT MATCH!',
                                                text: 'Password and Confirm Password do not match!',
                                                icon: 'error',
                                                showConfirmButton: false,
                                                timer: 5000
                                                });</script>";
                                        }else{ //confirm password and password match
                                            //prepare sql statement with password
                                            if(!empty($_POST['bday'])){
                                                $sql = "INSERT INTO `adminprofile`(`username`, `fname`, `mname`, `lname`, `suffix`, `address`, `sex`, `bday`, `age`, `role`, `email`, `password`) 
                                                VALUES ('$username', '$fname', '$mname', '$lname', '$suffix', '$address', '$sex', '$bday', '$age', '$role', '$email', '$password')";
                                            }else{
                                                $sql = "INSERT INTO `adminprofile`(`username`, `fname`, `mname`, `lname`, `suffix`, `address`, `sex`, `role`, `email`, `password`) 
                                                VALUES ('$username', '$fname', '$mname', '$lname', '$suffix', '$address', '$sex', '$role', '$email', '$password')";
                                            }
                                            

                                            if (mysqli_query($conn, $sql)) {
                                                //log the adding of admin
                                                $admin_username = $_SESSION['fullname'];
                                                $log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Added', '$role with Username $username was added', '$admin_username')";
                                                $conn->query($log);

                                                echo "<script>Swal.fire({
                                                    title: 'Successfully Added',
                                                    text: 'New admin profile added successfully!',
                                                    icon: 'success',
                                                    buttons: {
                                                      confirm: true,
                                                    },
                                                  }).then((value) => {
                                                    if (value) {
                                                      document.location='addadmin.php';
                                                    } else {
                                                      document.location='addadmin.php';
                                                    }
                                                  });</script>";
                                                //echo "<script>alert('New record added successfully!');</script>";
                                                //echo "<script>document.location='addadmin.php';</script>";
                                            } else {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                            }
                                        }
                                    }else{//cofirm password empty
                                        echo "<script>Swal.fire({
                                            title: 'CONFIRM PASSWORD',
                                            text: 'Please confirm the password.',
                                            icon: 'info',
                                            showConfirmButton: false,
                                            timer: 5000
                                            });</script>";
                                    }
                                }else{//password empty
                                    echo "<script>Swal.fire({
                                        title: 'ADD PASSWORD',
                                        text: 'Please add the password.',
                                        icon: 'info',
                                        showConfirmButton: false,
                                        timer: 5000
                                        });</script>";
                                }
                            }
                        }
                        ?>
                        <form class="row" action="" method="post">
                            <div class="col-12 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" oninput="validateUsername(this)" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fname" name="fname" oninput="validateName(this)" placeholder="First Name" required>
                                    <label for="fname">First Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mname" name="mname" oninput="validateName(this)" placeholder="Middle Name">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lname" name="lname" oninput="validateName(this)" placeholder="Last Name" required>
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="suffix" name="suffix" oninput="validateName(this)" placeholder="Suffix">
                                    <label for="suffix">Suffix</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="address" name="address" oninput="validateAddress(this)" placeholder="Address">
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="sex" name="sex" value="">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    <label for="sex">Sex</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="bday" name="bday" value="" max="<?php echo date('Y-m-d'); ?>" min="1800-01-01" oninput="" placeholder="Birthday">
                                    <label for="bday">Birthday</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="age" name="age" oninput="" maxlength="3" placeholder="Age" readonly>
                                    <label for="age">Age</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="role" name="role" value="">
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="SUPER ADMIN">SUPER ADMIN</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="input-group mb-1">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="pass1" name="password" placeholder="Password">
                                        <label for="pass1">PASSWORD</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="height: 58px;" onclick="password_show_hide();">
                                            <i class="fas fa-eye" id="show_eye1"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye1"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6" id="passstrength" style="font-weight:bold;padding:6px 12px;">

                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="input-group mb-1">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="pass2" name="cpassword" placeholder="Confirm Password">
                                        <label for="pass2">CONFIRM PASSWORD</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="height: 58px;" onclick="cpassword_show_hide();">
                                            <i class="fas fa-eye" id="show_eye2"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-end">
                                <button type="submit" class="btn btn-add form-button-text" name="add"><span class="fw-bold">ADD</span></button>
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
        //for password strength mesurements
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

        //for text formatting
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

        function password_show_hide() {
			var x = document.getElementById("pass1");
			var show_eye = document.getElementById("show_eye1");
			var hide_eye = document.getElementById("hide_eye1");
			hide_eye.classList.remove("d-none");
			if (x.type === "password") {
				x.type = "text";
				show_eye.style.display = "none";
				hide_eye.style.display = "block";
			} else {
				x.type = "password";
				show_eye.style.display = "block";
				hide_eye.style.display = "none";
			}
		}

		function cpassword_show_hide() {
			var x = document.getElementById("pass2");
			var show_eye = document.getElementById("show_eye2");
			var hide_eye = document.getElementById("hide_eye2");
			hide_eye.classList.remove("d-none");
			if (x.type === "password") {
				x.type = "text";
				show_eye.style.display = "none";
				hide_eye.style.display = "block";
			} else {
				x.type = "password";
				show_eye.style.display = "block";
				hide_eye.style.display = "none";
			}
		}

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>