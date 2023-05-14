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
							<a class="nav-link active" aria-current="page" href="../list.php">LIST</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../about.php">ABOUT</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../profile.php">PROFILE</a>
						</li>>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php  echo $_SESSION["student"]; ?>
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
							</ul>
						</li>
				</div>
			</div>
		</nav>

        <header class="d-flex justify-content-center align-items-center p-5" id="Home">
			<div class="row">
				<div class="col-12 order-2 order-lg-1 col-lg-8 text-wrap text-center align-self-center">
					<h1 class="text-body-emphasis fw-bold">STEM</h1>
                    <p style="font-size: 30px;">This assessment aims to evaluate your fundamental understanding of each strand. 
                    To ensure accuracy, please answer the questions honestly and select the correct answer for each item. 
                    Please note that this assessment can only be taken once. Good luck!</p>

<?php
            $res=mysqli_query($link,"select * from exam_category");
            while($row=mysqli_fetch_array($res))
            {
                ?>
               
            <?php
            }
            ?>
					<button type="button" class="btn btn-outline-success btn-lg fw-bold fs-3 m-2"
					onclick="set_exam_type_session('STEM');">Take Assessment</button>
					

					

				</div>
				<div class="col-12 order-1 order-lg-2 col-lg-4 d-flex flex-wrap justify-content-center align-items-center p-5">
					<img src="../images/stem.png" class="img-fluid" alt="...">
				</div>
			</div>
		</header>
		<section class="d-flex flex-column align-items-center py-5">

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