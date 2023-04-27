
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
		<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 text-right">
                                        <ul class="breadcome-menu">
                                        <li><div id="countdowntimer" style="display: block;"></div>
                                        </li>

                                        </ul>
                                    </div>

<div class="row" style="margin: 0px; padding:0px; margin-bottom: 50px;">

<div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: white;">
<!--start edit-->
<br>
<div class ="row">
<br>

<div class ="col-lg-2 col-lg-push-10">
    <div id="current_que" style="float:left">0</div>
    <div style="float:left">/<div>
    <div id="total_que" style="float:left">0</div>
</div>

<div class ="row" style="margin-top: 30px"> 
<div class ="row">
    <div class ="col-lg-10 col-lg-push-1" style="min-height: 300px; background-color: white"
    id="load_questions">

</div>
</div>
</div>
<div class ="row" style="margin-top: 10px"> 
<div class ="col-lg-6 col-lg-push-3" style="min-height: 50px">

<div class="col-lg-12 text-center"> 

<input type="button" class = "btn btn-warning" value="Previous" onclick ="load_previous() ;">
&nbsp;

<input type="button" class = "btn btn-success" value="Next" onclick ="load_next() ;">
&nbsp;

</div>


</div>
</div>
</div>
<!--end edit-->
</div>

</div>

<script type ="text/javascript">
    function load_total_que()
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("total_que").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","forjax/load_total_que.php",true);
        xmlhttp.send(null);  
    }

    var questionno="1";
    load_questions(questionno);

    function load_questions(questionno)
    {
        document.getElementById("current_que").innerHTML=questionno;
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if(xmlhttp.responseText=="over"){

                    window.location="result_gas.php";

                }
                else{
                    document.getElementById("load_questions").innerHTML=xmlhttp.responseText;
                    load_total_que();

                }
            }
        };
        xmlhttp.open("GET","forjax/load_questions.php?questionno="+ questionno,true);
        xmlhttp.send(null);  

    }

    function radioclick(radiovalue, questionno)
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    
            }
        };
        xmlhttp.open("GET","forjax/save_answer_in_session.php?questionno="+ questionno + "&value1="+radiovalue,true);
        xmlhttp.send(null);  
    }

    function load_previous()
    {
if(questionno=="1")
{
    load_questions(questionno);
}
else{
    questionno=eval(questionno) -1;
    load_questions(questionno);
}
    }

    function load_next()
    {
        questionno=eval(questionno) +1;
    load_questions(questionno);
        
    }

    </script>

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