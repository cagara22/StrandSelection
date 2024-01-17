<?php
//Start the session and check if the admin is logged in or not
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GUIDE Admin</title>
    <link rel="icon" type="images/x-icon" href="images/GUIDE_Logo_2.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
	<header class="navbar sticky-top flex-md-nowrap p-0 shadow">
		<div class="container-fluid">
			<a class="navbar-brand" href="./dashboard.php">
				<img src="./images/GUIDE_Logo_3.png" alt="Logo" width="150" height="37" class="d-inline-block align-text-top">
			</a>
		</div>
	</header>

	<main class="row section-100">
		<div class="col-2">
			<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 100%; height: 100%;" id="sidebarMenu">
				<a href="adminprofile.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
					<span class="fs-4"><?php echo $_SESSION['role']; //Display the role ?></span>
				</a>
				<hr>
				<ul class="nav nav-pills flex-column mb-auto">
					<li>
						<a href="./dashboard.php" class="nav-link link-body-emphasis">
							<img src="./images/dashboard.png" alt="" width="16" height="16" class="bi pe-none me-2">
							DASHBOARD
						</a>
					</li>
					<li class="nav-item">
						<a href="./profiles.php" class="nav-link active" aria-current="page">
							<img src="./images/profiles.png" alt="" width="16" height="16" class="bi pe-none me-2">
							PROFILES
						</a>
					</li>
					<?php
                    
                    if($_SESSION['role'] == 'SUPER ADMIN'){ //Restrict the rest of the page to Super Admin only
                        echo '
                        <li>
							<a href="./admins.php" class="nav-link link-body-emphasis">
								<img src="./images/admins.png" alt="" width="16" height="16" class="bi pe-none me-2">
								ADMINS
							</a>
						</li>
						<li>
                            <a href="./sections.php" class="nav-link link-body-emphasis">
                                <img src="./images/section.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                SECTIONS
                            </a>
                        </li>
                        <li>
                            <a href="./schoolyrs.php" class="nav-link link-body-emphasis">
                                <img src="./images/schoolyr.png" alt="" width="16" height="16" class="bi pe-none me-2">
                                S.Y.
                            </a>
                        </li>
						<li>
							<a href="./backup.php" class="nav-link link-body-emphasis">
								<img src="./images/backup.png" alt="" width="16" height="16" class="bi pe-none me-2">
								BACKUP
							</a>
						</li>
						<li>
							<a href="./reports.php" class="nav-link link-body-emphasis">
								<img src="./images/reports.png" alt="" width="16" height="16" class="bi pe-none me-2">
								REPORTS
							</a>
						</li>
						<li>
							<a href="./logs.php" class="nav-link link-body-emphasis">
								<img src="./images/logs.png" alt="" width="16" height="16" class="bi pe-none me-2">
								LOGS
							</a>
						</li>
                        ';
                    }
                    
                    ?>
				</ul>
				<hr>
				<div class="dropdown">
					<a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="./images/man.png" alt="" width="32" height="32" class="rounded-circle me-2">
						<strong><?php echo $_SESSION['admin']; //Display the admin username ?></strong>
					</a>
					<ul class="dropdown-menu text-small shadow">
						<li><a class="dropdown-item" href="adminprofile.php">Profile</a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><a class="dropdown-item" href="logout.php">Sign out</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-10">
			<section class="section-100 d-flex flex-column py-2">
				<?php include "connection.php"; include "../vendor/autoload.php";?>
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="fw-bold sub-title"><?php echo $_GET['name']; ?></h1>
				</div>
				<div class="row w-100">
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">Account Details</h4>
							</div>
							<div class="card-body">
								<?php

								// Check if the update button for the account details has been clicked
								if (isset($_POST['update1'])) {
									$sql = '';
									//retrieve form data
									$curid = $_GET['lrn'];
									$newid = mysqli_real_escape_string($conn, $_POST['lrn']);
									$Fname = strtoupper(mysqli_real_escape_string($conn, $_POST['Fname']));
									$Mname = strtoupper(mysqli_real_escape_string($conn, $_POST['Mname']));
									$Lname = strtoupper(mysqli_real_escape_string($conn, $_POST['Lname']));
									$curName = $_GET['name'];
									$newName = $Fname . " " . $Lname;
									$address = strtoupper(mysqli_real_escape_string($conn, $_POST['address']));
									if(!empty($_POST['bday'])){
										$bday = $_POST['bday'];
										$birthdate = new DateTime($bday);
										$currentDate = new DateTime();
										$age = $currentDate->diff($birthdate)->y;
									}else{
										$bday = '';
										$age = 0;
									}
									//$age = !empty($_POST['age']) ? $_POST['age'] : 0;
									$sex = mysqli_real_escape_string($conn, $_POST['sex']);
									$suffix = strtoupper(mysqli_real_escape_string($conn, $_POST['suffix']));
									$email = mysqli_real_escape_string($conn, $_POST['email']);
									$section = mysqli_real_escape_string($conn, $_POST['section']);
									$schoolyr = mysqli_real_escape_string($conn, $_POST['schoolyr']);

									//check if the lrn has been changed
									if($curid == $newid){//lrn not changed
										
										// Define the SQL statement for updating user data
										if(!empty($_POST['bday'])){
											$sql = "UPDATE studentprofile SET Fname='$Fname', Mname='$Mname', Lname='$Lname', 
											address='$address', bday='$bday', age='$age', sex='$sex', suffix='$suffix', email='$email', sectionID=$section, schoolyrID=$schoolyr WHERE lrn='$curid'";
										}else{
											$sql = "UPDATE studentprofile SET Fname='$Fname', Mname='$Mname', Lname='$Lname', 
											address='$address', sex='$sex', suffix='$suffix', email='$email', sectionID=$section, schoolyrID=$schoolyr WHERE lrn='$curid'";
										}
										

										if(!empty($sql)){ //check if sql statement is not empty
											//execute the update query
											if (mysqli_query($conn, $sql)) {
												$affected_rows = mysqli_affected_rows($conn);

												if ($affected_rows > 0) {//check if a row in the database was updated successfully
													//log the update
													$admin_username = $_SESSION['fullname'];
													$log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', 'Student with LRN $curid got its account details updated', '$admin_username')";
													$conn->query($log);

													echo "<script>Swal.fire({
														title: 'Successfully Updated',
														text: 'Student Account updated successfully!',
														icon: 'success',
														buttons: {
														confirm: true,
														},
													}).then((value) => {
														if (value) {
														document.location='viewprofile.php?lrn=". $curid ."&name=". $newName ."';
														} else {
														document.location='viewprofile.php?lrn=". $curid ."&name=". $newName ."';
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
									}else{//lrn has been changed
										//check if the lrn already exists in the database
										$query = "SELECT lrn FROM studentprofile WHERE lrn = '$newid'";
										$result = mysqli_query($conn, $query);
										if (mysqli_num_rows($result) > 0) {//it already exists
											echo "<script>Swal.fire({
												title: 'INVALID LRN!',
												text: 'LRN is already in use!',
												icon: 'error',
												showConfirmButton: false,
                                                timer: 5000
												});</script>";
											//echo "<script>document location ='viewprofile.php?lrn=". $curid ."&name=". $curName ."';</script>";
										}else{//it does not exist
										
											// Define the SQL statement for updating user data
											if(!empty($_POST['bday'])){
												$sql = "UPDATE studentprofile SET lrn='$newid', Fname='$Fname', Mname='$Mname', Lname='$Lname', 
												address='$address', bday='$bday', age='$age', sex='$sex', suffix='$suffix', email='$email', sectionID=$section, schoolyrID=$schoolyr WHERE lrn='$curid'";
											}else{
												$sql = "UPDATE studentprofile SET lrn='$newid', Fname='$Fname', Mname='$Mname', Lname='$Lname', 
												address='$address', sex='$sex', suffix='$suffix', email='$email', sectionID=$section, schoolyrID=$schoolyr WHERE lrn='$curid'";
											}
											
											

											if(!empty($sql)){//check if the sql is empty
												//prep the update statement for the child table
												$sql_result = "UPDATE result SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_studentacad = "UPDATE studentacad SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_studentinterest = "UPDATE studentinterest SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_studentskill = "UPDATE studentskill SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_studentsocioeco = "UPDATE studentsocioeco SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_studentcareer = "UPDATE studentcareer SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_stemresult = "UPDATE stemresult SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_humssresult = "UPDATE humssresult SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_abmresult = "UPDATE abmresult SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_gasresult = "UPDATE gasresult SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_tvlictresult = "UPDATE tvlictresult SET lrn = '$newid' WHERE lrn = '$curid'";
												$sql_tvlheresult = "UPDATE tvlheresult SET lrn = '$newid' WHERE lrn = '$curid'";

												//disable foreign key check
												$conn->query("SET foreign_key_checks = 0");
												//execute the update query
												if (mysqli_query($conn, $sql)) {
													$affected_rows = mysqli_affected_rows($conn);

													if ($affected_rows > 0) {//check if a row in the database was updated successfully
														
														//update the child tables
														mysqli_autocommit($conn, false);
														if (
															mysqli_query($conn, $sql_result) &&
															mysqli_query($conn, $sql_studentacad) &&
															mysqli_query($conn, $sql_studentinterest) &&
															mysqli_query($conn, $sql_studentskill) &&
															mysqli_query($conn, $sql_studentcareer) &&
															mysqli_query($conn, $sql_studentsocioeco) &&
															mysqli_query($conn, $sql_stemresult) &&
															mysqli_query($conn, $sql_humssresult) &&
															mysqli_query($conn, $sql_abmresult) &&
															mysqli_query($conn, $sql_gasresult) &&
															mysqli_query($conn, $sql_tvlictresult) &&
															mysqli_query($conn, $sql_tvlheresult)
														) {
															mysqli_commit($conn);
															$conn->query("SET foreign_key_checks = 1");
															mysqli_autocommit($conn, true);
															
															//log the update
															$admin_username = $_SESSION['fullname'];
															$log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', 'Student with LRN $newid got its account details updated', '$admin_username')";
															$conn->query($log);

															echo "<script>Swal.fire({
																title: 'Successfully Updated',
																text: 'Student Account updated successfully!',
																icon: 'success',
																buttons: {
																confirm: true,
																},
															}).then((value) => {
																if (value) {
																document.location='viewprofile.php?lrn=". $newid ."&name=". $newName ."';
																} else {
																document.location='viewprofile.php?lrn=". $newid ."&name=". $newName ."';
																}
															});</script>";	
														} else {//error updating child table
															mysqli_rollback($conn);
															$conn->query("SET foreign_key_checks = 1");
															mysqli_autocommit($conn, true);
															echo "Error updating record: R" . mysqli_error($conn);
														}

														// Restore autocommit mode
														$conn->query("SET foreign_key_checks = 1");
														mysqli_autocommit($conn, true);

													} else {//no changes were made
														echo "<script>Swal.fire({
															title: 'NO CHANGES',
															text: 'No changes were made',
															icon: 'info',
															showConfirmButton: false,
                                                			timer: 5000
															});</script>";
													}
												} else {//error updatin the record
													echo "Error updating record: " . mysqli_error($conn);
												}
											}
										}
									}
								}

								if (isset($_POST['resetpass'])){
									$curid = $_GET['lrn'];
									$name = $_GET['name'];
									$password = md5($curid);

									$sql = "UPDATE studentprofile SET password='$password' WHERE lrn='$curid'";

									if (mysqli_query($conn, $sql)) {
										$affected_rows = mysqli_affected_rows($conn);

										if ($affected_rows > 0) {//check if a row in the database was updated successfully
											//log the update
											$admin_username = $_SESSION['fullname'];
											$log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', 'Student with LRN $curid has had their password reset', '$admin_username')";
											$conn->query($log);

											echo "<script>Swal.fire({
												title: 'Successfully Reset of Password',
												text: 'Student Account Password Reset',
												icon: 'success',
												buttons: {
												confirm: true,
												},
											}).then((value) => {
												if (value) {
												document.location='viewprofile.php?lrn=". $curid ."&name=". $name ."';
												} else {
												document.location='viewprofile.php?lrn=". $curid ."&name=". $name ."';
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

								//check if the student's lrn is available
								if (isset($_GET['lrn'])) {

									$user_id = $_GET['lrn']; //get the lrn

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

											$lrn1 = $row['lrn'];
											$Fname1 = $row['Fname'];
											$Mname1 = $row['Mname'];
											$Lname1 = $row['Lname'];
											$address1 = $row['address'];
											$bday1 = $row['bday'];
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
											<input type="text" class="form-control" id="lrn" name="lrn" value="<?php echo $lrn1; ?>" oninput="validateLRN(this)" pattern=".{12}" title="Please enter exactly 12 digits" placeholder="Learner's Reference Number" required>
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
											<input type="text" class="form-control" id="address" name="address" value="<?php echo $address1; ?>" oninput="validateAddress(this)" placeholder="Address">
											<label for="address">Address</label>
										</div>
									</div>
									<div class="col-12 col-md-2 mb-1">
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
									<div class="col-12 col-md-2 mb-1">
										<div class="form-floating mb-3">
											<input type="date" class="form-control" id="bday" name="bday" value="<?php echo $bday1; ?>" max="<?php echo date('Y-m-d'); ?>" min="1800-01-01" oninput="" placeholder="Birthday">
											<label for="bday">Birthday</label>
										</div>
									</div>
									<div class="col-12 col-md-2 mb-1">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" id="age" name="age" value="<?php echo $age1; ?>" oninput="" maxlength="3" placeholder="Age" readonly>
											<label for="age">Age</label>
										</div>
									</div>
									<?php
									$sql2 = "SELECT * FROM section";

									$result = $conn->query($sql2);
									?>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="section" name="section" value="<?php echo $sectionID1; ?>">
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
									$sql3 = "SELECT * FROM schoolyr ORDER BY schoolyrID DESC";

									$result = $conn->query($sql3);
									?>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="schoolyr" name="schoolyr" value="<?php echo $schoolyrID1; ?>">
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
											<input type="email" class="form-control" id="email" name="email" value="<?php echo $email1; ?>" placeholder="Email">
											<label for="email">Email</label>
										</div>
									</div>
									<div class="d-grid gap-2 d-md-flex justify-content-end">
										<button type="submit" class="btn btn-view form-button-text" name="resetpass"><span class="fw-bold">RESET PASSWORD</span></button>
										<button type="submit" class="btn btn-update form-button-text" name="update1"><span class="fw-bold">UPDATE</span></button>
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
								// Check if form was submitted
								if (isset($_POST['update2'])) {

									// Retrieve form data
									$id = $_GET['lrn'];
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
									$acadScience = $_POST['acadScience'];
									$acadMath = $_POST['acadMath'];
									$acadEnglish = $_POST['acadEnglish'];
									$acadFilipino = $_POST['acadFilipino'];
									$acadICTRelatedSubject = $_POST['acadICTRelatedSub'];
									$acadHERelatedSubject = $_POST['acadHERelatedSub'];
									//careerpath
									$CareerPath1 = $_POST['CareerPath1'];
									$CareerPath2 = $_POST['CareerPath2hid'];
									$CareerPath3 = $_POST['CareerPath3hid'];
									//socioeco
									$TotalHouseholdMonthlyIncome = $_POST['TotalHouseholdMonthlyIncome'];

									if($acadScience === "SELECT" || $acadMath === "SELECT" || $acadEnglish === "SELECT" || $acadFilipino === "SELECT" || $acadICTRelatedSubject === "SELECT" || $acadHERelatedSubject === "SELECT"){
										echo "<script>Swal.fire({
											title: 'LACK OF DATA!',
											text: 'Atleast update the students academic performance!',
											icon: 'info',
											showConfirmButton: false,
                                            timer: 5000
										});</script>";
									}else{
										if($TotalHouseholdMonthlyIncome == "SELECT"){
											$TotalHouseholdMonthlyIncome = '';
										}

										$sql41 = "UPDATE studentskill
										SET
											skiCommunicationSkills = '$skiCommunicationSkills',
											skiCriticalThinking = '$skiCriticalThinking',
											skiReadingComprehension = '$skiReadingComprehension',
											skiProblemSolving = '$skiProblemSolving',
											skiResearchSkills = '$skiResearchSkills ',
											skiDigitalLiteracy = '$skiDigitalLiteracy',
											skiInnovative = '$skiInnovative',
											skiTimeManagement = '$skiTimeManagement',
											skiAdaptability = '$skiAdaptability',
											skiScientificInquiry = '$skiScientificInquiry',
											skiMathematicalSkills = '$skiMathematicalSkills',
											skiLogicalReasoning = '$skiLogicalReasoning',
											skiLabExperimentalSkills = '$skiLabExperimentalSkills',
											skiAnalyticalSkills = '$skiAnalyticalSkills',
											skiResearchWriting = '$skiResearchWriting',
											skiSociologicalAnalysis = '$skiSociologicalAnalysis',
											skiCulturalCompetence = '$skiCulturalCompetence',
											skiEthicalReasoning = '$skiEthicalReasoning',
											skiHistoryPoliticalScience = '$skiHistoryPoliticalScience',
											skiFinancialLiteracy = '$skiFinancialLiteracy',
											skiBusinessPlanning = '$skiBusinessPlanning',
											skiMarketing = '$skiMarketing',
											skiAccounting = '$skiAccounting',
											skiEntrepreneurship = '$skiEntrepreneurship',
											skiComputerHardwareSoftware = '$skiComputerHardwareSoftware',
											skiComputerNetworking = '$skiComputerNetworking ',
											skiWebDevelopment = '$skiWebDevelopment',
											skiProgramming = '$skiProgramming',
											skiTroubleshooting = '$skiTroubleshooting ',
											skiGraphicsDesign = '$skiGraphicsDesign',
											skiCulinarySkills = '$skiCulinarySkills',
											skiSewingFashionDesign = '$skiSewingFashionDesign',
											skiInteriorDesign = '$skiInteriorDesign',
											skiChildcareFamilyServices = '$skiChildcareFamilyServices',
											skiNutritionFoodSafety = '$skiNutritionFoodSafety',
											skiEconomics = '$skiEconomics'
										WHERE
											lrn = '$id'";
										
										$sql42 = "UPDATE studentinterest 
										SET
											intCalculus = '$intCalculus',
											intBiology = '$intBiology',
											intPhysics = '$intPhysics',
											intCreativeWriting = '$intCreativeWriting',
											intCreativeNonfiction = '$intCreativeNonfiction',
											intIntroWorldReligionsBeliefSystems = '$intIntroWorldReligionsBeliefSystems',
											intPhilippinePoliticsGovernance = '$intPhilippinePoliticsGovernance',
											intDisciplinesIdeasSocialSciences = '$intDisciplinesIdeasSocialSciences',
											intAppliedEconomics = '$intAppliedEconomics',
											intBusinessEthicsSocialResponsibility = '$intBusinessEthicsSocialResponsibility',
											intFundamentalsABM = '$intFundamentalsABM',
											intBusinessMath = '$intBusinessMath',
											intBusinessFinance = '$intBusinessFinance',
											intOrganizationManagement = '$intOrganizationManagement',
											intPrinciplesMarketing = '$intPrinciplesMarketing',
											intComputerProgramming = '$intComputerProgramming',
											intComputerSystemServicing = '$intComputerSystemServicing',
											intContactCenterServices = '$intContactCenterServices',
											intCISCOComputerNetworking = '$intCISCOComputerNetworking',
											intAnimationIllustration = '$intAnimationIllustration',
											intCookery = '$intCookery',
											intBreadPastryProduction = '$intBreadPastryProduction',
											intFashionDesign = '$intFashionDesign',
											intFoodBeverages = '$intFoodBeverages',
											intTailoring = '$intTailoring',
											intChemistry = '$intChemistry'
										WHERE
											lrn = '$id'";

										$sql43 = "UPDATE studentsocioeco
										SET
											TotalHouseholdMonthlyIncome = '$TotalHouseholdMonthlyIncome'
										WHERE
											lrn = '$id'";

										$sql44 = "UPDATE studentacad
										SET
											acadScience = '$acadScience',
											acadMath = '$acadMath',
											acadEnglish = '$acadEnglish',
											acadFilipino = '$acadFilipino',
											acadICTRelatedSubject = '$acadICTRelatedSubject',
											acadHERelatedSubject = '$acadHERelatedSubject'
										WHERE
											lrn = '$id'";
										
										$sql45 = "UPDATE studentcareer
										SET
											CareerPath1 = '$CareerPath1',
											CareerPath2 = '$CareerPath2',
											CareerPath3 = '$CareerPath3'
										WHERE
											lrn = '$id'";

										$ErrorNum = 0;
										$AffectedRowsNum = 0;
										$logText = "Student with LRN $id got its Profile [";

										if (mysqli_query($conn, $sql41)) {
											$affected_rows1 = mysqli_affected_rows($conn);

											if ($affected_rows1 > 0) {
												$logText .= "(Skills)";
												$AffectedRowsNum++;
											}
										}else{
											$ErrorNum++;
										}

										if (mysqli_query($conn, $sql42)) {
											$affected_rows2 = mysqli_affected_rows($conn);

											if ($affected_rows2 > 0) {
												$logText .= "(Interests)";
												$AffectedRowsNum++;
											}
										}else{
											$ErrorNum++;
										}

										if (mysqli_query($conn, $sql43)) {
											$affected_rows3 = mysqli_affected_rows($conn);

											if ($affected_rows3 > 0) {
												$logText .= "(Socio-economic Background)";
												$AffectedRowsNum++;
											}
										}else{
											$ErrorNum++;
										}

										if (mysqli_query($conn, $sql44)) {
											$affected_rows4 = mysqli_affected_rows($conn);

											if ($affected_rows4 > 0) {
												$logText .= "(Academic Performance)";
												$AffectedRowsNum++;
											}
										}else{
											$ErrorNum++;
										}

										if (mysqli_query($conn, $sql45)) {
											$affected_rows5 = mysqli_affected_rows($conn);

											if ($affected_rows5 > 0) {
												$logText .= "(Career)";
												$AffectedRowsNum++;
											}
										}else{
											$ErrorNum++;
										}

										if($ErrorNum == 0){
											if($AffectedRowsNum > 0){
												//log the update
												$admin_username = $_SESSION['fullname'];
												$logText .= "] updated";
												$log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', '$logText', '$admin_username')";
												$conn->query($log);

												echo "<script>Swal.fire({
													title: 'Successfully Updated',
													text: 'Student Profile updated successfully!',
													icon: 'success',
													buttons: {
													confirm: true,
													},
												}).then((value) => {
													if (value) {
													document.location='viewprofile.php?lrn=". $id ."&name=". $_GET['name'] ."';
													} else {
													document.location='viewprofile.php?lrn=". $id ."&name=". $_GET['name'] ."';
													}
												});</script>";
											}else{
												echo "<script>Swal.fire({
													title: 'NO CHANGES',
													text: 'No changes were made',
													icon: 'info',
													showConfirmButton: false,
													timer: 5000
													});</script>";
											}
										}else{
											echo "Error updating";
										}
									}
								}

								?>
								<form class="row" action="" method="post">
									<div class="divider d-flex align-items-center my-4">
										<p class="text-center fs-5 fw-bold mx-3 mb-0">Skills, Interest, and Socio-economic Background</p>
									</div>
									<div class="col-12">
										<p id="" class="d-block form-label">Based on your self-assesment, select the skills that are applicable to you...</p>
										<div class="row">
											<div class="col-12 col-sm-6 col-md-4">
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCommunicationSkills" name="skiCommunicationSkills" value="1" <?php if (strpos($skiCommunicationSkills1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiCommunicationSkills">Communication Skills</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to convey thoughts, ideas, or information effectively to others through various means, such as speaking, writing, or listening.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiScientificInquiry" name="skiScientificInquiry" value="1" <?php if (strpos($skiScientificInquiry1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiScientificInquiry">Scientific Inquiry</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of asking questions, conducting investigations, and drawing conclusions based on evidence to understand the natural world.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiResearchWriting" name="skiResearchWriting" value="1" <?php if (strpos($skiResearchWriting1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiResearchWriting">Research and Writing</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to gather information systematically and communicate ideas effectively through written means.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiFinancialLiteracy" name="skiFinancialLiteracy" value="1" <?php if (strpos($skiFinancialLiteracy1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiFinancialLiteracy">Financial Literacy</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The understanding of financial concepts and practices, enabling informed financial decision-making.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiComputerHardwareSoftware" name="skiComputerHardwareSoftware" value="1" <?php if (strpos($skiComputerHardwareSoftware1, "1") !== false) {
																																															echo " checked";
																																														} ?>>
														<label class="form-check-label" for="skiComputerHardwareSoftware">Computer Hardware and Software</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Knowledge of computer components and software programs, including installation and maintenance.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCulinarySkills" name="skiCulinarySkills" value="1" <?php if (strpos($skiCulinarySkills1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiCulinarySkills">Culinary Skills</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in food preparation, cooking techniques, and culinary arts.">
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCriticalThinking" name="skiCriticalThinking" value="1" <?php if (strpos($skiCriticalThinking1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiCriticalThinking">Critical Thinking</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to analyze, evaluate, and reason about information and situations in a logical and thoughtful manner to make informed decisions.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiMathematicalSkills" name="skiMathematicalSkills" value="1" <?php if (strpos($skiMathematicalSkills1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiMathematicalSkills">Mathematical Skills</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to use mathematical concepts, operations, and methods to solve problems and make sense of numerical information.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCulturalCompetence" name="skiCulturalCompetence" value="1" <?php if (strpos($skiCulturalCompetence1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiCulturalCompetence">Cultural Competence</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to interact and work effectively with people from diverse cultural backgrounds while respecting and valuing their beliefs and practices.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAccounting" name="skiAccounting" value="1" <?php if (strpos($skiAccounting1, "1") !== false) {
																																								echo " checked";
																																							} ?>>
														<label class="form-check-label" for="skiAccounting">Accounting</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The systematic recording, reporting, and analysis of financial transactions to track a business's financial health.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiProgramming" name="skiProgramming" value="1" <?php if (strpos($skiProgramming1, "1") !== false) {
																																								echo " checked";
																																							} ?>>
														<label class="form-check-label" for="skiProgramming">Programming</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Writing, testing, and maintaining the source code of computer programs to achieve specific tasks or functions.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiChildcareFamilyServices" name="skiChildcareFamilyServices" value="1" <?php if (strpos($skiChildcareFamilyServices1, "1") !== false) {
																																														echo " checked";
																																													} ?>>
														<label class="form-check-label" for="skiChildcareFamilyServices">Childcare and Family Services</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Providing care, support, and services for children and families, often including early childhood education and child development.">
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiReadingComprehension" name="skiReadingComprehension" value="1" <?php if (strpos($skiReadingComprehension1, "1") !== false) {
																																													echo " checked";
																																												} ?>>
														<label class="form-check-label" for="skiReadingComprehension">Reading Comprehension</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of understanding and interpreting written text, including identifying key ideas and details.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiLogicalReasoning" name="skiLogicalReasoning" value="1" <?php if (strpos($skiLogicalReasoning1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiLogicalReasoning">Logical Reasoning</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to think rationally and systematically, making well-structured, coherent arguments and decisions.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEthicalReasoning" name="skiEthicalReasoning" value="1" <?php if (strpos($skiEthicalReasoning1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiEthicalReasoning">Ethical Reasoning</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of evaluating moral dilemmas and making decisions that align with ethical principles and values.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEntrepreneurship" name="skiEntrepreneurship" value="1" <?php if (strpos($skiEntrepreneurship1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiEntrepreneurship">Entrepreneurship</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to identify business opportunities, take calculated risks, and create and manage successful ventures.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiTroubleshooting" name="skiTroubleshooting" value="1" <?php if (strpos($skiTroubleshooting1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiTroubleshooting">Troubleshooting</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to identify and resolve technical issues or problems in hardware, software, or systems.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiNutritionFoodSafety" name="skiNutritionFoodSafety" value="1" <?php if (strpos($skiNutritionFoodSafety1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiNutritionFoodSafety">Nutrition and Food Safety</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Knowledge and practices related to proper nutrition, dietary planning, and ensuring the safety of food consumption.">
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiProblemSolving" name="skiProblemSolving" value="1" <?php if (strpos($skiProblemSolving1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiProblemSolving">Problem Solving</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capability to identify challenges, analyze them, and develop effective solutions or strategies to overcome them.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiLabExperimentalSkills" name="skiLabExperimentalSkills" value="1" <?php if (strpos($skiLabExperimentalSkills1, "1") !== false) {
																																													echo " checked";
																																												} ?>>
														<label class="form-check-label" for="skiLabExperimentalSkills">Lab and Experimental Skills</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in conducting experiments, including using equipment, collecting data, and following scientific procedures accurately.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiHistoryPoliticalScience" name="skiHistoryPoliticalScience" value="1" <?php if (strpos($skiHistoryPoliticalScience1, "1") !== false) {
																																														echo " checked";
																																													} ?>>
														<label class="form-check-label" for="skiHistoryPoliticalScience">History and Political Science</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in studying and interpreting historical events and political systems to gain insights into the past and present.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEconomics" name="skiEconomics" value="1" <?php if (strpos($skiEconomics1, "1") !== false) {
																																							echo " checked";
																																						} ?>>
														<label class="form-check-label" for="skiEconomics">Economics</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of how societies allocate resources and make decisions about production, distribution, and consumption.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiGraphicsDesign" name="skiGraphicsDesign" value="1" <?php if (strpos($skiGraphicsDesign1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiGraphicsDesign">Graphics Design</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Creating visual content and layouts for digital or print media, including images, illustrations, and multimedia elements.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiInnovative" name="skiInnovative" value="1" <?php if (strpos($skiInnovative1, "1") !== false) {
																																								echo " checked";
																																							} ?>>
														<label class="form-check-label" for="skiInnovative">Innovative Thinking</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to generate new ideas, concepts, or approaches to solve problems, create opportunities, or enhance existing processes.">
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiResearchSkills" name="skiResearchSkills" value="1" <?php if (strpos($skiResearchSkills1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiResearchSkills">Research Skills</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The aptitude to gather, assess, and synthesize information from various sources to acquire knowledge and address questions or issues.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAnalyticalSkills" name="skiAnalyticalSkills" value="1" <?php if (strpos($skiAnalyticalSkills1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiAnalyticalSkills">Analytical Skills</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of examining and interpreting complex data or information to identify patterns, trends, or insights.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiBusinessPlanning" name="skiBusinessPlanning" value="1" <?php if (strpos($skiBusinessPlanning1, "1") !== false) {
																																											echo " checked";
																																										} ?>>
														<label class="form-check-label" for="skiBusinessPlanning">Business Planning</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of developing a detailed strategy for achieving business goals, including financial, operational, and marketing plans.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiComputerNetworking" name="skiComputerNetworking" value="1" <?php if (strpos($skiComputerNetworking1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiComputerNetworking">Computer Networking</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to set up, configure, and manage computer networks for data communication.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiSewingFashionDesign" name="skiSewingFashionDesign" value="1" <?php if (strpos($skiSewingFashionDesign1, "1") !== false) {
																																												echo " checked";
																																											} ?>>
														<label class="form-check-label" for="skiSewingFashionDesign">Sewing and Fashion Design</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to create and tailor clothing, including sewing, pattern-making, and fashion design.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiTimeManagement" name="skiTimeManagement" value="1" <?php if (strpos($skiTimeManagement1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiTimeManagement">Time Management</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of efficiently organizing and prioritizing tasks and activities to make the most of available time.">
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiDigitalLiteracy" name="skiDigitalLiteracy" value="1" <?php if (strpos($skiDigitalLiteracy1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiDigitalLiteracy">Digital Literacy</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in using digital devices and technology to access, understand, and communicate information effectively in the digital age.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiSociologicalAnalysis" name="skiSociologicalAnalysis" value="1" <?php if (strpos($skiSociologicalAnalysis1, "1") !== false) {
																																													echo " checked";
																																												} ?>>
														<label class="form-check-label" for="skiSociologicalAnalysis">Sociological Analysis</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of examining and understanding social phenomena, behavior, and institutions, often through a critical and systematic approach.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiMarketing" name="skiMarketing" value="1" <?php if (strpos($skiMarketing1, "1") !== false) {
																																							echo " checked";
																																						} ?>>
														<label class="form-check-label" for="skiMarketing">Marketing</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The practice of promoting and selling products or services by understanding customer needs and creating strategies to meet them.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiWebDevelopment" name="skiWebDevelopment" value="1" <?php if (strpos($skiWebDevelopment1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiWebDevelopment">Web Development</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of creating websites and web applications, involving coding, design, and functionality.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiInteriorDesign" name="skiInteriorDesign" value="1" <?php if (strpos($skiInteriorDesign1, "1") !== false) {
																																										echo " checked";
																																									} ?>>
														<label class="form-check-label" for="skiInteriorDesign">Interior Design</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Planning and decorating interior spaces to create functional and aesthetically pleasing environments.">
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAdaptability" name="skiAdaptability" value="1" <?php if (strpos($skiAdaptability1, "1") !== false) {
																																									echo " checked";
																																								} ?>>
														<label class="form-check-label" for="skiAdaptability">Adaptability</label>
														<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to adjust and thrive in changing circumstances, embracing new situations and challenges with flexibility.">
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
													<label for="intAnimationIllustration" class="form-label">Animation / Illustration</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Creating animations and illustrations using digital tools.">
													<input type="range" class="form-range" min="1" max="5" id="intAnimationIllustration" name="intAnimationIllustration" value="<?php echo $intAnimationIllustration1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intAppliedEconomics" class="form-label">Applied Economics</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Applying economic principles to real-world situations.">
													<input type="range" class="form-range" min="1" max="5" id="intAppliedEconomics" name="intAppliedEconomics" value="<?php echo $intAppliedEconomics1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBiology" class="form-label">Biology</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The exploration of living organisms and their processes.">
													<input type="range" class="form-range" min="1" max="5" id="intBiology" name="intBiology" value="<?php echo $intBiology1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBreadPastryProduction" class="form-label">Bread and Pastry Production</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Baking bread and pastries.">
													<input type="range" class="form-range" min="1" max="5" id="intBreadPastryProduction" name="intBreadPastryProduction" value="<?php echo $intBreadPastryProduction1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessEthicsSocialResponsibility" class="form-label">Business Ethics and Social Responsibility</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Exploring ethical issues in business and corporate social responsibility.">
													<input type="range" class="form-range" min="1" max="5" id="intBusinessEthicsSocialResponsibility" name="intBusinessEthicsSocialResponsibility" value="<?php echo $intBusinessEthicsSocialResponsibility1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessFinance" class="form-label">Business Finance</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Understanding financial management and investment.">
													<input type="range" class="form-range" min="1" max="5" id="intBusinessFinance" name="intBusinessFinance" value="<?php echo $intBusinessFinance1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessMath" class="form-label">Business Math</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Mathematical concepts used in business and finance.">
													<input type="range" class="form-range" min="1" max="5" id="intBusinessMath" name="intBusinessMath" value="<?php echo $intBusinessMath1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCalculus" class="form-label">Calculus</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of continuous change and mathematical analysis.">
													<input type="range" class="form-range" min="1" max="5" id="intCalculus" name="intCalculus" value="<?php echo $intCalculus1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCISCOComputerNetworking" class="form-label">CISCO Computer Networking</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Understanding network systems and Cisco technology.">
													<input type="range" class="form-range" min="1" max="5" id="intCISCOComputerNetworking" name="intCISCOComputerNetworking" value="<?php echo $intCISCOComputerNetworking1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intChemistry" class="form-label">Chemistry</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of substances, their properties, and chemical reactions.">
													<input type="range" class="form-range" min="1" max="5" id="intChemistry" name="intChemistry" value="<?php echo $intChemistry1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intComputerProgramming" class="form-label">Computer Programming</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Learning to write and develop computer programs.">
													<input type="range" class="form-range" min="1" max="5" id="intComputerProgramming" name="intComputerProgramming" value="<?php echo $intComputerProgramming1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intComputerSystemServicing" class="form-label">Computer System Servicing</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Maintaining and repairing computer systems.">
													<input type="range" class="form-range" min="1" max="5" id="intComputerSystemServicing" name="intComputerSystemServicing" value="<?php echo $intComputerSystemServicing1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intContactCenterServices" class="form-label">Contact Center Services</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Skills for customer service and communication.">
													<input type="range" class="form-range" min="1" max="5" id="intContactCenterServices" name="intContactCenterServices" value="<?php echo $intContactCenterServices1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCookery" class="form-label">Cookery</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Culinary skills and cooking techniques.">
													<input type="range" class="form-range" min="1" max="5" id="intCookery" name="intCookery" value="<?php echo $intCookery1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCreativeNonfiction" class="form-label">Creative Nonfiction</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Crafting factual narratives in engaging and artistic ways.">
													<input type="range" class="form-range" min="1" max="5" id="intCreativeNonfiction" name="intCreativeNonfiction" value="<?php echo $intCreativeNonfiction1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCreativeWriting" class="form-label">Creative Writing</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The practice of expressing thoughts and ideas through imaginative written works.">
													<input type="range" class="form-range" min="1" max="5" id="intCreativeWriting" name="intCreativeWriting" value="<?php echo $intCreativeWriting1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intDisciplinesIdeasSocialSciences" class="form-label">Disciplines and Ideas in the Social Sciences</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="An overview of various social science fields.">
													<input type="range" class="form-range" min="1" max="5" id="intDisciplinesIdeasSocialSciences" name="intDisciplinesIdeasSocialSciences" value="<?php echo $intDisciplinesIdeasSocialSciences1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFashionDesign" class="form-label">Fashion Design</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Designing clothing and fashion items.">
													<input type="range" class="form-range" min="1" max="5" id="intFashionDesign" name="intFashionDesign" value="<?php echo $intBreadPastryProduction1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFoodBeverages" class="form-label">Food and Beverages</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Managing food and beverage services.">
													<input type="range" class="form-range" min="1" max="5" id="intFoodBeverages" name="intFoodBeverages" value="<?php echo $intFoodBeverages1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFundamentalsABM" class="form-label">Fundamentals of ABM</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Introduction to Accounting, Business, and Management principles.">
													<input type="range" class="form-range" min="1" max="5" id="intFundamentalsABM" name="intFundamentalsABM" value="<?php echo $intFundamentalsABM1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intIntroWorldReligionsBeliefSystems" class="form-label">Introduction to World Religions and Belief Systems</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Exploring diverse religious beliefs and their impact on societies.">
													<input type="range" class="form-range" min="1" max="5" id="intIntroWorldReligionsBeliefSystems" name="intIntroWorldReligionsBeliefSystems" value="<?php echo $intIntroWorldReligionsBeliefSystems1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intOrganizationManagement" class="form-label">Organization and Management</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Principles of organizational structure and management.">
													<input type="range" class="form-range" min="1" max="5" id="intOrganizationManagement" name="intOrganizationManagement" value="<?php echo $intOrganizationManagement1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPhilippinePoliticsGovernance" class="form-label">Philippine Politics and Governance</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Examining political systems and governance in the Philippines.">
													<input type="range" class="form-range" min="1" max="5" id="intPhilippinePoliticsGovernance" name="intPhilippinePoliticsGovernance" value="<?php echo $intPhilippinePoliticsGovernance1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPhysics" class="form-label">Physics</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The investigation of matter, energy, and the fundamental forces of the universe.">
													<input type="range" class="form-range" min="1" max="5" id="intPhysics" name="intPhysics" value="<?php echo $intPhysics1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPrinciplesMarketing" class="form-label">Principles in Marketing</label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Basics of marketing strategies and consumer behavior.">
													<input type="range" class="form-range" min="1" max="5" id="intPrinciplesMarketing" name="intPrinciplesMarketing" value="<?php echo $intPrinciplesMarketing1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intTailoring" class="form-label">Tailoring </label>
													<img src='./images/info.png' alt='' width='18' height='18' class='' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Sewing and creating tailored clothing.">
													<input type="range" class="form-range" min="1" max="5" id="intTailoring" name="intTailoring" value="<?php echo $intTailoring1 ?>">
													<div class=" text-center">
														<span class="rangeValue">1</span>
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
											<p class="text-center fs-5 fw-bold mx-3 mb-0">Academic Performance</p>
										</div>
										<div class="row">
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadScience" name="acadScience">
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
													<select class="form-select" id="acadMath" name="acadMath">
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
													<select class="form-select" id="acadEnglish" name="acadEnglish">
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
													<select class="form-select" id="acadFilipino" name="acadFilipino">
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
													<select class="form-select" id="acadICTRelatedSub" name="acadICTRelatedSub">
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
													<select class="form-select" id="acadHERelatedSub" name="acadHERelatedSub">
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
											<p class="text-center fs-5 fw-bold mx-3 mb-0">Career Path</p>
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
										<button type="submit" class="btn btn-update form-button-text" id="submitButton" name="update2"><span class="fw-bold">UPDATE</span></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">Results</h4>
							</div>
							<div class="card-body">
								<h4>Profile: <span id="profileStatus" style="color: red">NOT DONE</span></h4>
								<p class="text-muted" id="profileStatusText" style="display: <?php echo (!empty($strandResult)) ? 'none' : 'block'; ?>;">Profile not done... Please Update your profile!</p>
								<p class="text-muted" id="profileStatusText" style="display: <?php echo (!empty($strandResult)) ? 'block' : 'none'; ?>;">Based on your Profile, here is your recommended strand!</p>
								<form action="" method="post">
									<div class="mb-3">
										<?php
											if(!empty($strandResult)){
												$terms_to_highlight = array('STEM', 'ABM', 'HUMSS', 'GAS', 'TVL-ICT', 'TVL-HE');
												$replacement_terms = array(
													'<span style="color: rgba(112,214,255,1.0); font-weight: bold;">STEM</span>',
													'<span style="color: rgba(255,151,112,1.0); font-weight: bold;">ABM</span>',
													'<span style="color: rgba(255,112,166,1.0); font-weight: bold;">HUMSS</span>',
													'<span style="color: rgba(255,214,112,1.0); font-weight: bold;">GAS</span>',
													'<span style="color: rgba(91,95,151,1.0); font-weight: bold;">TVL-ICT</span>',
													'<span style="color: rgba(104,122,0,1.0); font-weight: bold;">TVL-HE</span>'
												);

												$strandResult = str_replace($terms_to_highlight, $replacement_terms, $strandResult);
											}else{
												$strandResult = '<span style="color: red; font-weight: bold;">_____</span>';
											}
										?>
										<h3>RESULT: <?php echo $strandResult; ?></h3>
									</div>
									<div class="d-grid gap-2 d-md-flex justify-content-end">
										<button type="submit" id="generateBtn" name="generateBtn" class="btn btn-add form-button-text"><span class="fw-bold">GENERATE</span></button>
									</div>
								</form>
								<?php
								//check if the generate button has been clicked
								if (isset($_POST['generateBtn'])) {
									//check if there is an invalid data
									if (
										$intCalculus1 == 0 ||
										$intBiology1 == 0 ||
										$intPhysics1 == 0 ||
										$intChemistry1 == 0 ||
										$intCreativeWriting1 == 0 ||
										$intCreativeNonfiction1 == 0 ||
										$intIntroWorldReligionsBeliefSystems1 == 0 ||
										$intPhilippinePoliticsGovernance1 == 0 ||
										$intDisciplinesIdeasSocialSciences1 == 0 ||
										$intAppliedEconomics1 == 0 ||
										$intBusinessEthicsSocialResponsibility1 == 0 ||
										$intFundamentalsABM1 == 0 ||
										$intBusinessMath1 == 0 ||
										$intBusinessFinance1 == 0 ||
										$intOrganizationManagement1 == 0 ||
										$intPrinciplesMarketing1 == 0 ||
										$intComputerProgramming1 == 0 ||
										$intComputerSystemServicing1 == 0 ||
										$intContactCenterServices1 == 0 ||
										$intCISCOComputerNetworking1 == 0 ||
										$intAnimationIllustration1 == 0 ||
										$intCookery1 == 0 ||
										$intBreadPastryProduction1 == 0 ||
										$intFashionDesign1 == 0 ||
										$intFoodBeverages1 == 0 ||
										$intTailoring1 == 0
									) {//Interest data invalid
										echo "<script>Swal.fire({
											title: 'INVALID DATA!',
											text: 'Invalid data detected at the Interest Section! Please select a valid answer.',
											icon: 'error',
											showConfirmButton: false,
                                            timer: 5000
										});</script>";
									}else{//interest data valid
										if($TotalHouseholdMonthlyIncome1 == "SELECT" || empty($TotalHouseholdMonthlyIncome1)){ //thmi data invalid
											echo "<script>Swal.fire({
												title: 'INVALID DATA!',
												text: 'Invalid data detected at the Socioeconomic Section! Please select a valid answer.',
												icon: 'error',
												showConfirmButton: false,
                                                timer: 5000
											});</script>";
										}else{//thmi data valid
											if(($acadScience1 == "SELECT" || $acadMath1 == "SELECT" || $acadEnglish1 == "SELECT" || $acadFilipino1 == "SELECT" || $acadICTRelatedSub1 == "SELECT" || $acadHERelatedSub1 == "SELECT") || (empty($acadScience1) || empty($acadMath1) || empty($acadEnglish1) || empty($acadFilipino1) || empty($acadICTRelatedSub1) || empty($acadHERelatedSub1))){ //academic perf data invalid
												echo "<script>Swal.fire({
													title: 'INVALID DATA!',
													text: 'Invalid data detected at the Academic Performance Section! Please select a valid answer.',
													icon: 'error',
													showConfirmButton: false,
                                                	timer: 5000
												});</script>";
											}else{//academic perf data valid
												$id = $_GET['lrn']; //get the lrn of the student
									
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
												$filename = 'output'. time() . '.json';
												$json_file = '../Model/' . $filename;
												file_put_contents($json_file, $input_json);
												/*if (file_put_contents($json_file, $input_json)) {
													echo "<p>JSON data saved to $json_file.</p>";
												} else {
													echo "<p>Error saving JSON data to $json_file.</p>";
												}*/

												$jsonfile_path .= $filename . '"';

												//construct the command to execute the R script with input JSON
												$command = $r_scriptexe_path . " " . $r_script_path . " " . $jsonfile_path;
												// echo "<p>Here is the result: " . $command;

												//execute the command and capture the output
												$output = shell_exec($command);
												unlink($json_file);
												// echo "<p>Here is the result: " . $output;

												//parse the JSON output from R
												$resultscores = json_decode($output, true);
												//print_r($resultscores);

												$studentScores = $resultscores['StudentScores'];
												usort($studentScores, function($a, $b) {
													return $b['Percentage_Score'] <=> $a['Percentage_Score'];
												});
												$topThree = array_slice($studentScores, 0, 3);
												//print_r($topThree);

												//access the result scores
												$mostSuitableStrand = $resultscores["MostSuitableStrand"][0];
												$secondSuitableStrand = $topThree[1]['Strand'];
												$thirdSuitableStrand = $topThree[2]['Strand'];

												// Access the first element of StudentScores
												$stemStudentScore = $resultscores["StudentScores"][0];
												$humssStudentScore = $resultscores["StudentScores"][1];
												$abmStudentScore = $resultscores["StudentScores"][2];
												$gasStudentScore = $resultscores["StudentScores"][3];
												$tvlictStudentScore = $resultscores["StudentScores"][4];
												$tvlheStudentScore = $resultscores["StudentScores"][5];

												// Access specific values within the first student score
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
												$prompt = "You function as a Decision Support System for upcoming senior high school students. Based on the assesement that takes into account the student's skills, interests, academic performance, and career aspirations, Here are the Top 3 Strand the student is most suitable with:
													TOP 1: ". $mostSuitableStrand ."; Overall Score in Percentage=". $topThree[0]['Percentage_Score'] ." Skills=". $topThree[0]['Skills_Probability'] ." Interest=". $topThree[0]['Interest_Probability'] ." Academic Performance=". $topThree[0]['Academic_Probability'] ." Carrer Aspiration=". $topThree[0]['Career_Probability'] ."
													TOP 2: ". $secondSuitableStrand ."; Overall Score in Percentage=". $topThree[1]['Percentage_Score'] ." Skills=". $topThree[1]['Skills_Probability'] ." Interest=". $topThree[1]['Interest_Probability'] ." Academic Performance=". $topThree[1]['Academic_Probability'] ." Carrer Aspiration=". $topThree[1]['Career_Probability'] ."
													TOP 3: ". $thirdSuitableStrand ."; Overall Score in Percentage=". $topThree[2]['Percentage_Score'] ." Skills=". $topThree[2]['Skills_Probability'] ." Interest=". $topThree[2]['Interest_Probability'] ." Academic Performance=". $topThree[2]['Academic_Probability'] ." Carrer Aspiration=". $topThree[2]['Career_Probability'] ."
													Here is also his socioeconomic backgrond, their Total Household Monthly Income in Philippine Peso: ". $TotalHouseholdMonthlyIncome1 ."
													Based on the provided information, create a recomendation or advice for the student on what senior high school best fit him. Always State the strand he is most suitable with which is ". $mostSuitableStrand ." and the next top two strand are ". $secondSuitableStrand ." and ". $thirdSuitableStrand ." respectively. Also provide an advice based on his socioeconomic background on how it will affect his journey in the senior high. Start your statement with 'Based on your result...' and state at the end that the choice is always up to them, consult with their parents, teachers, and guidance councelors.";

												//place yout api key here
												$client = OpenAI::client($apiKey);

												$maxAttempts = 10;
												$attempt = 1;
												$recomendation = null;
												$timeout = false;

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
															$timeout = false;
															break;
														} else { //try again
															$attempt++;
															sleep(1);
														}
													}catch(Exception $e){
														echo 'Caught exception: ',  $e->getMessage(), "\n";
														$timeout = true;
														$attempt++;
													}
												}

												if ($recomendation === null || $timeout) {//handle the case where a recommendation was not obtained after maximum attempts
													echo "<script>Swal.fire({
														title: 'UNABLE TO GENERATE A RECOMMENDATION!',
														text: 'Please try again...!',
														icon: 'error',
														buttons: {
														  confirm: true,
														},
													  }).then((value) => {
														if (value) {
														  document.location='viewprofile.php';
														} else {
														  document.location='viewprofile.php';
														}
													  });</script>";
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
															//log the generation
															$admin_username = $_SESSION['fullname'];
															$log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Updated', 'Student with LRN $id got its results updated', '$admin_username')";
															$conn->query($log);
															
															echo "<script>Swal.fire({
																title: 'Successfully Generated',
																text: 'Student results generated successfully!',
																icon: 'success',
																buttons: {
																confirm: true,
																},
															}).then((value) => {
																if (value) {
																document.location='viewprofile.php?lrn=". $_GET['lrn'] ."&name=". $_GET['name'] ."';
																} else {
																document.location='viewprofile.php?lrn=". $_GET['lrn'] ."&name=". $_GET['name'] ."';
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
										}
									}
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">STATISTIC</h4>
							</div>

							<?php
							//check for the students lrn
							if (isset($_GET['lrn'])) {
								include "connection.php"; //include the connection file

								$user_id = $_GET['lrn']; //get the lrn

								//prep the select query
								$sql = "SELECT sp.*, r.*, 
								sr.acadProb AS acadProbStem, 
								sr.intProb AS intProbStem, 
								sr.carProb AS carProbStem, 
								sr.skiProb AS skiProbStem, 
								sr.totalScore AS totalScoreStem, 
								sr.percScore AS percScoreStem, 
								hr.acadProb AS acadProbHumss, 
								hr.intProb AS intProbHumss, 
								hr.carProb AS carProbHumss, 
								hr.skiProb AS skiProbHumss, 
								hr.totalScore AS totalScoreHumss, 
								hr.percScore AS percScoreHumss, 
								ar.acadProb AS acadProbAbm, 
								ar.intProb AS intProbAbm, 
								ar.carProb AS carProbAbm, 
								ar.skiProb AS skiProbAbm, 
								ar.totalScore AS totalScoreAbm, 
								ar.percScore AS percScoreAbm, 
								gr.acadProb AS acadProbGas, 
								gr.intProb AS intProbGas, 
								gr.carProb AS carProbGas, 
								gr.skiProb AS skiProbGas, 
								gr.totalScore AS totalScoreGas, 
								gr.percScore AS percScoreGas, 
								tr.acadProb AS acadProbTvlict, 
								tr.intProb AS intProbTvlict, 
								tr.carProb AS carProbTvlict, 
								tr.skiProb AS skiProbTvlict, 
								tr.totalScore AS totalScoreTvlict, 
								tr.percScore AS percScoreTvlict, 
								tlr.acadProb AS acadProbTvlhe, 
								tlr.intProb AS intProbTvlhe, 
								tlr.carProb AS carProbTvlhe, 
								tlr.skiProb AS skiProbTvlhe, 
								tlr.totalScore AS totalScoreTvlhe, 
								tlr.percScore AS percScoreTvlhe 
						FROM studentprofile sp
						JOIN result r ON sp.lrn = r.lrn 
						JOIN stemresult sr ON sp.lrn = sr.lrn 
						JOIN humssresult hr ON sp.lrn = hr.lrn 
						JOIN abmresult ar ON sp.lrn = ar.lrn 
						JOIN gasresult gr ON sp.lrn = gr.lrn 
						JOIN tvlictresult tr ON sp.lrn = tr.lrn 
						JOIN tvlheresult tlr ON sp.lrn = tlr.lrn 
						WHERE sp.lrn = '$user_id';";

								$result = $conn->query($sql);

								if ($result->num_rows > 0) {

									while ($row = $result->fetch_assoc()) {
										//get all the student's result
										$recommendation = $row['recommendation'];

										$ovrSTEM = $row['percScoreStem'];
										$ovrHUMSS = $row['percScoreHumss'];
										$ovrABM = $row['percScoreAbm'];
										$ovrGAS = $row['percScoreGas'];
										$ovrTVLICT = $row['percScoreTvlict'];
										$ovrTVLHE = $row['percScoreTvlhe'];

										$skiSTEM = $row['skiProbStem'];
										$skiHUMSS = $row['skiProbHumss'];
										$skiABM = $row['skiProbAbm'];
										$skiGAS = $row['skiProbGas'];
										$skiTVLICT = $row['skiProbTvlict'];
										$skiTVLHE = $row['skiProbTvlhe'];

										$intSTEM = $row['intProbStem'];
										$intHUMSS = $row['intProbHumss'];
										$intABM = $row['intProbAbm'];
										$intGAS = $row['intProbGas'];
										$intTVLICT = $row['intProbTvlict'];
										$intTVLHE = $row['intProbTvlhe'];

										$acadSTEM = $row['acadProbStem'];
										$acadHUMSS = $row['acadProbHumss'];
										$acadABM = $row['acadProbAbm'];
										$acadGAS = $row['acadProbGas'];
										$acadTVLICT = $row['acadProbTvlict'];
										$acadTVLHE = $row['acadProbTvlhe'];

										$carSTEM = $row['carProbStem'];
										$carHUMSS = $row['carProbHumss'];
										$carABM = $row['carProbAbm'];
										$carGAS = $row['carProbGas'];
										$carTVLICT = $row['carProbTvlict'];
										$carTVLHE = $row['carProbTvlhe'];
									}
									//check if the student has a result already
									$haveResult = ($ovrSTEM == 0 && $ovrHUMSS == 0 && $ovrABM == 0 && $ovrGAS == 0 && $ovrTVLICT == 0 && $ovrTVLHE == 0) ? 0 : 1;
								}
							}
							?>

							<div class="card-body">
								<div class="row w-100">
									<input type="hidden" class="checkRes" name="checkRes" id="checkRes" value="<?php echo $haveResult; ?>">
									<p id="messageTitle">LEGENDS:
										<small class="fw-bold" style="color: rgba(112,214,255,1.0);">STEM</small> -
										<small class="fw-bold" style="color: rgba(255,112,166,1.0);">HUMSS</small> -
										<small class="fw-bold" style="color: rgba(255,151,112,1.0);">ABM</small> -
										<small class="fw-bold" style="color: rgba(255,214,112,1.0);">GAS</small> -
										<small class="fw-bold" style="color: rgba(91,95,151,1.0);">TVL-ICT</small> -
										<small class="fw-bold" style="color: rgba(104,122,0,1.0);">TVL-HE</small>
									</p>
									<div class="col-12">
										<canvas id="overallpieChart"></canvas>
										<input type="hidden" class="ovr" name="ovrSTEM" id="ovrSTEM" value="<?php echo $ovrSTEM; ?>">
										<input type="hidden" class="ovr" name="ovrHUMSS" id="ovrHUMSS" value="<?php echo $ovrHUMSS; ?>">
										<input type="hidden" class="ovr" name="ovrABM" id="ovrABM" value="<?php echo $ovrABM; ?>">
										<input type="hidden" class="ovr" name="ovrGAS" id="ovrGAS" value="<?php echo $ovrGAS; ?>">
										<input type="hidden" class="ovr" name="ovrTVLICT" id="ovrTVLICT" value="<?php echo $ovrTVLICT; ?>">
										<input type="hidden" class="ovr" name="ovrTVLHE" id="ovrTVLHE" value="<?php echo $ovrTVLHE; ?>">
									</div>
									<div class="col-12 col-md-6">
										<canvas id="skipieChart"></canvas>
										<input type="hidden" class="ski" name="skiSTEM" id="skiSTEM" value="<?php echo $skiSTEM; ?>">
										<input type="hidden" class="ski" name="skiHUMSS" id="skiHUMSS" value="<?php echo $skiHUMSS; ?>">
										<input type="hidden" class="ski" name="skiABM" id="skiABM" value="<?php echo $skiABM; ?>">
										<input type="hidden" class="ski" name="skiGAS" id="skiGAS" value="<?php echo $skiGAS; ?>">
										<input type="hidden" class="ski" name="skiTVLICT" id="skiTVLICT" value="<?php echo $skiTVLICT; ?>">
										<input type="hidden" class="ski" name="skiTVLHE" id="skiTVLHE" value="<?php echo $skiTVLHE; ?>">
									</div>
									<div class="col-12 col-md-6">
										<canvas id="intpieChart"></canvas>
										<input type="hidden" class="int" name="intSTEM" id="intSTEM" value="<?php echo $intSTEM; ?>">
										<input type="hidden" class="int" name="intHUMSS" id="intHUMSS" value="<?php echo $intHUMSS; ?>">
										<input type="hidden" class="int" name="intABM" id="intABM" value="<?php echo $intABM; ?>">
										<input type="hidden" class="int" name="intGAS" id="intGAS" value="<?php echo $intGAS; ?>">
										<input type="hidden" class="int" name="intTVLICT" id="intTVLICT" value="<?php echo $intTVLICT; ?>">
										<input type="hidden" class="int" name="intTVLHE" id="intTVLHE" value="<?php echo $intTVLHE; ?>">
									</div>
									<div class="col-12 col-md-6">
										<canvas id="acadpieChart"></canvas>
										<input type="hidden" class="acad" name="acadSTEM" id="acadSTEM" value="<?php echo $acadSTEM; ?>">
										<input type="hidden" class="acad" name="acadHUMSS" id="acadHUMSS" value="<?php echo $acadHUMSS; ?>">
										<input type="hidden" class="acad" name="acadABM" id="acadABM" value="<?php echo $acadABM; ?>">
										<input type="hidden" class="acad" name="acadGAS" id="acadGAS" value="<?php echo $acadGAS; ?>">
										<input type="hidden" class="acad" name="acadTVLICT" id="acadTVLICT" value="<?php echo $acadTVLICT; ?>">
										<input type="hidden" class="acad" name="acadTVLHE" id="acadTVLHE" value="<?php echo $acadTVLHE; ?>">
									</div>
									<div class="col-12 col-md-6">
										<canvas id="careerpieChart"></canvas>
										<input type="hidden" class="car" name="carSTEM" id="carSTEM" value="<?php echo $carSTEM; ?>">
										<input type="hidden" class="car" name="carHUMSS" id="carHUMSS" value="<?php echo $carHUMSS; ?>">
										<input type="hidden" class="car" name="carABM" id="carABM" value="<?php echo $carABM; ?>">
										<input type="hidden" class="car" name="carGAS" id="carGAS" value="<?php echo $carGAS; ?>">
										<input type="hidden" class="car" name="carTVLICT" id="carTVLICT" value="<?php echo $carTVLICT; ?>">
										<input type="hidden" class="car" name="carTVLHE" id="carTVLHE" value="<?php echo $carTVLHE; ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">RECOMMENDATION</h4>
							</div>
							<div class="card-body text-start">
								<?php
								if (empty($recommendation)) {
									//if the recommendation is empty
									echo "<p class='fw-bold text-center'>NO RESULTS HAVE BEEN FOUND!</p>";
								} else {
									//display the recomendation
									$terms_to_highlight = array('STEM', 'ABM', 'HUMSS', 'GAS', 'TVL-ICT', 'TVL-HE');
									$replacement_terms = array(
										'<span style="color: rgba(112,214,255,1.0); font-weight: bold;">STEM</span>',
										'<span style="color: rgba(255,151,112,1.0); font-weight: bold;">ABM</span>',
										'<span style="color: rgba(255,112,166,1.0); font-weight: bold;">HUMSS</span>',
										'<span style="color: rgba(255,214,112,1.0); font-weight: bold;">GAS</span>',
										'<span style="color: rgba(91,95,151,1.0); font-weight: bold;">TVL-ICT</span>',
										'<span style="color: rgba(104,122,0,1.0); font-weight: bold;">TVL-HE</span>'
									);

									$recommendation = str_replace($terms_to_highlight, $replacement_terms, $recommendation);

									$sentences = explode('. ', $recommendation);

									$midpoint = ceil(count($sentences) / 2);

									$paragraph1 = implode('. ', array_slice($sentences, 0, $midpoint)) . ".";
									$paragraph2 = implode('. ', array_slice($sentences, $midpoint));

									echo "<p style='text-align: justify; text-indent: 20px;'>" . $paragraph1 . "</p> <p style='text-align: justify; text-indent: 20px;'>" . $paragraph2 . "</p>";
									//echo "<p>". $recommendation . "</p>";
								}
								?>
							</div>
						</div>
					</div>
					<?php
						if (!empty($recommendation)) {
							$lrn=$_GET['lrn'];
							echo "<div class='col-12 d-flex justify-content-center align-items-center mb-3'>
									<a href='printpdf.php?lrn=$lrn'  target='_blank' class='btn btn-view fw-bold w-100' role='button'>PRINT RESULTS</a>
								</div>";
						}
					?>
				</div>
			</section>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	<script>
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
			var regex = /^[a-zA-Z\s]*$/; // Regular expression to allow only alphanumeric characters and spaces

			if (!regex.test(input.value)) {
				input.value = input.value.replace(/[^a-zA-Z\s]/g, ''); // Remove any special characters
			}
		}

		function calculateAge() {
			// Get the input elements
			var bdayInput = document.getElementById('bday');
			var ageInput = document.getElementById('age');

			// Get the selected date value from the birthday input
			var selectedDate = new Date(bdayInput.value);

			// Get the current date
			var currentDate = new Date();

			// Calculate the difference in years between the selected date and the current date
			var age = currentDate.getFullYear() - selectedDate.getFullYear();

			// Check if the birthday for this year has already occurred
			if (
				currentDate.getMonth() < selectedDate.getMonth() ||
				(currentDate.getMonth() === selectedDate.getMonth() && currentDate.getDate() < selectedDate.getDate())
			) {
				age--;
			}

			// Update the age input field
			ageInput.value = age;
		}

		// Attach the calculateAge function to the oninput event of the birthday input
		document.getElementById('bday').addEventListener('input', calculateAge);

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
			const profileStatusText = document.getElementById("profileStatusText");
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
				profileStatusText.textContent = "Profile not done... Please Update your profile!"
				// Change the text color to green
				profileStatus.style.color = "red";

				//Disable the button
				generateButton.disabled = true;
			} else {
				// Update the text to "DONE"
				profileStatus.textContent = "DONE";
				profileStatusText.textContent = "Profile is done... Ready for Strand Recommendation!"
				// Change the text color to green
				profileStatus.style.color = "green";

				//Enable the button
				generateButton.disabled = false;
			}

			//for checking if there is a result generated for the student
			const checkRes = document.getElementById('checkRes');
			const canvases = document.querySelectorAll('canvas');
			const messageTitle = document.getElementById('messageTitle');

			if (checkRes.value === '0') {//no results
				for (let i = 0; i < canvases.length; i++) {
					canvases[i].style.display = 'none';
				}
				messageTitle.innerText = 'NO RESULTS HAVE BEEN FOUND!';
				messageTitle.classList.add('fw-bold');
			} else {//have results, display it
				var labels = ["STEM", "HUMSS", "ABM", "GAS", "TVL-ICT", "TVL-HE"];
				var skivalues = [];
				var intvalues = [];
				var acadvalues = [];
				var careervalues = [];
				var overallvalues = [];

				let ovrhiddenInputs = document.querySelectorAll("input[type=hidden].ovr");
				ovrhiddenInputs.forEach(input => {
					overallvalues.push(input.value);
				});

				let skihiddenInputs = document.querySelectorAll("input[type=hidden].ski");
				skihiddenInputs.forEach(input => {
					skivalues.push(input.value);
				});

				let inthiddenInputs = document.querySelectorAll("input[type=hidden].int");
				inthiddenInputs.forEach(input => {
					intvalues.push(input.value);
				});

				let acadhiddenInputs = document.querySelectorAll("input[type=hidden].acad");
				acadhiddenInputs.forEach(input => {
					acadvalues.push(input.value);
				});

				let carhiddenInputs = document.querySelectorAll("input[type=hidden].car");
				carhiddenInputs.forEach(input => {
					careervalues.push(input.value);
				});

				var barColors = [
					"rgba(112,214,255,1.0)",
					"rgba(255,112,166,1.0)",
					"rgba(255,151,112,1.0)",
					"rgba(255,214,112,1.0)",
					"rgba(91,95,151,1.0)",
					"rgba(104,122,0,1.0)",
				];

				const skipieChart = new Chart("skipieChart", {
					type: "doughnut",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: barColors,
							data: skivalues
						}]
					},
					options: {
						title: {
							display: true,
							text: "Skills"
						},
						legend: {
							display: false
						}
					}
				});

				const intpieChart = new Chart("intpieChart", {
					type: "doughnut",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: barColors,
							data: intvalues
						}]
					},
					options: {
						title: {
							display: true,
							text: "Interests"
						},
						legend: {
							display: false
						}
					}
				});

				const acadpieChart = new Chart("acadpieChart", {
					type: "doughnut",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: barColors,
							data: acadvalues
						}]
					},
					options: {
						title: {
							display: true,
							text: "Academic Performance"
						},
						legend: {
							display: false
						}
					}
				});

				const careerpieChart = new Chart("careerpieChart", {
					type: "doughnut",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: barColors,
							data: careervalues
						}]
					},
					options: {
						title: {
							display: true,
							text: "Career"
						},
						legend: {
							display: false
						}
					}
				});

				const overallpieChart = new Chart("overallpieChart", {
					type: "doughnut",
					data: {
						labels: labels,
						datasets: [{
							backgroundColor: barColors,
							data: overallvalues
						}]
					},
					options: {
						title: {
							display: true,
							text: "OVERALL"
						},
						legend: {
							display: false
						}
					}
				});
			}
		});

		function showLoading() {
			Swal.fire({
				title: 'Generating Recommendations!',
				text: 'Please wait...',
				allowOutsideClick: false,
				didOpen: () => {
				  Swal.showLoading();
				}
			});
		}

		document.getElementById('generateBtn').addEventListener('click', function() {
			showLoading();
		});

		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
	</script>
</body>

</html>