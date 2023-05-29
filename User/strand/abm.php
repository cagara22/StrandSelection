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
							<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<header class="d-flex justify-content-center align-items-center p-5" id="Home">
		<div class="row">
			<div class="col-12 order-2 order-lg-1 col-lg-8 text-wrap text-center align-self-center">
				<h1 class="text-body-emphasis fw-bold">ABM</h1>
				<p class="lead fst-italic">
					"ABM: Where math meets <code>money,</code> and dreams meet reality."
				</p>
				<a href="#Learn"><button type="button" class="btn btn-outline-primary btn-lg fw-bold fs-3 m-2">Learn More</button>

				</a>

				<?php
				// Assuming you have established a database connection using your preferred method

				// Perform the SQL query to retrieve the value from the database
				/*$id = $_SESSION['student'];
				$sql = "SELECT ABM FROM exam_score WHERE lrn = '$id'";
				$result = mysqli_query($link, $sql);

				// Check if the query was successful
				if ($result) {
					// Fetch the row from the result
					$row = mysqli_fetch_assoc($result);

					// Check if the exam_score value exists
					if (!empty($row['ABM'])) {
						// The assessment has been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" disabled>Assessment Answered</button>';
					} else {
						// The assessment has not been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" onclick="window.location.href = \'instructions_abm.php\';">Take assessment</button>';
					}
				} else {
					// An error occurred with the query
					echo 'Error: ' . mysqli_error($link);
				}*/

				?>

			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-4 d-flex flex-wrap justify-content-center align-items-center p-5">
				<img src="../images/abm.png" class="img-fluid" alt="...">
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
					The Accountancy, Business and Management (ABM) strand is one of the four strands offered in Senior High School. This strand is designed for students who are interested in pursuing a career in business, accounting, finance, economics, and other related fields. The ABM strand aims to equip students with the necessary skills and knowledge to become effective and efficient managers and leaders in the business world.
				</p>
				<p class="lh-base">
					The ABM strand covers a wide range of subjects that are essential to the world of business. These subjects include business mathematics, principles of marketing, business ethics and social responsibility, fundamentals of accountancy, organizational and management principles, and financial management. Students will also be exposed to business and investment strategies, entrepreneurship, business law, and economics.
				</p>
				<p class="lh-base">
					In addition to the theoretical concepts and principles, the ABM strand also focuses on developing practical skills that are needed in the business world. These skills include critical thinking, problem-solving, decision-making, and communication skills. Students are also expected to participate in various activities that will help them develop leadership, teamwork, and interpersonal skills.
				</p>
				<p class="lh-base">
					After completing the ABM strand, students have the option to pursue a career in various fields such as accounting, finance, marketing, human resource management, business development, and entrepreneurship. They can also opt to pursue higher education in business-related fields such as accountancy, business administration, economics, finance, marketing, and management.
				</p>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/goaloriented.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/analytical.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/practical.png" class="card-img-top" alt="...">
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
							The prerequisites for courses under the ABM strand may vary depending on the college or university offering them. However, in general, common prerequisites for ABM courses may include:
						</p>
						<ul>
							<li>Mathematics: A strong foundation in math is essential for most ABM courses. Students may need to complete courses in algebra, geometry, trigonometry, calculus, or statistics, depending on the specific course.</li>
							<li>Accounting: Since the ABM strand is focused on business and management, students may need to take courses in accounting to have a strong foundation in financial management and decision-making.</li>
							<li>Economics: Courses in economics may be required to provide students with a deeper understanding of the principles of supply and demand, market trends, and global economic issues.</li>
							<li>Business Communication: Courses in business communication may help students develop strong written and verbal communication skills, which are essential in the business world.</li>
							<li>Entrepreneurship: Some ABM courses may require students to take courses in entrepreneurship to understand the process of starting and managing a business.</li>
							<li>English: Courses in English may be necessary to help students improve their reading and writing skills, which are important for effective communication in the business world.</li>
							<li>Social Science: Courses in social science, such as psychology, sociology, or political science, may be necessary to help students understand the human behavior and social structures that influence business decisions.</li>
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
			<h1 class="fw-bold">Possible College Courses Under the ABM Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 order-2 order-lg-1 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/college_course.png" class="img-fluid" alt="...">
			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The ABM strand prepares students for a wide range of college courses related to business, management, and economics. Here are some possible college courses that align with the ABM strand:
						</p>
						<ul>
							<li>Accounting courses: Financial Accounting, Managerial Accounting, Taxation, Auditing, Cost Accounting, etc.</li>
							<li>Economics courses: Microeconomics, Macroeconomics, Econometrics, International Economics, Development Economics, Labor Economics, etc.</li>
							<li>Business courses: Business Administration, Marketing, Human Resource Management, Operations Management, Entrepreneurship, Business Ethics, Business Law, etc.</li>
							<li>Finance courses: Financial Management, Corporate Finance, Investment Analysis, Financial Markets and Institutions, Financial Planning, etc.</li>
							<li>Management courses: Strategic Management, Organizational Behavior, Leadership and Team Management, Project Management, Supply Chain Management, etc.</li>
							<li>Communication courses: Business Communication, Public Relations, Advertising, Mass Communication, etc.</li>
							<li>Legal courses: Business Law, Labor Law, International Law, Intellectual Property Law, etc.</li>
							<li>International Business courses: International Trade, Globalization and Culture, International Business Management, Cross-Cultural Management, etc.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center p-5">
		<div class="flex-row mb-3">
			<h1 class="fw-bold">Possible Jobs Under the ABM Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The ABM strand prepares students for a wide range of career paths related to accounting, business, and economics. Here are some possible jobs that align with the ABM strand:
						</p>
						<ul>
							<li>Accountant</li>
							<li>Financial Analyst</li>
							<li>Business Administrator</li>
							<li>Marketing Manager</li>
							<li>Human Resources Manager</li>
							<li>Operations Manager</li>
							<li>Entrepreneur</li>
							<li>Management Consultant</li>
							<li>Investment Banker</li>
							<li>Stockbroker</li>
							<li>Business Lawyer</li>
							<li>Economist</li>
							<li>Data Analyst</li>
							<li>Market Researcher</li>
							<li>Public Relations Specialist</li>
							<li>Advertising Executive</li>
							<li>Event Planner</li>
							<li>Hotel Manager</li>
							<li>Retail Manager</li>
							<li>Supply Chain Manager</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/abm_career.png" class="img-fluid" alt="...">
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
					window.location = "dashboard_abm.php";
				}
			};
			xmlhttp.open("GET", "forjax/set_exam_type_session.php?exam_category=" + exam_category, true);
			xmlhttp.send(null);
		}
	</script>
</body>

</html>