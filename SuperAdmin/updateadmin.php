<?php
session_start();

if (!isset($_SESSION["super_admin"])) {

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

					<!-- 
<li class="nav-item">
    <a class="nav-link" href="exam_category.php">EXAM CATEGORIES</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="add_edit_exam_questions.php">EXAM QUESTIONS</a>
</li>
-->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo $_SESSION['super_admin']; ?>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="admininfo.php">ADMIN INFO</a></li>
							<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="d-flex flex-column justify-content-center align-items-center py-5">
	<div class="col-4">
		<?php
		$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

		if (isset($_POST['update'])) {


			$id = $_GET['id2'];
			$username = $_POST['username'];

			$fullname = $_POST['fullname'];

			$password = $_POST['password'];

			$address = $_POST['address'];

			$contact = $_POST['contactnumber'];

			$sql = "UPDATE `admin` SET 
                `username`='$username',
                `fullname`='$fullname',
                `password`= MD5('$password'),
                `address`='$address',
                `contactnumber`='$contact'
         
                WHERE `id`= '$id'";
			$result = $conn->query($sql);


			if ($result == TRUE) {

				echo "<script>swal({
									title: 'Record updated successfully!',
									icon: 'success',
									button: 'OK',
								  });</script>";
				echo "<script>document location ='admins.php';</script>";
			} else {

				echo "Error:" . $sql . "<br>" . $conn->error;
			}
		}


		if (isset($_GET['id'])) {

			$user_id = $_GET['id'];

			$sql = "SELECT * FROM `admin` WHERE `id`='$user_id'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while ($row = $result->fetch_assoc()) {

					$username1 = $row['username'];

					$fullname1 = $row['fullname'];

					$address1 = $row['address'];

					$contact1 = $row['contactnumber'];
				}
			}
			$conn->close();
		}

		?>



		<form class="row g-3" action="" method="post">
			<h2 class="form-signin-heading">Admin Information</h2>
			<div class="col-12">
				<label class="form-label" for="username">Username</label>
				<input type="text" id="username" name="username" class="form-control" placeholder="Enter username" value="<?php echo $username1; ?>" />
			</div>
			<div class="col-12">
				<label class="form-label" for="fullname">Fullname</label>
				<input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter fullname" value="<?php echo $fullname1; ?>" />
			</div>
			<div class="col-12">
				<label class="form-label" for="password">Password</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="Enter password" />
			</div>
			<div class="col-12">
				<label class="form-label" for="confirmPassword">Confirm Password</label>
				<input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" />
			</div>
			<div class="col-12">
				<label class="form-label" for="address">Address</label>
				<input type="text" id="address" name="address" class="form-control" placeholder="Enter address" value="<?php echo $address1; ?>" />
			</div>
			<div class="col-12">
				<label class="form-label" for="contactNumber">Contact Number</label>
				<input type="text" id="contactNumber" name="contactnumber" class="form-control" placeholder="Enter contact number" value="<?php echo $contact1; ?>" />
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary" name="update">UPDATE</button>
				<button type="submit" class="btn btn-info" name="cancel">CANCEL</button>

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
</body>

</html>