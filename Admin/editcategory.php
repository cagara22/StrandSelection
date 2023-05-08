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
							<a class="nav-link" href="home.php">HOME</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profiles.php">PROFILES</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">ABOUT</a>
						</li>

						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page"  href="exam_category.php">EXAM CATEGORIES</a>
						</li>

                        <li class="nav-item">
							<a class="nav-link" href="add_edit_exam_questions.php">EXAM QUESTIONS</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" ><?php 
														
														echo $_SESSION['admin']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LOGOUT</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" href="admininfo.php">ADMIN INFO</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>


		<section class="d-flex flex-column justify-content-center align-items-center py-5">
			<div class="row" style="width:100%">

<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Exam</h1>
                    </div>
                </div>
            </div>
           
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                        <?php
$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

							if (isset($_POST['submit1'])) {

                                
                                $id = $_GET['id'];
								$category = $_POST['category'];

                                $exam_time = $_POST['exam_time_in_minutes'];

                              

                                    $sql = "UPDATE `exam_category` SET 
                `category`='$category',
                `exam_time_in_minutes`='$exam_time'
                
         
                WHERE `id`= '$id'"; 
                                $result = $conn->query($sql);
                                   
    
							if ($result == TRUE) {

                                echo "<script type = 'text/javascript'>
                                alert('exam updated successfully');
                                window.location = 'exam_category.php';
                                </script>";

							}else{

							echo "Error:". $sql . "<br>". $conn->error;

							} 

						 
							}
							

                            if (isset($_GET['id'])) {

                                $user_id = $_GET['id']; 
                            
                                $sql = "SELECT * FROM `exam_category` WHERE `id`='$user_id'";
                            
                                $result = $conn->query($sql); 
                            
                                if ($result->num_rows > 0) {        
                            
                                    while ($row = $result->fetch_assoc()) {
                            
                                        $examname1 = $row['category'];

                                        $examtime1 = $row['exam_time_in_minutes'];
        
        
                            
                                    }
						}
                            }
                            ?>  

                        <form name = "form1" action="" method="post">
                            
                            <div class="card-body">
                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Edit Exam</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label for="company" class=" form-control-label">
                                    New Exam Category</label><input type="text" name ="category" value = "<?php echo $examname1?>" placeholder="" class="form-control"></div>
                                    <div class="form-group"><label for="company" class=" form-control-label">
                                    Exam Time in Minutes</label><input type="text" name ="exam_time_in_minutes"  value = "<?php echo $examtime1?>" placeholder="" class="form-control"></div>

                                    <div class="form-group"> 

                                        <input type="submit" name = "submit1" value = "Submit"  placeholder="" class="btn btn-success"></div>
                                   
                                
                            </div>
                        </div>
                        </div>
                  

                                        </div>
                                        </form>
                                    </div><!-- .content -->

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
