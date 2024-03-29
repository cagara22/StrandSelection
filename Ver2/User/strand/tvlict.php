<?php
//Starts the sessin and checks if the student is logged in or not
session_start();

if (!isset($_SESSION["student"])) {
    header("Location: ../index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GUIDE</title>
	<link rel="icon" type="images/x-icon" href="../images/GUIDE_Logo_2.png" />
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
							<li><a class="dropdown-item" href="../logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="hero d-flex flex-column justify-content-center align-items-center" id="tvlictHeader">
		<div class="bgblur d-flex flex-column justify-content-center">
			<h1 class="title3 fw-bold">TVL - Information Communication and Technology</h1>
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
						<img src="../images/tvlict1.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Overview of TVL - ICT</h1>
							<p class="card-text">The Senior High School (SHS) strand in Technical-Vocational-Livelihood with a focus on Information and Communications Technology (TVL-ICT) is designed to equip students with practical skills and knowledge to prepare them for careers in the rapidly evolving world of technology and digital communication. TVL-ICT emphasizes hands-on learning and practical application of ICT-related skills, including computer programming, web development, network administration, and digital media production. This strand is tailored to cultivate technical proficiency in the field of ICT while fostering creativity and innovation.</p>
							<p class="card-text">In TVL-ICT, students will delve into subjects such as programming languages, software development, hardware maintenance, and digital design. They will also gain proficiency in using various software tools and programming environments, enabling them to solve real-world problems in the digital age. This strand not only equips students with technical skills but also emphasizes critical thinking, problem-solving, and adaptability in the ever-changing technology landscape. </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bglightgrey section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<h1 class="card-title fw-bold sub-title">Possible College Courses Under the TVL - ICT</h1>
			<p class="card-text">Many of our TVL-ICT students go on to apply for undergraduate programs and embark on journeys into their chosen specialized fields within the world of Information and Communications Technology (ICT). Through the courses under the TVL-ICT strand, these students continue to develop into the nation's future technology experts, software developers, network administrators, and digital innovators within their chosen areas of expertise. The TVL-ICT strand course list can encompass a variety of degree programs, including but not limited to:</p>
			<ul>
				<li>Bachelor of Science in Information Technology</li>
				<li>Bachelor of Science in Computer Science</li>
				<li>Bachelor of Science in Computer Engineering</li>
				<li>Bachelor of Science in Software Engineering</li>
				<li>Bachelor of Science in Network Administration</li>
				<li>Bachelor of Science in Digital Media Arts</li>
				<li>Bachelor of Science in Web Development</li>
				<li>Bachelor of Science in Cybersecurity</li>
				<li>Bachelor of Science in Data Science</li>
				<li>Bachelor of Science in Information Systems</li>
			</ul>
		</div>
	</section>

	<section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<div class="card border-light mb-3" style="max-width: 100%;">
				<div class="row g-0">
					<div class="order-1 order-md-2 col-md-5 d-flex flex-column justify-content-center align-items-center text-center">
						<img src="../images/tvlict2.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="order-2 order-md-1 col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Possible Jobs in the TVL - ICT</h1>
							<p class="card-text">Our senior high school TVL-ICT students go on to discover promising career opportunities that align perfectly with the practical skills and knowledge they've gained through our specialized curriculum. They will encounter abundant prospects, both in the workforce and in pursuing advanced studies in higher education. Senior high school graduates from the TVL-ICT strand have found rewarding and successful careers in the following ICT-related jobs:</p>
							<ul>
								<li>IT Specialist</li>
								<li>Software Developer</li>
								<li>Computer Engineer</li>
								<li>Software Engineer</li>
								<li>Network Administrator</li>
								<li>Digital Media Designer</li>
								<li>Web Developer</li>
								<li>Cybersecurity Analyst</li>
								<li>Data Scientist</li>
								<li>Information Systems Manager</li>
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
						<h1 class="card-title fw-bold sub-title">TVL - ICT Curriculum</h1>
						<p class="card-text">The senior high school TVL-ICT strand offers an immersive exploration of Information and Communications Technology (ICT) subjects, including programming, digital media, network administration, and cybersecurity. These subjects are designed to equip students with practical skills and knowledge to prepare them for future careers and higher education in the dynamic field of ICT.</p>
						<div class="d-grid gap-2 d-md-flex">
							<a class="btn btn-warning fw-bold" href="../propectus/TVL_ICT.jpg" download role="button">DOWNLOAD</a>
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