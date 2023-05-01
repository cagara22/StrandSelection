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
						<li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="profiles.php">PROFILES</a>
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
					</ul>
				</div>
			</div>
		</nav>
		
		<section class="d-flex flex-column justify-content-center align-items-center py-5">

		<?php 
			$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
			

			if (isset($_GET['lrn'])) {

				$user_id = $_GET['lrn']; 
			
				$sql = "SELECT * FROM student
				JOIN career ON student.lrn = career.lrn
				JOIN academic_performance ON career.lrn = academic_performance.lrn
				JOIN skills ON academic_performance.lrn = skills.lrn
				JOIN interests ON skills.lrn = interests.lrn
				JOIN socioeconomic_background ON interests.lrn = socioeconomic_background.lrn WHERE student.lrn = '$user_id';";
			
				$result = $conn->query($sql); 
			
				if ($result->num_rows > 0) {        
			
					while ($row = $result->fetch_assoc()) {
			
						$lrn1 = $row['lrn'];
						$Fname = $row['Fname'];
						$Mname = $row['Mname'];
						$Lname = $row['Lname'];
						$address = $row['address'];
						$sex = $row['sex'];
						$age = $row['age'];
						$civilstatus=$row['civilstatus'];
						$status=$row['status'];
						$strand=$row['strand'];
						$email=$row['email'];
						$approve=$row['approve'];

						$Science =$row['Science'];
						$Math =$row['Math'];
						$English =$row['English'];
						$Filipino =$row['Filipino'];
						$ICTRelatedSubject=$row['ICTRelatedSubject'];
						$HERelatedSubject=$row['HERelatedSubject'];

						$TotalMonthlyIncome = $row['TotalMonthlyIncome'];

						$MathSub =$row['MathSub'];
						$ScienceSub =$row['ScienceSub'];
						$ArtsandDesign =$row['ArtsandDesign'];
						$Humanities =$row['Humanities'];
						$Entrepreneurship =$row['Entrepreneurship'];
						$Information =$row['Information'];
						$Agriculture =$row['Agriculture'];
						$HomeEconomics =$row['HomeEconomics'];
						$IndustrialArts =$row['IndustrialArts'];

						$CareerGoals =$row['CareerGoals'];

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
				$conn->close();
			}
				
		?>


		<div class="row" style="width:70%">
				<form class="row"  action="" method="post">
					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Account Details</p>
					</div>
					<div class="col-12 mb-3">
						<label for="Name" class="form-label"> LRN</label>
						<input type="text" class="form-control" id="Name"
						name="lrn" value="<?php echo $lrn1; ?>" placeholder="" disabled>
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> First Name</label>
						<input type="text" class="form-control" id="Name"
						name="Fname" value="<?php echo $Fname; ?>" placeholder="">
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> Middle Name</label>
						<input type="text" class="form-control" id="Name"
						name="Mname" value="<?php echo $Mname; ?>" placeholder="">
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> Last Name</label>
						<input type="text" class="form-control" id="Name"
						name="Lname" value="<?php echo $Lname; ?>" placeholder="">
					</div>
					<div class="col-12 mb-3">
						<label for="Address" class="form-label">Address</label>
						<input type="text" class="form-control" id="Address"
						name="address" value="<?php echo $address; ?>" placeholder="">
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label class="form-label" for="Gender">Gender</label>
						<input type="text" class="form-control" id="Gender"
						name="sex" value="<?php echo $sex; ?>" placeholder="">
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label class="form-label" for="CivilStatus">Civil Status</label>
						<input type="text" class="form-control" id="CivilStatus"
						name="civilstatus" value="<?php echo $civilstatus; ?>" placeholder="">
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Age" class="form-label">Age</label>
						<input type="text" class="form-control" id="Age"
						name="age" value="<?php echo $age; ?>" placeholder="">
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="Email" class="form-label">Email</label>
						<input type="email" class="form-control" id="Email"
						name="username" value="<?php echo $email; ?>"  placeholder="">
					</div>

					<div class="col-12 col-md-6 mb-3">
						<label for="Approve" class="form-label">Approval Status</label>
						<input type="text" class="form-control" id="approve"
						name="approve" value="<?php echo $approve; ?>"  placeholder="">
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="Status" class="form-label">Status</label>
						<input type="text" class="form-control" id="ststus"
						name="status" value="<?php echo $status; ?>" placeholder="">
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="Strand" class="form-label"> Qualified Strand</label>
						<input type="strand" class="form-control" id="Strand" placeholder=""
						name="strand" value="<?php echo $strand; ?>">
					</div>

					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Academic Performance</p>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Science" class="form-label">Science</label>
						<select class="form-select" id="Science" name="Science">
							<option value="100 - 95" <?php if ($Science == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($Science == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($Science == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($Science == "100 - 95") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($Science == "79 - 75") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($Science == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Math" class="form-label">Math</label>
						<select class="form-select" id="Math" name="Math">
							<option value="100 - 95" <?php if ($Math == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($Math == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($Math == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($Math == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($Math == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($Math == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="English" class="form-label">English</label>
						<select class="form-select" id="English" name="English">
							<option value="100 - 95" <?php if ($English == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($English == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($English == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($English == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($English == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($English == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Filipino" class="form-label">Filipino</label>
						<select class="form-select" id="Filipino" name="Filipino">
							<option value="100 - 95" <?php if ($Filipino == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($Filipino == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($Filipino == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($Filipino == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($Filipino == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($Filipino == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="ICTRelatedSubject" class="form-label">ICT Related Subject</label>
						<select class="form-select" id="ICTRelatedSubject" name="ICTRelatedSubject">
							<option value="N/A" <?php if ($ICTRelatedSubject == "N/A") {echo " selected";}?>>N/A</option>
							<option value="100 - 95" <?php if ($ICTRelatedSubject == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($ICTRelatedSubject == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($ICTRelatedSubject == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($ICTRelatedSubject == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($ICTRelatedSubject == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($ICTRelatedSubject == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
						<small id="" class="form-text text-muted">This is optional... Leave blank if not applicable</small>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="HERelatedSubject" class="form-label">HE Related Subject</label>
						<select class="form-select" id="HERelatedSubject" name="HERelatedSubject">
							<option value="N/A" <?php if ($HERelatedSubject == "N/A") {echo " selected";}?>>N/A</option>
							<option value="100 - 95" <?php if ($HERelatedSubject == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($HERelatedSubject == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($HERelatedSubject == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($HERelatedSubject == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($HERelatedSubject == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($HERelatedSubject == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
						<small id="" class="form-text text-muted">This is optional... Leave blank if not applicable</small>
					</div>

					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Socioeconomic Background</p>
					</div>
					<div class="col-12">
						<div class="mb-3">
							<label class="form-label" for="TotalMonthlyIncome">Total Household Monthly Income</label>
							<select class="form-select" id="TotalMonthlyIncome" name="TotalMonthlyIncome">
								<option selected value="less than P9,100" <?php if ($TotalMonthlyIncome == "less than P9,100") {echo " selected";}?>>less than P9,100</option>
								<option value="P9,100-P18,200" <?php if ($TotalMonthlyIncome == "P9,100-P18,200") {echo " selected";}?>>P9,100-P18,200</option>
								<option value="P18,200-P36,400" <?php if ($TotalMonthlyIncome == "P18,200-P36,400") {echo " selected";}?>>P18,200-P36,400</option>
								<option value="P36,400-P63,700" <?php if ($TotalMonthlyIncome == "P36,400-P63,700") {echo " selected";}?>>P36,400-P63,700</option>
								<option value="P63,700-P109,200" <?php if ($TotalMonthlyIncome == "P63,700-P109,200") {echo " selected";}?>>P63,700-P109,200</option>
								<option value="P109,200-P182,000" <?php if ($TotalMonthlyIncome == "P109,200-P182,000") {echo " selected";}?>>P109,200-P182,000</option>
								<option value="greater than P182,000" <?php if ($TotalMonthlyIncome == "greater than P182,000") {echo " selected";}?>>greater than P182,000</option>
							</select>
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
							name="ScienceSub" value= "<?php echo $ScienceSub?>">
						</div>
						<div>
							<label for="MathSub" class="form-label">Math</label>
							<input type="range" class="form-range" min="0" max="10" id="MathSub"
							name="MathSub" value= "<?php echo $MathSub?>">
						</div>
						<div>
							<label for="ArtsandDesign" class="form-label">Arts and Design</label>
							<input type="range" class="form-range" min="0" max="10" id="ArtsandDesign"
							name="ArtsandDesign" value= "<?php echo $ArtsandDesign?>">
						</div>
						<div>
							<label for="Humanities" class="form-label">Humanities and Social Sciences</label>
							<input type="range" class="form-range" min="0" max="10" id="Humanities"
							name="Humanities" value= "<?php echo $Humanities?>">
						</div>
						<div>
							<label for="Entrepreneurship" class="form-label">Business and Entrepreneurship</label>
							<input type="range" class="form-range" min="0" max="10" id="Entrepreneurship"
							name="Entrepreneurship" value= "<?php echo $Entrepreneurship?>">
						</div>
						<div>
							<label for="Information" class="form-label">Information and Communication Technology</label>
							<input type="range" class="form-range" min="0" max="10" id="Information"
							name="Information" value= "<?php echo $Information?>">
						</div>
						<div>
							<label for="Agriculture" class="form-label">Agriculture and Fisheries</label>
							<input type="range" class="form-range" min="0" max="10" id="Agriculture"
							name="Agriculture" value= "<?php echo $Agriculture?>">
						</div>
						<div>
							<label for="HomeEconomics" class="form-label">Home Economics</label>
							<input type="range" class="form-range" min="0" max="10" id="HomeEconomics"
							name="HomeEconomics" value= "<?php echo $HomeEconomics?>">
						</div>
						<div>
							<label for="IndustrialArts" class="form-label">Industrial Arts and Technology</label>
							<input type="range" class="form-range" min="0" max="10" id="IndustrialArts"
							name="IndustrialArts" value= "<?php echo $IndustrialArts?>">
						</div>
					</div>
					<div>
						<label class="form-label" for="CareerGoals">What career field are you planning to take in the future?</label>
						<select class="form-select" id="CareerGoals" name="CareerGoals">
							<option value="Undecided"<?php if ($CareerGoals == "Undecided") {echo " selected";}?>>Undecided</option>
							<option value="Business and Management"<?php if ($CareerGoals == "Business and Management") {echo " selected";}?>>Business and Management</option>
							<option value="Education and Training"<?php if ($CareerGoals == "Education and Training") {echo " selected";}?>>Education and Training</option>
							<option value="Engineering and Technology"<?php if ($CareerGoals == "Engineering and Technology") {echo " selected";}?>>Engineering and Technology</option>
							<option value="Healthcare and Medicine"<?php if ($CareerGoals == "Healthcare and Medicine") {echo " selected";}?>>Healthcare and Medicine</option>
							<option value="Arts and Humanities"<?php if ($CareerGoals == "Arts and Humanities") {echo " selected";}?>>Arts and Humanities</option>
							<option value="Law and Public Policy"<?php if ($CareerGoals == "Law and Public Policy") {echo " selected";}?>>Law and Public Policy</option>
							<option value="Natural Sciences and Mathematics"<?php if ($CareerGoals == "Natural Sciences and Mathematics") {echo " selected";}?>>Natural Sciences and Mathematics</option>
							<option value="Social Sciences and Communication"<?php if ($CareerGoals == "Social Sciences and Communication") {echo " selected";}?>>Social Sciences and Communication</option>
							<option value="Information Technology and Computer Science"<?php if ($CareerGoals == "Information Technology and Computer Science") {echo " selected";}?>>Information Technology and Computer Science</option>
							<option value="Agriculture and Environmental Science"<?php if ($CareerGoals == "Agriculture and Environmental Science") {echo " selected";}?>>Agriculture and Environmental Science</option>
							<option value="Hospitality and Tourism"<?php if ($CareerGoals == "Hospitality and Tourism") {echo " selected";}?>>Hospitality and Tourism</option>
							<option value="Media and Entertainment"<?php if ($CareerGoals == "Media and Entertainment") {echo " selected";}?>>Media and Entertainment</option>
							<option value="Sports and Fitness"<?php if ($CareerGoals == "Sports and Fitness") {echo " selected";}?>>Sports and Fitness</option>
							<option value="Trades and Vocational Skills"<?php if ($CareerGoals == "Trades and Vocational Skills") {echo " selected";}?>>Trades and Vocational Skills</option>
							<option value="Government and Public Service"<?php if ($CareerGoals == "Government and Public Service") {echo " selected";}?>>Government and Public Service</option>
							<option value="Non-Profit and Philanthropy"<?php if ($CareerGoals == "Non-Profit and Philanthropy") {echo " selected";}?>>Non-Profit and Philanthropy</option>
						</select>
					</div>

					<div class="divider d-flex align-items-center my-4"></div>
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
