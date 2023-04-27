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
						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="home.php">HOME</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profiles.php">PROFILES</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admins.php">ADMINS</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">ABOUT</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="exam_category.php">ADD & EDIT EXAM CATEGORIES</a>
						</li>

                        <li class="nav-item">
							<a class="nav-link" href="add_edit_exam_questions.php">ADD & EDIT EXAM QUESTIONS</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" ><?php 
														echo $_SESSION['admin']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LOGOUT</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<section class="d-flex flex-column justify-content-center align-items-center py-5">
			<div class="flex-row py-3">
				<h1 class="fw-bold">GENERAL STATISTICS</h1>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-4 d-flex justify-content-center align-items-center py-1">
						<div class="card w-100 text-bg-primary">
							<div class="card-body">
								<h4 class="card-title">No. of Profiles:</h4>
								<div class="text-center">
									<?php
									$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
									$query = "SELECT lrn FROM student ORDER BY Lname";
									$query_run = mysqli_query($conn, $query);
									$row = mysqli_num_rows($query_run);
									echo "<p class='card-text fs-1 fw-bold'>$row</p>";
									?>
									<a href="profiles.php" class="btn btn-info">VIEW</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4 d-flex justify-content-center align-items-center py-1">
						<div class="card w-100 text-bg-success">
							<div class="card-body">
								<h4 class="card-title">No. STEM Qualified:</h4>
								<div class="text-center">
									<p class="card-text fs-1 fw-bold">1</p>
									<a href="list.html" class="btn btn-info">VIEW</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4 d-flex justify-content-center align-items-center py-1">
						<div class="card w-100 text-bg-success">
							<div class="card-body">
								<h4 class="card-title">No. HUMSS Qualified:</h4>
								<div class="text-center">
									<p class="card-text fs-1 fw-bold">1</p>
									<a href="list.html" class="btn btn-info">VIEW</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4 d-flex justify-content-center align-items-center py-1">
						<div class="card w-100 text-bg-success">
							<div class="card-body">
								<h4 class="card-title">No. ABM Qualified:</h4>
								<div class="text-center">
									<p class="card-text fs-1 fw-bold">1</p>
									<a href="list.html" class="btn btn-info">VIEW</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-4 d-flex justify-content-center align-items-center py-1">
						<div class="card w-100 text-bg-success">
							<div class="card-body">
								<h4 class="card-title">No. GAS Qualified:</h4>
								<div class="text-center">
									<p class="card-text fs-1 fw-bold">0</p>
									<a href="list.html" class="btn btn-info">VIEW</a>
								</div>
							</div>
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