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

    <div class="hero d-flex flex-column justify-content-center align-items-center" id="tvlheHeader">
		<div class="bgblur d-flex flex-column justify-content-center">
			<h1 class="title3 fw-bold">TVL - Home Economics</h1>
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
                        <img src="../images/tvlhe1.png" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h1 class="card-title fw-bold sub-title">Overview of TVL - HE</h1>
                            <p class="card-text">The Senior High School (SHS) strand in Technical-Vocational-Livelihood with a focus on Home Economics (TVL-HE) is designed to equip students with practical skills and knowledge in various aspects of home economics and related fields. TVL-HE emphasizes hands-on learning and practical application of essential life skills, including cooking, sewing, interior design, and family and consumer sciences.</p>
							<p class="card-text">In the TVL-HE strand, students will delve into subjects such as culinary arts, clothing and textile technology, family and child care, and household management. They will develop proficiency in cooking techniques, sewing and fabric manipulation, home decoration, and budgeting. These skills are not only valuable for personal development but also prepare students for potential careers in the areas of culinary arts, fashion and design, and family services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<section class="bglightgrey section-100 d-flex flex-column justify-content-center align-items-center py-5">
        <div class="reswid px-3">
            <h1 class="card-title fw-bold sub-title">Possible College Courses Under the TVL - HE</h1>
			<p class="card-text">Many of our TVL-HE (Technical-Vocational-Livelihood with a focus on Home Economics) students go on to apply for undergraduate programs and embark on journeys into their chosen specialized fields within the domain of home economics and related vocations. Through the courses under the TVL-HE strand, these students continue to develop into skilled professionals, artisans, and experts in areas such as culinary arts, fashion and design, family services, and home management. The TVL-HE strand curriculum opens doors to a variety of vocational and technical degree programs, which can include but are not limited to:</p>
			<ul>
				<li>Bachelor of Science in Culinary Arts</li>
				<li>Bachelor of Science in Fashion Design</li>
				<li>Bachelor of Science in Family and Consumer Sciences</li>
				<li>Bachelor of Science in Interior Design</li>
				<li>Bachelor of Science in Home Economics Education</li>
				<li>Bachelor of Science in Event Planning and Management</li>
				<li>Bachelor of Science in Nutrition and Dietetics</li>
				<li>Bachelor of Science in Hospitality Management</li>
				<li>Bachelor of Science in Child and Family Studies</li>
				<li>Bachelor of Science in Food Service Management</li>
			</ul>			
        </div>
    </section>

	<section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
        <div class="reswid px-3">
            <div class="card border-light mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="order-1 order-md-2 col-md-5 d-flex flex-column justify-content-center align-items-center text-center">
                        <img src="../images/tvlhe2.png" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="order-2 order-md-1 col-md-7">
                        <div class="card-body">
                            <h1 class="card-title fw-bold sub-title">Possible Jobs in the TVL - HE</h1>
                            <p class="card-text">Our senior high school TVL-HE students go on to discover meaningful career opportunities that align with the practical skills and knowledge they've acquired through our specialized curriculum. They will encounter abundant prospects, both in the workforce and in pursuing advanced studies in higher education. Senior high school graduates from the TVL-HE strand have found rewarding and successful careers in a variety of roles that directly relate to their field of expertise:</p>
							<div class="row">
								<div class="col-12 col-md-6">
									<ul>
										<li>Chef</li>
										<li>Pastry Chef</li>
										<li>Fashion Designer</li>
										<li>Textile Designer</li>
										<li>Family and Consumer Sciences Educator</li>
										<li>Interior Designer</li>
										<li>Home Economics Educator</li>
										<li>Event Planner</li>
									</ul>
								</div>
								<div class="col-12 col-md-6">
									<ul>
										<li>Nutritionist</li>
										<li>Dietitian</li>
										<li>Hotel Manager</li>
										<li>Restaurant Manager</li>
										<li>Child Life Specialist</li>
										<li>Family Counselor</li>
										<li>Food Service Manager</li>
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
						<h1 class="card-title fw-bold sub-title">TVL - HE Curriculum</h1>
						<p class="card-text">The senior high school TVL-HE (Technical-Vocational-Livelihood with a focus on Home Economics) strand offers an immersive exploration of practical skills and knowledge related to home economics and various vocational disciplines. These subjects are meticulously designed to equip students with valuable life skills, including cooking, sewing, interior design, family services, and household management, setting a strong foundation for their future careers and everyday life.</p>
						<div class="d-grid gap-2 d-md-flex">
							<a class="btn btn-warning fw-bold" href="../propectus/TVL_HE.jpg" download role="button">DOWNLOAD</a>
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