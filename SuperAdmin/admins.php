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
					<li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="admins.php">ADMINS</a>
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
						<a class="nav-link"><?php
											echo $_SESSION['super_admin']; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="admininfo.php">ADMIN INFO</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">LOGOUT</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="d-flex flex-column justify-content-center align-items-center py-5">
		<div class="row" style="width:100%">
			<div class="col-8">
				<form class="row g-3">
					<div class="col-4">
						<input type="text" class="form-control" id="searchname" name="searchname" placeholder="Search...">
					</div>
					<div class="col-md-4">
						<button type="submit" class="btn btn-secondary" name="search">SEARCH</button>
					</div>
				</form>

				<table class="table table-striped table-hover">
					<thead>
						<tr class="text-center">
							<th scope="col">ID</th>
							<th scope="col">Username</th>
							<th scope="col">Full Name</th>
							<th scope="col">Address</th>
							<th scope="col">Contact Number</th>
							<th scope="col" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						<tr>
							<?php
							$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
							if (isset($_GET['page_no'])) {
								$page_no = $_GET['page_no'];
							} else {
								$page_no = 1;
							}

							$total_records_per_page = 30;
							$offset = ($page_no - 1) * $total_records_per_page;

							$previous_page = $page_no - 1;
							$next_page = $page_no + 1;


							$result_count = mysqli_query($conn, "SELECT COUNT(*)as total_records FROM admin")
								or die('Unable to connect to database');

							$records = mysqli_fetch_array($result_count);
							$total_records = $records['total_records'];

							$total_no_of_page = ceil($total_records / $total_records_per_page);

							$sql = "select * from admin limit $offset,$total_records_per_page";



							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								// output data of each row
								while ($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td class = 'text-center'>" . $row['id'] . "</td>";
									echo "<td class = 'text-center'>" . $row['username'] . "</td>";
									echo "<td class = 'text-center'>" . $row['fullname'] . "</td>";
									echo "<td class = 'text-center'>" . $row['address'] . "</td>";
									echo "<td class = 'text-center'>" . $row['contactnumber'] . "</td>";
									echo "<td class = 'text-center'>
								<a href='updateadmin.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>EDIT</a> 
								<a href='deleteadmin.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>DELETE</a> 
								</td>";
									echo "</tr>";
								}
								echo "</table>";
							} else {
								echo "0 results";
							}

							?>
						</tr>
					</tbody>
				</table>
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>>Previous</a></li>
						<?php for ($counter = 1; $counter <= $total_no_of_page; $counter++) {
						?>
							<li class="page-item"><a class="page-link" href="?page_no=<?= $counter; ?>">
									<?= $counter; ?></a></li>
						<?php
						}
						?>
						<li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_page) ? 'disabled' : ''; ?>" <?= ($page_no < $total_no_of_page) ? 'href=?page_no=' . $next_page : ''; ?>>Next</a></li>
					</ul>
				</nav>

				<div class="p-10">
					<strong>Page <?= $page_no; ?> of <?= $total_no_of_page; ?>

					</strong>

				</div>

			</div>
			<div class="col-4">
				<?php

				$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

				if (isset($_POST['add'])) {

					$username = $_POST['username'];
					$fullname = $_POST['fullname'];
					$password = $_POST['password'];
					$address = $_POST['address'];
					$contact = $_POST['contactnumber'];
					$cpassword = $_POST['cpassword'];

					// Check if passwords match
					if ($password != $cpassword) {
						echo "<script>alert('Passwords do not match.');</script>";
						echo "<script>document.location='admins.php';</script>";
						exit();
					}

					$sql = "SELECT * FROM `admin` WHERE username = '$username' ";
					$result =  mysqli_query($conn, $sql);

					if ($result) {
						$num = mysqli_num_rows($result);
						if ($num > 0) {
							echo "<script>alert('Admin record already exists.');</script>";
							echo "<script>document.location='admins.php';</script>";
						} else {
							$sql = "INSERT INTO `admin`(`username`, `fullname`, `password`, `address`, `contactnumber`) VALUES 
            ('$username','$fullname', MD5('$password'),'$address','$contact')";
							$result = $conn->query($sql);
							if ($result == TRUE) {
								echo "<script>alert('New record added successfully!');</script>";
								echo "<script>document.location='admins.php';</script>";
							} else {
								echo "Error:" . $sql . "<br>" . $conn->error;
							}
						}
					}
				}
				?>

				<form class="row g-3" action="" method="post">
					<h2 class="form-signin-heading">Admin Information</h2>
					<div class="col-12">
						<label class="form-label" for="username">Username</label>
						<input type="text" id="username" name="username" class="form-control" placeholder="Enter username" />
					</div>
					<div class="col-12">
						<label class="form-label" for="fullname">Fullname</label>
						<input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter fullname" />
					</div>
					<div class="col-12">
						<label class="form-label" for="password">Password</label>
						<input type="password" id="password" name="password" class="form-control" placeholder="Enter password" />
					</div>
					<div class="col-12">
						<label class="form-label" for="confirmPassword">Confirm Password</label>
						<input type="password" id="confirmPassword" name="cpassword" class="form-control" placeholder="Confirm Password" />
					</div>
					<div class="col-12">
						<label class="form-label" for="address">Address</label>
						<input type="text" id="address" name="address" class="form-control" placeholder="Enter address" />
					</div>
					<div class="col-12">
						<label class="form-label" for="contactNumber">Contact Number</label>
						<input type="text" id="contactNumber" name="contactnumber" class="form-control" placeholder="Enter contact number" />
					</div>
					<div class="col-12">
						<button type="submit" class="btn btn-primary" name="add">ADD</button>
						<button type="submit" class="btn btn-info" name="cancel">CANCEL</button>
					</div>
				</form>
			</div>
		</div>
		<!-- <img src="./images/UnderDev.png" class="img-fluid" alt="Logo" width="400" height="400"> -->
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