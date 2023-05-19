<?php
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
					<li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="profiles.php">PROFILES</a>
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
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo $_SESSION['admin']; ?>
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
		// Establish database connection
		$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

		// Check if form was submitted
		if (isset($_POST['add'])) {

			// Retrieve form data
			$id = $_GET["lrn"];
			$approve = $_POST['approve'];
			$status = $_POST['status'];

			// Prepare update query
			$sql = "UPDATE `student` SET `approve`='$approve' , `status`= '$status' WHERE lrn = '$id'";


			// Execute update query
			$result = $conn->query($sql);

			// Check if query was successful
			if ($result) {
				// Display success message and redirect to profiles page
				echo "<script>alert('Record updated successfully!')</script>";
				echo "<script>window.location.href = 'profiles.php';</script>";
			} else {
				// Display error message and MySQL error details
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		if (isset($_GET['lrn'])) {

			$user_id = $_GET['lrn'];

			$sql = "SELECT * FROM `student` WHERE `lrn` ='$user_id'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while ($row = $result->fetch_assoc()) {

					$strand1 = $row['strand'];
					$approve1 = $row['approve'];
					$status1 = $row['status'];
				}
			}
		}
		?>
		<form class="row g-3" action="" method="post">
			<h2 class="form-signin-heading">Student Profile</h2>


			<div class="col-12 mb-3">
				<label class="form-label" for="approve">Approval Status</label>
				<select class="form-select" id="approve" name="approve">
					<option value="APPROVE" <?php if ($approve1 == "APPROVE") {
												echo " selected";
											} ?>>APPROVE</option>
					<option value="DISAPPROVE" <?php if ($approve1 == "REJECT") {
													echo " selected";
												} ?>>REJECT</option>
				</select>
			</div>

			<div class="col-12 mb-3">
				<label class="form-label" for="status">Status</label>
				<select class="form-select" id="status" name="status">
					<option value="ACTIVE" <?php if ($status1 == "ACTIVE") {
												echo " selected";
											} ?>>ACTIVE</option>
					<option value="INACTIVE" <?php if ($status1 == "INACTIVE") {
													echo " selected";
												} ?>>INACTIVE</option>
				</select>
			</div>

			<button type="submit" class="btn btn-primary" name="add">SUBMIT</button>
		</form>
	</div>
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