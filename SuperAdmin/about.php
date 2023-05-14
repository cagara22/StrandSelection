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
						<a class="nav-link" href="admins.php">ADMINS</a>
					</li>
					<li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="about.php">ABOUT</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="exam_category.php">EXAM CATEGORIES</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="add_edit_exam_questions.php">EXAM QUESTIONS</a>
					</li>

					<li class="nav-item">
						<a class="nav-link"><?php
											echo $_SESSION['admin']; ?></a>
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
		<div class="card w-75 border-light d-flex justify-content-center align-items-center text-center">
			<img src="./images/SystemBrandBlackVer1.png" class="img-fluid" alt="Logo" width="716" height="200">
			<div class="card-body">
				<h1 class="card-title fw-bold">ABOUT</h1>
				<p class="card-text">Welcome to our Decision Support System (DSS) for Senior High School Students! Our DSS is designed to help incoming senior high school students at Leyte National High School in selecting the most suitable strand based on their academic performance, interests, skills, and future job ambitions. Our system uses a structured and objective approach to decision-making, ensuring that students make informed choices and align their academic and career aspirations with the most suitable strand. Our web-based application provides an easy-to-use interface for students, making the process of selecting a strand efficient and stress-free. Join us and discover your path today!</p>
				<p class="card-text"><small class="text-muted">-DRPTM</small></p>
			</div>
		</div>
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center py-5">
		<h1 class="fw-bold">Developers</h1>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-md-3 d-flex justify-content-center align-items-center py-5">
					<div class="card w-75 border-light d-flex justify-content-center align-items-center text-center">
						<img src="./images/person.png" class="img-fluid rounded" alt="Logo" width="400" height="400">
						<div class="card-body">
							<h3 class="card-title fw-bold">Name</h3>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-3 d-flex justify-content-center align-items-center py-5">
					<div class="card w-75 border-light d-flex justify-content-center align-items-center text-center">
						<img src="./images/person.png" class="img-fluid rounded" alt="Logo" width="400" height="400">
						<div class="card-body">
							<h3 class="card-title fw-bold">Name</h3>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-3 d-flex justify-content-center align-items-center py-5">
					<div class="card w-75 border-light d-flex justify-content-center align-items-center text-center">
						<img src="./images/person.png" class="img-fluid rounded" alt="Logo" width="400" height="400">
						<div class="card-body">
							<h3 class="card-title fw-bold">Name</h3>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-3 d-flex justify-content-center align-items-center py-5">
					<div class="card w-75 border-light d-flex justify-content-center align-items-center text-center">
						<img src="./images/person.png" class="img-fluid rounded" alt="Logo" width="400" height="400">
						<div class="card-body">
							<h3 class="card-title fw-bold">Name</h3>
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