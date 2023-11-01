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

	<!-- Custom CSS -->
	<link rel="stylesheet" href="../custom_css.css">
</head>

<body>
	<nav class="navbar navbar-expand-md fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="../images/GUIDE_Logo_3.png" alt="Logo" width="150" height="37" class="d-inline-block align-text-top">
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
							<?php echo $_SESSION['fname']; //The name off the Student?>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="hero d-flex flex-column justify-content-center align-items-center" id="stemHeader">
		<div class="bgblur d-flex flex-column justify-content-center">
			<h1 class="title3 fw-bold">Science, Technology, Engineering, and Mathematics</h1>
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
						<img src="../images/stem1.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Overview of STEM</h1>
							<p class="card-text">The Senior High School (SHS) strand in Science, Technology, Engineering, and Mathematics (STEM) is designed to prepare students for careers in various fields related to these disciplines. STEM is a highly academic strand that emphasizes the development of skills in the areas of critical thinking, problem-solving, and innovation. This strand provides students with a strong foundation in mathematics, physical sciences, and life sciences, as well as exposure to emerging technologies and engineering concepts.</p>
							<p class="card-text">In the STEM strand, students are expected to master the fundamental principles of calculus, statistics, and physics, as well as concepts related to chemistry, biology, and earth sciences. The strand also introduces students to the latest technologies and engineering practices, including computer programming, robotics, and 3D printing. These technologies and practices are integrated into various subjects within the strand, allowing students to develop their skills in practical, hands-on ways.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bglightgrey section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<h1 class="card-title fw-bold sub-title">Possible College Courses Under the STEM</h1>
			<p class="card-text">Many of our STEM students go on to apply for undergraduate programs and explore their preferred specialized fields. Through the courses under the STEM strands, these students continue to grow into the country’s future scientists, engineers, programmers, and trailblazers within their niche. The STEM strand course list can include the following degree programs:</p>
			<div class="row">
				<div class="col-12 col-md-6">
					<ul>
						<li>Bachelor of Science in Computer Engineering</li>
						<li>Bachelor of Science in Chemical Engineering</li>
						<li>Bachelor of Science in Computer Science / Data Science</li>
						<li>Bachelor of Science in Information Technology / Information Systems</li>
						<li>Bachelor of Science in Industrial Engineering</li>
						<li>Bachelor of Science in Biology</li>
						<li>Bachelor of Science in Mathematics / Applied Mathematics</li>
						<li>Bachelor of Science in Statistics / Physics / Anatomy</li>
					</ul>
				</div>
				<div class="col-12 col-md-6">
					<ul>
						<li>Bachelor of Science in Architecture</li>
						<li>Bachelor of Science in Medical Sciences</li>
						<li>Bachelor of Science in Nursing</li>
						<li>Bachelor of Science in Physical Therapy</li>
						<li>Bachelor of Science in Pharmacy</li>
						<li>Bachelor of Science in Civil Engineering</li>
						<li>Bachelor of Science in Mechanical Engineering</li>
						<li>Bachelor of Science in Food Technology</li>
						<li>Bachelor of Science in Environmental Studies</li>
					</ul>
				</div>
			</div>

		</div>
	</section>

	<section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<div class="card border-light mb-3" style="max-width: 100%;">
				<div class="row g-0">
					<div class="order-1 order-md-2 col-md-5 d-flex flex-column justify-content-center align-items-center text-center">
						<img src="../images/stem2.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="order-2 order-md-1 col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Possible Jobs in the STEM</h1>
							<p class="card-text">Our senior high school students go on to find relevant STEM strand jobs that match the skills and knowledge they’ve acquired from our curriculum. They will find plenty of opportunities, both in employment and in further studies in higher education. Senior high school graduates have found fulfilling and successful careers in the following jobs in the STEM strand:</p>
							<div class="row">
								<div class="col-12 col-md-6">
									<ul>
										<li>Computer Engineer</li>
										<li>Chemical Engineer</li>
										<li>Data Scientist</li>
										<li>Information Technology Specialist</li>
										<li>Industrial Engineer</li>
										<li>Biologist</li>
										<li>Mathematician</li>
										<li>Statistician</li>
										<li>Physicist</li>
										<li>Architect</li>
									</ul>
								</div>
								<div class="col-12 col-md-6">
									<ul>
										<li>Doctor</li>
										<li>Registered Nurse</li>
										<li>Physical Therapist</li>
										<li>Pharmacist</li>
										<li>Civil Engineer</li>
										<li>Mechanical Engineer</li>
										<li>Food Technologist</li>
										<li>Environmental Scientist</li>
									</ul>
								</div>
							</div>
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
						<h1 class="card-title fw-bold sub-title">STEM Curriculum</h1>
						<p class="card-text">The senior high school STEM strand provides a deep dive into hard sciences including Earth Science, Pre-Calculus and Basic Calculus, and Physics. These subjects will serve as preparation for students’ future undergraduate programs.</p>
						<div class="d-grid gap-2 d-md-flex">
							<a class="btn btn-warning fw-bold" href="../propectus/STEM.jpg" download role="button">DOWNLOAD</a>
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