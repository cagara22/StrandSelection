<?php
//Starts the sessin and checks if the student is logged in or not
session_start();

if (!isset($_SESSION["student"])) {
    header("Location: index.php");
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
	<?php
		if($_SESSION['changePass']){
			echo "<script>Swal.fire({
				title: 'Change Password!',
				text: 'Please change your password immediately!',
				icon: 'warning',
				showConfirmButton: false,
				timer: 5000
				});</script>";
		}
	?>
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
					<li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="home.php">HOME</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="strand.php">STRAND</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php">PROFILE</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="result.php">RESULT</a>
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

	<div class="hero d-flex flex-column justify-content-center align-items-center" id="homeHeader">
		<div class="bgblur d-flex flex-column justify-content-center align-items-center text-center">
			<h1 class="title fst-italic fw-bold">"Dream, Discover, Decide: Senior High Strands - Your Choice, Your Legacy."</h1>
			<div class="py-5">
				<a href="#first"><button type="button" class="btn btn-outline-warning btn-lg fw-bold fs-3">GET STARTED</button></a>
			</div>
		</div>
	</div>

	<section class="section-100 d-flex flex-column justify-content-center align-items-center text-center px-3" id="first" style="padding-top: 4.3rem;">
		<h1 class="sub-title fw-bold">WHAT TO EXPECT?</h1>
		<div class="row my-3" style="width:100%">
			<div class="col-12 col-lg-4">
				<div class="card border-light text-center align-items-center mx-auto p-3" style="width: 18rem;">
					<img src="./images/personalization.png" class="cust-img-75" alt="...">
					<div class="card-body">
						<h5 class="card-title fw-bold">Personalized Strand Recommendations</h5>
						<p class="card-text lh-1">Our system utilizes a sophisticated algorithm to analyze academic performance, skills, interests, career aspirations and socio-economic background, providing personalized recommendations for senior high school strands that align with each student's unique profile.</p>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card border-light text-center align-items-center mx-auto p-3" style="width: 18rem;">
					<img src="./images/comprehensive.png" class="cust-img-75" alt="...">
					<div class="card-body">
						<h5 class="card-title fw-bold">Comprehensive Information Hub</h5>
						<p class="card-text lh-1">GUIDE (Guidance Using Intelligent Decision Engine) provides a rich database of academic strands, career opportunities, admission requirements, and real-world insights, empowering students with the information they need to confidently choose a path that suits their goals.</p>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card border-light text-center align-items-center mx-auto p-3" style="width: 18rem;">
					<img src="./images/efficacy.png" class="cust-img-75" alt="...">
					<div class="card-body">
						<h5 class="card-title fw-bold">Efficient Decision-Making</h5>
						<p class="card-text lh-1">By streamlining the decision-making process, GUIDE reduces confusion and anxiety, guiding students towards informed choices that enhance their engagement, motivation, and success throughout their academic journey.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-50 bglightgrey d-flex flex-column justify-content-center align-items-center px-4">
		<div class="card border-light mb-3 bglightgrey py-3" style="max-width: 100%;">
			<div class="row g-0">
				<div class="col-md-3 text-center">
					<img src="./images/research.png" class="cust-img-50 rounded-start" alt="...">
				</div>
				<div class="col-md-9">
					<div class="card-body">
						<h3 class="card-title fw-bold sub-title">1. Explore the Information Hub</h3>
						<p class="card-text">Begin your journey by delving into our Information Hub, where you'll find comprehensive overviews of each available strand: STEM, HUMSS, ABM, GAS, TVL-ICT, and TVL-HE. Discover the potential degrees, career opportunities, and curriculum details for each strand, providing you with a clear understanding of what lies ahead.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-50 d-flex flex-column justify-content-center align-items-center px-4">
		<div class="card border-light mb-3 py-3" style="max-width: 100%;">
			<div class="row g-0">
				<div class="col-md-3 order-1 order-md-2 text-center">
					<img src="./images/information.png" class="cust-img-50 rounded-start" alt="...">
				</div>
				<div class="col-md-9 order-2 order-md-1">
					<div class="card-body">
						<h3 class="card-title fw-bold sub-title">2. Set up your Profile</h3>
						<p class="card-text">Your unique path starts here. Create your profile by inputting essential information that fuels our decision-making process. Tell us about your skills, interests, socioeconomic background, academic performance, and career aspirations. This step is crucial, as it forms the foundation for tailoring our recommendations to your individual strengths and goals.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-50 bglightgrey d-flex flex-column justify-content-center align-items-center px-4">
		<div class="card border-light mb-3 bglightgrey py-3" style="max-width: 100%;">
			<div class="row g-0">
				<div class="col-md-3 text-center">
					<img src="./images/checklist.png" class="cust-img-50 rounded-start" alt="...">
				</div>
				<div class="col-md-9">
					<div class="card-body">
						<h3 class="card-title fw-bold sub-title">3. Discover Your Results</h3>
						<p class="card-text">The moment of clarity has arrived. Once you've set up your profile, our system processes the data to provide you with detailed results. These results will unveil the strand that aligns best with your skills, interests, and aspirations. It's your personalized roadmap to success, ensuring that your senior high school journey is a fulfilling and purpose-driven one.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-50 d-flex flex-column justify-content-center align-items-center px-4" id="homeEnd">
		<div class="row w-100">
			<div class="col-12 col-md-9">
				<h1 class="sub-title fw-bold">What are you waiting for? Start making informed decision with your Future!</h1>
			</div>
			<div class="col-12 col-md-3 text-center">
				<div class="py-5">
					<a href="./strand.php"><button type="button" class="btn btn-outline-warning btn-lg fw-bold fs-3">GET STARTED</button></a>
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