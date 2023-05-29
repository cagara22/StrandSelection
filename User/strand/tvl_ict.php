<?php
session_start();

if (!isset($_SESSION["student"])) {

?>
	<script type="text/javascript">
		window.location = "index.php";
	</script>
<?php

}
?>
<?php
include "connection.php";

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
	<link rel="stylesheet" href="../custom_css.css">
</head>

<body>
	<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="../images/SystemBrandWhiteVer2.png" alt="Logo" width="200" height="34" class="d-inline-block align-text-top">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
				<ul class="navbar-nav">
					<li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="../list.php">LIST</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../about.php">ABOUT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../profile.php">PROFILE</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo $_SESSION["student"]; ?>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="../logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<header class="d-flex justify-content-center align-items-center p-5" id="Home">
		<div class="row">
			<div class="col-12 order-2 order-lg-1 col-lg-8 text-wrap text-center align-self-center">
				<h1 class="text-body-emphasis fw-bold">TVL (ICT)</h1>
				<p class="lead fst-italic">
					"TVL ICT students don't just speak the language of computers, they <code>code</code> it."
				</p>
				<a href="#Learn"><button type="button" class="btn btn-outline-primary btn-lg fw-bold fs-3 m-2">Learn More</button>

				</a>

				<?php
				// Assuming you have established a database connection using your preferred method

				// Perform the SQL query to retrieve the value from the database
				$id = $_SESSION['student'];
				$sql = "SELECT ICT FROM exam_score WHERE lrn = '$id'";
				$result = mysqli_query($link, $sql);

				// Check if the query was successful
				/*if ($result) {
					// Fetch the row from the result
					$row = mysqli_fetch_assoc($result);

					// Check if the exam_score value exists
					if (!empty($row['ICT'])) {
						// The assessment has been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" disabled>Assessment Answered</button>';
					} else {
						// The assessment has not been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" onclick="window.location.href = \'instructions_ict.php\';">Take assessment</button>';
					}
				} else {
					// An error occurred with the query
					echo 'Error: ' . mysqli_error($link);
				}*/

				?>


			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-4 d-flex flex-wrap justify-content-center align-items-center p-5">
				<img src="../images/tvlict.png" class="img-fluid" alt="...">
			</div>
		</div>
	</header>

	<section class="d-flex flex-column justify-content-center align-items-center custPad" id="Learn">
		<div class="flex-row">
			<h1 class="fw-bold">STRAND OVERVIEW</h1>
		</div>
		<div class="desc row px-2">
			<div class="col-12">
				<p class="lh-base">
					The Senior High School (SHS) strand Technical Vocational Livelihood (TVL) Information and Communications Technology (ICT) is a two-year program that aims to equip students with the skills and knowledge necessary to become competent professionals in the ICT industry.
				</p>
				<p class="lh-base">
					The TVL ICT strand is designed for students who are interested in pursuing careers related to information technology, software development, programming, and other related fields. The program covers a range of subjects, including computer programming, web development, database management, networking, and computer hardware servicing. Students will be taught theoretical concepts and practical skills that will enable them to develop, implement and maintain information systems and technology solutions for organizations.
				</p>
				<p class="lh-base">
					In addition to developing technical skills, students in the TVL ICT strand will also learn soft skills such as communication, problem-solving, teamwork, and leadership. These skills are essential in the ICT industry, where professionals often work on collaborative projects and must communicate effectively with colleagues and clients. Throughout the program, students will be given opportunities to apply what they have learned in real-world settings through internships or on-the-job training. This will help them gain practical experience and prepare them for their future careers.
				</p>
				<p class="lh-base">
					Upon completion of the TVL ICT strand, students will have the skills and knowledge necessary to pursue further education in the field or seek employment in a variety of industries, including the IT industry, telecommunications, media, advertising, and more. Overall, the TVL ICT strand aims to provide students with a solid foundation in information technology and equip them with the skills and knowledge necessary to succeed in a rapidly evolving and highly competitive industry.
				</p>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/techy.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/logic.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/problemsolving.png" class="card-img-top" alt="...">
				</div>
			</div>
		</div>

		<!--<img src="../images/UnderDev.png" class="mx-auto d-block" alt="UnderDev">-->
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center p-5">
		<div class="flex-row mb-3">
			<h1 class="fw-bold">Possible Prerequisites</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The prerequisites for courses under the TVL ICT strand may vary depending on the college or university offering them. However, common prerequisites for TVL ICT courses may include:
						</p>
						<ul>
							<li>Basic Computer Skills: Students should have a basic understanding of computer systems, including how to use software applications and the internet.</li>
							<li>Mathematics: Basic knowledge of mathematics, including algebra and geometry, may be necessary for some TVL ICT courses.</li>
							<li>Science: Some TVL ICT courses may require basic knowledge of science concepts, particularly in the areas of physics and electronics.</li>
							<li>Programming Languages: Depending on the specific TVL ICT course, students may need to have knowledge of programming languages such as Java, C++, or Python.</li>
							<li>English: Students should have good communication skills in English, including reading, writing, and speaking.</li>
							<li>Analytical and Logical Skills: Some TVL ICT courses may require students to have strong analytical and logical skills, including the ability to problem-solve and think critically.</li>
							<li>Creative and Design Skills: For students interested in pursuing careers in multimedia or graphic design, creative and design skills may be necessary.</li>
							<li>Web Development Skills: For students interested in web development, knowledge of HTML, CSS, and JavaScript may be necessary.</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center p-5">
				<img src="../images/prerequisites.png" class="img-fluid" alt="...">
			</div>
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center p-5">
		<div class="flex-row mb-3">
			<h1 class="fw-bold">Possible College Courses Under the TVL (ICT) Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 order-2 order-lg-1 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/college_course.png" class="img-fluid" alt="...">
			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The TVL ICT strand prepares students for a variety of college courses related to information and communication technology. Here are some possible college courses that align with the TVL ICT strand:
						</p>
						<ul>
							<li>Computer Science</li>
							<li>Information Technology</li>
							<li>Information Systems</li>
							<li>Multimedia Arts</li>
							<li>Graphic Design</li>
							<li>Animation</li>
							<li>Web Development</li>
							<li>Mobile Application Development</li>
							<li>Game Development</li>
							<li>Network Administration</li>
							<li>Cybersecurity</li>
							<li>Database Administration</li>
							<li>Digital Marketing</li>
							<li>E-Commerce</li>
							<li>Business Intelligence</li>
							<li>Artificial Intelligence</li>
							<li>Machine Learning</li>
							<li>Data Science</li>
							<li>Computer Engineering</li>
							<li>Electronics Engineering</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center p-5">
		<div class="flex-row mb-3">
			<h1 class="fw-bold">Possible Jobs Under the TVL (ICT) Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The TVL ICT strand equips students with skills and knowledge in Information and Communications Technology, opening up various career opportunities in these fields. Here are some possible jobs under the TVL ICT strand:
						</p>
						<ul>
							<li>Software Developer</li>
							<li>Web Developer</li>
							<li>Mobile App Developer</li>
							<li>Game Developer</li>
							<li>Systems Analyst</li>
							<li>Network Administrator</li>
							<li>Cybersecurity Analyst</li>
							<li>Database Administrator</li>
							<li>Digital Marketer</li>
							<li>E-commerce Specialist</li>
							<li>Business Intelligence Analyst</li>
							<li>Artificial Intelligence Engineer</li>
							<li>Machine Learning Engineer</li>
							<li>Data Scientist</li>
							<li>IT Manager</li>
							<li>Multimedia Artist/Animator</li>
							<li>Graphic Designer</li>
							<li>User Interface/User Experience (UI/UX) Designer</li>
							<li>Computer Hardware Engineer</li>
							<li>Electronics Engineer</li>
							<li>Technical Support Specialist</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/tvlict_career.png" class="img-fluid" alt="...">
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
	<script type="text/javascript">
		function set_exam_type_session(exam_category) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					window.location = "dashboard_ict.php";
				}
			};
			xmlhttp.open("GET", "forjax/set_exam_type_session.php?exam_category=" + exam_category, true);
			xmlhttp.send(null);
		}
	</script>
</body>

</html>