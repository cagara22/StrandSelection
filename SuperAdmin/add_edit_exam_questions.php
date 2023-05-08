<?php
session_start();

if(!isset($_SESSION["admin"]))
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
					<li class="nav-item">
							<a class="nav-link" href="home.php">HOME</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profiles.php">PROFILES</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admins.php">ADMINS</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">ABOUT</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="exam_category.php">EXAM CATEGORIES</a>
						</li>

						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="add_edit_exam_questions.php">EXAM QUESTIONS</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" ><?php echo $_SESSION['admin']; ?></a>
							
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admininfo.php">ADMIN INFO</a>
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

<section class="d-flex flex-column justify-content-center align-items-center py-5">
<div class="row" style="width:100%">
 <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Select Exam Categories for Add and Edit Questions</h1>
                    </div>
                </div>
            </div>
           
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            
                            <div class="card-body">
                               
                            <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Exam Name</th>
                                            <th scope="col">Exam Time</th>
                                            <th scope="col">Select</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $res=mysqli_query($link, "select * from exam_category");
                                        while($row=mysqli_fetch_array($res))
                                        {
                                            
                                            ?>
                                         <tr>
                                           
                                         <td><?php echo $row["id"];?></td>
                                            <td><?php echo $row["category"];?></td>
                                            <td><?php echo $row["exam_time_in_minutes"];?></td>
                                            <td><a class="btn btn-info" href="add_edit_questions.php?id=<?php echo $row['id']; ?>">
                                            Select</a></td>
                                        </tr>
                                            <?php

                                           
                                        }
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>

                                
                            </div>
                        </div>

                    </div>
                  

                                        </div><!-- .animated -->
                                    </div><!-- .content -->

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