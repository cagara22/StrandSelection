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


						$Fname = $_POST['Fname'];
						$Mname = $_POST['Mname'];
						$Lname = $_POST['Lname'];
						$address = $_POST['address'];
						$age = $_POST['age'];
						$civilstatus = $_POST['civilstatus'];
						$sex = $_POST['sex'];
						$email=$_POST['email'];
						$strand=$_POST['predictedStrand'];

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

						$TotalMonthlyIncome = $_POST['TotalMonthlyIncome'];

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
						JOIN socioeconomic_background sb ON ap.lrn = sb.lrn
						JOIN interests i ON sb.lrn = i.lrn
						JOIN skills sk ON i.lrn = sk.lrn
						SET s.Fname = '$Fname', 
							s.Mname = '$Mname',
							s.Lname = '$Lname',
							s.sex = '$sex',
							s.age = '$age',
							s.civilstatus = '$civilstatus',
							s.email = '$email',
							s.address = '$address',
							s.strand = '$strand',
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
							sk.Businessmanagement = '$Businessmanagement',
							sk.Entrepreneurialskills = '$Entrepreneurialskills',
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
							i.IndustrialArts = '$industrialArts',
							sb.TotalMonthlyIncome = '$TotalMonthlyIncome'";
				
				// Check if password and confirm password match
				if (!empty($_POST['password']) && !empty($_POST['cpassword'])) {
					$password = md5($_POST['password']);
					$cpassword = md5($_POST['cpassword']);
				
					if ($password !== $cpassword) {
						echo "<script>alert('Password and Confirm Password do not match!');</script>";
						echo "<script>window.location.href='profile.php';</script>";
					}
				}
				// Execute the update query
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record updated successfully!');</script>";
    echo "<script>window.location.href='profile.php';</script>";
} else {
    echo "Error updating record: " . $conn->error;
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
								$strand1 = $row['strand'];
								$civilstatus1 = $row['civilstatus'];		
								$sex1 = $row['sex'];
								$email1=$row['email'];

								$TotalMonthlyIncome = $row['TotalMonthlyIncome'];
						
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
						name="Fname" value="<?php echo $Fname1; ?>" oninput="validateFirstName(this)" placeholder="" required >
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> Middle Name</label>
						<input type="text" class="form-control" id="Name"
						name="Mname" value="<?php echo $Mname1; ?>" oninput="validateMiddleName(this)" placeholder="" required >
					</div>
					<div class="col-12 col-md-4 mb-3">
						<label for="Name" class="form-label"> Last Name</label>
						<input type="text" class="form-control" id="Name"
						name="Lname" value="<?php echo $Lname1; ?>" oninput="validateLastName(this)" placeholder="" required>
					</div>
					<div class="col-12 mb-3">
						<label for="Address" class="form-label">Address</label>
						<input type="text" class="form-control" id="Address"
						name="address" value="<?php echo $address1; ?>" oninput="validateAddress(this)" placeholder="" required>
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
						name="age" value="<?php echo $age1; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
								maxlength = "3" placeholder="" required>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="lrn" class="form-label">LRN</label>
						<input type="text" class="form-control" id="lrn"
						name="lrn" value="<?php echo $lrn1; ?>"  placeholder="" disabled>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="Email" class="form-label">Email</label>
						<input type="email" class="form-control" id="Email"
						name="email" value="<?php echo $email1; ?>"  placeholder="" required>
					</div>

					<div class="col-12 col-md-6 mb-3">
						<label for="Password" class="form-label">Password</label>
						<input type="password" class="form-control" id="Password" name="password" placeholder="">
						<div class="col-sm-6" id="example-getting-started-text" style="font-weight:bold;padding:6px 12px;">

						</div>
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
						<select class="form-select" id="Science" name="Science">
							<option value="100 - 95" <?php if ($science21 == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($science21 == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($science21 == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($science21 == "100 - 95") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($science21 == "79 - 75") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($science21 == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Math" class="form-label">Math</label>
						<select class="form-select" id="Math" name="Math">
							<option value="100 - 95" <?php if ($math11 == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($math11 == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($math11 == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($math11 == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($math11 == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($math11 == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="English" class="form-label">English</label>
						<select class="form-select" id="English" name="English">
							<option value="100 - 95" <?php if ($English1 == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($English1 == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($English1 == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($English1 == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($English1 == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($English1 == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 col-lg-3 mb-3">
						<label for="Filipino" class="form-label">Filipino</label>
						<select class="form-select" id="Filipino" name="Filipino">
							<option value="100 - 95" <?php if ($Filipino1 == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($Filipino1 == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($Filipino1 == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($Filipino1 == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($Filipino1 == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($Filipino1 == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="ICTRelatedSubject" class="form-label">ICT Related Subject</label>
						<select class="form-select" id="ICTRelatedSubject" name="ICTRelatedSubject">
							<option value="N/A" <?php if ($ICTRelatedSubject1 == "N/A") {echo " selected";}?>>N/A</option>
							<option value="100 - 95" <?php if ($ICTRelatedSubject1 == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($ICTRelatedSubject1 == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($ICTRelatedSubject1 == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($ICTRelatedSubject1 == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($ICTRelatedSubject1 == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($ICTRelatedSubject1 == "69 - 0") {echo " selected";}?>>69 - 0</option>
						</select>
						<small id="" class="form-text text-muted">This is optional... Leave blank if not applicable</small>
					</div>
					<div class="col-12 col-md-6 mb-3">
						<label for="HERelatedSubject" class="form-label">HE Related Subject</label>
						<select class="form-select" id="HERelatedSubject" name="HERelatedSubject">
							<option value="N/A" <?php if ($HERelatedSubject1 == "N/A") {echo " selected";}?>>N/A</option>
							<option value="100 - 95" <?php if ($HERelatedSubject1 == "100 - 95") {echo " selected";}?>>100 - 95</option>
							<option value="94 - 90" <?php if ($HERelatedSubject1 == "94 - 90") {echo " selected";}?>>94 - 90</option>
							<option value="89 - 80" <?php if ($HERelatedSubject1 == "89 - 80") {echo " selected";}?>>89 - 80</option>
							<option value="79 - 75" <?php if ($HERelatedSubject1 == "79 - 75") {echo " selected";}?>>79 - 75</option>
							<option value="74 - 70" <?php if ($HERelatedSubject1 == "74 - 70") {echo " selected";}?>>74 - 70</option>
							<option value="69 - 0" <?php if ($HERelatedSubject1 == "69 - 0") {echo " selected";}?>>69 - 0</option>
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
					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Assessment Score</p>
					</div>
					<div class="col-12 mb-3">
						<label for="assessment" class="form-label">Highest Assessment Score</label>
						<input type="text" class="form-control" id="assessment"
						name="assessment" value="" placeholder="Your highest score...">
					</div>

					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Predicted Strand</p>
					</div>
					<div class="col-12 mb-3">
						<label for="predictedStrand" class="form-label">STRAND</label>
						<input type="text" class="form-control" id="predictedStrand"
						name="predictedStrand" value= "<?php echo $strand1?>" placeholder="Your predicted strand...">
					</div>
					<div class="divider d-flex align-items-center my-4"></div>
					<div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
						<button class="btn btn-primary" type="submit" name="submit">UPDATE</button>
						<button class="btn btn-success" type="button" name="predict" onclick="predictStrand()">PREDICT</button>
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
		<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="./js/password-score.js"></script>
		<script type="text/javascript" src="./js/password-score-options.js"></script>
		<script type="text/javascript" src="./js/bootstrap-strength-meter.js"></script>
		<script src="customjs.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#Password').strengthMeter('text', {
					container: $('#example-getting-started-text'),
					hierarchy: {
						'0': ['text-danger', ' '],
						'1': ['text-danger', 'Very Weak'],
						'25': ['text-danger', 'Weak'],
						'50': ['text-warning', 'Moderate'],
						'75': ['text-warning', 'Good'],
						'100': ['text-success', 'Strong'],
						'125': ['text-success', 'Very Strong']
					}
				});
			});

			function validateAddress(input) {
				var regex = /^[a-zA-Z0-9\s.,]*$/; // Regular expression to allow alphanumeric characters, spaces, periods, and commas

				if (!regex.test(input.value)) {
					input.value = input.value.replace(/[^a-zA-Z0-9\s.,]/g, ''); // Remove any special characters except periods and commas
				}
			}

			function validateFirstName(input) {
				var regex = /^[a-zA-Z0-9\s]*$/; // Regular expression to allow only alphanumeric characters and spaces

				if (!regex.test(input.value)) {
					input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, ''); // Remove any special characters
				}
			}

			function validateMiddleName(input) {
				var regex = /^[a-zA-Z0-9\s]*$/; // Regular expression to allow only alphanumeric characters and spaces

				if (!regex.test(input.value)) {
					input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, ''); // Remove any special characters
				}
			}

			function validateLastName(input) {
				var regex = /^[a-zA-Z0-9\s]*$/; // Regular expression to allow only alphanumeric characters and spaces

				if (!regex.test(input.value)) {
					input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, ''); // Remove any special characters
				}
			}

			function predictStrand(){
				var Science8 = document.getElementById("Science").value;
				var Math9 = document.getElementById("Math").value;
				var English = document.getElementById("English").value;
				var Filipino = document.getElementById("Filipino").value;
				var ICT10 = document.getElementById("ICTRelatedSubject").value;
				var HE = document.getElementById("HERelatedSubject").value;
				var TotalIncome = document.getElementById("TotalMonthlyIncome").value;
				var MathSkills = document.getElementById("Mathematicalskills").checked ? 1 : 0;
				var ScienceSkills = document.getElementById("Scientificskills").checked ? 1 : 0;
				var TechSkills = document.getElementById("Technicalskills").checked ? 1 : 0;
				var LanguageSkills = document.getElementById("Languageskills").checked ? 1 : 0;
				var SocialSkills = document.getElementById("Socialsciences").checked ? 1 : 0;
				var CommSkills = document.getElementById("Communicationskills").checked ? 1 : 0;
				var FinanceSkills = document.getElementById("Accountingandfinance").checked ? 1 : 0;
				var ManagementSkills = document.getElementById("Businessmanagement").checked ? 1 : 0;
				var EntrepreneurSkills = document.getElementById("Entrepreneurialskills").checked ? 1 : 0;
				var TimeMgmt = document.getElementById("Timemanagement").checked ? 1 : 0;
				var Leadership = document.getElementById("LeadershipSkills").checked ? 1 : 0;
				var ArtSkills = document.getElementById("Artisticskills").checked ? 1 : 0;
				var MusicSkills = document.getElementById("Musicskills").checked ? 1 : 0;
				var CulinarySkills = document.getElementById("Culinaryarts").checked ? 1 : 0;
				var HomeMgmt = document.getElementById("Homemanagement").checked ? 1 : 0;
				var FashionSkills = document.getElementById("Fashionandbeauty").checked ? 1 : 0;
				var ICTSkills = document.getElementById("ICTskills").checked ? 1 : 0;
				var MediaSkills = document.getElementById("Multimediaskills").checked ? 1 : 0;
				var DigitalSkills = document.getElementById("Digitalcommunication").checked ? 1 : 0;
				var Science34 = document.getElementById("ScienceSub").value;
				var Math35 = document.getElementById("MathSub").value;
				var ArtsDesign = document.getElementById("ArtsandDesign").value;
				var HumSocial = document.getElementById("Humanities").value;
				var BusEntrep = document.getElementById("Entrepreneurship").value;
				var ICT36 = document.getElementById("Information").value;
				var AgriFish = document.getElementById("Agriculture").value;
				var HomeEcon = document.getElementById("HomeEconomics").value;
				var IndusTech = document.getElementById("IndustrialArts").value;
				var CareerGoals = document.getElementById("CareerGoals").value;

				var url = "http://127.0.0.1:8000/predict";
				var params = "?Science8=" + Science8 +
								"&Math9=" + Math9 +
								"&English=" + English +
								"&Filipino=" + Filipino +
								"&ICT10=" + ICT10 +
								"&HE=" + HE +
								"&TotalIncome=" + TotalIncome +
								"&MathSkills=" + MathSkills +
								"&ScienceSkills=" + ScienceSkills +
								"&TechSkills=" + TechSkills +
								"&LanguageSkills=" + LanguageSkills +
								"&SocialSkills=" + SocialSkills +
								"&CommSkills=" + CommSkills +
								"&FinanceSkills=" + FinanceSkills +
								"&ManagementSkills=" + ManagementSkills +
								"&EntrepreneurSkills=" + EntrepreneurSkills +
								"&TimeMgmt=" + TimeMgmt +
								"&Leadership=" + Leadership +
								"&ArtSkills=" + ArtSkills +
								"&MusicSkills=" + MusicSkills +
								"&CulinarySkills=" + CulinarySkills +
								"&HomeMgmt=" + HomeMgmt +
								"&FashionSkills=" + FashionSkills +
								"&ICTSkills=" + ICTSkills +
								"&MediaSkills=" + MediaSkills +
								"&DigitalSkills=" + DigitalSkills +
								"&Science34=" + Science34 +
								"&Math35=" + Math35 +
								"&ArtsDesign=" + ArtsDesign +
								"&HumSocial=" + HumSocial +
								"&BusEntrep=" + BusEntrep +
								"&ICT36=" + ICT36 +
								"&AgriFish=" + AgriFish +
								"&HomeEcon=" + HomeEcon +
								"&IndusTech=" + IndusTech +
								"&CareerGoals=" + CareerGoals;
				console.log(url + params)
				fetch(url + params)
					.then(response => response.json())
					.then(data => {
						var strandData = data[0];
						console.log(strandData);
						switch(strandData) {
							case "1":
								document.getElementById("predictedStrand").value = "STEM";
								break;
							case "2":
								document.getElementById("predictedStrand").value = "HUMSS";
								break;
							case "3":
								document.getElementById("predictedStrand").value = "ABM";
								break;
							case "4":
								document.getElementById("predictedStrand").value = "GAS";
								break;
							case "5":
								document.getElementById("predictedStrand").value = "TVL - HE";
								break;
							case "6":
								document.getElementById("predictedStrand").value = "TVL - ICT";
								break;
							default:
								document.getElementById("predictedStrand").value = "Unknown";
						}
					})
					.catch(error => {
						console.log(error);
					});
			}
		</script>
	</body>
</html>
