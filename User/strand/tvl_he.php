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
				<h1 class="text-body-emphasis fw-bold">TVL (HE)</h1>
				<p class="lead fst-italic">
					"The TVL-HE strand: where passion meets precision in the <code>culinary arts</code>!"
				</p>
				<a href="#Learn"><button type="button" class="btn btn-outline-primary btn-lg fw-bold fs-3 m-2">Learn More</button>

				</a>

				<?php
				// Assuming you have established a database connection using your preferred method

				// Perform the SQL query to retrieve the value from the database
				$id = $_SESSION['student'];
				$sql = "SELECT HE FROM exam_score WHERE lrn = '$id'";
				$result = mysqli_query($link, $sql);

				// Check if the query was successful
				if ($result) {
					// Fetch the row from the result
					$row = mysqli_fetch_assoc($result);

					// Check if the exam_score value exists
					if (!empty($row['HE'])) {
						// The assessment has been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" disabled>Assessment Answered</button>';
					} else {
						// The assessment has not been answered
						echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" onclick="window.location.href = \'instructions_he.php\';">Take assessment</button>';
					}
				} else {
					// An error occurred with the query
					echo 'Error: ' . mysqli_error($link);
				}

				?>


			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-4 d-flex flex-wrap justify-content-center align-items-center p-5">
				<img src="../images/tvlhe.png" class="img-fluid" alt="...">
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
					The Technical-Vocational Livelihood (TVL) strand with the Home Economics (HE) specialization focuses on developing students' technical and vocational skills in various fields related to home economics. It provides practical and hands-on training to prepare students for careers in various fields, including food and beverage, hospitality, tourism, and caregiving. Students who choose this strand will acquire competencies in preparing, cooking, and serving food, as well as managing and operating restaurants, hotels, and other food service establishments.
				</p>
				<p class="lh-base">
					The TVL HE strand consists of core subjects, contextualized subjects, and specializations. Core subjects include mathematics, science, English, and Filipino, which are essential for all students regardless of their chosen specialization. Contextualized subjects are those that are specific to the TVL HE strand, such as food and beverage services, tourism promotion services, and housekeeping services.
				</p>
				<p class="lh-base">
					The specialization subjects provide students with the necessary knowledge and skills for their chosen career paths. These include courses in culinary arts, baking and pastry arts, food and beverage services, hospitality, and tourism management. Additionally, the TVL HE strand also provides opportunities for students to engage in real-world experiences through on-the-job training, apprenticeships, and internships.
				</p>
				<p class="lh-base">
					Overall, the TVL HE strand aims to develop students' competencies in various technical and vocational skills while also providing them with a strong foundation in general education. Students who choose this strand can pursue a wide range of careers in the food and beverage industry, hospitality, and tourism, or caregiving.
				</p>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/skill.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/practical.png" class="card-img-top" alt="...">
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card border-light text-center mx-auto" style="width: 10rem;">
					<img src="../images/service.png" class="card-img-top" alt="...">
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
							The prerequisites for courses under the TVL HE strand may vary depending on the specific program or course. However, in general, common prerequisites for TVL HE courses may include:
						</p>
						<ul>
							<li>Basic Mathematics: Students should have a strong foundation in basic math concepts such as arithmetic, algebra, and geometry.</li>
							<li>Science: Some TVL HE courses may require basic knowledge of science concepts, particularly in the areas of nutrition, food safety, and food microbiology.</li>
							<li>English: Students should have good communication skills in English, including reading, writing, and speaking.</li>
							<li>Computer Skills: Basic computer skills such as word processing, spreadsheet manipulation, and internet research may be necessary for some TVL HE courses.</li>
							<li>Technical Skills: Some TVL HE courses may require students to have specific technical skills, such as cooking or baking, sewing, or carpentry.</li>
							<li>Basic Accounting: For students interested in pursuing careers in hospitality management, basic accounting principles may be necessary.</li>
							<li>Customer Service Skills: For students interested in careers in the hospitality industry, customer service skills are essential.</li>
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
			<h1 class="fw-bold">Possible College Courses Under the TVL (HE) Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 order-2 order-lg-1 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/college_course.png" class="img-fluid" alt="...">
			</div>
			<div class="col-12 order-1 order-lg-2 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The TVL HE strand prepares students for college courses related to hospitality, tourism, and other related fields. Here are some possible college courses that align with the TVL HE strand:
						</p>
						<ul>
							<li>Food and Beverage Services NC II</li>
							<li>Cookery NC II</li>
							<li>Bread and Pastry Production NC II</li>
							<li>Housekeeping NC II</li>
							<li>Commercial Cooking NC II</li>
							<li>Bartending NC II</li>
							<li>Front Office Services NC II</li>
							<li>Food Processing NC II</li>
							<li>Food Safety and Sanitation</li>
							<li>Entrepreneurship</li>
							<li>Hospitality Management</li>
							<li>Travel and Tourism Management</li>
							<li>Culinary Arts</li>
							<li>Baking and Pastry Arts</li>
							<li>Nutrition and Dietetics</li>
							<li>Hotel and Restaurant Management</li>
							<li>Event Management</li>
							<li>Customer Service</li>
							<li>Food Business Management</li>
							<li>Culinary Entrepreneurship</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="d-flex flex-column justify-content-center align-items-center p-5">
		<div class="flex-row mb-3">
			<h1 class="fw-bold">Possible Jobs Under the TVL (HE) Strand</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card border-light w-100">
					<div class="card-body">
						<p class="lh-base fw-semibold">
							The TVL HE strand equips students with skills and knowledge in Cooking, Baking, Hospitality, and Service, opening up various career opportunities in these fields. Here are some possible jobs under the TVL HE strand:
						</p>
						<ul>
							<li>Chef</li>
							<li>Baker</li>
							<li>Pastry Chef</li>
							<li>Food and Beverage Manager</li>
							<li>Restaurant Manager</li>
							<li>Hotel Manager</li>
							<li>Catering Manager</li>
							<li>Kitchen Manager</li>
							<li>Food Scientist</li>
							<li>Nutritionist</li>
							<li>Dietician</li>
							<li>Food Safety Specialist</li>
							<li>Event Planner</li>
							<li>Tour Guide</li>
							<li>Travel Agent</li>
							<li>Barista</li>
							<li>Bartender</li>
							<li>Sommelier</li>
							<li>Customer Service Representative</li>
							<li>Entrepreneur (starting a food business)</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
				<img src="../images/tvlhe_career.png" class="img-fluid" alt="...">
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
					window.location = "dashboard_he.php";
				}
			};
			xmlhttp.open("GET", "forjax/set_exam_type_session.php?exam_category=" + exam_category, true);
			xmlhttp.send(null);
		}
	</script>
</body>

</html>