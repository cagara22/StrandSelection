<?php
session_start();

if(!isset($_SESSION["admin"]))
{

    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php

}
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
							<a class="nav-link" href="home.php">HOME</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profiles.php">PROFILES</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">ABOUT</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="exam_category.php">EXAM CATEGORIES</a>
						</li>

                        <li class="nav-item">
							<a class="nav-link" href="add_edit_exam_questions.php">EXAM QUESTIONS</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" ><?php 
														echo $_SESSION['admin']; ?></a>
						</li>
						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="adminifo.php">ADMIN INFO</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LOGOUT</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<section class="d-flex flex-column align-items-center py-5">
			<div class="flex-row">


				<h1 class="fw-bold">Admin Information</h1>
			</div>

			
			<div class="row" style="width:70%">

			<?php 
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

    // Check if form was submitted
    if (isset($_POST['submit'])) {
        
        // Retrieve form data
        $id = $_SESSION['admin'];

		$password = $_POST['password'];
		$cpassword =$_POST['cpassword'];

		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$address = $_POST['address'];
		$contactnumber = $_POST['contactnumber'];

        // Prepare update query
		$sql = " UPDATE `admin` SET `username`='$username',`fullname`='$fullname',`address`='$address',`contactnumber`='$contactnumber'";
			
if (!empty($_POST['password'])) {
    $password = md5($_POST['password']);
    $sql .= ", password = '$cpassword'";
}  

if (!empty($_POST['password'])) {
    $cpassword = md5($_POST['cpassword']);
    $sql .= ", cpassword = '$cpassword'";
}  
       
$sql .= " WHERE username = '$id'";

        // Execute update query
        $result = $conn->query($sql);

        // Check if query was successful
        if ($result) {
            // Display success message and redirect to profiles page
            echo "<script>alert('Record updated successfully!')</script>";
            echo "<script>window.location.href = 'admininfo.php';</script>";

		} else {
			// Check if password and confirm password match
			if ($password !== $cpassword) {
			  echo "<script>alert('Password and Confirm Password do not match!');</script>";
			  echo "<script type='text/javascript'>history.go(-1);</script>";
        } else {
            // Display error message and MySQL error details
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } 
    }
}

	if (isset($_SESSION['admin'])) {

		$user_id = $_SESSION['admin']; 
	
		$sql = "SELECT * FROM `admin` WHERE username = '$user_id';";
	
		$result = $conn->query($sql); 
	
		if ($result->num_rows > 0) {        
	
			while ($row = $result->fetch_assoc()) {
	
             
        
                $fullname1 = $row['fullname'];
                $username1 = $row['username'];
                $address1 = $row['address'];
                $contactnumber1 = $row['contactnumber'];
				
}
}
	}
		
?>
				<form class="row"  action="" method="post">
					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Account Details</p>
					</div>

					<div class="col-12 mb-3">
						<label for="Name" class="form-label"> Full Name</label>
						<input type="text" class="form-control" id="Name"
						name="fullname" value="<?php echo $fullname1; ?>" placeholder="" required>
					</div>
                    <div class="col-12 mb-3">
						<label for="Address" class="form-label">Address</label>
						<input type="text" class="form-control" id="Address"
						name="address" value="<?php echo $address1; ?>" placeholder="" required>
					</div>
					<div class="col-12 mb-3">
						<label for="ContactNumber" class="form-label">Contact Number</label>
						<input type="text" class="form-control" id="ContactNumber"
						name="contactnumber" value="<?php echo $contactnumber1; ?>" placeholder="" required>
					</div>
					<div class="col-12 mb-3">
						<label for="UserName" class="form-label"> Username</label>
						<input type="text" class="form-control" id="UserName"
						name="username" value="<?php echo $username1; ?>" placeholder="" required>
					</div>
                    <div class="col-12 col-md-6 mb-3">
						<label for="Password" class="form-label">Password</label>
						<input type="text" class="form-control" id="Password"
						name="password"   placeholder="" >
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="ConfirmPassword" class="form-label">Confirm Password</label>
						<input type="text" class="form-control" id="ConfirmPassword"
						name="cpassword" placeholder="">
					</div>

					<div class="divider d-flex align-items-center my-4"></div>

					<div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
						<button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
						<button class="btn btn-secondary" type="button">CLEAR</button>
					</div>
				</form>
			</div>
		</section>
		
		<footer class="d-flex flex-column flex-md-row text-center justify-content-center py-4 px-4 px-xl-5 bg-dark">
			<!-- Copyright -->
			<div class="text-white mb-3 mb-md-0">
			  Copyright © 2022. All rights reserved.
			</div>
			<!-- Copyright -->
		</footer>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
		<script src="customjs.js"></script>
	</body>
</html>