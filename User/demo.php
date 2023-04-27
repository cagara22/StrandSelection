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
						<li class="nav-item">
							<a class="nav-link" href="list.php">LIST</a>
						</li>
						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="about.php">ABOUT</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profile.php">PROFILE</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" ><?php 
														session_start();
														echo $_SESSION['student']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LOGOUT</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<?php  
         include "connection.php";

        
?> 
        <section class="d-flex flex-column align-items-center py-5">
        <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">

                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 text-right">
                                        <ul class="breadcome-menu">
                                            <li>Count Down timer
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<script type = "text/javascript">
			setInterval(function(){timer();},1000);
	function set_exam_type_session(exam_category)
	{
		var xmlhttp=new XMLHTTPRequest();
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){

				alert(xmlhttp.responseText);
				window.location="dashboard.php";
			}
		};
		xmmlhttp.open("GET", "foarajax/set_exam_type_session.php?exam_category="+ exam_category, true);
		xmlhttp.send(null);
	

	}
	</script>


        <div class="row" style="margin: 0px; padding:0px; margin-bottom: 50px;">

            <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: white;"></div>

			<?php
			$res= mysqli_query($link, "select * from exam_category");

			while($row=mysqli_fetch_array($res)){
				?>

<input type ="button" class = "btn btn-success form-control" value = "<?php echo $row["category"]; ?>" 
style ="magin-top: 10px; background-color: blue; color: white" onclick="set_exam_type_session(this.value);">
<?php

			}

			?>

		

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

