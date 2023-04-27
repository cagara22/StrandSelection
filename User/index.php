<?php
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Strand Selection</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		<!-- Custom CSS -->
		<link rel="stylesheet" href="custom_css.css">
	</head>
	
	<body>
		<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">
					<img src="./images/SystemBrandWhiteVer2.png" alt="Logo" width="200" height="34" class="d-inline-block align-text-top">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="#LoginSection">LOGIN</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalRegisterForm">REGISTER</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		

		<header class="d-flex flex-column justify-content-center align-items-center py-5" id="Header">
			<img src="./images/SystemLogo.png" alt="Logo" class="img-fluid">
			<h3 class="fst-italic fw-bold">"Discover Your Path: Let Our Decision Support System Guide You to Your Ideal Senior High School Strand!"</h3>
			<div class="py-5">
				<a href="#LoginSection"><button type="button" class="btn btn-outline-dark btn-lg fw-bold fs-3">GET STARTED</button></a>
			</div>
		</header>

		<section class="py-5" id="LoginSection">
			<div class="container-fluid">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-md-9 col-lg-6 col-xl-5">
						<img src="./images/edupic.png" class="img-fluid" alt="Sample image">
					</div>
					<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
					<?php
$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

if (isset($_POST['lrn']) && isset($_POST['password'])) {
  $username = mysqli_real_escape_string($conn, $_POST['lrn']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT * FROM student WHERE lrn = '$username' AND approve = 'APPROVE'";
  $q = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($q);

  if ($num == 1) {
    $data = mysqli_fetch_assoc($q);
    $upass = $data['password'];

    if (md5($password) == "$upass") {
      $_SESSION['student'] = $username;
      header("Location: list.php");
    } else {
      echo "<script>swal({
              title: 'Wrong Password',
              icon: 'error',
              button: 'OK',
            });</script>";
      echo "<script type='text/javascript'> document location =index.php#LoginSection</script>";
    }
  } else {
    echo "<script>swal({
            title: 'Invalid Username or Account not yet approved.',
            icon: 'error',
            button: 'OK',
          });</script>";
    echo "<script type='text/javascript'> document location =index.php#LoginSection</script>";

  }
}
?>

						<form action="" method="post">
							<div class="d-flex flex-row align-items-center justify-content-center">
								<img src="./images/SystemBrandBlackVer2.png" alt="Logo" width="250" height="50" class="d-inline-block align-text-top">
							</div>

							<div class="divider d-flex align-items-center my-4">
								<p class="text-center fw-bold mx-3 mb-0">LOGIN FORM</p>
							</div>

							<!-- LRN input -->
							<div class="form-outline mb-4">
								<label class="form-label" for="username">LRN</label>
								<input type="text" id="username" name ="lrn" class="form-control form-control-lg" placeholder="Enter a valid LRN" />
							</div>

							<!-- Password input -->
							<div class="form-outline mb-3">
								<label class="form-label" for="password">Password</label>
								<input type="password" id="password" name ="password" class="form-control form-control-lg" placeholder="Enter password" />
							</div>

							<div class="d-flex justify-content-between align-items-center">
								<!-- Checkbox -->
								<div class="form-check mb-0">
									<input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
									<label class="form-check-label" for="form2Example3"> Remember me </label>
								</div>
							</div>

							<div class="text-center text-lg-start mt-4 pt-2">
		
									<button type="submit" class="btn btn-primary btn-lg"
									style="padding-left: 2.5rem; padding-right: 2.5rem;">LOGIN</button>
					
							</div>

						</form>
					</div>
				</div>
			</div>
		</section>
	

		<div class="modal fade" id="modalRegisterForm" tabindex="-1" aria-labelledby="modalRegisterForm" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="ModalLabel">REGISTER</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

					<?php
// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

if (isset($_POST['add'])) {
  // Get form data
  $lrn = mysqli_real_escape_string($conn, $_POST["lrn2"]);
  $fname = mysqli_real_escape_string($conn, $_POST["Fname"]);
  $mname = mysqli_real_escape_string($conn, $_POST["Mname"]);
  $lname = mysqli_real_escape_string($conn, $_POST["Lname"]);
  $address = mysqli_real_escape_string($conn, $_POST["address"]);
  $sex = mysqli_real_escape_string($conn, $_POST["sex"]);
  $age = mysqli_real_escape_string($conn, $_POST["age"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password2"]);

  // Check if LRN already exists
  $sql = "SELECT * FROM `student` WHERE `lrn` = '$lrn'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $num = mysqli_num_rows($result);
  if ($num > 0) {
    echo "<script>alert('LRN already exists!');</script>";
	echo "<script type='text/javascript'>history.go(-1);</script>";
  } else {
    // Insert new record
	$sql = "INSERT INTO `student`(`lrn`, `password`, `Fname`, `address`, `sex`, `Mname`, `age`, `Lname`, `email`, `approve`) 
        VALUES ('$lrn', MD5('$password'), '$fname', '$address', '$sex', '$mname', '$age', '$lname', '$email', 'PENDING')";

$result1 = $conn->query($sql);

if ($result1 === TRUE) {
    $lrn_id = $lrn;
    
    $sql2 = "INSERT INTO `academic_performance`(`lrn`) VALUES ('$lrn_id')";
    $result2 = $conn->query($sql2);

    $sql3 = "INSERT INTO `career`(`lrn`) VALUES ('$lrn_id')";
    $result3 = $conn->query($sql3);

    $sql4 = "INSERT INTO `exam_score`(`lrn`) VALUES ('$lrn_id')";
    $result4 = $conn->query($sql4);

    $sql5 = "INSERT INTO `interests`(`lrn`) VALUES ('$lrn_id')";
    $result5 = $conn->query($sql5);

    $sql6 = "INSERT INTO `skills`(`lrn`) VALUES ('$lrn_id')";
    $result6 = $conn->query($sql6);

    $sql7 = "INSERT INTO `socioeconomic_background`(`lrn`) VALUES ('$lrn_id')";
    $result7 = $conn->query($sql7);

    if ($result2 === TRUE && $result3 === TRUE && $result4 === TRUE && $result5 === TRUE && $result6 === TRUE && $result7 === TRUE) {
        echo "<script>swal({
                title: 'Record Added',
                icon: 'success',
                button: 'OK',
              });</script>";
        echo "<script type='text/javascript'> document.location = 'index.php#LoginSection'; </script>";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        $conn->rollback();
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->commit();
	} 


	}

	?>

							<form class="row"  action="" method="post">
							<div class="divider d-flex align-items-center my-4">
								<p class="text-center fw-bold mx-3 mb-0">Account Details</p>
							</div>
							<div class="col-12 mb-3">
								<label for="lrn" class="form-label">LRN</label>
								<input type="number" class="form-control" id="lrn" name="lrn2" placeholder="">
							</div>
							<div class="col-12 col-md-4 mb-3">
								<label for="FName" class="form-label">First Name</label>
								<input type="text" class="form-control" id="FName" name="Fname" placeholder="">
							</div>
							<div class="col-12 col-md-4 mb-3">
								<label for="MName" class="form-label">Middle Name</label>
								<input type="text" class="form-control" id="MName" name="Mname" placeholder="">
							</div>
							<div class="col-12 col-md-4 mb-3">
								<label for="LName" class="form-label">Last Name</label>
								<input type="text" class="form-control" id="LName" name="Lname" placeholder="">
							</div>
							<div class="col-12 mb-3">
								<label for="Address" class="form-label">Address</label>
								<input type="text" class="form-control" id="Address" name="address" placeholder="">
							</div>
							<div class="col-12 col-md-6 mb-3">
								<label class="form-label" for="Gender">Sex</label>
								<select class="form-select" id="Gender" name="sex">
									<option value="M">Male</option>
									<option value="F">Female</option>
								</select>
							</div>
							<div class="col-12 col-md-6 mb-3">
								<label for="Age" class="form-label">Age</label>
								<input type="text" class="form-control" id="Age"  name= "age" placeholder="">
							</div>
							<div class="col-12 mb-3">
								<label for="Email" class="form-label">Email</label>
								<input type="email" class="form-control" id="Email" name ="email" placeholder="">
							</div>
							<div class="col-12 col-md-6 mb-3">
								<label for="Password" class="form-label">Password</label>
								<input type="password" class="form-control" minlength="8" id="example-getting-started-input"
								name= "password2" placeholder="" required>
								<div class="col-sm-6" id="example-getting-started-text" style="font-weight:bold;padding:6px 12px;">
 
								</div>
							</div>
							<div class="col-12 col-md-6 mb-3">
								<label for="CofirmPassword" class="form-label">Cofirm Password</label>
								<input type="password" class="form-control" id="CofirmPassword" placeholder="">
							</div>
							<button type="submit" class="btn btn-primary" name="add" >SUBMIT</button>

							
						</form>
					</div>
				</div>
			</div>
		</div>
            
		
		<footer class="d-flex flex-column flex-md-row text-center justify-content-center py-4 px-4 px-xl-5 bg-dark">
			<!-- Copyright -->
			<div class="text-white mb-3 mb-md-0">
			  Copyright © 2022. All rights reserved.
			</div>
			<!-- Copyright -->
		</footer>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="./js/password-score.js"></script>
		<script type="text/javascript" src="./js/password-score-options.js"></script>
		<script type="text/javascript" src="./js/bootstrap-strength-meter.js"></script>
		<script src="customjs.js"></script>
		

		<script type="text/javascript">
			$(document).ready(function() {
				$('#example-getting-started-input').strengthMeter('text', {
					container: $('#example-getting-started-text'),
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
		</script>
	</body>
</html>