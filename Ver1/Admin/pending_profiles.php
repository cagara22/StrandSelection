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
		<div class="row" style="width:100%">
			<div class="col-12">

				<form class="row g-3" method="GET" action="">
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
							<th scope="col">LRN</th>
							<th scope="col">First Name</th>
							<th scope="col">Middle Name</th>
							<th scope="col">Last Name</th>
							<th scope="col">Approval Status</th>
							<th scope="col">Qualified Strand</th>
							<th scope="col">Status</th>
							<th scope="col" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						<?php
						$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

						if (isset($_GET['page_no'])) {
							$page_no = $_GET['page_no'];
						} else {
							$page_no = 1;
						}

						$total_records_per_page = 30;
						$offset = ($page_no - 1) * $total_records_per_page;

						if (isset($_GET['searchname'])) {
							$search = $_GET['searchname'];
							$sql = "SELECT * FROM student WHERE Fname LIKE '%$search%' OR Mname LIKE '%$search%' OR Lname LIKE '%$search%' OR approve LIKE '%$search%'";
						} else {
							$sql = "SELECT * FROM student WHERE approve LIKE '%PENDING%' LIMIT $offset, $total_records_per_page";
						}

						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							// output data of each row
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td class='text-center'>" . $row['lrn'] . "</td>";
								echo "<td class='text-center'>" . $row['Fname'] . "</td>";
								echo "<td class='text-center'>" . $row['Mname'] . "</td>";
								echo "<td class='text-center'>" . $row['Lname'] . "</td>";
								echo "<td class='text-center'>" . $row['approve'] . "</td>";
								echo "<td class='text-center'>" . $row['strand'] . "</td>";
								echo "<td class='text-center'>" . $row['status'] . "</td>";
								echo "<td class='text-center'>
              <a href='update.php?lrn=" . $row['lrn'] . "' class='btn btn-success editbtn'>EDIT</a>
              <a href='delete.php?lrn=" . $row['lrn'] . "' class='btn btn-danger btn-sm'>DELETE</a> 
              <a href='view.php?lrn=" . $row['lrn'] . "' class='btn btn-secondary btn-sm'>VIEW</a>
              </td>";
								echo "</tr>";
							}
							echo "</table>";
						} else {
							echo "0 results";
						}

						$sql = "SELECT COUNT(*) AS total_records FROM student WHERE approve LIKE '%APPROVE%'";
						$result = $conn->query($sql);
						$total_records = $result->fetch_assoc()['total_records'];
						$total_no_of_pages = ceil($total_records / $total_records_per_page);

						?>

					</tbody>
				</table>

				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?>" <?= ($page_no > 1) ? 'href=?page_no=' . $previous_page : ''; ?>>Previous</a></li>
						<?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++) { ?>
							<li class="page-item"><a class="page-link" href="?page_no=<?= $counter; ?>">
									<?= $counter; ?></a></li>
						<?php } ?>
						<li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?>" <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' . $next_page : ''; ?>>Next</a></li>
					</ul>
				</nav>

				<div class="p-10">
					<strong>Page <?= $page_no; ?> of <?= $total_no_of_pages; ?></strong>
				</div>
			</div>
			</form>
		</div>
		</div>


		<div class="modal fade" id="modalRegisterForm" tabindex="-1" aria-labelledby="modalRegisterForm" aria-hidden="true">
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
				$sql = "UPDATE `student` SET `approve`='$approve', `status`='$status' WHERE `lrn`='$id'";

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

				$sql = "SELECT * FROM `student` WHERE `lrn`='$user_id'";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {

					while ($row = $result->fetch_assoc()) {

						$approve1 = $row['approve'];
						$status1 = $row['status'];
					}
				}
			}
			?>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="ModalLabel">UPDATE STUDENT RECORD</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">





						<form class="row" action="" method="post">
							<div class="divider d-flex align-items-center my-4">
								<p class="text-center fw-bold mx-3 mb-0">Account Details</p>
							</div>

							<div class="col-12 mb-3">
								<label class="form-label" for="approve">Approval Status</label>
								<select class="form-select" id="approve" name="approve">
									<option value="APPROVE" <?php if ($approve1 == "APPROVE") {
																echo " selected";
															} ?>>APPROVE</option>
									<option value="REJECT" <?php if ($approve1 == "REJECT") {
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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script src="customjs.js"></script>
</body>

</html>