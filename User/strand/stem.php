<?php
session_start();

if(!isset($_SESSION["student"]))
{

    ?>
    <script type="text/javascript">
        window.location="index.php";
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
								<?php  echo $_SESSION["student"]; ?>
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
					<h1 class="text-body-emphasis fw-bold">STEM</h1>
					<p class="lead fst-italic">
						"In STEM, we don't call it mistakes, we call it <code>learning opportunities</code>..."
					</p>
					<a href="#Learn"><button type="button" class="btn btn-outline-primary btn-lg fw-bold fs-3 m-2">Learn More</button>
					
				</a>

				<?php
// Assuming you have established a database connection using your preferred method

// Perform the SQL query to retrieve the value from the database
$id = $_SESSION['student'];
$sql = "SELECT STEM FROM exam_score WHERE lrn = '$id'";
$result = mysqli_query($link, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the row from the result
    $row = mysqli_fetch_assoc($result);
    
    // Check if the exam_score value exists
    if (!empty($row['STEM'])) {
        // The assessment has been answered
        echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" disabled>Assessment Answered</button>';
    } else {
        // The assessment has not been answered
        echo '<button class="btn btn-outline-success btn-lg fw-bold fs-3 m-2" onclick="window.location.href = \'instructions_stem.php\';">Take assessment</button>';
    }
} else {
    // An error occurred with the query
    echo 'Error: ' . mysqli_error($link);
}

?>


					

					

				</div>
				<div class="col-12 order-1 order-lg-2 col-lg-4 d-flex flex-wrap justify-content-center align-items-center p-5">
					<img src="../images/stem.png" class="img-fluid" alt="...">
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
                        The Senior High School (SHS) strand in Science, Technology, Engineering, and Mathematics (STEM) is designed to prepare students for careers in various fields related to these disciplines. STEM is a highly academic strand that emphasizes the development of skills in the areas of critical thinking, problem-solving, and innovation. This strand provides students with a strong foundation in mathematics, physical sciences, and life sciences, as well as exposure to emerging technologies and engineering concepts. 
                    </p>
                    <p class="lh-base">
                        In the STEM strand, students are expected to master the fundamental principles of calculus, statistics, and physics, as well as concepts related to chemistry, biology, and earth sciences. The strand also introduces students to the latest technologies and engineering practices, including computer programming, robotics, and 3D printing. These technologies and practices are integrated into various subjects within the strand, allowing students to develop their skills in practical, hands-on ways. 
                    </p>
                    <p class="lh-base">
                        In addition to its academic rigor, the STEM strand also emphasizes the development of soft skills such as collaboration, communication, and leadership. Students in this strand are encouraged to work together in teams to solve problems, communicate their ideas effectively, and take on leadership roles within their groups. 
                    </p>
					<p class="lh-base">
                        Graduates of the STEM strand are well-prepared for a wide range of careers in fields such as engineering, computer science, healthcare, research, and teaching. They also have a strong foundation for pursuing higher education in science and technology-related fields. With its focus on critical thinking, problem-solving, and innovation, the STEM strand equips students with the skills and knowledge they need to succeed in the 21st-century workforce. 
                    </p>
                </div>
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card border-light text-center mx-auto" style="width: 10rem;">
						<img src="../images/innovative.png" class="card-img-top" alt="...">
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card border-light text-center mx-auto" style="width: 10rem;">
						<img src="../images/analytical.png" class="card-img-top" alt="...">
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
								The prerequisites for courses under the STEM strand may vary depending on the college or university offering them. However, in general, common prerequisites for STEM courses may include:
							</p>
							<ul>
								<li>Mathematics: A strong foundation in math is essential for most STEM courses. Students may need to complete courses in algebra, trigonometry, calculus, or statistics, depending on the specific course.</li>
								<li>Science: Science courses such as physics, chemistry, and biology are often required prerequisites for STEM courses. These courses may also have laboratory components.</li>			
								<li>Computer Science: Many STEM courses require basic programming knowledge, so some courses in computer science may be necessary.</li>
								<li>Engineering: Courses in engineering principles and design may be required for some STEM courses.</li>
								<li>Language: Some STEM courses may require proficiency in a specific language, particularly if the course involves international research or collaboration.</li>
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
				<h1 class="fw-bold">Possible College Courses Under the STEM Strand</h1>
			</div>
			<div class="row">
				<div class="col-12 order-2 order-lg-1 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
					<img src="../images/college_course.png" class="img-fluid" alt="...">
				</div>
				<div class="col-12 order-1 order-lg-2 col-lg-6 d-flex justify-content-center align-items-center">
					<div class="card border-light w-100">
						<div class="card-body">
							<p class="lh-base fw-semibold">
								The STEM strand prepares students for a wide range of college courses related to science, technology, engineering, and mathematics. Here are some possible college courses that align with the STEM strand: 
							</p>
							<ul>
								<li>Engineering courses: Mechanical Engineering, Electrical Engineering, Chemical Engineering, Aerospace Engineering, Civil Engineering, Computer Engineering, Biomedical Engineering, Environmental Engineering, Industrial Engineering, etc.</li>
								<li>Mathematics courses: Mathematics, Applied Mathematics, Statistics, Actuarial Science, Data Science, Financial Mathematics, etc.</li>			
								<li>Science courses: Physics, Chemistry, Biology, Environmental Science, Geology, Astronomy, Medical Laboratory Science, Medical Technology, etc.</li>
								<li>Computer Science courses: Computer Science, Information Technology, Computer Engineering, Cybersecurity, Data Science, Artificial Intelligence, Software Engineering, etc.</li>
								<li>Architecture courses: Architecture, Landscape Architecture, Interior Design, Urban Planning, etc.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="d-flex flex-column justify-content-center align-items-center p-5">
			<div class="flex-row mb-3">
				<h1 class="fw-bold">Possible Jobs Under the STEM Strand</h1>
			</div>
			<div class="row">
				<div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
					<div class="card border-light w-100">
						<div class="card-body">
							<p class="lh-base fw-semibold">
								The STEM strand equips students with skills and knowledge in Science, Technology, Engineering, and Mathematics, opening up various career opportunities in these fields. Here are some possible jobs under the STEM strand: 
							</p>
							<ul>
								<li>Scientist (Chemist, Biologist, Physicist)</li>
								<li>Mathematician/Statistician</li>
								<li>Engineer (Civil, Mechanical, Electrical, Chemical, Aerospace, etc.)</li>
								<li>Information Technology (IT) professional (Programmer, Developer, Network Engineer, Web Developer, etc.)</li>
								<li>Architect</li>
								<li>Surveyor</li>
								<li>Environmental Specialist (Ecologist, Environmental Scientist, Geoscientist, etc.)</li>
								<li>Medical Professional (Doctor, Nurse, Dentist, etc.)</li>
								<li>Data Analyst/Scientist</li>
								<li>Researcher</li>
								<li>Science Writer/Communicator</li>
								<li>Financial Analyst</li>
								<li>Geographer</li>
								<li>Physiotherapist</li>
								<li>Robotics Engineer/Technician</li>
								<li>Renewable Energy Specialist</li>
								<li>Computer Systems Analyst</li>
								<li>Agricultural Scientist/Engineer</li>
								<li>Science Educator/Professor</li>
								<li>Biomedical Engineer/Technician.</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center align-items-center">
					<img src="../images/stem_career.png" class="img-fluid" alt="...">
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
    function set_exam_type_session(exam_category)
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location = "dashboard_stem.php";
            }
        };
        xmlhttp.open("GET","forjax/set_exam_type_session.php?exam_category="+ exam_category,true);
        xmlhttp.send(null);
    }
</script>
	</body>
</html>