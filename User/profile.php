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
							<a class="nav-link" href="list.php">LIST</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">ABOUT</a>
						</li>
						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="profile.php">PROFILE</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" ><?php  echo $_SESSION["student"];?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LOGOUT</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<section class="d-flex flex-column align-items-center py-5">
			<div class="flex-row">


				<h1 class="fw-bold">Student Profile</h1>
			</div>

			
			<div class="row" style="width:70%">

			<?php 
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

    // Check if form was submitted
    if (isset($_POST['submit'])) {
        
        // Retrieve form data
        $id = $_SESSION['student'];

		$password = md5($_POST['password']);
		$cpassword = md5($_POST['cpassword']);

		$Fname = $_POST['Fname'];
		$Mname = $_POST['Mname'];
		$Lname = $_POST['Lname'];
		$address = $_POST['address'];
		$age = $_POST['age'];
		$civilstatus = $_POST['civilstatus'];
		$sex = $_POST['sex'];
		$email=$_POST['email'];

$science = $_POST['ScienceSub'];
$math = $_POST['MathSub'];
$arts = $_POST['ArtsandDesign'];
$humanities = $_POST['Humanities'];
$entrepreneurship = $_POST['Entrepreneurship'];
$information = $_POST['Information'];
$agriculture = $_POST['Agriculture'];
$homeEconomics = $_POST['HomeEconomics'];
$industrialArts = $_POST['IndustrialArts'];

$math12 = $_POST['Math'];
$science2 = $_POST['Science'];
$English = $_POST['English'];
$Filipino = $_POST['Filipino'];
$ICTRelatedSubject = $_POST['ICTRelatedSubject'];
$HERelatedSubject = $_POST['HERelatedSubject'];



$Mathematicalskills = isset($_POST['Mathematicalskills']) ? 1 : 0;
$Scientificskills = isset ($_POST['Scientificskills']) ? 1: 0;
$Technicalskills = isset ($_POST['Technicalskills']) ? 1 : 0;
$Socialsciences = isset ($_POST['Socialsciences']) ? 1 : 0;
$Languageskills = isset ($_POST['Languageskills']) ? 1 : 0;
$Communicationskills = isset ($_POST['Communicationskills']) ? 1 : 0;
$Accountingandfinance = isset ($_POST['Accountingandfinance']) ? 1 : 0;
$Businessmanagement = isset ($_POST['Businessmanagement']) ? 1 : 0;
$Entrepreneurialskills = isset ($_POST['Entrepreneurialskills']) ? 1 : 0;
$Timemanagement = isset ($_POST['Timemanagement']) ? 1 : 0;
$LeadershipSkills = isset ($_POST['LeadershipSkills']) ? 1 : 0;
$Artisticskills = isset ($_POST['Artisticskills']) ? 1 : 0;
$Musicskills = isset ($_POST['Musicskills']) ? 1 : 0;
$Culinaryarts = isset($_POST['Culinaryarts']) ? 1 : 0;
$Homemanagement = isset ($_POST['Homemanagement']) ? 1 : 0;
$Fashionandbeauty = isset ($_POST['Fashionandbeauty']) ? 1 : 0;
$ICTskills = isset ($_POST['ICTskills']) ? 1 : 0;
$Multimediaskills = isset ($_POST['Multimediaskills']) ? 1 : 0;
$Digitalcommunication = isset ($_POST['Digitalcommunication']) ? 1 : 0;


$CareerGoals = $_POST['CareerGoals'];



        // Prepare update query
		$sql = "UPDATE student s
        JOIN career c ON s.lrn = c.lrn
        JOIN academic_performance ap ON c.lrn = ap.lrn
        JOIN interests i ON ap.lrn = i.lrn
		JOIN skills sk ON i.lrn = sk.lrn
        SET s.Fname = '$Fname', 
            s.Mname = '$Mname',
            s.Lname = '$Lname',
            s.sex = '$sex',
            s.age = '$age',
            s.civilstatus = '$civilstatus',
            s.email = '$email',
			s.address = '$address',
            c.CareerGoals = '$CareerGoals',
            ap.Math = '$math12',
            ap.Science = '$science2',
            ap.English = '$English',
            ap.Filipino = '$Filipino',
            ap.ICTRelatedSubject = '$ICTRelatedSubject',
            ap.HERelatedSubject = '$HERelatedSubject',
			sk.Mathematicalskills = '$Mathematicalskills',
			sk.Scientificskills = '$Scientificskills',
			sk.Technicalskills = '$Technicalskills',
			sk.Socialsciences= '$Socialsciences',
			sk.Languageskills = '$Languageskills',
			sk.Communicationskills = '$Communicationskills',
			sk.Accountingandfinance = '$Accountingandfinance',
			sk.Entrepreneurialskills = '$Entrepreneurialskills',
			sk.Businessmanagement = '$Businessmanagement',
			sk.Timemanagement = '$Timemanagement',
			sk.LeadershipSkills = '$LeadershipSkills',
			sk.Artisticskills = '$Artisticskills',
			sk.Musicskills = '$Musicskills',
			sk.Culinaryarts = '$Culinaryarts',
			sk.Homemanagement = '$Homemanagement',
			sk.Fashionandbeauty = '$Fashionandbeauty',
			sk.ICTskills = '$ICTskills',
			sk.Multimediaskills = '$Multimediaskills',
			sk.Digitalcommunication = '$Digitalcommunication',
			i.ScienceSub = '$science',
			i.MathSub = '$math',
			i.ArtsandDesign = '$arts',
			i.Humanities = '$humanities',
			i.Entrepreneurship = '$entrepreneurship',
			i.Information = '$information',
			i.Agriculture ='$agriculture',
			i.HomeEconomics = '$homeEconomics',
			i.IndustrialArts = '$industrialArts'";
			
if (!empty($_POST['password'])) {
    $password = md5($_POST['password']);
    $sql .= ", s.password = '$cpassword'";
}  

if (!empty($_POST['password'])) {
    $cpassword = md5($_POST['cpassword']);
    $sql .= ", s.cpassword = '$cpassword'";
}  
       
$sql .= " WHERE s.lrn = '$id'";

        // Execute update query
        $result = $conn->query($sql);

        // Check if query was successful
        if ($result) {
            // Display success message and redirect to profiles page
            echo "<script>alert('Record updated successfully!')</script>";
            echo "<script>window.location.href = 'profile.php';</script>";

		} else {
			// Check if password and confirm password match
			if ($password !== $cpassword) {
			  echo "<script>alert('Password and Confirm Password do not match!');</script>";
			  echo "<script type='text/javascript'>history.go(-1);</script>";
        } else {
            // Display error message and MySQL error details
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } 
    }
}

	if (isset($_SESSION['student'])) {

		$user_id = $_SESSION['student']; 
	
		$sql = "SELECT * FROM student
		JOIN career ON student.lrn = career.lrn
		JOIN academic_performance ON career.lrn = academic_performance.lrn
		JOIN skills ON academic_performance.lrn = skills.lrn
		JOIN interests ON skills.lrn = interests.lrn
		JOIN socioeconomic_background  ON interests.lrn = socioeconomic_background.lrn WHERE student.lrn = '$user_id';";
	
		$result = $conn->query($sql); 
	
		if ($result->num_rows > 0) {        
	
			while ($row = $result->fetch_assoc()) {
	

				$lrn1 = $row['lrn'];
				$Fname1 = $row['Fname'];
				$Mname1 = $row['Mname'];
				$Lname1 = $row['Lname'];
				$address1 = $row['address'];
		
				$age1 = $row['age'];
		
				$civilstatus1 = $row['civilstatus'];
		
				$sex1 = $row['sex'];
				$email1=$row['email'];
		
		$science1 = $row['ScienceSub'];
		$math1 = $row['MathSub'];
		$arts1 = $row['ArtsandDesign'];
		$humanities1 = $row['Humanities'];
		$entrepreneurship1 = $row['Entrepreneurship'];
		$information1 = $row['Information'];
		$agriculture1 = $row['Agriculture'];
		$homeEconomics1 = $row['HomeEconomics'];
		$industrialArts1 = $row['IndustrialArts'];
		
		$math11 = $row['Math'];
		$science21 =$row['Science'];
		$English1 = $row['English'];
		$Filipino1 = $row['Filipino'];
		$ICTRelatedSubject1 = $row['ICTRelatedSubject'];
		$HERelatedSubject1 = $row['HERelatedSubject'];
		
		
		$CareerGoals1 = $row['CareerGoals'];
				
		$Mathematicalskills1 = $row['Mathematicalskills'];
		$Scientificskills1 = $row['Scientificskills'];
		$Technicalskills1 = $row['Technicalskills'];
		$Socialsciences1 = $row['Socialsciences'];
		$Languageskills1 = $row['Languageskills'];
		$Communicationskills1 = $row['Communicationskills'];
		$Accountingandfinance1 = $row['Accountingandfinance'];
		$Businessmanagement1 = $row['Businessmanagement'];
		$Entrepreneurialskills1 = $row['Entrepreneurialskills'];
		$Timemanagement1 = $row['Timemanagement'];
		$LeadershipSkills1 = $row['LeadershipSkills'];
		$Artisticskills1 = $row['Artisticskills'];
		$Musicskills1 = $row['Musicskills'];
		$Culinaryarts1 = $row['Culinaryarts'];
		$Homemanagement1 = $row['Homemanagement'];
		$Fashionandbeauty1 = $row['Fashionandbeauty'];
		$ICTskills1 = $row['ICTskills'];
		$Multimediaskills1 = $row['Multimediaskills'];
		$Digitalcommunication1 = $row['Digitalcommunication'];
}
}
	}
		
?>
				<form class="row"  action="" method="post">
					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Account Details</p>
					</div>

					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> First Name</label>
						<input type="text" class="form-control" id="Name"
						name="Fname" value="<?php echo $Fname1; ?>" placeholder="" required>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> Middle Name</label>
						<input type="text" class="form-control" id="Name"
						name="Mname" value="<?php echo $Mname1; ?>" placeholder="" required>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> Last Name</label>
						<input type="text" class="form-control" id="Name"
						name="Lname" value="<?php echo $Lname1; ?>" placeholder="" required>
					</div>
					<div class="col-12 mb-3">
						<label for="Address" class="form-label">Address</label>
						<input type="text" class="form-control" id="Address"
						name="address" value="<?php echo $address1; ?>" placeholder="" required>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label class="form-label" for="Gender">Gender</label>
						<select class="form-select" id="Gender"
						name="sex" value="<?php echo $sex1; ?>">
							<option value="M" <?php if ($sex1 == "Male") {echo " selected";}?>>Male</option>
							<option value="F" <?php if ($sex1 == "Female") {echo " selected";}?>>Female</option>
				
						</select>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label class="form-label" for="CivilStatus">Civil Status</label>
						<select class="form-select" id="CivilStatus"
						name="civilstatus">
							<option selected value="Single" <?php if ($civilstatus1 == "Single") {echo " selected";}?>>Single</option>
							<option value="In a Relationship" <?php if ($civilstatus1 == "In a Relationship") {echo " selected";}?>>In a Relationship</option>
							<option value="Married" <?php if ($civilstatus1 == "Married") {echo " selected";}?>>Married</option>
							<option value="Divorced" <?php if ($civilstatus1 == "Divorced") {echo " selected";}?>>Divorced</option>
							<option value="Separated" <?php if ($civilstatus1 == "Separated") {echo " selected";}?>>Separated</option>
							<option value="Widowed" <?php if ($civilstatus1 == "Widowed") {echo " selected";}?>>Widowed</option>
						</select>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Age" class="form-label">Age</label>
						<input type="text" class="form-control" id="Age"
						name="age" value="<?php echo $age1; ?>" placeholder="" required>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="Email" class="form-label">LRN</label>
						<input type="email" class="form-control" id="Email"
						name="lrn" value="<?php echo $lrn1; ?>"  placeholder="" disabled>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="Email" class="form-label">Email</label>
						<input type="email" class="form-control" id="Email"
						name="email" value="<?php echo $email1; ?>"  placeholder="" required>
					</div>

					<div class="col-12 col-md-6 mb-3">
						<label for="Password" class="form-label">Password</label>
						<input type="password" class="form-control" id="Password"
						name="password" placeholder="">
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="ConfirmPassword" class="form-label">Cofirm Password</label>
						<input type="password" class="form-control" id="CofirmPassword" name = "cpassword" placeholder="">
					</div>

					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Academic Performance</p>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Science" class="form-label">Science</label>
						<input type="text" class="form-control" id="Science" 
						name="Science" value="<?php echo $science21; ?> "placeholder=""required>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Math" class="form-label">Math</label>
						<input type="text" class="form-control" id="Math"
						name="Math" value="<?php echo $math11; ?>" placeholder="" required>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="English" class="form-label">English</label>
						<input type="text" class="form-control" id="English"
						name="English" value="<?php echo $English1; ?>" placeholder="" required>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Filipino" class="form-label">Filipino</label>
						<input type="text" class="form-control" id="Filipino"
						name="Filipino" value="<?php echo $Filipino1; ?>"  placeholder="" required>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="ICTRelatedSubject" class="form-label">ICT Related Subject</label>
						<input type="text" class="form-control" id="ICTRelatedSubject" 
						name="ICTRelatedSubject" value="<?php echo $ICTRelatedSubject1; ?>" placeholder="">
						<small id="" class="form-text text-muted">This is optional... Leave blank if not applicable</small>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="HERelatedSubject" class="form-label">HE Related Subject</label>
						<input type="text" class="form-control" id="HERelatedSubject" 
						name="HERelatedSubject" value="<?php echo $HERelatedSubject1; ?>" placeholder="">
						<small id="" class="form-text text-muted">This is optional... Leave blank if not applicable</small>
					</div>

					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Socioeconomic Background</p>
					</div>
					<div class="col-12 col-md-4">
						<div class="divider d-flex align-items-center my-4">
							<p class="text-center mx-3 mb-0">Mother's Details</p>
						</div>
						<div class="mb-3">
							<label for="EducationalLevel" class="form-label">Highest Attained Educational Level</label>
							<input type="text" class="form-control" id="EducationalLevel" 
							name="EducationalLevel1" placeholder="">
						</div>
						<div class="mb-3">
							<label for="Occupation" class="form-label">Occupation</label>
							<input type="text" class="form-control" id="Occupation"
							name="Occupation1" placeholder="">
						</div>
						<div class="mb-3">
							<label class="form-label" for="MonthlyIncome">Monthly Income</label>
							<input type="text" class="form-control" id="MonthlyIncome"
							name="MonthlyIncome1" placeholder="">
							
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="divider d-flex align-items-center my-4">
							<p class="text-center mx-3 mb-0">Father's Details</p>
						</div>
						<div class="mb-3">
							<label for="EducationalLevel" class="form-label">Highest Attained Educational Level</label>
							<input type="text" class="form-control" id="EducationalLevel" 
							name="EducationalLevel2" placeholder="">
						</div>
						<div class="mb-3">
							<label for="Occupation" class="form-label">Occupation</label>
							<input type="text" class="form-control" id="Occupation"
							name="Occupation2" placeholder="">
						</div>
						
						<div class="mb-3">
							<label class="form-label" for="MonthlyIncome">Monthly Income</label>
							<input type="text" class="form-control" id="MonthlyIncome"
							name="MonthlyIncome2"  placeholder="">
							
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="divider d-flex align-items-center my-4">
							<p class="text-center mx-3 mb-0">Guardian's Details</p>
						</div>
						<div class="mb-3">
							<label for="EducationalLevel" class="form-label">Highest Attained Educational Level</label>
							<input type="text" class="form-control" id="EducationalLevel" 
							name="EducationalLevel3"  placeholder="">

						</div>
						<div class="mb-3">
							<label for="Occupation" class="form-label">Occupation</label>
							<input type="text" class="form-control" id="Occupation" 
							name="Occupation3" placeholder="">
						</div>
						<div class="mb-3">
							<label class="form-label" for="MonthlyIncome">Monthly Income</label>
							<input type="text" class="form-control" id="MonthlyIncome"
							name="MonthlyIncome3" placeholder="">
							</div>
						</div>
					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Skills, Interest, and Career Goals</p>
					</div>
					<div class="col-12 col-md-6">
						<p id="" class="d-block fw-bold form-label">Select the skills that are applicable to you...</p>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Mathematicalskills"
							name="Mathematicalskills" value= "1" <?php if (strpos($Mathematicalskills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Mathematicalskills">Mathematical skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Scientificskills" 
							name="Scientificskills"  value= "1" <?php if (strpos($Scientificskills1, "1") !== false) {echo " checked";}?> >
							<label class="form-check-label" for="Scientificskills">Scientific skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Technicalskills"
							name="Technicalskills"  value= "1" <?php if (strpos($Technicalskills1, "1") !== false) {echo " checked";}?> >
							<label class="form-check-label" for="Technicalskills">Technical skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Languageskills"
							name="Languageskills"  value= "1" <?php if (strpos($Languageskills1, "1") !== false) {echo " checked";}?> >
							<label class="form-check-label" for="Languageskills">Language skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Socialsciences" 
							name="Socialsciences"  value= "1" <?php if (strpos($Socialsciences1, "1") !== false) {echo " checked";}?> >
							<label class="form-check-label" for="Socialsciences">Social sciences</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Communicationskills"
							name="Communicationskills"  value= "1" <?php if (strpos($Communicationskills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Communicationskills">Communication skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Accountingandfinance"
							name="Accountingandfinance"  value="1" <?php if (strpos($Accountingandfinance1, "1") !== false) {echo " checked";}?> >
							<label class="form-check-label" for="Accountingandfinance">Accounting and finance skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Businessmanagement"
							name="Businessmanagement" value="1" <?php if (strpos($Businessmanagement1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Businessmanagement">Business management skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Entrepreneurialskills"
							name="Entrepreneurialskills" value="1" <?php if (strpos($Entrepreneurialskills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Entrepreneurialskills">Entrepreneurial skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Timemanagement"
							name="Timemanagement" value="1" <?php if (strpos($Timemanagement1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Timemanagement">Time management</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="LeadershipSkills"
							name="LeadershipSkills" value="1" <?php if (strpos($LeadershipSkills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="LeadershipSkills">Leadership Skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Artisticskills"
							name="Artisticskills" value="1" <?php if (strpos($Artisticskills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Artisticskills">Artistic skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Musicskills"
							name="Musicskills"  value= "1" <?php if (strpos($Musicskills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Musicskills">Music skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Culinaryarts"
							name="Culinaryarts" value="1" <?php if (strpos($Culinaryarts1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Culinaryarts">Culinary arts skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Homemanagement"
							name="Homemanagement"  value= "1" <?php if (strpos($Homemanagement1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Homemanagement">Home management skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Fashionandbeauty"
							name="Fashionandbeauty" value="1" <?php if (strpos($Fashionandbeauty1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Fashionandbeauty">Fashion and beauty skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="ICTskills"
							name="ICTskills" value="1" <?php if (strpos($ICTskills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="ICTskills">ICT skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Multimediaskills"
							name="Multimediaskills" value="1" <?php if (strpos($Multimediaskills1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Multimediaskills">Multimedia skills</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="Digitalcommunication"
							name="Digitalcommunication" value="1" <?php if (strpos($Digitalcommunication1, "1") !== false) {echo " checked";}?>>
							<label class="form-check-label" for="Digitalcommunication">Digital communication skills</label>
						</div>
					</div>
					
					<div class="col-12 col-md-6">
						<p id="" class="d-block fw-bold form-label">On a scale of 0 to 10, with 0 being not interested at all and 10 being extremely interested, please rate your level of interest in the following areas:</p>
						<div>
							<label for="ScienceSub" class="form-label">Science</label>
							<input type="range" class="form-range" min="0" max="10" id="ScienceSub"
							name="ScienceSub" value= "<?php echo $science1?>">
						</div>
						<div>
							<label for="MathSub" class="form-label">Math</label>
							<input type="range" class="form-range" min="0" max="10" id="MathSub"
							name="MathSub" value= "<?php echo $math1?>">
						</div>
						<div>
							<label for="ArtsandDesign" class="form-label">Arts and Design</label>
							<input type="range" class="form-range" min="0" max="10" id="ArtsandDesign"
							name="ArtsandDesign" value= "<?php echo $arts1?>">
						</div>
						<div>
							<label for="Humanities" class="form-label">Humanities and Social Sciences</label>
							<input type="range" class="form-range" min="0" max="10" id="Humanities"
							name="Humanities" value= "<?php echo $humanities1?>">
						</div>
						<div>
							<label for="Entrepreneurship" class="form-label">Business and Entrepreneurship</label>
							<input type="range" class="form-range" min="0" max="10" id="Entrepreneurship"
							name="Entrepreneurship" value= "<?php echo $entrepreneurship1?>">
						</div>
						<div>
							<label for="Information" class="form-label">Information and Communication Technology</label>
							<input type="range" class="form-range" min="0" max="10" id="Information"
							name="Information" value= "<?php echo $information1?>">
						</div>
						<div>
							<label for="Agriculture" class="form-label">Agriculture and Fisheries</label>
							<input type="range" class="form-range" min="0" max="10" id="Agriculture"
							name="Agriculture" value= "<?php echo $agriculture1?>">
						</div>
						<div>
							<label for="HomeEconomics" class="form-label">Home Economics</label>
							<input type="range" class="form-range" min="0" max="10" id="HomeEconomics"
							name="HomeEconomics" value= "<?php echo $homeEconomics1?>">
						</div>
						<div>
							<label for="IndustrialArts" class="form-label">Industrial Arts and Technology</label>
							<input type="range" class="form-range" min="0" max="10" id="IndustrialArts"
							name="IndustrialArts" value= "<?php echo $industrialArts1?>">
						</div>
					</div>
					<div>
  <label class="form-label" for="CareerGoals">What career field are you planning to take in the future?</label>
  <select class="form-select" id="CareerGoals" name="CareerGoals">
    <option value="Undecided"<?php if ($CareerGoals1 == "Undecided") {echo " selected";}?>>Undecided</option>
    <option value="Business and Management"<?php if ($CareerGoals1 == "Business and Management") {echo " selected";}?>>Business and Management</option>
    <option value="Education and Training"<?php if ($CareerGoals1 == "Education and Training") {echo " selected";}?>>Education and Training</option>
    <option value="Engineering and Technology"<?php if ($CareerGoals1 == "Engineering and Technology") {echo " selected";}?>>Engineering and Technology</option>
    <option value="Healthcare and Medicine"<?php if ($CareerGoals1 == "Healthcare and Medicine") {echo " selected";}?>>Healthcare and Medicine</option>
    <option value="Arts and Humanities"<?php if ($CareerGoals1 == "Arts and Humanities") {echo " selected";}?>>Arts and Humanities</option>
    <option value="Law and Public Policy"<?php if ($CareerGoals1 == "Law and Public Policy") {echo " selected";}?>>Law and Public Policy</option>
    <option value="Natural Sciences and Mathematics"<?php if ($CareerGoals1 == "Natural Sciences and Mathematics") {echo " selected";}?>>Natural Sciences and Mathematics</option>
    <option value="Social Sciences and Communication"<?php if ($CareerGoals1 == "Social Sciences and Communication") {echo " selected";}?>>Social Sciences and Communication</option>
    <option value="Information Technology and Computer Science"<?php if ($CareerGoals1 == "Information Technology and Computer Science") {echo " selected";}?>>Information Technology and Computer Science</option>
    <option value="Agriculture and Environmental Science"<?php if ($CareerGoals1 == "Agriculture and Environmental Science") {echo " selected";}?>>Agriculture and Environmental Science</option>
    <option value="Hospitality and Tourism"<?php if ($CareerGoals1== "Hospitality and Tourism") {echo " selected";}?>>Hospitality and Tourism</option>
    <option value="Media and Entertainment"<?php if ($CareerGoals1 == "Media and Entertainment") {echo " selected";}?>>Media and Entertainment</option>
    <option value="Sports and Fitness"<?php if ($CareerGoals1 == "Sports and Fitness") {echo " selected";}?>>Sports and Fitness</option>
    <option value="Trades and Vocational Skills"<?php if ($CareerGoals1 == "Trades and Vocational Skills") {echo " selected";}?>>Trades and Vocational Skills</option>
    <option value="Government and Public Service"<?php if ($CareerGoals1 == "Government and Public Service") {echo " selected";}?>>Government and Public Service</option>
    <option value="Non-Profit and Philanthropy"<?php if ($CareerGoals1 == "Non-Profit and Philanthropy") {echo " selected";}?>>Non-Profit and Philanthropy</option>
  </select>
</div>

					<div class="divider d-flex align-items-center my-4"></div>

					<div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
						<button class="btn btn-primary" type="submit" name="submit">SUBMIT</button>
						<button class="btn btn-secondary" type="button">CLEAR</button>
					</div>
				</form>
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
