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
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Strand Selection</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
		
		<!-- Custom CSS -->
		<link rel="stylesheet" href="custom_css.css">
	</head>
	
	<body>
		<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">
					<img src="./images/SystemBrandWhiteVer2.png" alt="Logo" width="200" height="34" class="d-inline-block align-text-top">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
					<ul class="navbar-nav">
						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="list.php">LIST</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">ABOUT</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profile.php">PROFILE</a>
						</li>>
						<li class="nav-item">
							<a class="nav-link" ><?php  echo $_SESSION["student"]; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LOGOUT</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		
		<section class="d-flex flex-column align-items-center py-5">
			<div class="flex-row">
				<h1 class="fw-bold">CHOOSE A STRAND</h1>
			</div>
			<div class="row" style="width:100%">
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					<div class="card border-light text-center mx-auto" style="width: 18rem;">
						<img src="./images/stem.png" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title fw-bold">STEM</h5>
							<p class="card-text lh-1">This strand is focused on developing skills and knowledge in the fields of science, technology, engineering, and math, and is ideal for students who want to pursue careers in these fields.</p>
							<a href="./strand/stem.php" class="btn btn-primary">EXPLORE</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					<div class="card border-light text-center mx-auto" style="width: 18rem;">
						<img src="./images/humss.png" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title fw-bold">HUMSS</h5>
							<p class="card-text lh-1">This strand is focused on developing skills and knowledge in the areas of language, literature, history, philosophy, psychology, and the social sciences. It is ideal for students who are interested in pursuing careers in fields such as law, teaching, social work, or journalism.</p>
							<a href="./strand/humms.php" class="btn btn-primary">EXPLORE</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					<div class="card border-light text-center mx-auto" style="width: 18rem;">
						<img src="./images/abm.png" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title fw-bold">ABM</h5>
							<p class="card-text lh-1">This strand is focused on developing skills and knowledge in the areas of accounting, business, and management. It is ideal for students who are interested in pursuing careers in fields such as business, finance, economics, or entrepreneurship.</p>
							<a href="./strand/abm.php" class="btn btn-primary">EXPLORE</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					<div class="card border-light text-center mx-auto" style="width: 18rem;">
						<img src="./images/gas.png" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title fw-bold">GAS</h5>
							<p class="card-text lh-1">This strand is designed to provide students with a broad range of knowledge and skills across various academic disciplines. It is ideal for students who are still exploring their interests and are undecided about their career paths.</p>
							<a href="./strand/gas.php" class="btn btn-primary">EXPLORE</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					<div class="card border-light text-center mx-auto" style="width: 18rem;">
						<img src="./images/tvlict.png" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title fw-bold">TVL-ICT</h5>
							<p class="card-text lh-1">TVL-ICT (Information and Communications Technology) is a technical-vocational strand that focuses on the skills needed for information and communication technology.</p>
							<a href="./strand/tvl_ict.php" class="btn btn-primary">EXPLORE</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					<div class="card border-light text-center mx-auto" style="width: 18rem;">
						<img src="./images/tvlhe.png" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title fw-bold">TVL-HE</h5>
							<p class="card-text lh-1">TVL-HE (Home Economics) is a technical-vocational strand that focuses on the skills needed for home economics and entrepreneurship.</p>
							<a href="./strand/tvl_he.php" class="btn btn-primary">EXPLORE</a>
						</div>
					</div>
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
	</body>
</html>