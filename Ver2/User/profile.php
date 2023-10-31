<?php
//Starts the sessin and checks if the student is logged in or not
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
	<title>GUIDE</title>
	<link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
							<?php echo $_SESSION['fname']; //The name off the Student ?>
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
		<?php include "connection.php"; include "../vendor/autoload.php"; //include the connection file to the database and the OpenAI API Lib ?>
		<h2 class="fw-bold sub-title mt-3">Hello <?php echo $_SESSION["fname"]; //the name of the student ?>!</h2>
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
								//check if submit button for the account details has been clicked
								if (isset($_POST['submit1'])) {
									$sql='';
									//retrieve form data
									$id = $_SESSION['student'];
									$Fname = strtoupper(mysqli_real_escape_string($conn, $_POST['Fname']));
									$Mname = strtoupper(mysqli_real_escape_string($conn, $_POST['Mname']));
									$Lname = strtoupper(mysqli_real_escape_string($conn, $_POST['Lname']));
									$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
									$age = mysqli_real_escape_string($conn, $_POST['age']);
									$sex = mysqli_real_escape_string($conn, $_POST['sex']);
									$suffix = strtoupper(mysqli_real_escape_string($conn, $_POST['suffix']));
									$email = mysqli_real_escape_string($conn, $_POST['email']);
									$password = md5($_POST['password']);
									$cpassword = md5($_POST['cpassword']);

									//check if the password is empty or not
									if (!empty($_POST['password'])) { //password not empty
										if (!empty($_POST['cpassword'])) {//confirm password is not empty
											//check if the password and confirm password are the same
											if ($password !== $cpassword) {//not the same
												echo "<script>Swal.fire({
													title: 'PASSWORDS DO NOT MATCH!',
													text: 'Password and Confirm Password do not match!',
													icon: 'error',
													showConfirmButton: false,
                                                	timer: 5000
													});</script>";
												//echo "<script>window.location.href='profile.php';</script>";
												//exit; //exit the script if passwords do not match
											}else{//if everything is good, define the sql statement to update the student account details with password
												$sql = "UPDATE studentprofile SET Fname='$Fname', Mname='$Mname', Lname='$Lname', 
												address='$address', age='$age', sex='$sex', suffix='$suffix', email='$email', password='$password' WHERE lrn='$id'";
											}
										} else {//confirm password is empty
											echo "<script>Swal.fire({
												title: 'CONFIRM PASSWORD',
												text: 'Please confirm the password.',
												icon: 'info',
												showConfirmButton: false,
                                                timer: 5000
												});</script>";
											//echo "<script>window.location.href='profile.php';</script>";
										}
									} else {
										//if everything is good, define the sql statement to update the student account details without password
										$sql = "UPDATE studentprofile SET Fname='$Fname', Mname='$Mname', Lname='$Lname', 
										address='$address', age='$age', sex='$sex', suffix='$suffix', email='$email' WHERE lrn='$id'";
									}

									if(!empty($sql)){ //check if sql statement is not empty
										//execute the update query
										if (mysqli_query($conn, $sql)) {
											$affected_rows = mysqli_affected_rows($conn);

											if ($affected_rows > 0) {//check if a row in the database was updated successfully
												$_SESSION['fname'] = $Fname;
												echo "<script>Swal.fire({
													title: 'Successfully Updated',
													text: 'Student Account updated successfully!',
													icon: 'success',
													buttons: {
													confirm: true,
													},
												}).then((value) => {
													if (value) {
													document.location='profile.php';
													} else {
													document.location='profile.php';
													}
												});</script>";
											} else {//no changes were made to the record
												echo "<script>Swal.fire({
													title: 'NO CHANGES',
													text: 'No changes were made',
													icon: 'info',
													showConfirmButton: false,
                                                	timer: 5000
													});</script>";
											}
										} else {//error in updating the account
											echo "Error updating record: " . mysqli_error($conn);
										}
									}
								}

								//check if the student's lrn is available
								if (isset($_SESSION['student'])) {

									$user_id = $_SESSION['student']; //get the lrn

									//prep the select statement
									$sql1 = "SELECT * FROM studentprofile
					JOIN studentcareer ON studentprofile.lrn = studentcareer.lrn
					JOIN studentacad ON studentcareer.lrn = studentacad.lrn
					JOIN studentskill ON studentacad.lrn = studentskill.lrn
					JOIN studentinterest ON studentskill.lrn = studentinterest.lrn
					JOIN studentsocioeco  ON studentinterest.lrn = studentsocioeco.lrn
					JOIN result ON studentsocioeco.lrn = result.lrn WHERE studentprofile.lrn = '$user_id';";

									$result = $conn->query($sql1);

									if ($result->num_rows > 0) {

										//retrieve the students information
										while ($row = $result->fetch_assoc()) {

											$_SESSION['student'] = $row['lrn'];
											$_SESSION['fname'] = $row['Fname'];
											$lrn1 = $row['lrn'];
											$Fname1 = $row['Fname'];
											$Mname1 = $row['Mname'];
											$Lname1 = $row['Lname'];
											$address1 = $row['address'];
											$age1 = $row['age'];
											$suffix1 = $row['suffix'];
											$sex1 = $row['sex'];
											$email1 = $row['email'];
											$sectionID1 = $row['sectionID'];
											$schoolyrID1 = $row['schoolyrID'];
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
											//acadperf
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
											//result
											$strandResult = $row['MostSuitableStrand'];
										}
									}
								}
								?>


								<form class="row" action="" method="post">
									<div class="col-12 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="lrn" name="lrn" value="<?php echo $lrn1; ?>" oninput="validateLRN(this)" pattern=".{12}" title="Please enter exactly 12 digits" placeholder="Learner's Reference Number" disabled readonly>
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
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="sex" name="sex" value="<?php echo $sex1; ?>">
												<option value="M" <?php if ($sex1 == "M") {
																		echo " selected";
																	} ?>>Male</option>
												<option value="F" <?php if ($sex1 == "F") {
																		echo " selected";
																	} ?>>Female</option>
											</select>
											<label for="sex">Sex</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" id="age" name="age" value="<?php echo $age1; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Age" required>
											<label for="age">Age</label>
										</div>
									</div>
									<?php
									$sql2 = "SELECT * FROM section";

									$result = $conn->query($sql2);
									?>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="section" name="section" value="" disabled>
												<?php
												while ($row = $result->fetch_assoc()) {
													if ($sectionID1 == $row['sectionID']) {
														echo '<option value="' . $row['sectionID'] . '" selected>' . $row['sectionName'] . '</option>';
													} else {
														echo '<option value="' . $row['sectionID'] . '">' . $row['sectionName'] . '</option>';
													}
												}
												?>
											</select>
											<label for="section">Section</label>
										</div>
									</div>
									<?php
									$sql3 = "SELECT * FROM schoolyr";

									$result = $conn->query($sql3);
									?>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="schoolyr" name="schoolyr" value="" disabled>
												<?php
												while ($row = $result->fetch_assoc()) {
													if ($schoolyrID1 == $row['schoolyrID']) {
														echo '<option value="' . $row['schoolyrID'] . '" selected>' . $row['schoolyrName'] . '</option>';
													} else {
														echo '<option value="' . $row['schoolyrID'] . '">' . $row['schoolyrName'] . '</option>';
													}
												}
												?>
											</select>
											<label for="schoolyr">School Year</label>
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
								//check if the submit button for the student's profile has been clicked
								if (isset($_POST['submit2'])) {

									//retrieve form data
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
									//academic performance
									/* $acadScience = $_POST['acadScience'];
									$acadMath = $_POST['acadMath'];
									$acadEnglish = $_POST['acadEnglish'];
									$acadFilipino = $_POST['acadFilipino'];
									$acadICTRelatedSubject = $_POST['acadICTRelatedSub'];
									$acadHERelatedSubject = $_POST['acadHERelatedSub']; */
									//careerpath
									$CareerPath1 = $_POST['CareerPath1'];
									$CareerPath2 = $_POST['CareerPath2hid'];
									$CareerPath3 = $_POST['CareerPath3hid'];
									//socioeco
									$TotalHouseholdMonthlyIncome = $_POST['TotalHouseholdMonthlyIncome'];


									$variables = array(
										'intCalculus',
										'intBiology',
										'intPhysics',
										'intChemistry',
										'intCreativeWriting',
										'intCreativeNonfiction',
										'intIntroWorldReligionsBeliefSystems',
										'intPhilippinePoliticsGovernance',
										'intDisciplinesIdeasSocialSciences',
										'intAppliedEconomics',
										'intBusinessEthicsSocialResponsibility',
										'intFundamentalsABM',
										'intBusinessMath',
										'intBusinessFinance',
										'intOrganizationManagement',
										'intPrinciplesMarketing',
										'intComputerProgramming',
										'intComputerSystemServicing',
										'intContactCenterServices',
										'intCISCOComputerNetworking',
										'intAnimationIllustration',
										'intCookery',
										'intBreadPastryProduction',
										'intFashionDesign',
										'intFoodBeverages',
										'intTailoring'
									);

									//check if any variable has a value of zero
									$hasZeroValue = false;
									foreach ($variables as $variable) {
										if ($_POST[$variable] == 0) {
											$hasZeroValue = true;
											break;
										}
									}

									if ($hasZeroValue) { //if one of the vrables in interest has zero value
										echo "<script>Swal.fire({
												title: 'Please select a valid answer in the Interest Section!',
												icon: 'error',
												showConfirmButton: false,
                                                timer: 5000
											});</script>";
									} else {
										if ($_POST['TotalHouseholdMonthlyIncome'] == "SELECT") { //if the totalHouseholdMonthlyIncome has not been answered
											echo "<script>Swal.fire({
													title: 'Please select a valid answer in the Socioeconomic Section!',
													icon: 'error',
													showConfirmButton: false,
                                                	timer: 5000
												});</script>";
										} else {
											//prepare update query
											$sql4 = "UPDATE studentprofile
									JOIN studentinterest ON studentprofile.lrn = studentinterest.lrn
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
									
										studentcareer.CareerPath1 = '$CareerPath1',
										studentcareer.CareerPath2 = '$CareerPath2',
										studentcareer.CareerPath3 = '$CareerPath3',

										studentsocioeco.TotalHouseholdMonthlyIncome = '$TotalHouseholdMonthlyIncome'
									WHERE
										studentprofile.lrn = '$id'";


											//execute the update query
											if ($conn->query($sql4) === TRUE) {//if the update is successful
												echo "<script>Swal.fire({
													title: 'Successfully Updated',
													text: 'Student Profile updated successfully!',
													icon: 'success',
													buttons: {
													confirm: true,
													},
												}).then((value) => {
													if (value) {
													document.location='profile.php';
													} else {
													document.location='profile.php';
													}
												});</script>";
											} else {
												echo "Error updating record: " . $conn->error;
											}
										}
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

												<option value="less than P9,100" <?php if ($TotalHouseholdMonthlyIncome1 == "less than P9,100") {
																						echo "selected";
																					} ?>>less than P9,100</option>
												<option value="P9,100-P18,200" <?php if ($TotalHouseholdMonthlyIncome1 == "P9,100-P18,200") {
																					echo "selected";
																				} ?>>P9,100-P18,200</option>
												<option value="P18,200-P36,400" <?php if ($TotalHouseholdMonthlyIncome1 == "P18,200-P36,400") {
																					echo "selected";
																				} ?>>P18,200-P36,400</option>
												<option value="P36,400-P63,700" <?php if ($TotalHouseholdMonthlyIncome1 == "P36,400-P63,700") {
																					echo "selected";
																				} ?>>P36,400-P63,700</option>
												<option value="P63,700-P109,200" <?php if ($TotalHouseholdMonthlyIncome1 == "P63,700-P109,200") {
																						echo "selected";
																					} ?>>P63,700-P109,200</option>
												<option value="P109,200-P182,000" <?php if ($TotalHouseholdMonthlyIncome1 == "P109,200-P182,000") {
																						echo "selected";
																					} ?>>P109,200-P182,000</option>
												<option value="greater than P182,000" <?php if ($TotalHouseholdMonthlyIncome1 == "greater than P182,000") {
																							echo "selected";
																						} ?>>greater than P182,000</option>

											</select>
											<label for="TotalHouseholdMonthlyIncome">Total Household Monthly Income</label>
										</div>
									</div>
									<div class="col-12">
										<div class="divider d-flex align-items-center my-4">
											<p class="text-center fw-bold mx-3 mb-0">Academic Performance</p>
										</div>
										<p id="" class="d-block form-label">NOTE: Your teachers are the only one allowed to input this data...</p>
										<div class="row">
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadScience" name="acadScience" disabled>
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadScience1 == "100 - 95") {
																						echo "selected";
																					} ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadScience1 == "94 - 90") {
																					echo "selected";
																				} ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadScience1 == "89 - 80") {
																					echo "selected";
																				} ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadScience1 == "79 - 75") {
																					echo "selected";
																				} ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadScience1 == "74 - 70") {
																					echo "selected";
																				} ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadScience1 == "69 - 0") {
																					echo "selected";
																				} ?>>69 - 0</option>

													</select>
													<label for="acadScience" class="form-label">Science</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadMath" name="acadMath" disabled>
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadMath1 == "100 - 95") {
																						echo "selected";
																					} ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadMath1 == "94 - 90") {
																					echo "selected";
																				} ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadMath1 == "89 - 80") {
																					echo "selected";
																				} ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadMath1 == "79 - 75") {
																					echo "selected";
																				} ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadMath1 == "74 - 70") {
																					echo "selected";
																				} ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadMath1 == "69 - 0") {
																					echo "selected";
																				} ?>>69 - 0</option>
													</select>
													<label for="acadMath" class="form-label">Math</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadEnglish" name="acadEnglish" disabled>
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadEnglish1 == "100 - 95") {
																						echo "selected";
																					} ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadEnglish1 == "94 - 90") {
																					echo "selected";
																				} ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadEnglish1 == "89 - 80") {
																					echo "selected";
																				} ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadEnglish1 == "79 - 75") {
																					echo "selected";
																				} ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadEnglish1 == "74 - 70") {
																					echo "selected";
																				} ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadEnglish1 == "69 - 0") {
																					echo "selected";
																				} ?>>69 - 0</option>
													</select>
													<label for="acadEnglish" class="form-label">English</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadFilipino" name="acadFilipino" disabled>
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95" <?php if ($acadFilipino1 == "100 - 95") {
																						echo "selected";
																					} ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadFilipino1 == "94 - 90") {
																					echo "selected";
																				} ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadFilipino1 == "89 - 80") {
																					echo "selected";
																				} ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadFilipino1 == "79 - 75") {
																					echo "selected";
																				} ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadFilipino1 == "74 - 70") {
																					echo "selected";
																				} ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadFilipino1 == "69 - 0") {
																					echo "selected";
																				} ?>>69 - 0</option>
													</select>
													<label for="acadFilipino" class="form-label">Filipino</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadICTRelatedSub" name="acadICTRelatedSub" disabled>
														<option selected value="SELECT">SELECT</option>
														<option value="NA" <?php if ($acadICTRelatedSub1 == "NA") {
																				echo "selected";
																			} ?>>N/A</option>
														<option value="100 - 95" <?php if ($acadICTRelatedSub1 == "100 - 95") {
																						echo "selected";
																					} ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadICTRelatedSub1  == "94 - 90") {
																					echo "selected";
																				} ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadICTRelatedSub1 == "89 - 80") {
																					echo "selected";
																				} ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadICTRelatedSub1 == "79 - 75") {
																					echo "selected";
																				} ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadICTRelatedSub1 == "74 - 70") {
																					echo "selected";
																				} ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadICTRelatedSub1 == "69 - 0") {
																					echo "selected";
																				} ?>>69 - 0</option>
													</select>
													<label for="acadICTRelatedSub" class="form-label">ICT Related Subject</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadHERelatedSub" name="acadHERelatedSub" disabled>
														<option selected value="SELECT">SELECT</option>
														<option value="NA" <?php if ($acadHERelatedSub1 == "NA") {
																				echo "selected";
																			} ?>>N/A</option>
														<option value="100 - 95" <?php if ($acadHERelatedSub1 == "100 - 95") {
																						echo "selected";
																					} ?>>100 - 95</option>
														<option value="94 - 90" <?php if ($acadHERelatedSub1  == "94 - 90") {
																					echo "selected";
																				} ?>>94 - 90</option>
														<option value="89 - 80" <?php if ($acadHERelatedSub1 == "89 - 80") {
																					echo "selected";
																				} ?>>89 - 80</option>
														<option value="79 - 75" <?php if ($acadHERelatedSub1 == "79 - 75") {
																					echo "selected";
																				} ?>>79 - 75</option>
														<option value="74 - 70" <?php if ($acadHERelatedSub1 == "74 - 70") {
																					echo "selected";
																				} ?>>74 - 70</option>
														<option value="69 - 0" <?php if ($acadHERelatedSub1 == "69 - 0") {
																					echo "selected";
																				} ?>>69 - 0</option>
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
																						echo "selected";
																					} ?>>Undecided</option>
														<option value="Chemical Engineer" <?php if ($CareerPath11 == "Chemical Engineer") {
																								echo " selected";
																							} ?>>Chemical Engineer</option>
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
														<option value="Information Systems Manager" <?php if ($CareerPath11 == "Information Systems Manager") {
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
														<option value="Undecided" <?php if ($CareerPath21 == "Undecided") {
																						echo "selected";
																					} ?>>Undecided</option>
														<option value="NA" <?php if ($CareerPath21 == "NA") {
																				echo "selected";
																			} ?>>N/A</option>
														<option value="Chemical Engineer" <?php if ($CareerPath21 == "Chemical Engineer") {
																								echo "selected";
																							} ?>>Chemical Engineer</option>
														<option value="Industrial Engineer" <?php if ($CareerPath21 == "Industrial Engineer") {
																								echo "selected";
																							} ?>>Industrial Engineer</option>
														<option value="Biologist" <?php if ($CareerPath21 == "Biologist") {
																						echo "selected";
																					} ?>>Biologist</option>
														<option value="Mathematician" <?php if ($CareerPath21 == "Mathematician") {
																							echo "selected";
																						} ?>>Mathematician</option>
														<option value="Statistician" <?php if ($CareerPath21 == "Statistician") {
																							echo "selected";
																						} ?>>Statistician</option>
														<option value="Physicist" <?php if ($CareerPath21 == "Physicist") {
																						echo "selected";
																					} ?>>Physicist</option>
														<option value="Architect" <?php if ($CareerPath21 == "Architect") {
																						echo "selected";
																					} ?>>Architect</option>
														<option value="Doctor" <?php if ($CareerPath21 == "Doctor") {
																					echo "selected";
																				} ?>>Doctor</option>
														<option value="Registered Nurse" <?php if ($CareerPath21 == "Registered Nurse") {
																								echo "selected";
																							} ?>>Registered Nurse</option>
														<option value="Physical Therapist" <?php if ($CareerPath21 == "Physical Therapist") {
																								echo "selected";
																							} ?>>Physical Therapist</option>
														<option value="Pharmacist" <?php if ($CareerPath21 == "Pharmacist") {
																						echo "selected";
																					} ?>>Pharmacist</option>
														<option value="Civil Engineer" <?php if ($CareerPath21 == "Civil Engineer") {
																							echo "selected";
																						} ?>>Civil Engineer</option>
														<option value="Mechanical Engineer" <?php if ($CareerPath21 == "Mechanical Engineer") {
																								echo "selected";
																							} ?>>Mechanical Engineer</option>
														<option value="Food Technologist" <?php if ($CareerPath21 == "Food Technologist") {
																								echo "selected";
																							} ?>>Food Technologist</option>
														<option value="Environmental Scientist" <?php if ($CareerPath21 == "Environmental Scientist") {
																									echo "selected";
																								} ?>>Environmental Scientist</option>
														<option value="Social Scientist" <?php if ($CareerPath21 == "Social Scientist") {
																								echo "selected";
																							} ?>>Social Scientist</option>
														<option value="Psychologist" <?php if ($CareerPath21 == "Psychologist") {
																							echo "selected";
																						} ?>>Psychologist</option>
														<option value="Philosopher" <?php if ($CareerPath21 == "Philosopher") {
																						echo "selected";
																					} ?>>Philosopher</option>
														<option value="Social Worker" <?php if ($CareerPath21 == "Social Worker") {
																							echo "selected";
																						} ?>>Social Worker</option>
														<option value="Political Scientist" <?php if ($CareerPath21 == "Political Scientist") {
																								echo "selected";
																							} ?>>Political Scientist</option>
														<option value="Foreign Service Officer" <?php if ($CareerPath21 == "Foreign Service Officer") {
																									echo "selected";
																								} ?>>Foreign Service Officer</option>
														<option value="Police" <?php if ($CareerPath21 == "Police") {
																					echo "selected";
																				} ?>>Police</option>
														<option value="Fireman" <?php if ($CareerPath21 == "Fireman") {
																					echo "selected";
																				} ?>>Fireman</option>
														<option value="Soldier" <?php if ($CareerPath21 == "Soldier") {
																					echo "selected";
																				} ?>>Soldier</option>
														<option value="Communication Specialist" <?php if ($CareerPath21 == "Communication Specialist") {
																										echo "selected";
																									} ?>>Communication Specialist</option>
														<option value="Educator" <?php if ($CareerPath21 == "Educator") {
																						echo "selected";
																					} ?>>Educator</option>
														<option value="Journalist" <?php if ($CareerPath21 == "Journalist") {
																						echo "selected";
																					} ?>>Journalist</option>
														<option value="Broadcast Journalist" <?php if ($CareerPath21 == "Broadcast Journalist") {
																									echo "selected";
																								} ?>>Broadcast Journalist</option>
														<option value="Entrepreneur" <?php if ($CareerPath21 == "Entrepreneur") {
																							echo "selected";
																						} ?>>Entrepreneur</option>
														<option value="Tourism Manager" <?php if ($CareerPath21 == "Tourism Manager") {
																							echo "selected";
																						} ?>>Tourism Manager</option>
														<option value="Business Administrator" <?php if ($CareerPath21 == "Business Administrator") {
																									echo "selected";
																								} ?>>Business Administrator</option>
														<option value="Accountant" <?php if ($CareerPath21 == "Accountant") {
																						echo "selected";
																					} ?>>Accountant</option>
														<option value="Business Economist" <?php if ($CareerPath21 == "Business Economist") {
																								echo "selected";
																							} ?>>Business Economist</option>
														<option value="Banking and Finance Specialist" <?php if ($CareerPath21 == "Banking and Finance Specialist") {
																											echo "selected";
																										} ?>>Banking and Finance Specialist</option>
														<option value="Management Consultant" <?php if ($CareerPath21 == "Management Consultant") {
																									echo "selected";
																								} ?>>Management Consultant</option>
														<option value="IT Specialist" <?php if ($CareerPath21 == "IT Specialist") {
																							echo "selected";
																						} ?>>IT Specialist</option>
														<option value="Software Developer" <?php if ($CareerPath21 == "Software Developer") {
																								echo "selected";
																							} ?>>Software Developer</option>
														<option value="Computer Engineer" <?php if ($CareerPath21 == "Computer Engineer") {
																								echo "selected";
																							} ?>>Computer Engineer</option>
														<option value="Software Engineer" <?php if ($CareerPath21 == "Software Engineer") {
																								echo "selected";
																							} ?>>Software Engineer</option>
														<option value="Network Administrator" <?php if ($CareerPath21 == "Network Administrator") {
																									echo "selected";
																								} ?>>Network Administrator</option>
														<option value="Digital Media Designer" <?php if ($CareerPath21 == "Digital Media Designer") {
																									echo "selected";
																								} ?>>Digital Media Designer</option>
														<option value="Web Developer" <?php if ($CareerPath21 == "Web Developer") {
																							echo "selected";
																						} ?>>Web Developer</option>
														<option value="Cybersecurity Analyst" <?php if ($CareerPath21 == "Cybersecurity Analyst") {
																									echo "selected";
																								} ?>>Cybersecurity Analyst</option>
														<option value="Data Scientist" <?php if ($CareerPath21 == "Data Scientist") {
																							echo "selected";
																						} ?>>Data Scientist</option>
														<option value="Information Systems Manager" <?php if ($CareerPath21 == "Information Systems Manager") {
																										echo "selected";
																									} ?>>Information Systems Manager</option>
														<option value="Chef" <?php if ($CareerPath21 == "Chef") {
																					echo "selected";
																				} ?>>Chef</option>
														<option value="Pastry Chef" <?php if ($CareerPath21 == "Pastry Chef") {
																						echo "selected";
																					} ?>>Pastry Chef</option>
														<option value="Fashion Designer" <?php if ($CareerPath21 == "Fashion Designer") {
																								echo "selected";
																							} ?>>Fashion Designer</option>
														<option value="Textile Designer" <?php if ($CareerPath21 == "Textile Designer") {
																								echo "selected";
																							} ?>>Textile Designer</option>
														<option value="Family and Consumer Sciences Educator" <?php if ($CareerPath21 == "Family and Consumer Sciences Educator") {
																													echo "selected";
																												} ?>>Family and Consumer Sciences Educator</option>
														<option value="Interior Designer" <?php if ($CareerPath21 == "Interior Designer") {
																								echo "selected";
																							} ?>>Interior Designer</option>
														<option value="Home Economics Educator" <?php if ($CareerPath21 == "Home Economics Educator") {
																									echo "selected";
																								} ?>>Home Economics Educator</option>
														<option value="Event Planner" <?php if ($CareerPath21 == "Event Planner") {
																							echo "selected";
																						} ?>>Event Planner</option>
														<option value="Nutritionist" <?php if ($CareerPath21 == "Nutritionist") {
																							echo "selected";
																						} ?>>Nutritionist</option>
														<option value="Dietitian" <?php if ($CareerPath21 == "Dietitian") {
																						echo "selected";
																					} ?>>Dietitian</option>
														<option value="Hotel Manager" <?php if ($CareerPath21 == "Hotel Manager") {
																							echo "selected";
																						} ?>>Hotel Manager</option>
														<option value="Restaurant Manager" <?php if ($CareerPath21 == "Restaurant Manager") {
																								echo "selected";
																							} ?>>Restaurant Manager</option>
														<option value="Child Life Specialist" <?php if ($CareerPath21 == "Child Life Specialist") {
																									echo "selected";
																								} ?>>Child Life Specialist</option>
														<option value="Family Counselor" <?php if ($CareerPath21 == "Family Counselor") {
																								echo "selected";
																							} ?>>Family Counselor</option>
														<option value="Food Service Manager" <?php if ($CareerPath21 == "Food Service Manager") {
																									echo "selected";
																								} ?>>Food Service Manager</option>
													</select>
													<label for="CareerPath2" class="form-label">Career - 2nd Choice</label>
													<input type="hidden" name="CareerPath2hid" id="CareerPath2hid" value="<?php echo $CareerPath21; ?>">
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="CareerPath3" name="CareerPath3">
														<option value="Undecided" <?php if ($CareerPath31 == "Undecided") {
																						echo "selected";
																					} ?>>Undecided</option>
														<option value="NA" <?php if ($CareerPath31 == "NA") {
																				echo "selected";
																			} ?>>N/A</option>
														<option value="Chemical Engineer" <?php if ($CareerPath31 == "Chemical Engineer") {
																								echo "selected";
																							} ?>>Chemical Engineer</option>
														<option value="Industrial Engineer" <?php if ($CareerPath31 == "Industrial Engineer") {
																								echo "selected";
																							} ?>>Industrial Engineer</option>
														<option value="Biologist" <?php if ($CareerPath31 == "Biologist") {
																						echo "selected";
																					} ?>>Biologist</option>
														<option value="Mathematician" <?php if ($CareerPath31 == "Mathematician") {
																							echo "selected";
																						} ?>>Mathematician</option>
														<option value="Statistician" <?php if ($CareerPath31 == "Statistician") {
																							echo "selected";
																						} ?>>Statistician</option>
														<option value="Physicist" <?php if ($CareerPath31 == "Physicist") {
																						echo "selected";
																					} ?>>Physicist</option>
														<option value="Architect" <?php if ($CareerPath31 == "Architect") {
																						echo "selected";
																					} ?>>Architect</option>
														<option value="Doctor" <?php if ($CareerPath31 == "Doctor") {
																					echo "selected";
																				} ?>>Doctor</option>
														<option value="Registered Nurse" <?php if ($CareerPath31 == "Registered Nurse") {
																								echo "selected";
																							} ?>>Registered Nurse</option>
														<option value="Physical Therapist" <?php if ($CareerPath31 == "Physical Therapist") {
																								echo "selected";
																							} ?>>Physical Therapist</option>
														<option value="Pharmacist" <?php if ($CareerPath31 == "Pharmacist") {
																						echo "selected";
																					} ?>>Pharmacist</option>
														<option value="Civil Engineer" <?php if ($CareerPath31 == "Civil Engineer") {
																							echo "selected";
																						} ?>>Civil Engineer</option>
														<option value="Mechanical Engineer" <?php if ($CareerPath31 == "Mechanical Engineer") {
																								echo "selected";
																							} ?>>Mechanical Engineer</option>
														<option value="Food Technologist" <?php if ($CareerPath31 == "Food Technologist") {
																								echo "selected";
																							} ?>>Food Technologist</option>
														<option value="Environmental Scientist" <?php if ($CareerPath31 == "Environmental Scientist") {
																									echo "selected";
																								} ?>>Environmental Scientist</option>
														<option value="Social Scientist" <?php if ($CareerPath31 == "Social Scientist") {
																								echo "selected";
																							} ?>>Social Scientist</option>
														<option value="Psychologist" <?php if ($CareerPath31 == "Psychologist") {
																							echo "selected";
																						} ?>>Psychologist</option>
														<option value="Philosopher" <?php if ($CareerPath31 == "Philosopher") {
																						echo "selected";
																					} ?>>Philosopher</option>
														<option value="Social Worker" <?php if ($CareerPath31 == "Social Worker") {
																							echo "selected";
																						} ?>>Social Worker</option>
														<option value="Political Scientist" <?php if ($CareerPath31 == "Political Scientist") {
																								echo "selected";
																							} ?>>Political Scientist</option>
														<option value="Foreign Service Officer" <?php if ($CareerPath31 == "Foreign Service Officer") {
																									echo "selected";
																								} ?>>Foreign Service Officer</option>
														<option value="Police" <?php if ($CareerPath31 == "Police") {
																					echo "selected";
																				} ?>>Police</option>
														<option value="Fireman" <?php if ($CareerPath31 == "Fireman") {
																					echo "selected";
																				} ?>>Fireman</option>
														<option value="Soldier" <?php if ($CareerPath31 == "Soldier") {
																					echo "selected";
																				} ?>>Soldier</option>
														<option value="Communication Specialist" <?php if ($CareerPath31 == "Communication Specialist") {
																										echo "selected";
																									} ?>>Communication Specialist</option>
														<option value="Educator" <?php if ($CareerPath31 == "Educator") {
																						echo "selected";
																					} ?>>Educator</option>
														<option value="Journalist" <?php if ($CareerPath31 == "Journalist") {
																						echo "selected";
																					} ?>>Journalist</option>
														<option value="Broadcast Journalist" <?php if ($CareerPath31 == "Broadcast Journalist") {
																									echo "selected";
																								} ?>>Broadcast Journalist</option>
														<option value="Entrepreneur" <?php if ($CareerPath31 == "Entrepreneur") {
																							echo "selected";
																						} ?>>Entrepreneur</option>
														<option value="Tourism Manager" <?php if ($CareerPath31 == "Tourism Manager") {
																							echo "selected";
																						} ?>>Tourism Manager</option>
														<option value="Business Administrator" <?php if ($CareerPath31 == "Business Administrator") {
																									echo "selected";
																								} ?>>Business Administrator</option>
														<option value="Accountant" <?php if ($CareerPath31 == "Accountant") {
																						echo "selected";
																					} ?>>Accountant</option>
														<option value="Business Economist" <?php if ($CareerPath31 == "Business Economist") {
																								echo "selected";
																							} ?>>Business Economist</option>
														<option value="Banking and Finance Specialist" <?php if ($CareerPath31 == "Banking and Finance Specialist") {
																											echo "selected";
																										} ?>>Banking and Finance Specialist</option>
														<option value="Management Consultant" <?php if ($CareerPath31 == "Management Consultant") {
																									echo "selected";
																								} ?>>Management Consultant</option>
														<option value="IT Specialist" <?php if ($CareerPath31 == "IT Specialist") {
																							echo "selected";
																						} ?>>IT Specialist</option>
														<option value="Software Developer" <?php if ($CareerPath31 == "Software Developer") {
																								echo "selected";
																							} ?>>Software Developer</option>
														<option value="Computer Engineer" <?php if ($CareerPath31 == "Computer Engineer") {
																								echo "selected";
																							} ?>>Computer Engineer</option>
														<option value="Software Engineer" <?php if ($CareerPath31 == "Software Engineer") {
																								echo "selected";
																							} ?>>Software Engineer</option>
														<option value="Network Administrator" <?php if ($CareerPath31 == "Network Administrator") {
																									echo "selected";
																								} ?>>Network Administrator</option>
														<option value="Digital Media Designer" <?php if ($CareerPath31 == "Digital Media Designer") {
																									echo "selected";
																								} ?>>Digital Media Designer</option>
														<option value="Web Developer" <?php if ($CareerPath31 == "Web Developer") {
																							echo "selected";
																						} ?>>Web Developer</option>
														<option value="Cybersecurity Analyst" <?php if ($CareerPath31 == "Cybersecurity Analyst") {
																									echo "selected";
																								} ?>>Cybersecurity Analyst</option>
														<option value="Data Scientist" <?php if ($CareerPath31 == "Data Scientist") {
																							echo "selected";
																						} ?>>Data Scientist</option>
														<option value="Information Systems Manager" <?php if ($CareerPath31 == "Information Systems Manager") {
																										echo "selected";
																									} ?>>Information Systems Manager</option>
														<option value="Chef" <?php if ($CareerPath31 == "Chef") {
																					echo "selected";
																				} ?>>Chef</option>
														<option value="Pastry Chef" <?php if ($CareerPath31 == "Pastry Chef") {
																						echo "selected";
																					} ?>>Pastry Chef</option>
														<option value="Fashion Designer" <?php if ($CareerPath31 == "Fashion Designer") {
																								echo "selected";
																							} ?>>Fashion Designer</option>
														<option value="Textile Designer" <?php if ($CareerPath31 == "Textile Designer") {
																								echo "selected";
																							} ?>>Textile Designer</option>
														<option value="Family and Consumer Sciences Educator" <?php if ($CareerPath31 == "Family and Consumer Sciences Educator") {
																													echo "selected";
																												} ?>>Family and Consumer Sciences Educator</option>
														<option value="Interior Designer" <?php if ($CareerPath31 == "Interior Designer") {
																								echo "selected";
																							} ?>>Interior Designer</option>
														<option value="Home Economics Educator" <?php if ($CareerPath31 == "Home Economics Educator") {
																									echo "selected";
																								} ?>>Home Economics Educator</option>
														<option value="Event Planner" <?php if ($CareerPath31 == "Event Planner") {
																							echo "selected";
																						} ?>>Event Planner</option>
														<option value="Nutritionist" <?php if ($CareerPath31 == "Nutritionist") {
																							echo "selected";
																						} ?>>Nutritionist</option>
														<option value="Dietitian" <?php if ($CareerPath31 == "Dietitian") {
																						echo "selected";
																					} ?>>Dietitian</option>
														<option value="Hotel Manager" <?php if ($CareerPath31 == "Hotel Manager") {
																							echo "selected";
																						} ?>>Hotel Manager</option>
														<option value="Restaurant Manager" <?php if ($CareerPath31 == "Restaurant Manager") {
																								echo "selected";
																							} ?>>Restaurant Manager</option>
														<option value="Child Life Specialist" <?php if ($CareerPath31 == "Child Life Specialist") {
																									echo "selected";
																								} ?>>Child Life Specialist</option>
														<option value="Family Counselor" <?php if ($CareerPath31 == "Family Counselor") {
																								echo "selected";
																							} ?>>Family Counselor</option>
														<option value="Food Service Manager" <?php if ($CareerPath31 == "Food Service Manager") {
																									echo "selected";
																								} ?>>Food Service Manager</option>

													</select>
													<label for="CareerPath3" class="form-label">Career - 3rd Choice</label>
													<input type="hidden" name="CareerPath3hid" id="CareerPath3hid" value="<?php echo $CareerPath31; ?>">
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
						<h4>Profile: <span id="profileStatus" style="color: red">NOT DONE</span></h4>
						<p class="text-muted">If Profile is already done, click Generate...</p>
						<form action="" method="post">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="result" placeholder="Result" value="<?php echo !empty($strandResult) ? $strandResult : ''; ?>">
								<label for="result">RESULT</label>
							</div>
							<div class="d-grid gap-2 d-md-flex justify-content-end">
								<button type="submit" id="generateBtn" name="generateBtn" class="btn btn-primary form-button-text"><span class="fw-bold">GENERATE</span></button>
							</div>
						</form>
						<?php
						//check if the generate button has been clicked
						if (isset($_POST['generateBtn'])) {
							$id = $_SESSION['student']; //get the lrn of the student
							
							//store the student's profile in an aaray
							$user_input = array(
								"skiCommunicationSkills" => $skiCommunicationSkills1,
								"skiCriticalThinking" => $skiCriticalThinking1,
								"skiReadingComprehension" => $skiReadingComprehension1,
								"skiProblemSolving" => $skiProblemSolving1,
								"skiResearchSkills" => $skiResearchSkills1,
								"skiDigitalLiteracy" => $skiDigitalLiteracy1,
								"skiInnovative" => $skiInnovative1,
								"skiTimeManagement" => $skiTimeManagement1,
								"skiAdaptability" => $skiAdaptability1,
								"skiScientificInquiry" => $skiScientificInquiry1,
								"skiMathematicalSkills" => $skiMathematicalSkills1,
								"skiLogicalReasoning" => $skiLogicalReasoning1,
								"skiLabExperimentalSkills" => $skiLabExperimentalSkills1,
								"skiAnalyticalSkills" => $skiAnalyticalSkills1,
								"skiResearchWriting" => $skiResearchWriting1,
								"skiSociologicalAnalysis" => $skiSociologicalAnalysis1,
								"skiCulturalCompetence" => $skiCulturalCompetence1,
								"skiEthicalReasoning" => $skiEthicalReasoning1,
								"skiHistoryPoliticalScience" => $skiHistoryPoliticalScience1,
								"skiFinancialLiteracy" => $skiFinancialLiteracy1,
								"skiBusinessPlanning" => $skiBusinessPlanning1,
								"skiMarketing" => $skiMarketing1,
								"skiAccounting" => $skiAccounting1,
								"skiEntrepreneurship" => $skiEntrepreneurship1,
								"skiEconomics" => $skiEconomics1,
								"skiComputerHardwareSoftware" => $skiComputerHardwareSoftware1,
								"skiComputerNetworking" => $skiComputerNetworking1,
								"skiWebDevelopment" => $skiWebDevelopment1,
								"skiProgramming" => $skiProgramming1,
								"skiTroubleshooting" => $skiTroubleshooting1,
								"skiGraphicsDesign" => $skiGraphicsDesign1,
								"skiCulinarySkills" => $skiCulinarySkills1,
								"skiSewingFashionDesign" => $skiSewingFashionDesign1,
								"skiInteriorDesign" => $skiInteriorDesign1,
								"skiChildcareFamilyServices" => $skiChildcareFamilyServices1,
								"skiNutritionFoodSafety" => $skiNutritionFoodSafety1,
								"intCalculus" => $intCalculus1,
								"intBiology" => $intBiology1,
								"intPhysics" => $intPhysics1,
								"intChemistry" => $intChemistry1,
								"intCreativeWriting" => $intCreativeWriting1,
								"intCreativeNonfiction" => $intCreativeNonfiction1,
								"intIntroWorldReligionsBeliefSystems" => $intIntroWorldReligionsBeliefSystems1,
								"intPhilippinePoliticsGovernance" => $intPhilippinePoliticsGovernance1,
								"intDisciplinesIdeasSocialSciences" => $intDisciplinesIdeasSocialSciences1,
								"intAppliedEconomics" => $intAppliedEconomics1,
								"intBusinessEthicsSocialResponsibility" => $intBusinessEthicsSocialResponsibility1,
								"intFundamentalsABM" => $intFundamentalsABM1,
								"intBusinessMath" => $intBusinessMath1,
								"intBusinessFinance" => $intBusinessFinance1,
								"intOrganizationManagement" => $intOrganizationManagement1,
								"intPrinciplesMarketing" => $intPrinciplesMarketing1,
								"intComputerProgramming" => $intComputerProgramming1,
								"intComputerSystemServicing" => $intComputerSystemServicing1,
								"intContactCenterServices" => $intContactCenterServices1,
								"intCISCOComputerNetworking" => $intCISCOComputerNetworking1,
								"intAnimationIllustration" => $intAnimationIllustration1,
								"intCookery" => $intCookery1,
								"intBreadPastryProduction" => $intBreadPastryProduction1,
								"intFashionDesign" => $intFashionDesign1,
								"intFoodBeverages" => $intFoodBeverages1,
								"intTailoring" => $intTailoring1,
								"TotalHouseholdMonthlyIncome" => $TotalHouseholdMonthlyIncome1,
								"acadScience" => $acadScience1,
								"acadMath" => $acadMath1,
								"acadEnglish" => $acadEnglish1,
								"acadFilipino" => $acadFilipino1,
								"acadICTRelatedSub" => $acadICTRelatedSub1,
								"acadHERelatedSub" => $acadHERelatedSub1,
								"CareerPath1" => $CareerPath11,
								"CareerPath2" => $CareerPath21,
								"CareerPath3" => $CareerPath31
							);

							//convert the user input array to a JSON string
							$input_json = json_encode($user_input);
							// echo "<p>Here is the result: " . $input_json;

							//put the json string into a file
							$json_file = '../Model/output.json';
							file_put_contents($json_file, $input_json);
							/*if (file_put_contents($json_file, $input_json)) {
                                echo "<p>JSON data saved to $json_file.</p>";
                            } else {
                                echo "<p>Error saving JSON data to $json_file.</p>";
                            }*/

							//construct the command to execute the R script with input JSON
							$command = $r_scriptexe_path . " " . $r_script_path . " " . $jsonfile_path;
							// echo "<p>Here is the result: " . $command;

							//execute the command and capture the output
							$output = shell_exec($command);
							// echo "<p>Here is the result: " . $output;

							//parse the JSON output from R
							$resultscores = json_decode($output, true);

							//access the result scores
							$mostSuitableStrand = $resultscores["MostSuitableStrand"][0];

							//access the first element of StudentScores
							$stemStudentScore = $resultscores["StudentScores"][0];
							$humssStudentScore = $resultscores["StudentScores"][1];
							$abmStudentScore = $resultscores["StudentScores"][2];
							$gasStudentScore = $resultscores["StudentScores"][3];
							$tvlictStudentScore = $resultscores["StudentScores"][4];
							$tvlheStudentScore = $resultscores["StudentScores"][5];

							//access specific values within the first student score
							$strand1 = $stemStudentScore["Strand"];
							$skillsProbability1 = number_format($stemStudentScore["Skills_Probability"], 4);
							$academicProbability1 = number_format($stemStudentScore["Academic_Probability"], 4);
							$interestProbability1 = number_format($stemStudentScore["Interest_Probability"], 4);
							$careerProbability1 = number_format($stemStudentScore["Career_Probability"], 4);
							$totalScore1 = number_format($stemStudentScore["Total_Score"], 4);
							$percentageScore1 = number_format($stemStudentScore["Percentage_Score"], 2);

							$strand2 = $humssStudentScore["Strand"];
							$skillsProbability2 = number_format($humssStudentScore["Skills_Probability"], 4);
							$academicProbability2 = number_format($humssStudentScore["Academic_Probability"], 4);
							$interestProbability2 = number_format($humssStudentScore["Interest_Probability"], 4);
							$careerProbability2 = number_format($humssStudentScore["Career_Probability"], 4);
							$totalScore2 = number_format($humssStudentScore["Total_Score"], 4);
							$percentageScore2 = number_format($humssStudentScore["Percentage_Score"], 2);

							$strand3 = $abmStudentScore["Strand"];
							$skillsProbability3 = number_format($abmStudentScore["Skills_Probability"], 4);
							$academicProbability3 = number_format($abmStudentScore["Academic_Probability"], 4);
							$interestProbability3 = number_format($abmStudentScore["Interest_Probability"], 4);
							$careerProbability3 = number_format($abmStudentScore["Career_Probability"], 4);
							$totalScore3 = number_format($abmStudentScore["Total_Score"], 4);
							$percentageScore3 = number_format($abmStudentScore["Percentage_Score"], 2);

							$strand4 = $gasStudentScore["Strand"];
							$skillsProbability4 = number_format($gasStudentScore["Skills_Probability"], 4);
							$academicProbability4 = number_format($gasStudentScore["Academic_Probability"], 4);
							$interestProbability4 = number_format($gasStudentScore["Interest_Probability"], 4);
							$careerProbability4 = number_format($gasStudentScore["Career_Probability"], 4);
							$totalScore4 = number_format($gasStudentScore["Total_Score"], 4);
							$percentageScore4 = number_format($gasStudentScore["Percentage_Score"], 2);

							$strand5 = $tvlictStudentScore["Strand"];
							$skillsProbability5 = number_format($tvlictStudentScore["Skills_Probability"], 4);
							$academicProbability5 = number_format($tvlictStudentScore["Academic_Probability"], 4);
							$interestProbability5 = number_format($tvlictStudentScore["Interest_Probability"], 4);
							$careerProbability5 = number_format($tvlictStudentScore["Career_Probability"], 4);
							$totalScore5 = number_format($tvlictStudentScore["Total_Score"], 4);
							$percentageScore5 = number_format($tvlictStudentScore["Percentage_Score"], 2);

							$strand6 = $tvlheStudentScore["Strand"];
							$skillsProbability6 = number_format($tvlheStudentScore["Skills_Probability"], 4);
							$academicProbability6 = number_format($tvlheStudentScore["Academic_Probability"], 4);
							$interestProbability6 = number_format($tvlheStudentScore["Interest_Probability"], 4);
							$careerProbability6 = number_format($tvlheStudentScore["Career_Probability"], 4);
							$totalScore6 = number_format($tvlheStudentScore["Total_Score"], 4);
							$percentageScore6 = number_format($tvlheStudentScore["Percentage_Score"], 2);

							// require '../vendor/autoload.php';
							//prepare the prompt for thr gpt api
                            $prompt = "You are a Decision Support System for upcoming senior high school students. Here is a result of a student based on the assessment of his skills, interest, academic performance, and carrer aspiration:
                                STEM: Skills=". $skillsProbability1 ." Interest=". $interestProbability1 ." Academic Performance=". $academicProbability1 ." Carrer Aspiration=". $careerProbability1 ." Overall Score in Percentage=". $percentageScore1 ."
                                HUMSS: Skills=". $skillsProbability2 ." Interest=". $interestProbability2 ." Academic Performance=". $academicProbability2 ." Carrer Aspiration=". $careerProbability2 ." Overall Score in Percentage=". $percentageScore2 ."
                                ABM: Skills=". $skillsProbability3 ." Interest=". $interestProbability3 ." Academic Performance=". $academicProbability3 ." Carrer Aspiration=". $careerProbability3 ." Overall Score in Percentage=". $percentageScore3 ."
                                GAS: Skills=". $skillsProbability4 ." Interest=". $interestProbability4 ." Academic Performance=". $academicProbability4 ." Carrer Aspiration=". $careerProbability4 ." Overall Score in Percentage=". $percentageScore4 ."
                                TVL-ICT: Skills=". $skillsProbability5 ." Interest=". $interestProbability5 ." Academic Performance=". $academicProbability5 ." Carrer Aspiration=". $careerProbability5 ." Overall Score in Percentage=". $percentageScore5 ."
                                TVL-HE: Skills=". $skillsProbability6 ." Interest=". $interestProbability6 ." Academic Performance=". $academicProbability6 ." Carrer Aspiration=". $careerProbability6 ." Overall Score in Percentage=". $percentageScore6 ."
                                Here is also his socioeconomic backgrond, their Total Household Monthly Income in Philippine Peso: ". $TotalHouseholdMonthlyIncome1 ."
                                Based on the provided information, create a recomendation or advice for the student on what senior high school best fit him. State the top 3 strand he is suitable with based on his skills, interest, academic performance, carrer aspiration and overall score. Also provide an advice based on his socioeconomic background on how it will affect his journey in the senior high. Start your statement with 'Based on your result...' and state at the end that the choice is always up to them, consult with their parents, teachers, and guidance councelors.";

							//place yout api key here
							$client = OpenAI::client($apiKey);

							$maxAttempts = 10;
							$attempt = 1;
							$recomendation = null;

							while ($attempt <= $maxAttempts) {
								try{
									//access the api with the prompt
									$data = $client->chat()->create([
										'model' => 'gpt-3.5-turbo',
										'messages' => [[
											'role' => 'user',
											'content' => $prompt,
										]],
										'max_tokens' => 512,
									]);

									if (!empty($data['choices'][0]['message']['content'])) { //check if has returend a message
										$recomendation = $data['choices'][0]['message']['content'];
										break;
									} else { //try again
										$attempt++;
										sleep(1);
									}
								}catch(Exception $e){
									echo 'Caught exception: ',  $e->getMessage(), "\n";
									$attempt++;
								}
							}

							if ($recomendation === null) {//handle the case where a recommendation was not obtained after maximum attempts
								echo 'error generating recommendation';
							} else {//prepare the update statement for student's results
								$sql5 = "UPDATE studentprofile
								JOIN result ON studentprofile.lrn = result.lrn
								JOIN stemresult ON studentprofile.lrn = stemresult.lrn
								JOIN humssresult ON studentprofile.lrn = humssresult.lrn
								JOIN abmresult ON studentprofile.lrn = abmresult.lrn
								JOIN gasresult ON studentprofile.lrn = gasresult.lrn
								JOIN tvlictresult ON studentprofile.lrn = tvlictresult.lrn
								JOIN tvlheresult ON studentprofile.lrn = tvlheresult.lrn
								SET
								result.MostSuitableStrand = ?,
								result.recommendation = ?,

								stemresult.acadProb = ?,
								stemresult.intProb = ?,
								stemresult.carProb = ?,
								stemresult.skiProb = ?,
								stemresult.totalScore = ?,
								stemresult.percScore = ?,
								
								humssresult.acadProb = ?,
								humssresult.intProb = ?,
								humssresult.carProb = ?,
								humssresult.skiProb = ?,
								humssresult.totalScore = ?,
								humssresult.percScore = ?,
								
								abmresult.acadProb = ?,
								abmresult.intProb = ?,
								abmresult.carProb = ?,
								abmresult.skiProb = ?,
								abmresult.totalScore = ?,
								abmresult.percScore = ?,
								
								gasresult.acadProb = ?,
								gasresult.intProb = ?,
								gasresult.carProb = ?,
								gasresult.skiProb = ?,
								gasresult.totalScore = ?,
								gasresult.percScore = ?,
								
								tvlictresult.acadProb = ?,
								tvlictresult.intProb = ?,
								tvlictresult.carProb = ?,
								tvlictresult.skiProb = ?,
								tvlictresult.totalScore = ?,
								tvlictresult.percScore = ?,
								
								tvlheresult.acadProb = ?,
								tvlheresult.intProb = ?,
								tvlheresult.carProb = ?,
								tvlheresult.skiProb = ?,
								tvlheresult.totalScore = ?,
								tvlheresult.percScore = ?
								WHERE
									studentprofile.lrn = ?";

								$stmt = $conn->prepare($sql5);
								if($stmt){
									$stmt->bind_param("sssssssssssssssssssssssssssssssssssssss",
									$mostSuitableStrand,
									$recomendation,
									$academicProbability1,
									$interestProbability1,
									$careerProbability1,
									$skillsProbability1,
									$totalScore1,
									$percentageScore1,
									$academicProbability2,
									$interestProbability2,
									$careerProbability2,
									$skillsProbability2,
									$totalScore2,
									$percentageScore2,
									$academicProbability3,
									$interestProbability3,
									$careerProbability3,
									$skillsProbability3,
									$totalScore3,
									$percentageScore3,
									$academicProbability4,
									$interestProbability4,
									$careerProbability4,
									$skillsProbability4,
									$totalScore4,
									$percentageScore4,
									$academicProbability5,
									$interestProbability5,
									$careerProbability5,
									$skillsProbability5,
									$totalScore5,
									$percentageScore5,
									$academicProbability6,
									$interestProbability6,
									$careerProbability6,
									$skillsProbability6,
									$totalScore6,
									$percentageScore6,
									$id);

									$stmt->execute();

									if ($stmt->affected_rows > 0) {
										echo "<script>Swal.fire({
											title: 'Successfully Generated',
											text: 'Student results generated successfully!',
											icon: 'success',
											buttons: {
											confirm: true,
											},
										}).then((value) => {
											if (value) {
											document.location='profile.php';
											} else {
											document.location='profile.php';
											}
										});</script>";
									} else {
										echo "Error generating recommendation: " . $stmt->error;
									}

									$stmt->close();
								}else{
									echo "Prepare statement error: " . $conn->error;
								}
							}
						}
						?>
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
		//for pasword strength measurement
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

		function validateLRN(input) {
            var regex = /^[0-9]*$/; // Regular expression to allow only numbers

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9]/g, ''); // Remove any characters that are not numeric
            }

            if (input.value.length > 12) {
                input.value = input.value.slice(0, 12); // Truncate the input value to 12 characters if it exceeds the limit
            }
        }

		//for validating Address
		function validateAddress(input) {
			var regex = /^[a-zA-Z0-9\s.,]*$/; // Regular expression to allow alphanumeric characters, spaces, periods, and commas

			if (!regex.test(input.value)) {
				input.value = input.value.replace(/[^a-zA-Z0-9\s.,]/g, ''); // Remove any special characters except periods and commas
			}
		}

		//for validating Names
		function validateName(input) {
			var regex = /^[a-zA-Z0-9\s]*$/; // Regular expression to allow only alphanumeric characters and spaces

			if (!regex.test(input.value)) {
				input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, ''); // Remove any special characters
			}
		}

		//for displaying the value for the sliders
		const rangeInputs = document.querySelectorAll('.form-range');
		const rangeValueSpans = document.querySelectorAll('.rangeValue');

		//displays the range values for each input element
		rangeInputs.forEach((input, index) => {
			input.addEventListener('input', () => {
				rangeValueSpans[index].textContent = input.value;
			});

			rangeValueSpans[index].textContent = input.value;
		});

		//for the carrer option logic DO NOT F**kING touch it!!!
		var prevVal1;
		var prevVal2;

		window.addEventListener('DOMContentLoaded', function() {
			const careerPath1 = document.getElementById('CareerPath1');
			const careerPath2 = document.getElementById('CareerPath2');
			const careerPath3 = document.getElementById('CareerPath3');
			const hidcareerPath2 = document.getElementById('CareerPath2hid');
			const hidcareerPath3 = document.getElementById('CareerPath3hid');

			function updateCareerPathSelect1() {

				if (careerPath1.value === 'Undecided') {
					showOption(careerPath2, 'Undecided');
					showOption(careerPath3, 'Undecided');
					showOption(careerPath2, prevVal1);
					showOption(careerPath3, prevVal1);

					careerPath2.value = 'Undecided';
					careerPath3.value = 'Undecided';

					careerPath2.disabled = true;
					careerPath3.disabled = true;


				} else {
					careerPath2.value = 'NA';
					careerPath3.value = 'NA';
					updateCareerPathSelect2();
					careerPath2.disabled = false;

					showOption(careerPath2, prevVal1);
					showOption(careerPath3, prevVal1);
					hideOption(careerPath2, 'Undecided');
					hideOption(careerPath3, 'Undecided');
					hideOption(careerPath2, careerPath1.value);
					hideOption(careerPath3, careerPath1.value);
					prevVal1 = careerPath1.value;
				}
				hidcareerPath2.value = careerPath2.value;
				hidcareerPath3.value = careerPath3.value;
			}

			function updateCareerPathSelect2() {
				if (careerPath1.value != 'Undecided' && (careerPath2.value === 'NA' || careerPath2.value === 'Undecided')) {
					careerPath3.value = 'NA';
					careerPath3.disabled = true;
				} else {
					careerPath3.value = 'NA';
					careerPath3.disabled = false;
				}
				hidcareerPath2.value = careerPath2.value;
				hidcareerPath3.value = careerPath3.value;
				showOption(careerPath3, prevVal2);
				hideOption(careerPath3, careerPath2.value);
				prevVal2 = careerPath2.value;
			}
			// Function to hide an option by its value
			function hideOption(selectElement, optionValue) {
				const options = selectElement.querySelectorAll('option');
				for (const option of options) {
					if (option.value === optionValue) {
						option.style.display = 'none';
					}
				}
			}
			// Function to show a hidden option
			function showOption(selectElement, optionValue) {
				const options = selectElement.querySelectorAll('option');
				for (const option of options) {
					if (option.value === optionValue) {
						option.style.display = '';
					}
				}
			}

			// Call the function when the page loads
			if (careerPath1.value === 'Undecided') {
				updateCareerPathSelect2();
				updateCareerPathSelect1();
			}
			if (careerPath1.value != 'Undecided' && careerPath2.value === 'NA') {
				updateCareerPathSelect2();
				hideOption(careerPath2, 'Undecided');
				hideOption(careerPath3, 'Undecided');
				hideOption(careerPath2, careerPath1.value);
				hideOption(careerPath3, careerPath1.value);
				prevVal1 = careerPath1.value;
			} else {
				hideOption(careerPath2, 'Undecided');
				hideOption(careerPath3, 'Undecided');
				hideOption(careerPath2, careerPath1.value);
				hideOption(careerPath3, careerPath1.value);
				prevVal1 = careerPath1.value;
				if (careerPath2.value != 'NA') {
					hideOption(careerPath3, careerPath2.value);
					prevVal2 = careerPath2.value;
				}
			}
			hidcareerPath2.value = careerPath2.value;
			hidcareerPath3.value = careerPath3.value;

			careerPath1.addEventListener('change', updateCareerPathSelect1);
			careerPath2.addEventListener('change', updateCareerPathSelect2);
			careerPath3.addEventListener('change', function() {
				hidcareerPath3.value = careerPath3.value;
			});

			//for determining if the student's profile is already been filled out and good to go for generating results
			const totalHouseholdIncomeSelect = document.getElementById('TotalHouseholdMonthlyIncome');
			const acadScience = document.getElementById('acadScience');
			const acadMath = document.getElementById('acadMath');
			const acadEnglish = document.getElementById('acadEnglish');
			const acadFilipino = document.getElementById('acadFilipino');
			const acadICTRelatedSub = document.getElementById('acadICTRelatedSub');
			const acadHERelatedSub = document.getElementById('acadHERelatedSub');
			const submitButton = document.getElementById('submitButton');
			const profileStatus = document.getElementById("profileStatus");
			const generateButton = document.getElementById("generateBtn");

			let interestHasZero = false;
			let thmiIsSelect = false;
			let acadIsSelect = false;

			rangeInputs.forEach(rangeInputs => {
				if (rangeInputs.value === '0') {
					interestHasZero = true;
					return;
				}
			});

			if (totalHouseholdIncomeSelect.value === 'SELECT') {
				thmiIsSelect = true;
			}

			if (acadScience.value === 'SELECT') {
				acadIsSelect = true;
			}

			if (acadMath.value === 'SELECT') {
				acadIsSelect = true;
			}

			if (acadEnglish.value === 'SELECT') {
				acadIsSelect = true;
			}

			if (acadFilipino.value === 'SELECT') {
				acadIsSelect = true;
			}

			if (acadICTRelatedSub.value === 'SELECT') {
				acadIsSelect = true;
			}

			if (acadHERelatedSub.value === 'SELECT') {
				acadIsSelect = true;
			}

			if (interestHasZero || thmiIsSelect || acadIsSelect) {
				// Update the text to "DONE"
				profileStatus.textContent = "NOT DONE";

				// Change the text color to green
				profileStatus.style.color = "red";

				//Disable the button
				generateButton.disabled = true;
			} else {
				// Update the text to "DONE"
				profileStatus.textContent = "DONE";

				// Change the text color to green
				profileStatus.style.color = "green";

				//Enable the button
				generateButton.disabled = false;
			}
		});

		//for bootstrap tooltips
		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
	</script>
</body>

</html>