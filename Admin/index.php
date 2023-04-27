<?php
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Strand Selection</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
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
						<li class="nav-item">
							<a class="nav-link" href="#LoginSection">LOGIN</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<header class="d-flex flex-column justify-content-center align-items-center py-5" id="Header">
			<h1 class="fw-bold">Administrative System for</h1>
			<img src="./images/SystemBrandBlackVer2.png" alt="Logo" width="850" height="200">
			<h3 class="fst-italic">"Revolutionize your decision-making process with our DSS for strand selection."</h3>
			<div class="py-5">
				<a href="#LoginSection"><button type="button" class="btn btn-outline-dark btn-lg fw-bold fs-3">LOGIN</button></a>
			</div>
		</header>
	
		<section class="py-5" id="LoginSection">
			<div class="container-fluid">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-md-9 col-lg-6 col-xl-5">
						<img src="./images/edupic.png" class="img-fluid" alt="Sample image">
					</div>
					<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
						<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    
  

    $conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

     $sql = "SELECT * FROM admin WHERE username = '$username'";
    $q = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($q);

    if ($num == 1) {

        $data = mysqli_fetch_assoc($q);

        $upass = $data['password'];

        if (md5($password) == "$upass") {
            $_SESSION['admin'] = $username;
            header("Location: home.php");
        } else {
            echo"<script>swal({
                title: 'Login Failed!',
                text: 'Invalid Username or Password.',
                icon: 'error',
                button: 'OK',
              });</script>";
        echo "<script>document location ='index.php';</script>";
    
        }
    } else {
        echo"<script>swal({
            title: 'Login Failed!',
            text: 'Invalid Username or Password.',
            icon: 'error',
            button: 'OK',
          });</script>";
    echo "<script>document location ='index.php';</script>";
    }
}


//INSERT INTO `admin`(`username`, `password`)VALUES ('admin', MD5('admin'));
?>

						<form action="" method="post">
							<div class="d-flex flex-row align-items-center justify-content-center">
								<img src="./images/SystemBrandBlackVer2.png" alt="Logo" width="250" height="50" class="d-inline-block align-text-top">
							</div>

							<div class="divider d-flex align-items-center my-4">
								<p class="text-center fw-bold mx-3 mb-0">LOGIN FORM</p>
							</div>

							<!-- Email input -->
							<div class="form-outline mb-4">
								<label class="form-label" for="username">Username</label>
								<input type="text" id="username" name ="username" class="form-control form-control-lg" placeholder="Enter a valid username" required />
							</div>

							<!-- Password input -->
							<div class="form-outline mb-3">
								<label class="form-label" for="password">Password</label>
								<input type="password" id="password" name ="password" class="form-control form-control-lg" placeholder="Enter password" required />
							</div>

							<div class="d-flex justify-content-between align-items-center">
								<!-- Checkbox -->
								<div class="form-check mb-0">
									<input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
									<label class="form-check-label" for="form2Example3"> Remember me </label>
								</div>
							</div>

							<div class="text-center text-lg-start mt-4 pt-2">
		
									<button type="submit" class="btn btn-primary btn-lg"
									style="padding-left: 2.5rem; padding-right: 2.5rem;">LOGIN</button>
					
							</div>

						</form>
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