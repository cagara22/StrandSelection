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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="./images/SystemBrandWhiteVer2.png" alt="Logo" width="200" height="34" class="d-inline-block align-text-top">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="home.php">HOME</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="strand.php">STRAND</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php">PROFILE</a>
					</li>
                    <li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="result.php">RESULT</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="about.php">ABOUT</a>
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

	<section class="section-100 d-flex flex-column justify-content-center align-items-center px-3 py-5">
		<h2 class="fw-bold sub-title mt-3">Here is your detailed result!</h2>
		<div class="row w-100">
			<div class="col-12 col-lg-8 d-flex justify-content-center align-items-center mb-3">
				<div class="card custcard border-light text-center" style="width: 100%;">
					<div class="card-header">
						<h4 class="fw-bold card-text-header">STATISTIC</h4>
					</div>
					<div class="card-body">
						<div class="row w-100">
							<div class="col-12">
								<canvas id="overallpieChart"></canvas>
							</div>
							<div class="col-6 col-md-4">
								<canvas id="skintpieChart"></canvas>
							</div>
							<div class="col-6 col-md-4">
								<canvas id="acadpieChart"></canvas>
							</div>
							<div class="col-6 col-md-4">
								<canvas id="careerpieChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4 d-flex justify-content-center align-items-center mb-3">
				<div class="card custcard border-light text-center" style="width: 100%;">
					<div class="card-header">
						<h4 class="fw-bold card-text-header">RECOMENDATION</h4>
					</div>
					<div class="card-body">
						
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
	<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	
	<script>
        var labels =["STEM", "HUMSS", "ABM", "GAS", "TVL-ICT", "TVL-HE"];
		var skintvalues =[60, 30, 10, 0, 0, 0];
		var acadvalues =[70, 20, 10, 0, 0, 0];
		var careervalues =[90, 5, 5, 0, 0, 0];
		var overallvalues =[95, 3, 2, 0, 0, 0];
		var barColors = [
			"rgba(112,214,255,1.0)",
			"rgba(255,112,166,1.0)",
			"rgba(255,151,112,1.0)",
			"rgba(255,214,112,1.0)",
			"rgba(233,255,112,1.0)",
			"rgba(104,122,0,1.0)",
		];

		const skintpieChart = new Chart("skintpieChart", {
			type: "doughnut",
			data: {
				labels: labels,
				datasets: [{
					backgroundColor: barColors,
					data: skintvalues
				}]
			},
			options: {
				title: {
					display: true,
					text: "Skills & Interests"
				},
				legend: {
					display: false
				}
			}
		});

		const acadpieChart = new Chart("acadpieChart", {
			type: "doughnut",
			data: {
				labels: labels,
				datasets: [{
					backgroundColor: barColors,
					data: acadvalues
				}]
			},
			options: {
				title: {
					display: true,
					text: "Academic Performance"
				},
				legend: {
					display: false
				}
			}
		});

		const careerpieChart = new Chart("careerpieChart", {
			type: "doughnut",
			data: {
				labels: labels,
				datasets: [{
					backgroundColor: barColors,
					data: careervalues
				}]
			},
			options: {
				title: {
					display: true,
					text: "Career"
				},
				legend: {
					display: false
				}
			}
		});

		const overallpieChart = new Chart("overallpieChart", {
			type: "doughnut",
			data: {
				labels: labels,
				datasets: [{
					backgroundColor: barColors,
					data: overallvalues
				}]
			},
			options: {
				title: {
					display: true,
					text: "OVERALL"
				}
			}
		});
    </script>
</html>
