<?php
//Starts the sessin and checks if the student is logged in or not
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
	<title>GUIDE</title>
	<link rel="icon" type="images/x-icon" href="images/GUIDE_Logo_2.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
	<nav class="navbar navbar-expand-md fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="./images/GUIDE_Logo_3.png" alt="Logo" width="150" height="37" class="d-inline-block align-text-top">
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
							<?php echo $_SESSION['fname']; //The name off the Student?>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="section-100 d-flex flex-column justify-content-top align-items-center px-3 py-5">
		<h2 class="fw-bold sub-title mt-4">Here is your detailed result!</h2>
		<div class="row w-100">
			<div class="col-12 col-lg-8 d-flex justify-content-center align-items-center mb-3">
				<div class="card custcard border-light text-center" style="width: 100%;">
					<div class="card-header">
						<h4 class="fw-bold card-text-header">STATISTIC</h4>
					</div>

					<?php
					//check for the students lrn
					if (isset($_SESSION['student'])) {
						include "connection.php"; //include the connection file

						$user_id = $_SESSION['student']; //get the lrn

						//prep the select query
						$sql = "SELECT sp.*, r.*, 
						sr.acadProb AS acadProbStem, 
						sr.intProb AS intProbStem, 
						sr.carProb AS carProbStem, 
						sr.skiProb AS skiProbStem, 
						sr.totalScore AS totalScoreStem, 
						sr.percScore AS percScoreStem, 
						hr.acadProb AS acadProbHumss, 
						hr.intProb AS intProbHumss, 
						hr.carProb AS carProbHumss, 
						hr.skiProb AS skiProbHumss, 
						hr.totalScore AS totalScoreHumss, 
						hr.percScore AS percScoreHumss, 
						ar.acadProb AS acadProbAbm, 
						ar.intProb AS intProbAbm, 
						ar.carProb AS carProbAbm, 
						ar.skiProb AS skiProbAbm, 
						ar.totalScore AS totalScoreAbm, 
						ar.percScore AS percScoreAbm, 
						gr.acadProb AS acadProbGas, 
						gr.intProb AS intProbGas, 
						gr.carProb AS carProbGas, 
						gr.skiProb AS skiProbGas, 
						gr.totalScore AS totalScoreGas, 
						gr.percScore AS percScoreGas, 
						tr.acadProb AS acadProbTvlict, 
						tr.intProb AS intProbTvlict, 
						tr.carProb AS carProbTvlict, 
						tr.skiProb AS skiProbTvlict, 
						tr.totalScore AS totalScoreTvlict, 
						tr.percScore AS percScoreTvlict, 
						tlr.acadProb AS acadProbTvlhe, 
						tlr.intProb AS intProbTvlhe, 
						tlr.carProb AS carProbTvlhe, 
						tlr.skiProb AS skiProbTvlhe, 
						tlr.totalScore AS totalScoreTvlhe, 
						tlr.percScore AS percScoreTvlhe 
				 FROM studentprofile sp
				 JOIN result r ON sp.lrn = r.lrn 
				 JOIN stemresult sr ON sp.lrn = sr.lrn 
				 JOIN humssresult hr ON sp.lrn = hr.lrn 
				 JOIN abmresult ar ON sp.lrn = ar.lrn 
				 JOIN gasresult gr ON sp.lrn = gr.lrn 
				 JOIN tvlictresult tr ON sp.lrn = tr.lrn 
				 JOIN tvlheresult tlr ON sp.lrn = tlr.lrn 
				 WHERE sp.lrn = '$user_id';";

						$result = $conn->query($sql);

						if ($result->num_rows > 0) {

							while ($row = $result->fetch_assoc()) {
								//get all the student's result
								$recommendation = $row['recommendation'];

								$ovrSTEM = $row['percScoreStem'];
								$ovrHUMSS = $row['percScoreHumss'];
								$ovrABM = $row['percScoreAbm'];
								$ovrGAS = $row['percScoreGas'];
								$ovrTVLICT = $row['percScoreTvlict'];
								$ovrTVLHE = $row['percScoreTvlhe'];

								$skiSTEM = $row['skiProbStem'];
								$skiHUMSS = $row['skiProbHumss'];
								$skiABM = $row['skiProbAbm'];
								$skiGAS = $row['skiProbGas'];
								$skiTVLICT = $row['skiProbTvlict'];
								$skiTVLHE = $row['skiProbTvlhe'];

								$intSTEM = $row['intProbStem'];
								$intHUMSS = $row['intProbHumss'];
								$intABM = $row['intProbAbm'];
								$intGAS = $row['intProbGas'];
								$intTVLICT = $row['intProbTvlict'];
								$intTVLHE = $row['intProbTvlhe'];

								$acadSTEM = $row['acadProbStem'];
								$acadHUMSS = $row['acadProbHumss'];
								$acadABM = $row['acadProbAbm'];
								$acadGAS = $row['acadProbGas'];
								$acadTVLICT = $row['acadProbTvlict'];
								$acadTVLHE = $row['acadProbTvlhe'];

								$carSTEM = $row['carProbStem'];
								$carHUMSS = $row['carProbHumss'];
								$carABM = $row['carProbAbm'];
								$carGAS = $row['carProbGas'];
								$carTVLICT = $row['carProbTvlict'];
								$carTVLHE = $row['carProbTvlhe'];
							}
							//check if the student has a result already
							$haveResult = ($ovrSTEM == 0 && $ovrHUMSS == 0 && $ovrABM == 0 && $ovrGAS == 0 && $ovrTVLICT == 0 && $ovrTVLHE == 0) ? 0 : 1;
						}
					}
					?>

					<div class="card-body">
						<div class="row w-100">
							<input type="hidden" class="checkRes" name="checkRes" id="checkRes" value="<?php echo $haveResult; ?>">
							<p id="messageTitle">LEGENDS:
								<small class="fw-bold" style="color: rgba(112,214,255,1.0);">STEM</small> -
								<small class="fw-bold" style="color: rgba(255,112,166,1.0);">HUMSS</small> -
								<small class="fw-bold" style="color: rgba(255,151,112,1.0);">ABM</small> -
								<small class="fw-bold" style="color: rgba(255,214,112,1.0);">GAS</small> -
								<small class="fw-bold" style="color: rgba(233,255,112,1.0);">TVL-ICT</small> -
								<small class="fw-bold" style="color: rgba(104,122,0,1.0);">TVL-HE</small>
							</p>
							<div class="col-12">
								<canvas id="overallpieChart"></canvas>
								<input type="hidden" class="ovr" name="ovrSTEM" id="ovrSTEM" value="<?php echo $ovrSTEM; ?>">
								<input type="hidden" class="ovr" name="ovrHUMSS" id="ovrHUMSS" value="<?php echo $ovrHUMSS; ?>">
								<input type="hidden" class="ovr" name="ovrABM" id="ovrABM" value="<?php echo $ovrABM; ?>">
								<input type="hidden" class="ovr" name="ovrGAS" id="ovrGAS" value="<?php echo $ovrGAS; ?>">
								<input type="hidden" class="ovr" name="ovrTVLICT" id="ovrTVLICT" value="<?php echo $ovrTVLICT; ?>">
								<input type="hidden" class="ovr" name="ovrTVLHE" id="ovrTVLHE" value="<?php echo $ovrTVLHE; ?>">
							</div>
							<div class="col-12 col-md-6">
								<canvas id="skipieChart"></canvas>
								<input type="hidden" class="ski" name="skiSTEM" id="skiSTEM" value="<?php echo $skiSTEM; ?>">
								<input type="hidden" class="ski" name="skiHUMSS" id="skiHUMSS" value="<?php echo $skiHUMSS; ?>">
								<input type="hidden" class="ski" name="skiABM" id="skiABM" value="<?php echo $skiABM; ?>">
								<input type="hidden" class="ski" name="skiGAS" id="skiGAS" value="<?php echo $skiGAS; ?>">
								<input type="hidden" class="ski" name="skiTVLICT" id="skiTVLICT" value="<?php echo $skiTVLICT; ?>">
								<input type="hidden" class="ski" name="skiTVLHE" id="skiTVLHE" value="<?php echo $skiTVLHE; ?>">
							</div>
							<div class="col-12 col-md-6">
								<canvas id="intpieChart"></canvas>
								<input type="hidden" class="int" name="intSTEM" id="intSTEM" value="<?php echo $intSTEM; ?>">
								<input type="hidden" class="int" name="intHUMSS" id="intHUMSS" value="<?php echo $intHUMSS; ?>">
								<input type="hidden" class="int" name="intABM" id="intABM" value="<?php echo $intABM; ?>">
								<input type="hidden" class="int" name="intGAS" id="intGAS" value="<?php echo $intGAS; ?>">
								<input type="hidden" class="int" name="intTVLICT" id="intTVLICT" value="<?php echo $intTVLICT; ?>">
								<input type="hidden" class="int" name="intTVLHE" id="intTVLHE" value="<?php echo $intTVLHE; ?>">
							</div>
							<div class="col-12 col-md-6">
								<canvas id="acadpieChart"></canvas>
								<input type="hidden" class="acad" name="acadSTEM" id="acadSTEM" value="<?php echo $acadSTEM; ?>">
								<input type="hidden" class="acad" name="acadHUMSS" id="acadHUMSS" value="<?php echo $acadHUMSS; ?>">
								<input type="hidden" class="acad" name="acadABM" id="acadABM" value="<?php echo $acadABM; ?>">
								<input type="hidden" class="acad" name="acadGAS" id="acadGAS" value="<?php echo $acadGAS; ?>">
								<input type="hidden" class="acad" name="acadTVLICT" id="acadTVLICT" value="<?php echo $acadTVLICT; ?>">
								<input type="hidden" class="acad" name="acadTVLHE" id="acadTVLHE" value="<?php echo $acadTVLHE; ?>">
							</div>
							<div class="col-12 col-md-6">
								<canvas id="careerpieChart"></canvas>
								<input type="hidden" class="car" name="carSTEM" id="carSTEM" value="<?php echo $carSTEM; ?>">
								<input type="hidden" class="car" name="carHUMSS" id="carHUMSS" value="<?php echo $carHUMSS; ?>">
								<input type="hidden" class="car" name="carABM" id="carABM" value="<?php echo $carABM; ?>">
								<input type="hidden" class="car" name="carGAS" id="carGAS" value="<?php echo $carGAS; ?>">
								<input type="hidden" class="car" name="carTVLICT" id="carTVLICT" value="<?php echo $carTVLICT; ?>">
								<input type="hidden" class="car" name="carTVLHE" id="carTVLHE" value="<?php echo $carTVLHE; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4 d-flex justify-content-center align-items-start mb-3">
				<div class="card custcard border-light text-center" style="width: 100%;">
					<div class="card-header">
						<h4 class="fw-bold card-text-header">RECOMENDATION</h4>
					</div>
					<div class="card-body text-start">
						<?php
						if (empty($recommendation)) {
							//if the recommendation is empty
							echo "<p class='fw-bold'>NO RESULTS HAVE BEEN FOUND!</p>";
						} else {
							//display the recomendation
							echo "<p>". $recommendation . "</p>";
						}
						?>
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
		window.addEventListener('DOMContentLoaded', function() {
			//for checking if there is a result generated for the student
			const checkRes = document.getElementById('checkRes');
			const canvases = document.querySelectorAll('canvas');
			const messageTitle = document.getElementById('messageTitle');

			if (checkRes.value === '0') {//no results
				for (let i = 0; i < canvases.length; i++) {
					canvases[i].style.display = 'none';
				}
				messageTitle.innerText = 'NO RESULTS HAVE BEEN FOUND!';
				messageTitle.classList.add('fw-bold');
			} else {//have results, display it
				var labels = ["STEM", "HUMSS", "ABM", "GAS", "TVL-ICT", "TVL-HE"];
				var skivalues = [];
				var intvalues = [];
				var acadvalues = [];
				var careervalues = [];
				var overallvalues = [];

				let ovrhiddenInputs = document.querySelectorAll("input[type=hidden].ovr");
				ovrhiddenInputs.forEach(input => {
					overallvalues.push(input.value);
				});

				let skihiddenInputs = document.querySelectorAll("input[type=hidden].ski");
				skihiddenInputs.forEach(input => {
					skivalues.push(input.value);
				});

				let inthiddenInputs = document.querySelectorAll("input[type=hidden].int");
				inthiddenInputs.forEach(input => {
					intvalues.push(input.value);
				});

				let acadhiddenInputs = document.querySelectorAll("input[type=hidden].acad");
				acadhiddenInputs.forEach(input => {
					acadvalues.push(input.value);
				});

				let carhiddenInputs = document.querySelectorAll("input[type=hidden].car");
				carhiddenInputs.forEach(input => {
					careervalues.push(input.value);
				});

				var barColors = [
					"rgba(112,214,255,1.0)",
					"rgba(255,112,166,1.0)",
					"rgba(255,151,112,1.0)",
					"rgba(255,214,112,1.0)",
					"rgba(233,255,112,1.0)",
					"rgba(104,122,0,1.0)",
				];

				const skipieChart = new Chart("skipieChart", {
					type: "doughnut",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: barColors,
							data: skivalues
						}]
					},
					options: {
						title: {
							display: true,
							text: "Skills"
						},
						legend: {
							display: false
						}
					}
				});

				const intpieChart = new Chart("intpieChart", {
					type: "doughnut",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: barColors,
							data: intvalues
						}]
					},
					options: {
						title: {
							display: true,
							text: "Interests"
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
						},
						legend: {
							display: false
						}
					}
				});
			}
		});
	</script>

</html>