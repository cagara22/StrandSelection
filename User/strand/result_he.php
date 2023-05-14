<?php
session_start();

if(!isset($_SESSION["student"]))
{

    ?>
<?php
session_start();
$date=date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date."+$_SESSION[exam_time] minutes"));
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
						<li class="nav-item">
							<a class="nav-link" ><?php  echo $_SESSION["student"]; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../logout.php">LOGOUT</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

        <section class="d-flex flex-column align-items-center py-5">
		<div class="row" style="margin: 0px; padding:0px; margin-bottom: 50px; height: 550px;">

<div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: white;">
<?php 
$correct=0;
$wrong=0;
if(isset($_SESSION["answer"]))
{
    for($i=1; $i<=sizeof($_SESSION["answer"]); $i++)
    {
$answer="";
$res=mysqli_query($link, "select * from questions where category = '$_SESSION[exam_category]' && question_no=$i");
while($row=mysqli_fetch_array($res))
{
    $answer=$row["answer"];
}

if(isset($_SESSION["answer"][$i]))
{
    if($answer==$_SESSION["answer"][$i])
    {
        $correct=$correct+1;
    }
    else{
        $wrong=$wrong+1;
    }
}
else{
    $wrong=$wrong+1;
}

    }
}

$count=0;
$res=mysqli_query($link, "SELECT * FROM questions WHERE category = '$_SESSION[exam_category]'");
$count=mysqli_num_rows($res);
$wrong=$count-$correct;
$percent = ($correct/$count)*100;
echo "<br><br>";
echo "<center>";
echo "Total Questions=".$count;
echo "<br>";
echo "Correct answer=".$correct;
echo "<br>";
echo "Wrong answer=".$wrong;
echo "<br>";
echo "Percentage Correct=".number_format($percent, 2)." %";
echo "</center>"; 
?>
 <br>
 <button onclick="window.location.href = '../list.php';">Take assessment for another strand</button>
</div>

</div>

<?php
if (isset($_SESSION["exam_start"])) {
	$user_id = $_SESSION['student']; 
    mysqli_query($link, "UPDATE `exam_score` SET `HE`='$percent' WHERE `lrn`='$user_id'")
    or die(mysqli_error($link));
}

if (isset($_SESSION["exam_start"])) {
    unset($_SESSION["exam_start"]);
    ?>
    <script type="text/javascript">
        window.location.href = window.location.href;
    </script>
    <?php
}
?>
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
