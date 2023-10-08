<?php
session_start();

if (!isset($_SESSION["student"])) {

?>
	<script type="text/javascript">
		window.location = "index.php";
	</script>
<?php

}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strand Selection Ver2</title>
	<link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
	<nav class="navbar navbar-expand-md fixed-top">
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
						<a class="nav-link" href="strand.php">STRAND</a>
					</li>
					<li class="nav-item px-4 fw-bold">
						<a class="nav-link active" aria-current="page" href="profile.php">PROFILE</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="result.php">RESULT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="about.php">ABOUT</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo $_SESSION["student"]; ?>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="section-100 d-flex flex-column justify-content-center px-3 py-5">
		<h2 class="fw-bold sub-title mt-3">Hello <?php echo $_SESSION["student"]; ?>!</h2>
		<div class="row w-100">
			<div class="col-12 col-lg-9 d-flex justify-content-center">
				<div class="row w-100">
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">Account Details</h4>
							</div>
							<div class="card-body">



								<?php
								// Establish database connection
								$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

								// Check if form was submitted
								if (isset($_POST['submit1'])) {
									// Retrieve form data
									$id = $_SESSION['student'];
									$Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
									$Mname = mysqli_real_escape_string($conn, $_POST['Mname']);
									$Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
									$address = mysqli_real_escape_string($conn, $_POST['address']);
									$age = mysqli_real_escape_string($conn, $_POST['age']);
									$sex = mysqli_real_escape_string($conn, $_POST['sex']);
									$suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
									$email = mysqli_real_escape_string($conn, $_POST['email']);

									// Check if password and confirm password match
									if (!empty($_POST['password']) && !empty($_POST['cpassword'])) {
										$password = md5($_POST['password']);
										$cpassword = md5($_POST['cpassword']);

										if ($password !== $cpassword) {
											echo "<script>alert('Password and Confirm Password do not match!');</script>";
											echo "<script>window.location.href='profile.php';</script>";
											exit; // Exit the script if passwords do not match
										}
									}

									// Define the SQL statement for updating user data
									$sql = "UPDATE studentprofile SET Fname='$Fname', Mname='$Mname', Lname='$Lname', 
            address='$address', age='$age', sex='$sex', suffix='$suffix', email='$email' WHERE Fname='$id'";

									// Execute the update query
									if (mysqli_query($conn, $sql)) {
										$affected_rows = mysqli_affected_rows($conn);

										if ($affected_rows > 0) {
											echo "<script>alert('Record updated successfully!');</script>";
											echo "<script>window.location.href='profile.php';</script>";
										} else {
											echo "<script>alert('No changes were made to the record.');</script>";
										}
									} else {
										echo "Error updating record: " . mysqli_error($conn);
									}
								}

								if (isset($_SESSION['student'])) {

									$user_id = $_SESSION['student'];

									$sql = "SELECT * FROM studentprofile
					JOIN studentcareer ON studentprofile.lrn = studentcareer.lrn
					JOIN studentacad ON studentcareer.lrn = studentacad.lrn
					JOIN studentskill ON studentacad.lrn = studentskill.lrn
					JOIN studentinterest ON studentskill.lrn = studentinterest.lrn
					JOIN studentsocioeco  ON studentinterest.lrn = studentsocioeco.lrn WHERE studentprofile.lrn = '$user_id';";

									$result = $conn->query($sql);

									if ($result->num_rows > 0) {

										while ($row = $result->fetch_assoc()) {


											$lrn1 = $row['lrn'];
											$Fname1 = $row['Fname'];
											$Mname1 = $row['Mname'];
											$Lname1 = $row['Lname'];
											$address1 = $row['address'];
											$age1 = $row['age'];
											$suffix1 = $row['suffix'];
											$sex1 = $row['sex'];
											$email1 = $row['email'];
											//skills
											$skiCommunicationSkills1 = $row['skiCommunicationSkills'];
											$skiCriticalThinking1 = $row['skiCriticalThinking'];
											$skiReadingComprehension1 = $row['skiReadingComprehension'];
											$skiProblemSolving1 = $row['skiProblemSolving'];
											$skiResearchSkills1 = $row['skiResearchSkills'];
											$skiDigitalLiteracy1 = $row['skiDigitalLiteracy'];
											$skiInnovative1 = $row['skiInnovative'];
											$skiTimeManagement1 = $row['skiTimeManagement'];
											$skiAdaptability1 = $row['skiAdaptability'];
											$skiScientificInquiry1 = $row['skiScientificInquiry'];
											$skiMathematicalSkills1 = $row['skiMathematicalSkills'];
											$skiLogicalReasoning1 = $row['skiLogicalReasoning'];
											$skiLabExperimentalSkills1 = $row['skiLabExperimentalSkills'];
											$skiAnalyticalSkills1 = $row['skiAnalyticalSkills'];
											$skiResearchWriting1 = $row['skiResearchWriting'];
											$skiSociologicalAnalysis1 = $row['skiSociologicalAnalysis'];
											$skiCulturalCompetence1 = $row['skiCulturalCompetence'];
											$skiEthicalReasoning1 = $row['skiEthicalReasoning'];
											$skiHistoryPoliticalScience1 = $row['skiHistoryPoliticalScience'];
											$skiFinancialLiteracy1 = $row['skiFinancialLiteracy'];
											$skiBusinessPlanning1 = $row['skiBusinessPlanning'];
											$skiMarketing1 = $row['skiMarketing'];
											$skiAccounting1 = $row['skiAccounting'];
											$skiEntrepreneurship1 = $row['skiEntrepreneurship'];
											$skiComputerHardwareSoftware1 = $row['skiComputerHardwareSoftware'];
											$skiComputerNetworking1 = $row['skiComputerNetworking'];
											$skiWebDevelopment1 = $row['skiWebDevelopment'];
											$skiProgramming1 = $row['skiProgramming'];
											$skiTroubleshooting1 = $row['skiTroubleshooting'];
											$skiGraphicsDesign1 = $row['skiGraphicsDesign'];
											$skiCulinarySkills1 = $row['skiCulinarySkills'];
											$skiSewingFashionDesign1 = $row['skiSewingFashionDesign'];
											$skiInteriorDesign1 = $row['skiInteriorDesign'];
											$skiChildcareFamilyServices1 = $row['skiChildcareFamilyServices'];
											$skiNutritionFoodSafety1 = $row['skiNutritionFoodSafety'];
											$skiEconomics1 = $row['skiEconomics'];

											//interests
											$intCalculus1 = $row['intCalculus'];
											$intBiology1 = $row['intBiology'];
											$intPhysics1 = $row['intPhysics'];
											$intChemistry1 = $row['intChemistry'];
											$intCreativeWriting1 = $row['intCreativeWriting'];
											$intCreativeNonfiction1 = $row['intCreativeNonfiction'];
											$intIntroWorldReligionsBeliefSystems1 = $row['intIntroWorldReligionsBeliefSystems'];
											$intPhilippinePoliticsGovernance1 = $row['intPhilippinePoliticsGovernance'];
											$intDisciplinesIdeasSocialSciences1 = $row['intDisciplinesIdeasSocialSciences'];
											$intAppliedEconomics1 = $row['intAppliedEconomics'];
											$intBusinessEthicsSocialResponsibility1 = $row['intBusinessEthicsSocialResponsibility'];
											$intFundamentalsABM1 = $row['intFundamentalsABM'];
											$intBusinessMath1 = $row['intBusinessMath'];
											$intBusinessFinance1 = $row['intBusinessFinance'];
											$intOrganizationManagement1 = $row['intOrganizationManagement'];
											$intPrinciplesMarketing1 = $row['intPrinciplesMarketing'];
											$intComputerProgramming1 = $row['intComputerProgramming'];
											$intComputerSystemServicing1 = $row['intComputerSystemServicing'];
											$intContactCenterServices1 = $row['intContactCenterServices'];
											$intCISCOComputerNetworking1 = $row['intCISCOComputerNetworking'];
											$intAnimationIllustration1 = $row['intAnimationIllustration'];
											$intCookery1 = $row['intCookery'];
											$intBreadPastryProduction1 = $row['intBreadPastryProduction'];
											$intFashionDesign1 = $row['intFashionDesign'];
											$intFoodBeverages1 = $row['intFoodBeverages'];
											$intTailoring1 = $row['intTailoring'];
											$acadScience1 = $row['acadScience'];
											$acadMath1 = $row['acadMath'];
											$acadEnglish1 = $row['acadEnglish'];
											$acadFilipino1 = $row['acadFilipino'];
											$acadICTRelatedSub1 = $row['acadICTRelatedSubject'];
											$acadHERelatedSub1 = $row['acadHERelatedSubject'];
											//careerpath
											$CareerPath11 = $row['CareerPath1'];
											$CareerPath21 = $row['CareerPath2'];
											$CareerPath31 = $row['CareerPath3'];
											//socioeco
											$TotalHouseholdMonthlyIncome1 = $row['TotalHouseholdMonthlyIncome'];
										}
									}
								}
								?>


								<form class="row" action="" method="post">
									<div class="col-12 mb-1">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" id="lrn" name="lrn" value="<?php echo $lrn1; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="Learner's Reference Number" required>
											<label for="lrn">Learner's Reference Number</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="fname" name="Fname" value="<?php echo $Fname1; ?>" oninput="validateName(this)" placeholder="First Name" required>
											<label for="fname">First Name</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="mname" name="Mname" value="<?php echo $Mname1; ?>" oninput="validateName(this)" placeholder="Middle Name">
											<label for="mname">Middle Name</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="lname" name="Lname" value="<?php echo $Lname1; ?>" oninput="validateName(this)" placeholder="Last Name" required>
											<label for="lname">Last Name</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo $suffix1; ?>" oninput="validateName(this)" placeholder="Suffix">
											<label for="suffix">Suffix</label>
										</div>
									</div>
									<div class="col-12 mb-3">
										<div class="form-floating mb-1">
											<input type="text" class="form-control" id="address" name="address" value="<?php echo $address1; ?>" oninput="validateAddress(this)" placeholder="Address" required>
											<label for="address">Address</label>
										</div>
									</div>
									<div class="col-12 col-md-4 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="sex" name="sex" value="<?php echo $sex1; ?>">
												<option value="M" <?php if ($sex1 == "Male") {
																		echo " selected";
																	} ?>>Male</option>
												<option value="F" <?php if ($sex1 == "Female") {
																		echo " selected";
																	} ?>>Female</option>
											</select>
											<label for="sex">Sex</label>
										</div>
									</div>
									<div class="col-12 col-md-4 mb-1">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" id="age" name="age" value="<?php echo $age1; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Age" required>
											<label for="age">Age</label>
										</div>
									</div>
									<div class="col-12 col-md-4 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="section" name="section" value="">
												<option value="1">Chumunooy</option>
												<option value="2">Churba</option>
												<option value="3">Bella</option>
												<option value="4">Burnok</option>
											</select>
											<label for="section">Section</label>
										</div>
									</div>
									<div class="col-12 mb-3">
										<div class="form-floating mb-1">
											<input type="email" class="form-control" id="email" name="email" value="<?php echo $email1; ?>" placeholder="Email" required>
											<label for="email">Email</label>
										</div>
									</div>
									<div class="col-12 col-md-6 mb-1">
										<div class="form-floating">
											<input type="password" class="form-control" id="pass1" name="password" placeholder="Password">
											<label for="pass1">PASSWORD</label>
										</div>
										<div class="col-sm-6" id="passstrength" style="font-weight:bold;padding:6px 12px;">

										</div>
									</div>
									<div class="col-12 col-md-6 mb-1">
										<div class="form-floating">
											<input type="password" class="form-control" id="pass2" name="cpassword" placeholder="Confirm Password">
											<label for="pass2">CONFIRM PASSWORD</label>
										</div>
									</div>
									<div class="d-grid gap-2 d-md-flex justify-content-end">
										<button type="submit" class="btn btn-primary form-button-text" name="submit1"><span class="fw-bold">UPDATE</span></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">Student Profile</h4>
							</div>
							<div class="card-body">

								<?php
								// Establish database connection
								$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

								// Check if form was submitted
								if (isset($_POST['submit2'])) {

									// Retrieve form data
									$id = $_SESSION['student'];
									//skills
									$skiCommunicationSkills = isset($_POST['skiCommunicationSkills']) ? 1 : 0;
									$skiCriticalThinking = isset($_POST['skiCriticalThinking']) ? 1 : 0;
									$skiReadingComprehension = isset($_POST['skiReadingComprehension']) ? 1 : 0;
									$skiProblemSolving = isset($_POST['skiProblemSolving']) ? 1 : 0;
									$skiResearchSkills = isset($_POST['skiResearchSkills']) ? 1 : 0;
									$skiDigitalLiteracy = isset($_POST['skiDigitalLiteracy']) ? 1 : 0;
									$skiInnovative = isset($_POST['skiInnovative']) ? 1 : 0;
									$skiTimeManagement = isset($_POST['skiTimeManagement']) ? 1 : 0;
									$skiAdaptability = isset($_POST['skiAdaptability']) ? 1 : 0;
									$skiScientificInquiry = isset($_POST['skiScientificInquiry']) ? 1 : 0;
									$skiMathematicalSkills = isset($_POST['skiMathematicalSkills']) ? 1 : 0;
									$skiLogicalReasoning = isset($_POST['skiLogicalReasoning']) ? 1 : 0;
									$skiLabExperimentalSkills = isset($_POST['skiLabExperimentalSkills']) ? 1 : 0;
									$skiAnalyticalSkills = isset($_POST['skiAnalyticalSkills']) ? 1 : 0;
									$skiResearchWriting = isset($_POST['skiResearchWriting']) ? 1 : 0;
									$skiSociologicalAnalysis = isset($_POST['skiSociologicalAnalysis']) ? 1 : 0;
									$skiCulturalCompetence = isset($_POST['skiCulturalCompetence']) ? 1 : 0;
									$skiEthicalReasoning = isset($_POST['skiEthicalReasoning']) ? 1 : 0;
									$skiHistoryPoliticalScience = isset($_POST['skiHistoryPoliticalScience']) ? 1 : 0;
									$skiFinancialLiteracy = isset($_POST['skiFinancialLiteracy']) ? 1 : 0;
									$skiBusinessPlanning = isset($_POST['skiBusinessPlanning']) ? 1 : 0;
									$skiMarketing = isset($_POST['skiMarketing']) ? 1 : 0;
									$skiAccounting = isset($_POST['skiAccounting']) ? 1 : 0;
									$skiEntrepreneurship = isset($_POST['skiEntrepreneurship']) ? 1 : 0;
									$skiComputerHardwareSoftware = isset($_POST['skiComputerHardwareSoftware']) ? 1 : 0;
									$skiComputerNetworking = isset($_POST['skiComputerNetworking']) ? 1 : 0;
									$skiWebDevelopment = isset($_POST['skiWebDevelopment']) ? 1 : 0;
									$skiProgramming = isset($_POST['skiProgramming']) ? 1 : 0;
									$skiTroubleshooting = isset($_POST['skiTroubleshooting']) ? 1 : 0;
									$skiGraphicsDesign = isset($_POST['skiGraphicsDesign']) ? 1 : 0;
									$skiCulinarySkills = isset($_POST['skiCulinarySkills']) ? 1 : 0;
									$skiSewingFashionDesign = isset($_POST['skiSewingFashionDesign']) ? 1 : 0;
									$skiInteriorDesign = isset($_POST['skiInteriorDesign']) ? 1 : 0;
									$skiChildcareFamilyServices = isset($_POST['skiChildcareFamilyServices']) ? 1 : 0;
									$skiNutritionFoodSafety = isset($_POST['skiNutritionFoodSafety']) ? 1 : 0;
									$skiEconomics = isset($_POST['skiEconomics']) ? 1 : 0;
									//interests
									$intCalculus = $_POST['intCalculus'];
									$intBiology = $_POST['intBiology'];
									$intPhysics = $_POST['intPhysics'];
									$intChemistry = $_POST['intChemistry'];
									$intCreativeWriting = $_POST['intCreativeWriting'];
									$intCreativeNonfiction = $_POST['intCreativeNonfiction'];
									$intIntroWorldReligionsBeliefSystems = $_POST['intIntroWorldReligionsBeliefSystems'];
									$intPhilippinePoliticsGovernance = $_POST['intPhilippinePoliticsGovernance'];
									$intDisciplinesIdeasSocialSciences = $_POST['intDisciplinesIdeasSocialSciences'];
									$intAppliedEconomics = $_POST['intAppliedEconomics'];
									$intBusinessEthicsSocialResponsibility = $_POST['intBusinessEthicsSocialResponsibility'];
									$intFundamentalsABM = $_POST['intFundamentalsABM'];
									$intBusinessMath = $_POST['intBusinessMath'];
									$intBusinessFinance = $_POST['intBusinessFinance'];
									$intOrganizationManagement = $_POST['intOrganizationManagement'];
									$intPrinciplesMarketing = $_POST['intPrinciplesMarketing'];
									$intComputerProgramming = $_POST['intComputerProgramming'];
									$intComputerSystemServicing = $_POST['intComputerSystemServicing'];
									$intContactCenterServices = $_POST['intContactCenterServices'];
									$intCISCOComputerNetworking = $_POST['intCISCOComputerNetworking'];
									$intAnimationIllustration = $_POST['intAnimationIllustration'];
									$intCookery = $_POST['intCookery'];
									$intBreadPastryProduction = $_POST['intBreadPastryProduction'];
									$intFashionDesign = $_POST['intFashionDesign'];
									$intFoodBeverages = $_POST['intFoodBeverages'];
									$intTailoring =  $_POST['intTailoring'];
									$intChemistry =  $_POST['intChemistry'];
									$acadScience = $_POST['acadScience'];
									$acadMath = $_POST['acadMath'];
									$acadEnglish = $_POST['acadEnglish'];
									$acadFilipino = $_POST['acadFilipino'];
									$acadICTRelatedSubject = isset($_POST['acadICTRelatedSubject']) ? $_POST['acadICTRelatedSubject'] : '';
									$acadHERelatedSubject = isset($_POST['acadHERelatedSubject']) ? $_POST['acadHERelatedSubject'] : '';
									//careerpath
									$CareerPath1 = $_POST['CareerPath1'];
									$CareerPath2 = $_POST['CareerPath2'];
									$CareerPath3 = $_POST['CareerPath3'];
									//socioeco
									$TotalHouseholdMonthlyIncome = isset($_POST['TotalHouseholdMonthlyIncome']) ? $_POST['TotalHouseholdMonthlyIncome'] : '';

									// Prepare update query
									$sql2 = "UPDATE studentprofile
				JOIN studentinterest ON studentprofile.lrn = studentinterest.lrn
				JOIN studentacad ON studentprofile.lrn = studentacad.lrn
				JOIN studentcareer ON studentprofile.lrn = studentcareer.lrn
				JOIN studentsocioeco ON studentprofile.lrn = studentsocioeco.lrn
				JOIN studentskill ON studentprofile.lrn = studentskill.lrn
				SET
					studentskill.skiCommunicationSkills = '$skiCommunicationSkills',
					studentskill.skiCriticalThinking = '$skiCriticalThinking',
					studentskill.skiReadingComprehension = '$skiReadingComprehension',
					studentskill.skiProblemSolving = '$skiProblemSolving',
					studentskill.skiResearchSkills = '$skiResearchSkills ',
					studentskill.skiDigitalLiteracy = '$skiDigitalLiteracy',
					studentskill.skiInnovative = '$skiInnovative',
					studentskill.skiTimeManagement = '$skiTimeManagement',
					studentskill.skiAdaptability = '$skiAdaptability',
					studentskill.skiScientificInquiry = '$skiScientificInquiry',
					studentskill.skiMathematicalSkills = '$skiMathematicalSkills',
					studentskill.skiLogicalReasoning = '$skiLogicalReasoning',
					studentskill.skiLabExperimentalSkills = '$skiLabExperimentalSkills',
					studentskill.skiAnalyticalSkills = '$skiAnalyticalSkills',
					studentskill.skiResearchWriting = '$skiResearchWriting',
					studentskill.skiSociologicalAnalysis = '$skiSociologicalAnalysis',
					studentskill.skiCulturalCompetence = '$skiCulturalCompetence',
					studentskill.skiEthicalReasoning = '$skiEthicalReasoning',
					studentskill.skiHistoryPoliticalScience = '$skiHistoryPoliticalScience',
					studentskill.skiFinancialLiteracy = '$skiFinancialLiteracy',
					studentskill.skiBusinessPlanning = '$skiBusinessPlanning',
					studentskill.skiMarketing = '$skiMarketing',
					studentskill.skiAccounting = '$skiAccounting',
					studentskill.skiEntrepreneurship = '$skiEntrepreneurship',
					studentskill.skiComputerHardwareSoftware = '$skiComputerHardwareSoftware',
					studentskill.skiComputerNetworking = '$skiComputerNetworking ',
					studentskill.skiWebDevelopment = '$skiWebDevelopment',
					studentskill.skiProgramming = '$skiProgramming',
					studentskill.skiTroubleshooting = '$skiTroubleshooting ',
					studentskill.skiGraphicsDesign = '$skiGraphicsDesign',
					studentskill.skiCulinarySkills = '$skiCulinarySkills',
					studentskill.skiSewingFashionDesign = '$skiSewingFashionDesign',
					studentskill.skiInteriorDesign = '$skiInteriorDesign',
					studentskill.skiChildcareFamilyServices = '$skiChildcareFamilyServices',
					studentskill.skiNutritionFoodSafety = '$skiNutritionFoodSafety',
					studentskill.skiEconomics = '$skiEconomics',
					-- interests
					studentinterest.intCalculus = '$intCalculus',
					studentinterest.intBiology = '$intBiology',
					studentinterest.intPhysics = '$intPhysics',
					studentinterest.intCreativeWriting = '$intCreativeWriting',
					studentinterest.intCreativeNonfiction = '$intCreativeNonfiction',
					studentinterest.intIntroWorldReligionsBeliefSystems = '$intIntroWorldReligionsBeliefSystems',
					studentinterest.intPhilippinePoliticsGovernance = '$intPhilippinePoliticsGovernance',
					studentinterest.intDisciplinesIdeasSocialSciences = '$intDisciplinesIdeasSocialSciences',
					studentinterest.intAppliedEconomics = '$intAppliedEconomics',
					studentinterest.intBusinessEthicsSocialResponsibility = '$intBusinessEthicsSocialResponsibility',
					studentinterest.intFundamentalsABM = '$intFundamentalsABM',
					studentinterest.intBusinessMath = '$intBusinessMath',
					studentinterest.intBusinessFinance = '$intBusinessFinance',
					studentinterest.intOrganizationManagement = '$intOrganizationManagement',
					studentinterest.intPrinciplesMarketing = '$intPrinciplesMarketing',
					studentinterest.intComputerProgramming = '$intComputerProgramming',
					studentinterest.intComputerSystemServicing = '$intComputerSystemServicing',
					studentinterest.intContactCenterServices = '$intContactCenterServices',
					studentinterest.intCISCOComputerNetworking = '$intCISCOComputerNetworking',
					studentinterest.intAnimationIllustration = '$intAnimationIllustration',
					studentinterest.intCookery = '$intCookery',
					studentinterest.intBreadPastryProduction = '$intBreadPastryProduction',
					studentinterest.intFashionDesign = '$intFashionDesign',
					studentinterest.intFoodBeverages = '$intFoodBeverages',
					studentinterest.intTailoring = '$intTailoring',
					studentinterest.intChemistry = '$intChemistry',
			
					studentacad.acadScience = '$acadScience',
					studentacad.acadMath = '$acadMath',
					studentacad.acadEnglish = '$acadEnglish',
    				studentacad.acadFilipino = '$acadFilipino',
   					studentacad.acadICTRelatedSubject = '$acadICTRelatedSubject',
   				 	studentacad.acadHERelatedSubject = '$acadHERelatedSubject',
				
					studentcareer.CareerPath1 = '$CareerPath1',
					studentcareer.CareerPath2 = '$CareerPath2',
					studentcareer.CareerPath3 = '$CareerPath3',
					studentsocioeco.TotalHouseholdMonthlyIncome = '$TotalHouseholdMonthlyIncome'
				WHERE
					studentprofile.lrn = '$id'";


									// Execute the update query
									if ($conn->query($sql2) === TRUE) {
										echo "<script>alert('Record updated successfully!');</script>";
										echo "<script>window.location.href='profile.php';</script>";
									} else {
										echo "Error updating record: " . $conn->error;
									}
								}

								?>
								<form class="row" action="" method="post">
									<div class="divider d-flex align-items-center my-4">
										<p class="text-center fw-bold mx-3 mb-0">Skills, Interest, and Socio-economic Background</p>
									</div>
									<div class="col-12">
										<p id="" class="d-block form-label">Based on yuor self-assesment, select the skills that are applicable to you...</p>
										<div class="row">
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">Universal Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCommunicationSkills" name="skiCommunicationSkills" value="1" <?php if (strpos($skiCommunicationSkills1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiCommunicationSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to convey thoughts, ideas, or information effectively to others through various means, such as speaking, writing, or listening.">Communication Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCriticalThinking" name="skiCriticalThinking" value="1" <?php if (strpos($skiCriticalThinking1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiCriticalThinking" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to analyze, evaluate, and reason about information and situations in a logical and thoughtful manner to make informed decisions.">Critical Thinking</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiReadingComprehension" name="skiReadingComprehension" value="1" <?php if (strpos($skiReadingComprehension1, "1") !== false) {
																																													echo " checked";
																																												} ?>>
														<label class="form-check-label" for="skiReadingComprehension" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of understanding and interpreting written text, including identifying key ideas and details.">Reading Comprehension</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiProblemSolving" name="skiProblemSolving" value="1" <?php if (strpos($skiProblemSolving1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiProblemSolving" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capability to identify challenges, analyze them, and develop effective solutions or strategies to overcome them.">Problem Solving</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiResearchSkills" name="skiResearchSkills" value="1" <?php if (strpos($skiResearchSkills1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiResearchSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The aptitude to gather, assess, and synthesize information from various sources to acquire knowledge and address questions or issues.">Research Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiDigitalLiteracy" name="skiDigitalLiteracy" value="1" <?php if (strpos($skiDigitalLiteracy1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiDigitalLiteracy" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in using digital devices and technology to access, understand, and communicate information effectively in the digital age.">Digital Literacy</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiInnovative" name="skiInnovative" value="1" <?php if (strpos($skiInnovative1, "1") !== false) {
																																								echo " checked";
																																							} ?>>
														<label class="form-check-label" for="skiInnovative" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to generate new ideas, concepts, or approaches to solve problems, create opportunities, or enhance existing processes.">Innovative</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiTimeManagement" name="skiTimeManagement" value="1" <?php if (strpos($skiTimeManagement1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiTimeManagement" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of efficiently organizing and prioritizing tasks and activities to make the most of available time.">Time Management</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAdaptability" name="skiAdaptability" value="1" <?php if (strpos($skiAdaptability1, "1") !== false) {
																																									echo " checked";
																																								} ?>>
														<label class="form-check-label" for="skiAdaptability" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to adjust and thrive in changing circumstances, embracing new situations and challenges with flexibility.">Adaptability</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">STEM Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiScientificInquiry" name="skiScientificInquiry" value="1" <?php if (strpos($skiScientificInquiry1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiScientificInquiry" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of asking questions, conducting investigations, and drawing conclusions based on evidence to understand the natural world.">Scientific Inquiry</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiMathematicalSkills" name="skiMathematicalSkills" value="1" <?php if (strpos($skiMathematicalSkills1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiMathematicalSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to use mathematical concepts, operations, and methods to solve problems and make sense of numerical information.">Mathematical Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiLogicalReasoning" name="skiLogicalReasoning" value="1" <?php if (strpos($skiLogicalReasoning1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiLogicalReasoning" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to think rationally and systematically, making well-structured, coherent arguments and decisions.">Logical Reasoning</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiLabExperimentalSkills" name="skiLabExperimentalSkills" value="1" <?php if (strpos($skiLabExperimentalSkills1, "1") !== false) {
																																													echo " checked";
																																												} ?>>
														<label class="form-check-label" for="skiLabExperimentalSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in conducting experiments, including using equipment, collecting data, and following scientific procedures accurately.">Lab and Experimental Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAnalyticalSkills" name="skiAnalyticalSkills" value="1" <?php if (strpos($skiAnalyticalSkills1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiAnalyticalSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of examining and interpreting complex data or information to identify patterns, trends, or insights.">Analytical Skills</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">HUMSS Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiResearchWriting" name="skiResearchWriting" value="1" <?php if (strpos($skiResearchWriting1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiResearchWriting" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to gather information systematically and communicate ideas effectively through written means.">Research and Writing</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiSociologicalAnalysis" name="skiSociologicalAnalysis" value="1" <?php if (strpos($skiSociologicalAnalysis1, "1") !== false) {
																																													echo " checked";
																																												} ?>>
														<label class="form-check-label" for="skiSociologicalAnalysis" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of examining and understanding social phenomena, behavior, and institutions, often through a critical and systematic approach.">Sociological Analysis</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCulturalCompetence" name="skiCulturalCompetence" value="1" <?php if (strpos($skiCulturalCompetence1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiCulturalCompetence" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to interact and work effectively with people from diverse cultural backgrounds while respecting and valuing their beliefs and practices.">Cultural Competence</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEthicalReasoning" name="skiEthicalReasoning" value="1" <?php if (strpos($skiEthicalReasoning1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiEthicalReasoning" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of evaluating moral dilemmas and making decisions that align with ethical principles and values.">Ethical Reasoning</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiHistoryPoliticalScience" name="skiHistoryPoliticalScience" value="1" <?php if (strpos($skiHistoryPoliticalScience1, "1") !== false) {
																																														echo " checked";
																																													} ?>>
														<label class="form-check-label" for="skiHistoryPoliticalScience" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in studying and interpreting historical events and political systems to gain insights into the past and present.">History and Political Science</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">ABM Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiFinancialLiteracy" name="skiFinancialLiteracy" value="1" <?php if (strpos($skiFinancialLiteracy1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiFinancialLiteracy" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The understanding of financial concepts and practices, enabling informed financial decision-making.">Financial Literacy</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiBusinessPlanning" name="skiBusinessPlanning" value="1" <?php if (strpos($skiBusinessPlanning1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiBusinessPlanning" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of developing a detailed strategy for achieving business goals, including financial, operational, and marketing plans.">Business Planning</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiMarketing" name="skiMarketing" value="1" <?php if (strpos($skiMarketing1, "1") !== false) {
																																							echo " checked";
																																						} ?>>
														<label class="form-check-label" for="skiMarketing" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The practice of promoting and selling products or services by understanding customer needs and creating strategies to meet them.">Marketing</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAccounting" name="skiAccounting" value="1" <?php if (strpos($skiAccounting1, "1") !== false) {
																																								echo " checked";
																																							} ?>>
														<label class="form-check-label" for="skiAccounting" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The systematic recording, reporting, and analysis of financial transactions to track a business's financial health.">Accounting</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEntrepreneurship" name="skiEntrepreneurship" value="1" <?php if (strpos($skiEntrepreneurship1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiEntrepreneurship" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to identify business opportunities, take calculated risks, and create and manage successful ventures.">Entrepreneurship</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEconomics" name="skiEconomics" value="1" <?php if (strpos($skiEconomics1, "1") !== false) {
																																							echo " checked";
																																						} ?>>
														<label class="form-check-label" for="skiEconomics" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of how societies allocate resources and make decisions about production, distribution, and consumption.">Economics</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">TVL-ICT Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiComputerHardwareSoftware" name="skiComputerHardwareSoftware" value="1" <?php if (strpos($skiComputerHardwareSoftware1, "1") !== false) {
																																															echo " checked";
																																														} ?>>
														<label class="form-check-label" for="skiComputerHardwareSoftware" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Knowledge of computer components and software programs, including installation and maintenance.">Computer Hardware and Software</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiComputerNetworking" name="skiComputerNetworking" value="1" <?php if (strpos($skiComputerNetworking1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiComputerNetworking" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to set up, configure, and manage computer networks for data communication.">Computer Networking</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiWebDevelopment" name="skiWebDevelopment" value="1" <?php if (strpos($skiWebDevelopment1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiWebDevelopment" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of creating websites and web applications, involving coding, design, and functionality.">Web Development</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiProgramming" name="skiProgramming" value="1" <?php if (strpos($skiProgramming1, "1") !== false) {
																																								echo " checked";
																																							} ?>>
														<label class="form-check-label" for="skiProgramming" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Writing, testing, and maintaining the source code of computer programs to achieve specific tasks or functions.">Programming</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiTroubleshooting" name="skiTroubleshooting" value="1" <?php if (strpos($skiTroubleshooting1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiTroubleshooting" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to identify and resolve technical issues or problems in hardware, software, or systems.">Troubleshooting</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiGraphicsDesign" name="skiGraphicsDesign" value="1" <?php if (strpos($skiGraphicsDesign1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiGraphicsDesign" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Creating visual content and layouts for digital or print media, including images, illustrations, and multimedia elements.">Graphics Design</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">TVL-HE Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCulinarySkills" name="skiCulinarySkills" value="1" <?php if (strpos($skiCulinarySkills1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiCulinarySkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in food preparation, cooking techniques, and culinary arts.">Culinary Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiSewingFashionDesign" name="skiSewingFashionDesign" value="1" <?php if (strpos($skiSewingFashionDesign1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiSewingFashionDesign" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to create and tailor clothing, including sewing, pattern-making, and fashion design.">Sewing and Fashion Design</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiInteriorDesign" name="skiInteriorDesign" value="1" <?php if (strpos($skiInteriorDesign1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiInteriorDesign" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Planning and decorating interior spaces to create functional and aesthetically pleasing environments.">Interior Design</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiChildcareFamilyServices" name="skiChildcareFamilyServices" value="1" <?php if (strpos($skiChildcareFamilyServices1, "1") !== false) {
																																														echo " checked";
																																													} ?>>
														<label class="form-check-label" for="skiChildcareFamilyServices" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Providing care, support, and services for children and families, often including early childhood education and child development.">Childcare and Family Services</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiNutritionFoodSafety" name="skiNutritionFoodSafety" value="1" <?php if (strpos($skiNutritionFoodSafety1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiNutritionFoodSafety" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Knowledge and practices related to proper nutrition, dietary planning, and ensuring the safety of food consumption.">Nutrition and Food Safety</label>
													</div>
												</div>
											</div>
										</div>
										<br>
										<br>
										<br>
										<p id="" class="d-block form-label">Rate your level of interest in learning the following subject from 1 to 5 where:</p>
										<p id="" class="d-block form-label">1 - Not at all interested, 2 - Slightly interested, 3 - Moderately interested, 4 - Very interested, 5 - Extremely interested</p>
										<div class="row text-start">
											<div class="col-12 col-md-6">
												<div>
													<label for="intCalculus" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of continuous change and mathematical analysis.">Calculus</label>
													<input type="range" class="form-range" min="0" max="5" id="intCalculus" name="intCalculus" value="<?php echo $intCalculus1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBiology" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The exploration of living organisms and their processes.">Biology</label>
													<input type="range" class="form-range" min="0" max="5" id="intBiology" name="intBiology" value="<?php echo $intBiology1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPhysics" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The investigation of matter, energy, and the fundamental forces of the universe.">Physics</label>
													<input type="range" class="form-range" min="0" max="5" id="intPhysics" name="intPhysics" value="<?php echo $intPhysics1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intChemistry" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of substances, their properties, and chemical reactions.">Chemistry</label>
													<input type="range" class="form-range" min="0" max="5" id="intChemistry" name="intChemistry" value="<?php echo $intChemistry1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCreativeWriting" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The practice of expressing thoughts and ideas through imaginative written works.">Creative Writing</label>
													<input type="range" class="form-range" min="0" max="5" id="intCreativeWriting" name="intCreativeWriting" value="<?php echo $intCreativeWriting1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCreativeNonfiction" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Crafting factual narratives in engaging and artistic ways.">Creative Nonfiction</label>
													<input type="range" class="form-range" min="0" max="5" id="intCreativeNonfiction" name="intCreativeNonfiction" value="<?php echo $intCreativeNonfiction1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intIntroWorldReligionsBeliefSystems" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Exploring diverse religious beliefs and their impact on societies.">Introduction to World Religions and Belief Systems</label>
													<input type="range" class="form-range" min="0" max="5" id="intIntroWorldReligionsBeliefSystems" name="intIntroWorldReligionsBeliefSystems" value="<?php echo $intIntroWorldReligionsBeliefSystems1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPhilippinePoliticsGovernance" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Examining political systems and governance in the Philippines.">Philippine Politics and Governance</label>
													<input type="range" class="form-range" min="0" max="5" id="intPhilippinePoliticsGovernance" name="intPhilippinePoliticsGovernance" value="<?php echo $intPhilippinePoliticsGovernance1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intDisciplinesIdeasSocialSciences" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="An overview of various social science fields.">Disciplines and Ideas in the Social Sciences</label>
													<input type="range" class="form-range" min="0" max="5" id="intDisciplinesIdeasSocialSciences" name="intDisciplinesIdeasSocialSciences" value="<?php echo $intDisciplinesIdeasSocialSciences1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intAppliedEconomics" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Applying economic principles to real-world situations.">Applied Economics</label>
													<input type="range" class="form-range" min="0" max="5" id="intAppliedEconomics" name="intAppliedEconomics" value="<?php echo $intAppliedEconomics1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessEthicsSocialResponsibility" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Exploring ethical issues in business and corporate social responsibility.">Business Ethics and Social Responsibility</label>
													<input type="range" class="form-range" min="0" max="5" id="intBusinessEthicsSocialResponsibility" name="intBusinessEthicsSocialResponsibility" value="<?php echo $intBusinessEthicsSocialResponsibility1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFundamentalsABM" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Introduction to Accounting, Business, and Management principles.">Fundamentals of ABM</label>
													<input type="range" class="form-range" min="0" max="5" id="intFundamentalsABM" name="intFundamentalsABM" value="<?php echo $intFundamentalsABM1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessMath" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Mathematical concepts used in business and finance.">Business Math</label>
													<input type="range" class="form-range" min="0" max="5" id="intBusinessMath" name="intBusinessMath" value="<?php echo $intBusinessMath1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessFinance" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Understanding financial management and investment.">Business Finance</label>
													<input type="range" class="form-range" min="0" max="5" id="intBusinessFinance" name="intBusinessFinance" value="<?php echo $intBusinessFinance1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intOrganizationManagement" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Principles of organizational structure and management.">Organization and Management</label>
													<input type="range" class="form-range" min="0" max="5" id="intOrganizationManagement" name="intOrganizationManagement" value="<?php echo $intOrganizationManagement1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPrinciplesMarketing" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Basics of marketing strategies and consumer behavior.">Principles in Marketing</label>
													<input type="range" class="form-range" min="0" max="5" id="intPrinciplesMarketing" name="intPrinciplesMarketing" value="<?php echo $intPrinciplesMarketing1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intComputerProgramming" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Learning to write and develop computer programs.">Computer Programming</label>
													<input type="range" class="form-range" min="0" max="5" id="intComputerProgramming" name="intComputerProgramming" value="<?php echo $intComputerProgramming1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intComputerSystemServicing" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Maintaining and repairing computer systems.">Computer System Servicing</label>
													<input type="range" class="form-range" min="0" max="5" id="intComputerSystemServicing" name="intComputerSystemServicing" value="<?php echo $intComputerSystemServicing1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intContactCenterServices" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Skills for customer service and communication.">Contact Center Services</label>
													<input type="range" class="form-range" min="0" max="5" id="intContactCenterServices" name="intContactCenterServices" value="<?php echo $intContactCenterServices1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCISCOComputerNetworking" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Understanding network systems and Cisco technology.">CISCO Computer Networking</label>
													<input type="range" class="form-range" min="0" max="5" id="intCISCOComputerNetworking" name="intCISCOComputerNetworking" value="<?php echo $intCISCOComputerNetworking1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intAnimationIllustration" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Creating animations and illustrations using digital tools.">Animation / Illustration</label>
													<input type="range" class="form-range" min="0" max="5" id="intAnimationIllustration" name="intAnimationIllustration" value="<?php echo $intAnimationIllustration1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCookery" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Culinary skills and cooking techniques.">Cookery</label>
													<input type="range" class="form-range" min="0" max="5" id="intCookery" name="intCookery" value="<?php echo $intCookery1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBreadPastryProduction" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Baking bread and pastries.">Bread and Pastry Production</label>
													<input type="range" class="form-range" min="0" max="5" id="intBreadPastryProduction" name="intBreadPastryProduction" value="<?php echo $intBreadPastryProduction1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFashionDesign" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Designing clothing and fashion items.">Fashion Design</label>
													<input type="range" class="form-range" min="0" max="5" id="intFashionDesign" name="intFashionDesign" value="<?php echo $intBreadPastryProduction1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFoodBeverages" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Managing food and beverage services.">Food and Beverages</label>
													<input type="range" class="form-range" min="0" max="5" id="intFoodBeverages" name="intFoodBeverages" value="<?php echo $intFoodBeverages1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intTailoring " class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Sewing and creating tailored clothing.">Tailoring </label>
													<input type="range" class="form-range" min="0" max="5" id="intTailoring" name="intTailoring" value="<?php echo $intTailoring1 ?>">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
										</div>
										<br>
										<br>
										<br>
										<p id="" class="d-block form-label">Select the total monthly income of your household.</p>
										<div class="form-floating mb-3">
											<select class="form-select" id="TotalHouseholdMonthlyIncome" name="TotalHouseholdMonthlyIncome" value="">
												<option selected value="SELECT">SELECT</option>
												
											<option value="less than P9,100" <?php if ($TotalHouseholdMonthlyIncome1 == "less than P9,100") { echo "selected"; } ?>>less than P9,100</option>
											<option value="P9,100-P18,200" <?php if ($TotalHouseholdMonthlyIncome1 == "P9,100-P18,200") { echo "selected"; } ?>>P9,100-P18,200</option>
											<option value="P18,200-P36,400" <?php if ($TotalHouseholdMonthlyIncome1 == "P18,200-P36,400") { echo "selected"; } ?>>P18,200-P36,400</option>
											<option value="P36,400-P63,700" <?php if ($TotalHouseholdMonthlyIncome1 == "P36,400-P63,700") { echo "selected"; } ?>>P36,400-P63,700</option>
											<option value="P63,700-P109,200" <?php if ($TotalHouseholdMonthlyIncome1 == "P63,700-P109,200") { echo "selected"; } ?>>P63,700-P109,200</option>
											<option value="P109,200-P182,000" <?php if ($TotalHouseholdMonthlyIncome1 == "P109,200-P182,000") { echo "selected"; } ?>>P109,200-P182,000</option>
											<option value="greater than P182,000" <?php if ($TotalHouseholdMonthlyIncome1 == "greater than P182,000") { echo "selected"; } ?>>greater than P182,000</option>

											</select>
											<label for="TotalHouseholdMonthlyIncome">Total Household Monthly Income</label>
										</div>
									</div>
									<div class="col-12">
										<div class="divider d-flex align-items-center my-4">
											<p class="text-center fw-bold mx-3 mb-0">Academic Performance</p>
										</div>
										<div class="row">
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadScience" name="acadScience">
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadScience1 == "100 - 95") { echo "selected"; } ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadScience1 == "94 - 90") { echo "selected"; } ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadScience1 == "89 - 80") { echo "selected"; } ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadScience1 == "79 - 75") { echo "selected"; } ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadScience1 == "74 - 70") { echo "selected"; } ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadScience1 == "69 - 0") { echo "selected"; } ?>>69 - 0</option>

													</select>
													<label for="acadScience" class="form-label">Science</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadMath" name="acadMath">
													<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadMath1 == "100 - 95") { echo "selected"; } ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadMath1 == "94 - 90") { echo "selected"; } ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadMath1 == "89 - 80") { echo "selected"; } ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadMath1 == "79 - 75") { echo "selected"; } ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadMath1 == "74 - 70") { echo "selected"; } ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadMath1 == "69 - 0") { echo "selected"; } ?>>69 - 0</option>
													</select>
													<label for="acadMath" class="form-label">Math</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadEnglish" name="acadEnglish">
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadEnglish1 == "100 - 95") { echo "selected"; } ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadEnglish1 == "94 - 90") { echo "selected"; } ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadEnglish1 == "89 - 80") { echo "selected"; } ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadEnglish1 == "79 - 75") { echo "selected"; } ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadEnglish1 == "74 - 70") { echo "selected"; } ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadEnglish1 == "69 - 0") { echo "selected"; } ?>>69 - 0</option>
													</select>
													<label for="acadEnglish" class="form-label">English</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadFilipino" name="acadFilipino">
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadFilipino1 == "100 - 95") { echo "selected"; } ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadFilipino1 == "94 - 90") { echo "selected"; } ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadFilipino1 == "89 - 80") { echo "selected"; } ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadFilipino1 == "79 - 75") { echo "selected"; } ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadFilipino1 == "74 - 70") { echo "selected"; } ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadFilipino1 == "69 - 0") { echo "selected"; } ?>>69 - 0</option>
													</select>
													<label for="acadFilipino" class="form-label">Filipino</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadICTRelatedSub" name="acadICTRelatedSub">
														<option selected value="SELECT">SELECT</option>
														<option value="N/A" <?php if ($acadICTRelatedSub1 == "N/A") { echo "selected"; } ?>>N/A</option>
														<option value="100 - 95" <?php if ($acadICTRelatedSub1 == "100 - 95") { echo "selected"; } ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadICTRelatedSub1  == "94 - 90") { echo "selected"; } ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadICTRelatedSub1 == "89 - 80") { echo "selected"; } ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadICTRelatedSub1 == "79 - 75") { echo "selected"; } ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadICTRelatedSub1 == "74 - 70") { echo "selected"; } ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadICTRelatedSub1 == "69 - 0") { echo "selected"; } ?>>69 - 0</option>
													</select>
													<label for="acadICTRelatedSub" class="form-label">ICT Related Subject</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadHERelatedSub" name="acadHERelatedSub">
														<option selected value="SELECT">SELECT</option>
														<option value="N/A" <?php if ($acadHERelatedSub1 == "N/A") { echo "selected"; } ?>>N/A</option>
														<option value="100 - 95" <?php if ($acadHERelatedSub1 == "100 - 95") { echo "selected"; } ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadHERelatedSub1  == "94 - 90") { echo "selected"; } ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadHERelatedSub1 == "89 - 80") { echo "selected"; } ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadHERelatedSub1 == "79 - 75") { echo "selected"; } ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadHERelatedSub1 == "74 - 70") { echo "selected"; } ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadHERelatedSub1 == "69 - 0") { echo "selected"; } ?>>69 - 0</option>
													</select>
													<label for="acadHERelatedSub" class="form-label">HE Related Subject</label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="divider d-flex align-items-center my-4">
											<p class="text-center fw-bold mx-3 mb-0">Career Path</p>
										</div>
										<div class="row">
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="CareerPath1" name="CareerPath1">
														<option value="Undecided" <?php if ($CareerPath11 == "Undecided") {
																						echo " selected";
																					} ?>>Undecided</option>
														<option value="Chemical Engineer" <?php if ($CareerPath11 == "Chemical Engineer") {
																								echo " selected";
																							} ?>>>Chemical Engineer</option>
														<option value="Industrial Engineer" <?php if ($CareerPath11 == "Industrial Engineer") {
																								echo "selected";
																							} ?>>Industrial Engineer</option>
														<option value="Biologist" <?php if ($CareerPath11 == "Biologist") {
																						echo "selected";
																					} ?>>Biologist</option>
														<option value="Mathematician" <?php if ($CareerPath11 == "Mathematician") {
																							echo "selected";
																						} ?>>Mathematician</option>
														<option value="Statistician" <?php if ($CareerPath11 == "Statistician") {
																							echo "selected";
																						} ?>>Statistician</option>
														<option value="Physicist" <?php if ($CareerPath11 == "Physicist") {
																						echo "selected";
																					} ?>>Physicist</option>
														<option value="Architect" <?php if ($CareerPath11 == "Architect") {
																						echo "selected";
																					} ?>>Architect</option>
														<option value="Doctor" <?php if ($CareerPath11 == "Doctor") {
																					echo "selected";
																				} ?>>Doctor</option>
														<option value="Registered Nurse" <?php if ($CareerPath11 == "Registered Nurse") {
																								echo "selected";
																							} ?>>Registered Nurse</option>
														<option value="Physical Therapist" <?php if ($CareerPath11 == "Physical Therapist") {
																								echo "selected";
																							} ?>>Physical Therapist</option>
														<option value="Pharmacist" <?php if ($CareerPath11 == "Pharmacist") {
																						echo "selected";
																					} ?>>Pharmacist</option>
														<option value="Civil Engineer" <?php if ($CareerPath11 == "Civil Engineer") {
																							echo "selected";
																						} ?>>Civil Engineer</option>
														<option value="Mechanical Engineer" <?php if ($CareerPath11 == "Mechanical Engineer") {
																								echo "selected";
																							} ?>>Mechanical Engineer</option>
														<option value="Food Technologist" <?php if ($CareerPath11 == "Food Technologist") {
																								echo "selected";
																							} ?>>Food Technologist</option>
														<option value="Environmental Scientist" <?php if ($CareerPath11 == "Environmental Scientist") {
																									echo "selected";
																								} ?>>Environmental Scientist</option>
														<option value="Social Scientist" <?php if ($CareerPath11 == "Social Scientist") {
																								echo "selected";
																							} ?>>Social Scientist</option>
														<option value="Psychologist" <?php if ($CareerPath11 == "Psychologist") {
																							echo "selected";
																						} ?>>Psychologist</option>
														<option value="Philosopher" <?php if ($CareerPath11 == "Philosopher") {
																						echo "selected";
																					} ?>>Philosopher</option>
														<option value="Social Worker" <?php if ($CareerPath11 == "Social Worker") {
																							echo "selected";
																						} ?>>Social Worker</option>
														<option value="Political Scientist" <?php if ($CareerPath11 == "Political Scientist") {
																								echo "selected";
																							} ?>>Political Scientist</option>
														<option value="Foreign Service Officer" <?php if ($CareerPath11 == "Foreign Service Officer") {
																									echo "selected";
																								} ?>>Foreign Service Officer</option>
														<option value="Police" <?php if ($CareerPath11 == "Police") {
																					echo "selected";
																				} ?>>Police</option>
														<option value="Fireman" <?php if ($CareerPath11 == "Fireman") {
																					echo "selected";
																				} ?>>Fireman</option>
														<option value="Soldier" <?php if ($CareerPath11 == "Soldier") {
																					echo "selected";
																				} ?>>Soldier</option>
														<option value="Communication Specialist" <?php if ($CareerPath11 == "Communication Specialist") {
																										echo "selected";
																									} ?>>Communication Specialist</option>
														<option value="Educator" <?php if ($CareerPath11 == "Educator") {
																						echo "selected";
																					} ?>>Educator</option>
														<option value="Journalist" <?php if ($CareerPath11 == "Journalist") {
																						echo "selected";
																					} ?>>Journalist</option>
														<option value="Broadcast Journalist" <?php if ($CareerPath11 == "Broadcast Journalist") {
																									echo "selected";
																								} ?>>Broadcast Journalist</option>
														<option value="Entrepreneur" <?php if ($CareerPath11 == "Entrepreneur") {
																							echo "selected";
																						} ?>>Entrepreneur</option>
														<option value="Tourism Manager" <?php if ($CareerPath11 == "Tourism Manager") {
																							echo "selected";
																						} ?>>Tourism Manager</option>
														<option value="Business Administrator" <?php if ($CareerPath11 == "Business Administrator") {
																									echo "selected";
																								} ?>>Business Administrator</option>
														<option value="Accountant" <?php if ($CareerPath11 == "Accountant") {
																						echo "selected";
																					} ?>>Accountant</option>
														<option value="Business Economist" <?php if ($CareerPath11 == "Business Economist") {
																								echo "selected";
																							} ?>>Business Economist</option>
														<option value="Banking and Finance Specialist" <?php if ($CareerPath11 == "Banking and Finance Specialist") {
																											echo "selected";
																										} ?>>Banking and Finance Specialist</option>
														<option value="Management Consultant" <?php if ($CareerPath11 == "Management Consultant") {
																									echo "selected";
																								} ?>>Management Consultant</option>
														<option value="IT Specialist" <?php if ($CareerPath11 == "IT Specialist") {
																							echo "selected";
																						} ?>>IT Specialist</option>
														<option value="Software Developer" <?php if ($CareerPath11 == "Software Developer") {
																								echo "selected";
																							} ?>>Software Developer</option>
														<option value="Computer Engineer" <?php if ($CareerPath11 == "Computer Engineer") {
																								echo "selected";
																							} ?>>Computer Engineer</option>
														<option value="Software Engineer" <?php if ($CareerPath11 == "Software Engineer") {
																								echo "selected";
																							} ?>>Software Engineer</option>
														<option value="Network Administrator" <?php if ($CareerPath11 == "Network Administrator") {
																									echo "selected";
																								} ?>>Network Administrator</option>
														<option value="Digital Media Designer" <?php if ($CareerPath11 == "Digital Media Designer") {
																									echo "selected";
																								} ?>>Digital Media Designer</option>
														<option value="Web Developer" <?php if ($CareerPath11 == "Web Developer") {
																							echo "selected";
																						} ?>>Web Developer</option>
														<option value="Cybersecurity Analyst" <?php if ($CareerPath11 == "Cybersecurity Analyst") {
																									echo "selected";
																								} ?>>Cybersecurity Analyst</option>
														<option value="Data Scientist" <?php if ($CareerPath11 == "Data Scientist") {
																							echo "selected";
																						} ?>>Data Scientist</option>
														<option value="Information Systems Manager" <?php if ($Career11 == "Information Systems Manager") {
																										echo "selected";
																									} ?>>Information Systems Manager</option>
														<option value="Chef" <?php if ($CareerPath11 == "Chef") {
																					echo "selected";
																				} ?>>Chef</option>
														<option value="Pastry Chef" <?php if ($CareerPath11 == "Pastry Chef") {
																						echo "selected";
																					} ?>>Pastry Chef</option>
														<option value="Fashion Designer" <?php if ($CareerPath11 == "Fashion Designer") {
																								echo "selected";
																							} ?>>Fashion Designer</option>
														<option value="Textile Designer" <?php if ($CareerPath11 == "Textile Designer") {
																								echo "selected";
																							} ?>>Textile Designer</option>
														<option value="Family and Consumer Sciences Educator" <?php if ($CareerPath11 == "Family and Consumer Sciences Educator") {
																													echo "selected";
																												} ?>>Family and Consumer Sciences Educator</option>
														<option value="Interior Designer" <?php if ($CareerPath11 == "Interior Designer") {
																								echo "selected";
																							} ?>>Interior Designer</option>
														<option value="Home Economics Educator" <?php if ($CareerPath11 == "Home Economics Educator") {
																									echo "selected";
																								} ?>>Home Economics Educator</option>
														<option value="Event Planner" <?php if ($CareerPath11 == "Event Planner") {
																							echo "selected";
																						} ?>>Event Planner</option>
														<option value="Nutritionist" <?php if ($CareerPath11 == "Nutritionist") {
																							echo "selected";
																						} ?>>Nutritionist</option>
														<option value="Dietitian" <?php if ($CareerPath11 == "Dietitian") {
																						echo "selected";
																					} ?>>Dietitian</option>
														<option value="Hotel Manager" <?php if ($CareerPath11 == "Hotel Manager") {
																							echo "selected";
																						} ?>>Hotel Manager</option>
														<option value="Restaurant Manager" <?php if ($CareerPath11 == "Restaurant Manager") {
																								echo "selected";
																							} ?>>Restaurant Manager</option>
														<option value="Child Life Specialist" <?php if ($CareerPath11 == "Child Life Specialist") {
																									echo "selected";
																								} ?>>Child Life Specialist</option>
														<option value="Family Counselor" <?php if ($CareerPath11 == "Family Counselor") {
																								echo "selected";
																							} ?>>Family Counselor</option>
														<option value="Food Service Manager" <?php if ($CareerPath11 == "Food Service Manager") {
																									echo "selected";
																								} ?>>Food Service Manager</option>
													</select>
													<label for="CareerPath1" class="form-label">Career - 1st Choice</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="CareerPath2" name="CareerPath2">
													<option value="N/A" <?php if ($CareerPath21 == "N/A") { echo "selected"; } ?>>N/A</option>
											<option value="Chemical Engineer" <?php if ($CareerPath21 == "Chemical Engineer") { echo "selected"; } ?>>Chemical Engineer</option>
											<option value="Industrial Engineer" <?php if ($CareerPath21 == "Industrial Engineer") { echo "selected"; } ?>>Industrial Engineer</option>
											<option value="Biologist" <?php if ($CareerPath21 == "Biologist") { echo "selected"; } ?>>Biologist</option>
											<option value="Mathematician" <?php if ($CareerPath21 == "Mathematician") { echo "selected"; } ?>>Mathematician</option>
											<option value="Statistician" <?php if ($CareerPath21 == "Statistician") { echo "selected"; } ?>>Statistician</option>
											<option value="Physicist" <?php if ($CareerPath21 == "Physicist") { echo "selected"; } ?>>Physicist</option>
											<option value="Architect" <?php if ($CareerPath21 == "Architect") { echo "selected"; } ?>>Architect</option>
											<option value="Doctor" <?php if ($CareerPath21 == "Doctor") { echo "selected"; } ?>>Doctor</option>
											<option value="Registered Nurse" <?php if ($CareerPath21 == "Registered Nurse") { echo "selected"; } ?>>Registered Nurse</option>
											<option value="Physical Therapist" <?php if ($CareerPath21 == "Physical Therapist") { echo "selected"; } ?>>Physical Therapist</option>
											<option value="Pharmacist" <?php if ($CareerPath21 == "Pharmacist") { echo "selected"; } ?>>Pharmacist</option>
											<option value="Civil Engineer" <?php if ($CareerPath21 == "Civil Engineer") { echo "selected"; } ?>>Civil Engineer</option>
											<option value="Mechanical Engineer" <?php if ($CareerPath21 == "Mechanical Engineer") { echo "selected"; } ?>>Mechanical Engineer</option>
											<option value="Food Technologist" <?php if ($CareerPath21 == "Food Technologist") { echo "selected"; } ?>>Food Technologist</option>
											<option value="Environmental Scientist" <?php if ($CareerPath21 == "Environmental Scientist") { echo "selected"; } ?>>Environmental Scientist</option>
											<option value="Social Scientist" <?php if ($CareerPath21 == "Social Scientist") { echo "selected"; } ?>>Social Scientist</option>
											<option value="Psychologist" <?php if ($CareerPath21 == "Psychologist") { echo "selected"; } ?>>Psychologist</option>
											<option value="Philosopher" <?php if ($CareerPath21 == "Philosopher") { echo "selected"; } ?>>Philosopher</option>
											<option value="Social Worker" <?php if ($CareerPath21 == "Social Worker") { echo "selected"; } ?>>Social Worker</option>
											<option value="Political Scientist" <?php if ($CareerPath21 == "Political Scientist") { echo "selected"; } ?>>Political Scientist</option>
											<option value="Foreign Service Officer" <?php if ($CareerPath21 == "Foreign Service Officer") { echo "selected"; } ?>>Foreign Service Officer</option>
											<option value="Police" <?php if ($CareerPath21 == "Police") { echo "selected"; } ?>>Police</option>
											<option value="Fireman" <?php if ($CareerPath21 == "Fireman") { echo "selected"; } ?>>Fireman</option>
											<option value="Soldier" <?php if ($CareerPath21 == "Soldier") { echo "selected"; } ?>>Soldier</option>
											<option value="Communication Specialist" <?php if ($CareerPath21 == "Communication Specialist") { echo "selected"; } ?>>Communication Specialist</option>
											<option value="Educator" <?php if ($CareerPath21 == "Educator") { echo "selected"; } ?>>Educator</option>
											<option value="Journalist" <?php if ($CareerPath21 == "Journalist") { echo "selected"; } ?>>Journalist</option>
											<option value="Broadcast Journalist" <?php if ($CareerPath21 == "Broadcast Journalist") { echo "selected"; } ?>>Broadcast Journalist</option>
											<option value="Entrepreneur" <?php if ($CareerPath21 == "Entrepreneur") { echo "selected"; } ?>>Entrepreneur</option>
											<option value="Tourism Manager" <?php if ($CareerPath21 == "Tourism Manager") { echo "selected"; } ?>>Tourism Manager</option>
											<option value="Business Administrator" <?php if ($CareerPath21 == "Business Administrator") { echo "selected"; } ?>>Business Administrator</option>
											<option value="Accountant" <?php if ($CareerPath21 == "Accountant") { echo "selected"; } ?>>Accountant</option>
											<option value="Business Economist" <?php if ($CareerPath21 == "Business Economist") { echo "selected"; } ?>>Business Economist</option>
											<option value="Banking and Finance Specialist" <?php if ($CareerPath21 == "Banking and Finance Specialist") { echo "selected"; } ?>>Banking and Finance Specialist</option>
											<option value="Management Consultant" <?php if ($CareerPath21 == "Management Consultant") { echo "selected"; } ?>>Management Consultant</option>
											<option value="IT Specialist" <?php if ($CareerPath21 == "IT Specialist") { echo "selected"; } ?>>IT Specialist</option>
											<option value="Software Developer" <?php if ($CareerPath21 == "Software Developer") { echo "selected"; } ?>>Software Developer</option>
											<option value="Computer Engineer" <?php if ($CareerPath21 == "Computer Engineer") { echo "selected"; } ?>>Computer Engineer</option>
											<option value="Software Engineer" <?php if ($CareerPath21 == "Software Engineer") { echo "selected"; } ?>>Software Engineer</option>
											<option value="Network Administrator" <?php if ($CareerPath21 == "Network Administrator") { echo "selected"; } ?>>Network Administrator</option>
											<option value="Digital Media Designer" <?php if ($CareerPath21 == "Digital Media Designer") { echo "selected"; } ?>>Digital Media Designer</option>
											<option value="Web Developer" <?php if ($CareerPath21 == "Web Developer") { echo "selected"; } ?>>Web Developer</option>
											<option value="Cybersecurity Analyst" <?php if ($CareerPath21 == "Cybersecurity Analyst") { echo "selected"; } ?>>Cybersecurity Analyst</option>
											<option value="Data Scientist" <?php if ($CareerPath21 == "Data Scientist") { echo "selected"; } ?>>Data Scientist</option>
											<option value="Information Systems Manager" <?php if ($CareerPath21 == "Information Systems Manager") { echo "selected"; } ?>>Information Systems Manager</option>
											<option value="Chef" <?php if ($CareerPath21 == "Chef") { echo "selected"; } ?>>Chef</option>
											<option value="Pastry Chef" <?php if ($CareerPath21 == "Pastry Chef") { echo "selected"; } ?>>Pastry Chef</option>
											<option value="Fashion Designer" <?php if ($CareerPath21 == "Fashion Designer") { echo "selected"; } ?>>Fashion Designer</option>
											<option value="Textile Designer" <?php if ($CareerPath21 == "Textile Designer") { echo "selected"; } ?>>Textile Designer</option>
											<option value="Family and Consumer Sciences Educator" <?php if ($CareerPath21 == "Family and Consumer Sciences Educator") { echo "selected"; } ?>>Family and Consumer Sciences Educator</option>
											<option value="Interior Designer" <?php if ($CareerPath21 == "Interior Designer") { echo "selected"; } ?>>Interior Designer</option>
											<option value="Home Economics Educator" <?php if ($CareerPath21 == "Home Economics Educator") { echo "selected"; } ?>>Home Economics Educator</option>
											<option value="Event Planner" <?php if ($CareerPath21 == "Event Planner") { echo "selected"; } ?>>Event Planner</option>
											<option value="Nutritionist" <?php if ($CareerPath21 == "Nutritionist") { echo "selected"; } ?>>Nutritionist</option>
											<option value="Dietitian" <?php if ($CareerPath21 == "Dietitian") { echo "selected"; } ?>>Dietitian</option>
											<option value="Hotel Manager" <?php if ($CareerPath21 == "Hotel Manager") { echo "selected"; } ?>>Hotel Manager</option>
											<option value="Restaurant Manager" <?php if ($CareerPath21 == "Restaurant Manager") { echo "selected"; } ?>>Restaurant Manager</option>
											<option value="Child Life Specialist" <?php if ($CareerPath21 == "Child Life Specialist") { echo "selected"; } ?>>Child Life Specialist</option>
											<option value="Family Counselor" <?php if ($CareerPath21 == "Family Counselor") { echo "selected"; } ?>>Family Counselor</option>
											<option value="Food Service Manager" <?php if ($CareerPath21 == "Food Service Manager") { echo "selected"; } ?>>Food Service Manager</option>
													</select>
													<label for="CareerPath2" class="form-label">Career - 2nd Choice</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="CareerPath3" name="CareerPath3">
													<option value="N/A" <?php if ($CareerPath31 == "N/A") { echo "selected"; } ?>>N/A</option>
													<option value="Chemical Engineer" <?php if ($CareerPath31 == "Chemical Engineer") { echo "selected"; } ?>>Chemical Engineer</option>
													<option value="Industrial Engineer" <?php if ($CareerPath31 == "Industrial Engineer") { echo "selected"; } ?>>Industrial Engineer</option>
													<option value="Biologist" <?php if ($CareerPath31 == "Biologist") { echo "selected"; } ?>>Biologist</option>
													<option value="Mathematician" <?php if ($CareerPath31 == "Mathematician") { echo "selected"; } ?>>Mathematician</option>
													<option value="Statistician" <?php if ($CareerPath31 == "Statistician") { echo "selected"; } ?>>Statistician</option>
													<option value="Physicist" <?php if ($CareerPath31 == "Physicist") { echo "selected"; } ?>>Physicist</option>
													<option value="Architect" <?php if ($CareerPath31 == "Architect") { echo "selected"; } ?>>Architect</option>
													<option value="Doctor" <?php if ($CareerPath31 == "Doctor") { echo "selected"; } ?>>Doctor</option>
													<option value="Registered Nurse" <?php if ($CareerPath31 == "Registered Nurse") { echo "selected"; } ?>>Registered Nurse</option>
													<option value="Physical Therapist" <?php if ($CareerPath31 == "Physical Therapist") { echo "selected"; } ?>>Physical Therapist</option>
													<option value="Pharmacist" <?php if ($CareerPath31 == "Pharmacist") { echo "selected"; } ?>>Pharmacist</option>
													<option value="Civil Engineer" <?php if ($CareerPath31 == "Civil Engineer") { echo "selected"; } ?>>Civil Engineer</option>
													<option value="Mechanical Engineer" <?php if ($CareerPath31 == "Mechanical Engineer") { echo "selected"; } ?>>Mechanical Engineer</option>
													<option value="Food Technologist" <?php if ($CareerPath31 == "Food Technologist") { echo "selected"; } ?>>Food Technologist</option>
													<option value="Environmental Scientist" <?php if ($CareerPath31 == "Environmental Scientist") { echo "selected"; } ?>>Environmental Scientist</option>
													<option value="Social Scientist" <?php if ($CareerPath31 == "Social Scientist") { echo "selected"; } ?>>Social Scientist</option>
													<option value="Psychologist" <?php if ($CareerPath31 == "Psychologist") { echo "selected"; } ?>>Psychologist</option>
													<option value="Philosopher" <?php if ($CareerPath31 == "Philosopher") { echo "selected"; } ?>>Philosopher</option>
													<option value="Social Worker" <?php if ($CareerPath31 == "Social Worker") { echo "selected"; } ?>>Social Worker</option>
													<option value="Political Scientist" <?php if ($CareerPath31 == "Political Scientist") { echo "selected"; } ?>>Political Scientist</option>
													<option value="Foreign Service Officer" <?php if ($CareerPath31 == "Foreign Service Officer") { echo "selected"; } ?>>Foreign Service Officer</option>
													<option value="Police" <?php if ($CareerPath31 == "Police") { echo "selected"; } ?>>Police</option>
													<option value="Fireman" <?php if ($CareerPath31 == "Fireman") { echo "selected"; } ?>>Fireman</option>
													<option value="Soldier" <?php if ($CareerPath31 == "Soldier") { echo "selected"; } ?>>Soldier</option>
													<option value="Communication Specialist" <?php if ($CareerPath31 == "Communication Specialist") { echo "selected"; } ?>>Communication Specialist</option>
													<option value="Educator" <?php if ($CareerPath31 == "Educator") { echo "selected"; } ?>>Educator</option>
													<option value="Journalist" <?php if ($CareerPath31 == "Journalist") { echo "selected"; } ?>>Journalist</option>
													<option value="Broadcast Journalist" <?php if ($CareerPath31 == "Broadcast Journalist") { echo "selected"; } ?>>Broadcast Journalist</option>
													<option value="Entrepreneur" <?php if ($CareerPath31 == "Entrepreneur") { echo "selected"; } ?>>Entrepreneur</option>
													<option value="Tourism Manager" <?php if ($CareerPath31 == "Tourism Manager") { echo "selected"; } ?>>Tourism Manager</option>
													<option value="Business Administrator" <?php if ($CareerPath31 == "Business Administrator") { echo "selected"; } ?>>Business Administrator</option>
													<option value="Accountant" <?php if ($CareerPath31 == "Accountant") { echo "selected"; } ?>>Accountant</option>
													<option value="Business Economist" <?php if ($CareerPath31 == "Business Economist") { echo "selected"; } ?>>Business Economist</option>
													<option value="Banking and Finance Specialist" <?php if ($CareerPath31 == "Banking and Finance Specialist") { echo "selected"; } ?>>Banking and Finance Specialist</option>
													<option value="Management Consultant" <?php if ($CareerPath31 == "Management Consultant") { echo "selected"; } ?>>Management Consultant</option>
													<option value="IT Specialist" <?php if ($CareerPath31 == "IT Specialist") { echo "selected"; } ?>>IT Specialist</option>
													<option value="Software Developer" <?php if ($CareerPath31 == "Software Developer") { echo "selected"; } ?>>Software Developer</option>
													<option value="Computer Engineer" <?php if ($CareerPath31 == "Computer Engineer") { echo "selected"; } ?>>Computer Engineer</option>
													<option value="Software Engineer" <?php if ($CareerPath31 == "Software Engineer") { echo "selected"; } ?>>Software Engineer</option>
													<option value="Network Administrator" <?php if ($CareerPath31 == "Network Administrator") { echo "selected"; } ?>>Network Administrator</option>
													<option value="Digital Media Designer" <?php if ($CareerPath31 == "Digital Media Designer") { echo "selected"; } ?>>Digital Media Designer</option>
													<option value="Web Developer" <?php if ($CareerPath31 == "Web Developer") { echo "selected"; } ?>>Web Developer</option>
													<option value="Cybersecurity Analyst" <?php if ($CareerPath31 == "Cybersecurity Analyst") { echo "selected"; } ?>>Cybersecurity Analyst</option>
													<option value="Data Scientist" <?php if ($CareerPath31 == "Data Scientist") { echo "selected"; } ?>>Data Scientist</option>
													<option value="Information Systems Manager" <?php if ($CareerPath31 == "Information Systems Manager") { echo "selected"; } ?>>Information Systems Manager</option>
													<option value="Chef" <?php if ($CareerPath31 == "Chef") { echo "selected"; } ?>>Chef</option>
													<option value="Pastry Chef" <?php if ($CareerPath31 == "Pastry Chef") { echo "selected"; } ?>>Pastry Chef</option>
													<option value="Fashion Designer" <?php if ($CareerPath31 == "Fashion Designer") { echo "selected"; } ?>>Fashion Designer</option>
													<option value="Textile Designer" <?php if ($CareerPath31 == "Textile Designer") { echo "selected"; } ?>>Textile Designer</option>
													<option value="Family and Consumer Sciences Educator" <?php if ($CareerPath31 == "Family and Consumer Sciences Educator") { echo "selected"; } ?>>Family and Consumer Sciences Educator</option>
													<option value="Interior Designer" <?php if ($CareerPath31 == "Interior Designer") { echo "selected"; } ?>>Interior Designer</option>
													<option value="Home Economics Educator" <?php if ($CareerPath31 == "Home Economics Educator") { echo "selected"; } ?>>Home Economics Educator</option>
													<option value="Event Planner" <?php if ($CareerPath31 == "Event Planner") { echo "selected"; } ?>>Event Planner</option>
													<option value="Nutritionist" <?php if ($CareerPath31 == "Nutritionist") { echo "selected"; } ?>>Nutritionist</option>
													<option value="Dietitian" <?php if ($CareerPath31 == "Dietitian") { echo "selected"; } ?>>Dietitian</option>
													<option value="Hotel Manager" <?php if ($CareerPath31 == "Hotel Manager") { echo "selected"; } ?>>Hotel Manager</option>
													<option value="Restaurant Manager" <?php if ($CareerPath31 == "Restaurant Manager") { echo "selected"; } ?>>Restaurant Manager</option>
													<option value="Child Life Specialist" <?php if ($CareerPath31 == "Child Life Specialist") { echo "selected"; } ?>>Child Life Specialist</option>
													<option value="Family Counselor" <?php if ($CareerPath31 == "Family Counselor") { echo "selected"; } ?>>Family Counselor</option>
													<option value="Food Service Manager" <?php if ($CareerPath31 == "Food Service Manager") { echo "selected"; } ?>>Food Service Manager</option>

													</select>
													<label for="CareerPath3" class="form-label">Career - 3rd Choice</label>
												</div>
											</div>
										</div>
									</div>

									<div class="d-grid gap-2 d-md-flex justify-content-end">
										<button type="submit" class="btn btn-primary form-button-text" id="submitButton" name="submit2"><span class="fw-bold">SUBMIT</span></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-lg-3 d-flex justify-content-center">
				<div class="card custcard border-light text-center" style="width: 320px; height: 300px;">
					<div class="card-header">
						<h4 class="fw-bold card-text-header">Results</h4>
					</div>
					<div class="card-body">
						<h4>Profile: <span style="color: red">NOT DONE</span></h4>
						<p class="text-muted">If Profile is already done, click Generate...</p>
						<form action="" method="post">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="result" placeholder="Result">
								<label for="result">RESULT</label>
							</div>
							<div class="d-grid gap-2 d-md-flex justify-content-end">
								<button type="button" class="btn btn-primary form-button-text"><span class="fw-bold">GENERATE</span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>


	<footer class="d-flex flex-column flex-md-row text-center justify-content-center py-4 px-4 px-xl-5">
		<!-- Copyright -->
		<div class="text-white mb-3 mb-md-0">
			Copyright © 2023. All rights reserved.
		</div>
		<!-- Copyright -->
	</footer>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./js/password-score.js"></script>
	<script type="text/javascript" src="./js/password-score-options.js"></script>
	<script type="text/javascript" src="./js/bootstrap-strength-meter.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#pass1').strengthMeter('text', {
				container: $('#passstrength'),
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

		function validateName(input) {
			var regex = /^[a-zA-Z0-9\s]*$/; // Regular expression to allow only alphanumeric characters and spaces

			if (!regex.test(input.value)) {
				input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, ''); // Remove any special characters
			}
		}

		const rangeInputs = document.querySelectorAll('.form-range');
		const rangeValueSpans = document.querySelectorAll('.rangeValue');

		rangeInputs.forEach((input, index) => {
			input.addEventListener('input', () => {
				rangeValueSpans[index].textContent = input.value;
			});

			rangeValueSpans[index].textContent = input.value;
		});

		window.addEventListener('DOMContentLoaded', function() {
			const careerPath1 = document.getElementById('CareerPath1');
			const careerPath2 = document.getElementById('CareerPath2');
			const careerPath3 = document.getElementById('CareerPath3');

			if (careerPath1.value === 'Undecided') {
				careerPath2.value = 'N/A';
				careerPath3.value = 'N/A';
				careerPath2.disabled = true;
				careerPath3.disabled = true;
			} else {
				careerPath2.disabled = false;
				careerPath3.disabled = false;
			}

			careerPath1.addEventListener('change', function() {
				if (careerPath1.value === 'Undecided') {
					careerPath2.value = 'N/A';
					careerPath3.value = 'N/A';
					careerPath2.disabled = true;
					careerPath3.disabled = true;
				} else {
					careerPath2.disabled = false;
					careerPath3.disabled = false;
				}
			});
		});

		const totalHouseholdIncomeSelect = document.getElementById('TotalHouseholdMonthlyIncome');
		const acadScience = document.getElementById('acadScience');
		const acadMath = document.getElementById('acadMath');
		const acadEnglish = document.getElementById('acadEnglish');
		const acadFilipino = document.getElementById('acadFilipino');
		const acadICTRelatedSub = document.getElementById('acadICTRelatedSub');
		const acadHERelatedSub = document.getElementById('acadHERelatedSub');
		const submitButton = document.getElementById('submitButton');

		submitButton.addEventListener('click', function() {
			let canSubmit = true;

			rangeInputs.forEach(rangeInputs => {
				if (rangeInputs.value === '0') {
					canSubmit = false;
					return;
				}
			});

			if (totalHouseholdIncomeSelect.value === 'SELECT') {
				canSubmit = false;
			}

			if (acadScience.value === 'SELECT') {
				canSubmit = false;
			}

			if (acadMath.value === 'SELECT') {
				canSubmit = false;
			}

			if (acadEnglish.value === 'SELECT') {
				canSubmit = false;
			}

			if (acadFilipino.value === 'SELECT') {
				canSubmit = false;
			}

			if (acadICTRelatedSub.value === 'SELECT') {
				canSubmit = false;
			}

			if (acadHERelatedSub.value === 'SELECT') {
				canSubmit = false;
			}

			if (!canSubmit) {
				swal({
					title: 'Please answer all fields!',
					icon: 'error',
					button: 'OK',
				});
			}
		});


		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
	</script>
</body>

</html>