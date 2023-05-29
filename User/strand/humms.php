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
				<h1 class="text-body-emphasis fw-bold">HUMMS</h1>
				<p class="lead fst-italic">
					"HUMMS: Where the study of the past can shape the <code>future.</code>"
				</p>
				<a href="#Learn"><button type="button" class="btn btn-outline-primary btn-lg fw-bold fs-3 m-2">Learn More</button>

				</a>

				<?php
				// Assuming you have established a database connection using your preferred method

				// Perform the SQL query to retrieve the value from the database
				/*$id = $_SESSION['student'];
				$sql = "SELECT HUMSS FROM exam_score WHERE lrn = '$id'";
				$result = mysqli_query($link, $sql);

				// Check if the query was successful
				if ($result) {
					// Fetch the row from the result
					$row = mysqli_fetch_assoc($result);

					// Check if the exam_score value exists
					if (!empty($row['HUMSS'])) {
						// The assessment has been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" disabled>Assessment Answered</button>';
					} else {
						// The assessment has not been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" onclick="window.location.href = \'instructions_humss.php\';">Take assessment</button>';
					}
				} else {
					// An error occurred with the query
					echo 'Error: ' . mysqli_error($link);
				}*/

				?>
			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-4 d-flex flex-wrap justify-content-center align-items-center p-5">
				<img src="../images/humss.png" class="img-fluid" alt="...">
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
					The Humanities and Social Sciences (HUMSS) strand is designed for students who are interested in the humanities, social sciences, and arts. It focuses on developing students' critical thinking and communication skills, as well as their understanding of society and culture. The HUMSS curriculum covers a broad range of subjects, including economics, politics, sociology, history, literature, philosophy, and anthropology.
				</p>
				<p class="lh-base">
					In HUMSS, students learn about the complexities of human behavior and interaction, as well as the structures and systems that shape our society. The strand also emphasizes the importance of self-expression, creativity, and cultural awareness. Students are encouraged to explore their own interests and passions, while also developing a deep appreciation for the arts and humanities.
				</p>
				<p class="lh-base">
					Throughout the HUMSS program, students engage in a variety of activities, including research projects, debates, essays, and presentations. They are taught how to analyze and interpret data, evaluate arguments, and communicate effectively with others. The strand also encourages students to participate in community service projects and other extracurricular activities that help them develop leadership and teamwork skills.
				</p>
				<p class="lh-base">
					Upon graduation, HUMSS students are well-prepared for a range of careers in the humanities and social sciences, as well as in fields like law, journalism, education, and public service. The skills and knowledge they gain in the HUMSS program will also serve them well in their personal lives, helping them become more informed and engaged members of society.
				</p>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/creative.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/analytical.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/expressive.png" class="card-img-top" alt="...">
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
							The prerequisites for courses under the HUMMS strand may vary depending on the college or university offering them. However, in general, common prerequisites for HUMMS courses may include:
						</p>
						<ul>
							<li>English: A strong foundation in English language and literature is essential for most HUMMS courses, as they involve extensive reading, writing, and critical thinking.</li>
							<li>Social Science: Courses in social science such as history, anthropology, psychology, or sociology may be required for some HUMMS courses, as they deal with human behavior, culture, and society.</li>
							<li>Humanities: Courses in humanities such as literature, philosophy, or art may be necessary for some HUMMS courses, as they involve analyzing and interpreting human expressions and creativity.</li>
							<li>Mathematics: Basic proficiency in math may be required for some HUMMS courses, particularly those that involve statistical analysis, economics, or research.</li>
							<li>Foreign Language: Some HUMMS courses may require proficiency in a specific foreign language, particularly if the course involves studying literature or culture from non-English speaking countries.</li>
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
			<h1 class="fw-bold">Possible College Courses Under the HUMMS Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 order-2 order-lg-1 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/college_course.png" class="img-fluid" alt="...">
			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The HUMMS strand prepares students for a wide range of college courses related to the humanities, social sciences, and arts. Here are some possible college courses that align with the HUMMS strand:
						</p>
						<ul>
							<li>Humanities courses: Literature, Philosophy, History, Linguistics, Cultural Studies, Comparative Literature, Classics, etc.</li>
							<li>Social Science courses: Psychology, Sociology, Anthropology, Political Science, Economics, Communication, Geography, etc.</li>
							<li>Arts courses: Fine Arts, Graphic Design, Performing Arts, Music, Theater, Film Studies, Creative Writing, Journalism, Advertising, etc.</li>
							<li>Education courses: Early Childhood Education, Elementary Education, Special Education, Secondary Education, Physical Education, etc.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center p-5">
		<div class="flex-row mb-3">
			<h1 class="fw-bold">Possible Jobs Under the HUMMS Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The HUMSS strand prepares students for a wide range of career paths related to humanities, social sciences, and the arts. Here are some possible jobs that align with the HUMSS strand:
						</p>
						<ul>
							<li>Lawyer</li>
							<li>Historian</li>
							<li>Anthropologist</li>
							<li>Psychologist</li>
							<li>Economist</li>
							<li>Political analyst</li>
							<li>Writer</li>
							<li>Teacher or Professor</li>
							<li>Social worker</li>
							<li>Public relations specialist</li>
							<li>Event planner</li>
							<li>Journalist</li>
							<li>Advertising executive</li>
							<li>Museum curator</li>
							<li>Art director</li>
							<li>Graphic designer</li>
							<li>Musician</li>
							<li>Actor or Actress</li>
							<li>Fashion designer</li>
							<li>Interior designer</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/humms_career.png" class="img-fluid" alt="...">
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
					window.location = "dashboard_humss.php";
				}
			};
			xmlhttp.open("GET", "forjax/set_exam_type_session.php?exam_category=" + exam_category, true);
			xmlhttp.send(null);
		}
	</script>
</body>

</html>