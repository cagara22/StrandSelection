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

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strand Selection Ver2</title>
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
						<a class="nav-link active" aria-current="page" href="../strand.ph">STRAND</a>
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

	<div class="hero d-flex flex-column justify-content-center align-items-center" id="gasHeader">
		<div class="bgblur d-flex flex-column justify-content-center">
			<h1 class="title3 fw-bold">General Academic Strand</h1>
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
						<img src="../images/gas1.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Overview of GAS</h1>
							<p class="card-text">The Senior High School (SHS) strand in General Academic Strand (GAS) is designed to provide students with a well-rounded education that prepares them for a wide range of academic and career paths. GAS is a versatile strand that emphasizes critical thinking, effective communication, and a broad understanding of various subjects across the humanities, social sciences, and natural sciences.</p>
							<p class="card-text">In the GAS strand, students are exposed to a diverse curriculum that includes subjects in literature, mathematics, social sciences, natural sciences, and the arts. This comprehensive approach equips students with a broad knowledge base and the skills necessary to analyze complex issues, communicate effectively, and make informed decisions. GAS allows students to explore their interests and talents across multiple fields, making it an excellent choice for those who have not yet decided on a specific career path. It serves as a solid foundation for further education in various disciplines, including the humanities, social sciences, natural sciences, education, and the arts.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bglightgrey section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<h1 class="card-title fw-bold sub-title">Possible College Courses Under the GAS</h1>
			<p class="card-text">The General Academic Strand (GAS) in senior high school is designed to provide students with a well-rounded education, and it does not typically lead to specific career tracks like some other specialized strands such as STEM, ABM, or HUMSS. Instead, GAS offers a flexible curriculum that allows students to explore a wide range of interests and prepares them for a variety of undergraduate programs.</p>
			<p class="card-text">Students in the GAS strand have the flexibility to choose programs based on their interests and strengths, whether in the humanities, social sciences, natural sciences, or other fields. It's important for GAS students to explore their interests and consult with career counselors to make informed decisions about their future academic and career paths.</p>
		</div>
	</section>

	<section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
		<div class="reswid px-3">
			<div class="card border-light mb-3" style="max-width: 100%;">
				<div class="row g-0">
					<div class="order-1 order-md-2 col-md-5 d-flex flex-column justify-content-center align-items-center text-center">
						<img src="../images/gas2.png" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="order-2 order-md-1 col-md-7">
						<div class="card-body">
							<h1 class="card-title fw-bold sub-title">Possible Jobs in the GAS</h1>
							<p class="card-text">The General Academic Strand (GAS) in senior high school is a flexible and adaptable educational program designed to offer students a comprehensive foundation in various subjects. This well-rounded approach equips students with knowledge and skills that can be applied to numerous career opportunities spanning a wide array of fields and industries.</p>
							<p class="card-text">One of the notable features of the GAS strand is its versatility. Unlike some other specialized strands, GAS doesn't confine students to a predetermined career track. Instead, it provides a broad and balanced curriculum that covers subjects from the humanities, social sciences, natural sciences, and even mathematics. This diversity ensures that GAS graduates possess a well-rounded education and a wide-ranging skill set.</p>
							<p class="card-text">In essence, GAS provides a solid and adaptable foundation for students to embark on diverse career journeys. It empowers them to make informed decisions about their future education and careers while allowing them the flexibility to explore and choose paths that align with their unique aspirations and passions. Whether it's entering the workforce directly after high school or pursuing higher education, GAS graduates are well-prepared for the challenges and opportunities that lie ahead.</p>
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
						<h1 class="card-title fw-bold sub-title">GAS Curriculum</h1>
						<p class="card-text">The senior high school General Academic Strand (GAS) offers a comprehensive and well-rounded education, encompassing a diverse range of subjects from the humanities, social sciences, natural sciences, and mathematics. These subjects collectively build a strong academic foundation that equips students with versatile knowledge and skills applicable to various undergraduate programs and future career paths.</p>
						<div class="d-grid gap-2 d-md-flex">
							<a class="btn btn-warning fw-bold" href="../propectus/GAS.jpg" download role="button">DOWNLOAD</a>
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