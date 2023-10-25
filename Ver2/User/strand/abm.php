<?php
//Starts the sessin and checks if the student is logged in or not
session_start();

if (!isset($_SESSION["student"])) {

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
	<title>GUIDE</title>
	<link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../custom_css.css">
</head>

<body>
	<nav class="navbar navbar-expand-md fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="../images/SystemBrandWhiteVer2.png" alt="Logo" width="200" height="34" class="d-inline-block align-text-top">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../home.php">HOME</a>
					</li>
					<li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="../strand.php">STRAND</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../profile.php">PROFILE</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../result.php">RESULT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../about.php">ABOUT</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php $_SESSION['fname']; //The name off the Student?>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="hero d-flex flex-column justify-content-center align-items-center" id="abmHeader">
		<div class="bgblur d-flex flex-column justify-content-center">
			<h1 class="title3 fw-bold">Accountancy, Business, and Management</h1>
			<div class="py-5">
				<a href="#first"><button type="button" class="btn btn-outline-warning btn-lg fw-bold fs-3">LEARN MORE</button></a>
			</div>
		</div>
	</div>

	<section class="section-100 d-flex flex-column justify-content-center align-items-center py-5" id="first">
		<div class="reswid px-3">
			<div class="card border-light mb-3" style="max-width: 100%;">
				<div class="row g-0">
					<div class="col-md-5 d-flex flex-column justify-content-center align-items-center text-center">
						<img src="../images/abm1.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Overview of ABM</h1>
							<p class="card-text">The Senior High School (SHS) strand in Accountancy, Business, and Management (ABM) is designed to prepare students for careers in various fields related to business, finance, economics, and management. ABM is a highly versatile and practical strand that emphasizes the development of skills in critical thinking, decision-making, and entrepreneurship. This strand equips students with a solid foundation in business concepts, financial literacy, and management principles, as well as exposure to emerging trends in the business world.</p>
							<p class="card-text">In the ABM strand, students are expected to master fundamental concepts in accounting, finance, economics, and marketing. They also delve into topics related to entrepreneurship, business ethics, and strategic management. Additionally, students gain proficiency in using financial tools and software, which are essential for analyzing financial data and making informed business decisions.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bglightgrey section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<h1 class="card-title fw-bold sub-title">Possible College Courses Under the ABM</h1>
			<p class="card-text">Many of our ABM students embark on journeys to pursue undergraduate programs and delve into their chosen specialized fields. Through the courses under the ABM strand, these students continue to develop into the nation's future business leaders, entrepreneurs, financial analysts, and innovators within their chosen domains. The ABM strand course list can encompass a variety of degree programs, including but not limited to:</p>
			<ul>
				<li>Bachelor of Science in Entrepreneurship</li>
				<li>Bachelor of Science in Tourism</li>
				<li>Bachelor of Science in Business Administration</li>
				<li>Bachelor of Science in Accounting</li>
				<li>Bachelor of Science in Business Economics</li>
				<li>Bachelor of Science in Banking and Finace</li>
				<li>Bachelor of Science in Management</li>
			</ul>
		</div>
	</section>

	<section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<div class="card border-light mb-3" style="max-width: 100%;">
				<div class="row g-0">
					<div class="order-1 order-md-2 col-md-5 d-flex flex-column justify-content-center align-items-center text-center">
						<img src="../images/abm2.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="order-2 order-md-1 col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Possible Jobs in the ABM</h1>
							<p class="card-text">Our senior high school students go on to discover promising career opportunities that align with the skills and knowledge they've acquired through our comprehensive ABM curriculum. They will encounter abundant prospects, both in the workforce and in pursuing advanced studies in higher education. Senior high school graduates have found rewarding and successful careers in a wide array of job roles within the ABM strand, including:</p>
							<ul>
								<li>Entrepreneur</li>
								<li>Tourism Manager</li>
								<li>Business Administrator</li>
								<li>Accountant</li>
								<li>Business Economist</li>
								<li>Banking and Finance Specialist</li>
								<li>Management Consultant</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-50 bglightgrey d-flex flex-column justify-content-center align-items-center px-4">
		<div class="card border-light mb-3 bglightgrey" style="max-width: 100%;">
			<div class="row g-0">
				<div class="col-md-3 text-center">
					<img src="../images/curiculum.png" class="cust-img-50 rounded-start" alt="...">
				</div>
				<div class="col-md-9">
					<div class="card-body">
						<h1 class="card-title fw-bold sub-title">ABM Curriculum</h1>
						<p class="card-text">The senior high school ABM (Accountancy, Business, and Management) strand offers a comprehensive exploration of business and management-related subjects, including courses in entrepreneurship, business administration, accounting, economics, finance, and management. These subjects provide students with a strong foundation and practical skills to prepare them for their future undergraduate programs and careers in the field of business and management.</p>
						<div class="d-grid gap-2 d-md-flex">
							<a class="btn btn-warning fw-bold" href="../propectus/ABM.jpg" download role="button">DOWNLOAD</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer class="d-flex flex-column flex-md-row text-center justify-content-center py-4 px-4 px-xl-5">
		<!-- Copyright -->
		<div class="text-white mb-3 mb-md-0">
			Copyright © 2023. All rights reserved.
		</div>
		<!-- Copyright -->
	</footer>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>