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
				<h1 class="text-body-emphasis fw-bold">GAS</h1>
				<p class="lead fst-italic">
					GAS: Because life is too short to choose just <code>one subject</code> to study.
				</p>
				<a href="#Learn"><button type="button" class="btn btn-outline-primary btn-lg fw-bold fs-3 m-2">Learn More</button>

				</a>

				<?php
				// Assuming you have established a database connection using your preferred method

				// Perform the SQL query to retrieve the value from the database
				/*$id = $_SESSION['student'];
				$sql = "SELECT GAS FROM exam_score WHERE lrn = '$id'";
				$result = mysqli_query($link, $sql);

				// Check if the query was successful
				if ($result) {
					// Fetch the row from the result
					$row = mysqli_fetch_assoc($result);

					// Check if the exam_score value exists
					if (!empty($row['GAS'])) {
						// The assessment has been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" disabled>Assessment Answered</button>';
					} else {
						// The assessment has not been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" onclick="window.location.href = \'instructions_ga.php\';">Take assessment</button>';
					}
				} else {
					// An error occurred with the query
					echo 'Error: ' . mysqli_error($link);
				}*/

				?>
			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-4 d-flex flex-wrap justify-content-center align-items-center p-5">
				<img src="../images/gas.png" class="img-fluid" alt="...">
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
					The Senior High School (SHS) strand in General Academic Strand (GAS) is designed for students who want to explore different fields of study before choosing a specific career path. This strand is a flexible option that allows students to develop skills and knowledge across different disciplines, including the humanities, social sciences, natural sciences, and mathematics.
				</p>
				<p class="lh-base">
					In the GAS strand, students are exposed to a variety of academic subjects, including English, Mathematics, Science, and Social Science. The curriculum is designed to prepare students for higher education, regardless of the specific field of study they choose. This strand also provides students with the opportunity to develop critical thinking, problem-solving, communication, and research skills, which are essential in any career or academic pursuit.
				</p>
				<p class="lh-base">
					The GAS strand is ideal for students who are still exploring their interests and career options. It provides a well-rounded education that can be beneficial in many fields, from law and politics to business and technology. It is also a good choice for students who plan to pursue college degrees in interdisciplinary fields, such as Liberal Arts, Communication, or Environmental Studies.
				</p>
				<p class="lh-base">
					Overall, the GAS strand provides a strong foundation for students to succeed in higher education and in their chosen careers. It offers a broad range of courses and experiences that can help students develop their interests, skills, and passions, and provides them with the tools they need to succeed in today's rapidly changing world.
				</p>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/flexibility.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/multitasking.png" class="card-img-top" alt="...">
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
							The prerequisites for courses under the GAS strand may vary depending on the college or university offering them. However, in general, common prerequisites for GAS courses may include:
						</p>
						<ul>
							<li>Social Sciences: A strong foundation in social science subjects such as history, sociology, economics, and political science is necessary for most GAS courses.</li>
							<li>Humanities: Students may need to take courses in the humanities, such as literature, philosophy, and culture, depending on the specific GAS course.</li>
							<li>Research: Some GAS courses may require students to have knowledge of research methodologies and techniques.</li>
							<li>Language: Some GAS courses may require proficiency in a specific language, particularly if the course involves international research or collaboration.</li>
							<li>Communication: Students may need to have strong written and oral communication skills, which can be developed through courses in English, writing, and public speaking.</li>
							<li>Mathematics: Some GAS courses may require students to have a basic understanding of statistics or other mathematical concepts.</li>
							<li>Computer Literacy: Some GAS courses may require basic knowledge of computer applications and the use of technology in research and communication.</li>
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
			<h1 class="fw-bold">Possible College Courses Under the GAS Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 order-2 order-lg-1 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/college_course.png" class="img-fluid" alt="...">
			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The GAS strand prepares students for a wide range of college courses related to the social sciences, humanities, and interdisciplinary fields. Here are some possible college courses that align with the GAS strand:
						</p>
						<ul>
							<li>Social Sciences courses: History, Political Science, Sociology, Anthropology, Psychology, Geography, International Relations, Economics, Development Studies, etc.</li>
							<li>Humanities courses: Literature, Philosophy, Linguistics, Foreign Languages, Cultural Studies, Art History, Musicology, Religion, etc.</li>
							<li>Interdisciplinary courses: Gender Studies, Environmental Studies, African-American Studies, Asian Studies, Latin American Studies, Peace and Conflict Studies, etc.</li>
							<li>Communication courses: Communication Studies, Journalism, Public Relations, Media Studies, Advertising, Film Studies, etc.</li>
							<li>Research courses: Research Methods, Quantitative Analysis, Qualitative Analysis, Survey Design, Case Study Analysis, etc.</li>
							<li>Education courses: Education, Teaching, Curriculum Development, Educational Psychology, Educational Administration, etc.</li>
							<li>Political Science courses: Political Theory, Comparative Politics, International Relations, Public Administration, Political Economy, etc.</li>
							<li>Psychology courses: General Psychology, Abnormal Psychology, Social Psychology, Developmental Psychology, Cognitive Psychology, Neuropsychology, etc.</li>
							<li>Law courses: Constitutional Law, Criminal Law, Civil Law, International Law, Human Rights Law, Environmental Law, etc.</li>
							<li>Philosophy courses: Ethics, Logic, Metaphysics, Epistemology, Political Philosophy, Philosophy of Science, etc.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center p-5">
		<div class="flex-row mb-3">
			<h1 class="fw-bold">Possible Jobs Under the GAS Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The GAS strand equips students with wide array of skills and knowledge in various area, opening up various career opportunities in these fields. Here are some possible jobs under the GAS strand:
						</p>
						<ul>
							<li>Historian</li>
							<li>Political analyst</li>
							<li>Sociologist</li>
							<li>Anthropologist</li>
							<li>Psychologist</li>
							<li>Geographer</li>
							<li>Economist</li>
							<li>Writer or editor</li>
							<li>Researcher</li>
							<li>Journalist</li>
							<li>Public relations specialist</li>
							<li>Media planner or buyer</li>
							<li>Advertising executive</li>
							<li>Teacher or professor</li>
							<li>Lawyer or legal researcher</li>
							<li>Policy analyst or advisor</li>
							<li>Museum curator</li>
							<li>Archivist</li>
							<li>Librarian</li>
							<li>International development specialist</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/gas_career.png" class="img-fluid" alt="...">
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
					window.location = "dashboard_ga.php";
				}
			};
			xmlhttp.open("GET", "forjax/set_exam_type_session.php?exam_category=" + exam_category, true);
			xmlhttp.send(null);
		}
	</script>
</body>

</html>