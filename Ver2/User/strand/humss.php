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

	<div class="hero d-flex flex-column justify-content-center align-items-center" id="humssHeader">
		<div class="bgblur d-flex flex-column justify-content-center">
			<h1 class="title3 fw-bold">Humanities and Social Sciences</h1>
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
						<img src="../images/humss1.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Overview of HUMSS</h1>
							<p class="card-text">The Senior High School (SHS) strand in Humanities and Social Sciences (HUMSS) is designed to provide students with a well-rounded education that focuses on the study of human behavior, society, culture, and communication. HUMSS emphasizes critical thinking, effective communication, and a deep understanding of the social sciences and humanities. This strand equips students with the knowledge and skills necessary to pursue careers in various fields related to the humanities and social sciences.</p>
							<p class="card-text">In the HUMSS strand, students explore a wide range of subjects that delve into the complexities of human society and culture. They gain insights into history, philosophy, literature, sociology, psychology, economics, and political science. HUMSS students also engage in research, analysis, and critical evaluation of societal issues and cultural phenomena.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bglightgrey section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<h1 class="card-title fw-bold sub-title">Possible College Courses Under the HUMSS</h1>
			<p class="card-text">Many of our HUMSS students go on to apply for undergraduate programs and embark on journeys into their chosen specialized fields. Through the courses under the HUMSS strand, these students continue to develop into the nation's future scholars, educators, social scientists, legal professionals, and advocates within their respective domains. The HUMSS strand course list can encompass a variety of degree programs, including but not limited to:</p>
			<div class="row">
				<div class="col-12 col-md-6">
					<ul>
						<li>Bachelor of Arts major in Social Sciences</li>
						<li>Bachelor of Arts in Psychology</li>
						<li>Bachelor of Arts major in Philosophy</li>
						<li>Bachelor of Arts in Social Work</li>
						<li>Bachelor of Arts in Political Science</li>
						<li>Bachelor of Arts in Foriegn Studies</li>
						<li>Bachelor of Arts in Criminology</li>
					</ul>
				</div>
				<div class="col-12 col-md-6">
					<ul>
						<li>Bachelor of Arts in Communication</li>
						<li>Bachelor of Elementary Education</li>
						<li>Bachelor of Secondary Education</li>
						<li>Bachelor of Arts in Journalism</li>
						<li>Bachelor of Arts in Broadcast Journalism</li>
						<li>Bachelor of Arts in Social Studies</li>
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
						<img src="../images/humss2.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="order-2 order-md-1 col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Possible Jobs in the HUMSS</h1>
							<p class="card-text">Our senior high school students go on to discover meaningful career opportunities that align with the skills and knowledge they've gained through our comprehensive HUMSS curriculum. They will encounter a wealth of prospects, both in the workforce and in pursuing advanced studies at the tertiary level. Graduates from our senior high school program have achieved fulfillment and success in diverse careers within the HUMSS strand, including the following:</p>
							<div class="row">
								<div class="col-12 col-md-6">
									<ul>
										<li>Social Scientist</li>
										<li>Psychologist</li>
										<li>Philosopher</li>
										<li>Social Worker</li>
										<li>Political Scientist</li>
										<li>Foreign Service Officer</li>
										<li>Police</li>
									</ul>
								</div>
								<div class="col-12 col-md-6">
									<ul>
										<li>Soldier</li>
										<li>Communication Specialist</li>
										<li>Elementary School Teacher</li>
										<li>Secondary School Teacher</li>
										<li>Journalist</li>
										<li>Broadcast Journalist</li>
										<li>Social Studies Educator</li>
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
						<h1 class="card-title fw-bold sub-title">HUMSS Curriculum</h1>
						<p class="card-text">The senior high school HUMSS strand offers a comprehensive exploration of the humanities and social sciences, encompassing subjects such as History, Literature, Sociology, Psychology, Economics, and Political Science. These subjects lay a solid foundation for students as they prepare for their future undergraduate pursuits in the fields of humanities and social sciences.</p>
						<div class="d-grid gap-2 d-md-flex">
							<a class="btn btn-warning fw-bold" href="../propectus/HUMSS.jpg" download role="button">DOWNLOAD</a>
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