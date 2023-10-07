<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strand Selection Admin Ver2</title>
	<link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js" integrity="sha512-zO8oeHCxetPn1Hd9PdDleg5Tw1bAaP0YmNvPY8CwcRyUk7d7/+nyElmFrB6f7vg4f7Fv4sui1mcep8RIEShczg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
	<header class="navbar sticky-top flex-md-nowrap p-0 shadow">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="./images/SystemBrandWhiteVer2.png" alt="Logo" width="200" height="34" class="d-inline-block align-text-top">
			</a>
		</div>
	</header>

	<main class="row section-100">
		<div class="col-2">
			<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 100%; height: 100%;" id="sidebarMenu">
				<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
					<span class="fs-4">ADMIN</span>
				</a>
				<hr>
				<ul class="nav nav-pills flex-column mb-auto">
					<li class="nav-item">
						<a href="./dashboard.php" class="nav-link link-body-emphasis">
							<img src="./images/dashboard.png" alt="" width="16" height="16" class="bi pe-none me-2">
							DASHBOARD
						</a>
					</li>
					<li>
						<a href="./profiles.php" class="nav-link active" aria-current="page">
							<img src="./images/profiles.png" alt="" width="16" height="16" class="bi pe-none me-2">
							PROFILES
						</a>
					</li>
					<li>
						<a href="./admins.php" class="nav-link link-body-emphasis">
							<img src="./images/admins.png" alt="" width="16" height="16" class="bi pe-none me-2">
							ADMINS
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
				</ul>
				<hr>
				<div class="dropdown">
					<a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="./images/man.png" alt="" width="32" height="32" class="rounded-circle me-2">
						<strong>mdo</strong>
					</a>
					<ul class="dropdown-menu text-small shadow">
						<li><a class="dropdown-item" href="#">Profile</a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><a class="dropdown-item" href="#">Sign out</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-10">
			<section class="section-100 d-flex flex-column py-2">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="fw-bold sub-title">[LRN]</h1>
				</div>
				<div class="row w-100">
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">Account Details</h4>
							</div>
							<div class="card-body">
								<form class="row" action="" method="post">
									<div class="col-12 mb-1">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" id="lrn" name="lrn" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="Learner's Reference Number" required>
											<label for="lrn">Learner's Reference Number</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="fname" name="fname" oninput="validateName(this)" placeholder="First Name" required>
											<label for="fname">First Name</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="mname" name="mname" oninput="validateName(this)" placeholder="Middle Name">
											<label for="mname">Middle Name</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="lname" name="lname" oninput="validateName(this)" placeholder="Last Name" required>
											<label for="lname">Last Name</label>
										</div>
									</div>
									<div class="col-12 col-md-3 mb-1">
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="suffix" name="suffix" oninput="validateName(this)" placeholder="Suffix">
											<label for="suffix">Suffix</label>
										</div>
									</div>
									<div class="col-12 mb-3">
										<div class="form-floating mb-1">
											<input type="text" class="form-control" id="address" name="address" oninput="validateAddress(this)" placeholder="Address" required>
											<label for="address">Address</label>
										</div>
									</div>
									<div class="col-12 col-md-4 mb-1">
										<div class="form-floating mb-3">
											<select class="form-select" id="sex" name="sex" value="">
												<option value="M">Male</option>
												<option value="F">Female</option>
											</select>
											<label for="sex">Sex</label>
										</div>
									</div>
									<div class="col-12 col-md-4 mb-1">
										<div class="form-floating mb-3">
											<input type="number" class="form-control" id="age" name="age" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Age" required>
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
											<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
											<label for="email">Email</label>
										</div>
									</div>
									<div class="col-12 col-md-6 mb-1">
										<div class="form-floating">
											<input type="password" class="form-control" id="pass1" name="pass1" placeholder="Password">
											<label for="pass1">PASSWORD</label>
										</div>
										<div class="col-sm-6" id="passstrength" style="font-weight:bold;padding:6px 12px;">

										</div>
									</div>
									<div class="col-12 col-md-6 mb-1">
										<div class="form-floating">
											<input type="password" class="form-control" id="pass2" name="pass1" placeholder="Confirm Password">
											<label for="pass2">CONFIRM PASSWORD</label>
										</div>
									</div>
									<div class="d-grid gap-2 d-md-flex justify-content-end">
										<button type="button" class="btn btn-update form-button-text"><span class="fw-bold">UPDATE</span></button>
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
														<input class="form-check-input" type="checkbox" id="skiCommunicationSkills" name="skiCommunicationSkills" value="1">
														<label class="form-check-label" for="skiCommunicationSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to convey thoughts, ideas, or information effectively to others through various means, such as speaking, writing, or listening.">Communication Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCriticalThinking" name="skiCriticalThinking" value="1">
														<label class="form-check-label" for="skiCriticalThinking" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to analyze, evaluate, and reason about information and situations in a logical and thoughtful manner to make informed decisions.">Critical Thinking</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiReadingComprehension" name="skiReadingComprehension" value="1">
														<label class="form-check-label" for="skiReadingComprehension" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of understanding and interpreting written text, including identifying key ideas and details.">Reading Comprehension</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiProblemSolving" name="skiProblemSolving" value="1">
														<label class="form-check-label" for="skiProblemSolving" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capability to identify challenges, analyze them, and develop effective solutions or strategies to overcome them.">Problem Solving</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiResearchSkills" name="skiResearchSkills" value="1">
														<label class="form-check-label" for="skiResearchSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The aptitude to gather, assess, and synthesize information from various sources to acquire knowledge and address questions or issues.">Research Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiDigitalLiteracy" name="skiDigitalLiteracy" value="1">
														<label class="form-check-label" for="skiDigitalLiteracy" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in using digital devices and technology to access, understand, and communicate information effectively in the digital age.">Digital Literacy</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiInnovative" name="skiInnovative" value="1">
														<label class="form-check-label" for="skiInnovative" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to generate new ideas, concepts, or approaches to solve problems, create opportunities, or enhance existing processes.">Innovative</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiTimeManagement" name="skiTimeManagement" value="1">
														<label class="form-check-label" for="skiTimeManagement" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of efficiently organizing and prioritizing tasks and activities to make the most of available time.">Time Management</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAdaptability" name="skiAdaptability" value="1">
														<label class="form-check-label" for="skiAdaptability" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to adjust and thrive in changing circumstances, embracing new situations and challenges with flexibility.">Adaptability</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">STEM Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiScientificInquiry" name="skiScientificInquiry" value="1">
														<label class="form-check-label" for="skiScientificInquiry" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of asking questions, conducting investigations, and drawing conclusions based on evidence to understand the natural world.">Scientific Inquiry</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiMathematicalSkills" name="skiMathematicalSkills" value="1">
														<label class="form-check-label" for="skiMathematicalSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to use mathematical concepts, operations, and methods to solve problems and make sense of numerical information.">Mathematical Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiLogicalReasoning" name="skiLogicalReasoning" value="1">
														<label class="form-check-label" for="skiLogicalReasoning" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to think rationally and systematically, making well-structured, coherent arguments and decisions.">Logical Reasoning</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiLabExperimentalSkills" name="skiLabExperimentalSkills" value="1">
														<label class="form-check-label" for="skiLabExperimentalSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in conducting experiments, including using equipment, collecting data, and following scientific procedures accurately.">Lab and Experimental Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAnalyticalSkills" name="skiAnalyticalSkills" value="1">
														<label class="form-check-label" for="skiAnalyticalSkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of examining and interpreting complex data or information to identify patterns, trends, or insights.">Analytical Skills</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">HUMSS Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiResearchWriting" name="skiResearchWriting" value="1">
														<label class="form-check-label" for="skiResearchWriting" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to gather information systematically and communicate ideas effectively through written means.">Research and Writing</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiSociologicalAnalysis" name="skiSociologicalAnalysis" value="1">
														<label class="form-check-label" for="skiSociologicalAnalysis" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of examining and understanding social phenomena, behavior, and institutions, often through a critical and systematic approach.">Sociological Analysis</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCulturalCompetence" name="skiCulturalCompetence" value="1">
														<label class="form-check-label" for="skiCulturalCompetence" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The capacity to interact and work effectively with people from diverse cultural backgrounds while respecting and valuing their beliefs and practices.">Cultural Competence</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEthicalReasoning" name="skiEthicalReasoning" value="1">
														<label class="form-check-label" for="skiEthicalReasoning" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of evaluating moral dilemmas and making decisions that align with ethical principles and values.">Ethical Reasoning</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiHistoryPoliticalScience" name="skiHistoryPoliticalScience" value="1">
														<label class="form-check-label" for="skiHistoryPoliticalScience" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in studying and interpreting historical events and political systems to gain insights into the past and present.">History and Political Science</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">ABM Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiFinancialLiteracy" name="skiFinancialLiteracy" value="1">
														<label class="form-check-label" for="skiFinancialLiteracy" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The understanding of financial concepts and practices, enabling informed financial decision-making.">Financial Literacy</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiBusinessPlanning" name="skiBusinessPlanning" value="1">
														<label class="form-check-label" for="skiBusinessPlanning" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The process of developing a detailed strategy for achieving business goals, including financial, operational, and marketing plans.">Business Planning</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiMarketing" name="skiMarketing" value="1">
														<label class="form-check-label" for="skiMarketing" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The practice of promoting and selling products or services by understanding customer needs and creating strategies to meet them.">Marketing</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiAccounting" name="skiAccounting" value="1">
														<label class="form-check-label" for="skiAccounting" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The systematic recording, reporting, and analysis of financial transactions to track a business's financial health.">Accounting</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEntrepreneurship" name="skiEntrepreneurship" value="1">
														<label class="form-check-label" for="skiEntrepreneurship" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to identify business opportunities, take calculated risks, and create and manage successful ventures.">Entrepreneurship</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiEconomics" name="skiEconomics" value="1">
														<label class="form-check-label" for="skiEconomics" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of how societies allocate resources and make decisions about production, distribution, and consumption.">Economics</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">TVL-ICT Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiComputerHardwareSoftware" name="skiComputerHardwareSoftware" value="1">
														<label class="form-check-label" for="skiComputerHardwareSoftware" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Knowledge of computer components and software programs, including installation and maintenance.">Computer Hardware and Software</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiComputerNetworking" name="skiComputerNetworking" value="1">
														<label class="form-check-label" for="skiComputerNetworking" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to set up, configure, and manage computer networks for data communication.">Computer Networking</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiWebDevelopment" name="skiWebDevelopment" value="1">
														<label class="form-check-label" for="skiWebDevelopment" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The skill of creating websites and web applications, involving coding, design, and functionality.">Web Development</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiProgramming" name="skiProgramming" value="1">
														<label class="form-check-label" for="skiProgramming" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Writing, testing, and maintaining the source code of computer programs to achieve specific tasks or functions.">Programming</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiTroubleshooting" name="skiTroubleshooting" value="1">
														<label class="form-check-label" for="skiTroubleshooting" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to identify and resolve technical issues or problems in hardware, software, or systems.">Troubleshooting</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiGraphicsDesign" name="skiGraphicsDesign" value="1">
														<label class="form-check-label" for="skiGraphicsDesign" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Creating visual content and layouts for digital or print media, including images, illustrations, and multimedia elements.">Graphics Design</label>
													</div>
												</div>
											</div>
											<div class="col-12 col-sm-6 col-md-4">
												<p id="" class="fst-italic d-block form-label">TVL-HE Skills</p>
												<div class="text-start">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiCulinarySkills" name="skiCulinarySkills" value="1">
														<label class="form-check-label" for="skiCulinarySkills" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Proficiency in food preparation, cooking techniques, and culinary arts.">Culinary Skills</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiSewingFashionDesign" name="skiSewingFashionDesign" value="1">
														<label class="form-check-label" for="skiSewingFashionDesign" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The ability to create and tailor clothing, including sewing, pattern-making, and fashion design.">Sewing and Fashion Design</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiInteriorDesign" name="skiInteriorDesign" value="1">
														<label class="form-check-label" for="skiInteriorDesign" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Planning and decorating interior spaces to create functional and aesthetically pleasing environments.">Interior Design</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiChildcareFamilyServices" name="skiChildcareFamilyServices" value="1">
														<label class="form-check-label" for="skiChildcareFamilyServices" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Providing care, support, and services for children and families, often including early childhood education and child development.">Childcare and Family Services</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="skiNutritionFoodSafety" name="skiNutritionFoodSafety" value="1">
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
													<input type="range" class="form-range" min="0" max="5" id="intCalculus" name="intCalculus" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBiology" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The exploration of living organisms and their processes.">Biology</label>
													<input type="range" class="form-range" min="0" max="5" id="intBiology" name="intBiology" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPhysics" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The investigation of matter, energy, and the fundamental forces of the universe.">Physics</label>
													<input type="range" class="form-range" min="0" max="5" id="intPhysics" name="intPhysics" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intChemistry" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The study of substances, their properties, and chemical reactions.">Chemistry</label>
													<input type="range" class="form-range" min="0" max="5" id="intChemistry" name="intChemistry" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCreativeWriting" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="The practice of expressing thoughts and ideas through imaginative written works.">Creative Writing</label>
													<input type="range" class="form-range" min="0" max="5" id="intCreativeWriting" name="intCreativeWriting" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCreativeNonfiction" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Crafting factual narratives in engaging and artistic ways.">Creative Nonfiction</label>
													<input type="range" class="form-range" min="0" max="5" id="intCreativeNonfiction" name="intCreativeNonfiction" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intIntroWorldReligionsBeliefSystems" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Exploring diverse religious beliefs and their impact on societies.">Introduction to World Religions and Belief Systems</label>
													<input type="range" class="form-range" min="0" max="5" id="intIntroWorldReligionsBeliefSystems" name="intIntroWorldReligionsBeliefSystems" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPhilippinePoliticsGovernance" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Examining political systems and governance in the Philippines.">Philippine Politics and Governance</label>
													<input type="range" class="form-range" min="0" max="5" id="intPhilippinePoliticsGovernance" name="intPhilippinePoliticsGovernance" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intDisciplinesIdeasSocialSciences" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="An overview of various social science fields.">Disciplines and Ideas in the Social Sciences</label>
													<input type="range" class="form-range" min="0" max="5" id="intDisciplinesIdeasSocialSciences" name="intDisciplinesIdeasSocialSciences" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intAppliedEconomics" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Applying economic principles to real-world situations.">Applied Economics</label>
													<input type="range" class="form-range" min="0" max="5" id="intAppliedEconomics" name="intAppliedEconomics" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessEthicsSocialResponsibility" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Exploring ethical issues in business and corporate social responsibility.">Business Ethics and Social Responsibility</label>
													<input type="range" class="form-range" min="0" max="5" id="intBusinessEthicsSocialResponsibility" name="intBusinessEthicsSocialResponsibility" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFundamentalsABM" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Introduction to Accounting, Business, and Management principles.">Fundamentals of ABM</label>
													<input type="range" class="form-range" min="0" max="5" id="intFundamentalsABM" name="intFundamentalsABM" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessMath" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Mathematical concepts used in business and finance.">Business Math</label>
													<input type="range" class="form-range" min="0" max="5" id="intBusinessMath" name="intBusinessMath" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBusinessFinance" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Understanding financial management and investment.">Business Finance</label>
													<input type="range" class="form-range" min="0" max="5" id="intBusinessFinance" name="intBusinessFinance" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intOrganizationManagement" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Principles of organizational structure and management.">Organization and Management</label>
													<input type="range" class="form-range" min="0" max="5" id="intOrganizationManagement" name="intOrganizationManagement" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intPrinciplesMarketing" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Basics of marketing strategies and consumer behavior.">Principles in Marketing</label>
													<input type="range" class="form-range" min="0" max="5" id="intPrinciplesMarketing" name="intPrinciplesMarketing" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intComputerProgramming" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Learning to write and develop computer programs.">Computer Programming</label>
													<input type="range" class="form-range" min="0" max="5" id="intComputerProgramming" name="intComputerProgramming" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intComputerSystemServicing" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Maintaining and repairing computer systems.">Computer System Servicing</label>
													<input type="range" class="form-range" min="0" max="5" id="intComputerSystemServicing" name="intComputerSystemServicing" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intContactCenterServices" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Skills for customer service and communication.">Contact Center Services</label>
													<input type="range" class="form-range" min="0" max="5" id="intContactCenterServices" name="intContactCenterServices" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCISCOComputerNetworking" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Understanding network systems and Cisco technology.">CISCO Computer Networking</label>
													<input type="range" class="form-range" min="0" max="5" id="intCISCOComputerNetworking" name="intCISCOComputerNetworking" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intAnimationIllustration" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Creating animations and illustrations using digital tools.">Animation / Illustration</label>
													<input type="range" class="form-range" min="0" max="5" id="intAnimationIllustration" name="intAnimationIllustration" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intCookery" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Culinary skills and cooking techniques.">Cookery</label>
													<input type="range" class="form-range" min="0" max="5" id="intCookery" name="intCookery" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intBreadPastryProduction" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Baking bread and pastries.">Bread and Pastry Production</label>
													<input type="range" class="form-range" min="0" max="5" id="intBreadPastryProduction" name="intBreadPastryProduction" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFashionDesign" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Designing clothing and fashion items.">Fashion Design</label>
													<input type="range" class="form-range" min="0" max="5" id="intFashionDesign" name="intFashionDesign" value="0">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intFoodBeverages" class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Managing food and beverage services.">Food and Beverages</label>
													<input type="range" class="form-range" min="0" max="5" id="intFoodBeverages" name="intFoodBeverages" value="4">
													<div class=" text-center">
														<span class="rangeValue">0</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div>
													<label for="intTailoring " class="form-label" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Sewing and creating tailored clothing.">Tailoring </label>
													<input type="range" class="form-range" min="0" max="5" id="intTailoring " name="intTailoring " value="5">
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
												<option value="less than P9,100">less than P9,100</option>
												<option value="P9,100-P18,200">P9,100-P18,200</option>
												<option value="P18,200-P36,400">P18,200-P36,400</option>
												<option value="P36,400-P63,700">P36,400-P63,700</option>
												<option value="P63,700-P109,200">P63,700-P109,200</option>
												<option value="P109,200-P182,000">P109,200-P182,000</option>
												<option value="greater than P182,000">greater than P182,000</option>
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
														<option value="100 - 95">100 - 95</option>
														<option value="94 - 90">94 - 90</option>
														<option value="89 - 80">89 - 80</option>
														<option value="79 - 75">79 - 75</option>
														<option value="74 - 70">74 - 70</option>
														<option value="69 - 0">69 - 0</option>
													</select>
													<label for="acadScience" class="form-label">Science</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadMath" name="acadMath">
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95">100 - 95</option>
														<option value="94 - 90">94 - 90</option>
														<option value="89 - 80">89 - 80</option>
														<option value="79 - 75">79 - 75</option>
														<option value="74 - 70">74 - 70</option>
														<option value="69 - 0">69 - 0</option>
													</select>
													<label for="acadMath" class="form-label">Math</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadEnglish" name="acadEnglish">
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95">100 - 95</option>
														<option value="94 - 90">94 - 90</option>
														<option value="89 - 80">89 - 80</option>
														<option value="79 - 75">79 - 75</option>
														<option value="74 - 70">74 - 70</option>
														<option value="69 - 0">69 - 0</option>
													</select>
													<label for="acadEnglish" class="form-label">English</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadFilipino" name="acadFilipino">
														<option selected value="SELECT">SELECT</option>
														<option value="100 - 95">100 - 95</option>
														<option value="94 - 90">94 - 90</option>
														<option value="89 - 80">89 - 80</option>
														<option value="79 - 75">79 - 75</option>
														<option value="74 - 70">74 - 70</option>
														<option value="69 - 0">69 - 0</option>
													</select>
													<label for="acadFilipino" class="form-label">Filipino</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadICTRelatedSub" name="acadICTRelatedSub">
														<option selected value="SELECT">SELECT</option>
														<option value="N/A">N/A</option>
														<option value="100 - 95">100 - 95</option>
														<option value="94 - 90">94 - 90</option>
														<option value="89 - 80">89 - 80</option>
														<option value="79 - 75">79 - 75</option>
														<option value="74 - 70">74 - 70</option>
														<option value="69 - 0">69 - 0</option>
													</select>
													<label for="acadICTRelatedSub" class="form-label">ICT Related Subject</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="acadHERelatedSub" name="acadHERelatedSub">
														<option selected value="SELECT">SELECT</option>
														<option value="N/A">N/A</option>
														<option value="100 - 95">100 - 95</option>
														<option value="94 - 90">94 - 90</option>
														<option value="89 - 80">89 - 80</option>
														<option value="79 - 75">79 - 75</option>
														<option value="74 - 70">74 - 70</option>
														<option value="69 - 0">69 - 0</option>
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
														<option value="Undecided">Undecided</option>
														<option value="Chemical Engineer">Chemical Engineer</option>
														<option value="Industrial Engineer">Industrial Engineer</option>
														<option value="Biologist">Biologist</option>
														<option value="Mathematician">Mathematician</option>
														<option value="Statistician">Statistician</option>
														<option value="Physicist">Physicist</option>
														<option value="Architect">Architect</option>
														<option value="Doctor">Doctor</option>
														<option value="Registered Nurse">Registered Nurse</option>
														<option value="Physical Therapist">Physical Therapist</option>
														<option value="Pharmacist">Pharmacist</option>
														<option value="Civil Engineer">Civil Engineer</option>
														<option value="Mechanical Engineer">Mechanical Engineer</option>
														<option value="Food Technologist">Food Technologist</option>
														<option value="Environmental Scientist">Environmental Scientist</option>
														<option value="Social Scientist">Social Scientist</option>
														<option value="Psychologist">Psychologist</option>
														<option value="Philosopher">Philosopher</option>
														<option value="Social Worker">Social Worker</option>
														<option value="Political Scientist">Political Scientist</option>
														<option value="Foreign Service Officer">Foreign Service Officer</option>
														<option value="Police">Police</option>
														<option value="Police">Fireman</option>
														<option value="Soldier">Soldier</option>
														<option value="Communication Specialist">Communication Specialist</option>
														<option value="Educator">Educator</option>
														<option value="Journalist">Journalist</option>
														<option value="Broadcast Journalist">Broadcast Journalist</option>
														<option value="Entrepreneur">Entrepreneur</option>
														<option value="Tourism Manager">Tourism Manager</option>
														<option value="Business Administrator">Business Administrator</option>
														<option value="Accountant">Accountant</option>
														<option value="Business Economist">Business Economist</option>
														<option value="Banking and Finance Specialist">Banking and Finance Specialist</option>
														<option value="Management Consultant">Management Consultant</option>
														<option value="IT Specialist">IT Specialist</option>
														<option value="Software Developer">Software Developer</option>
														<option value="Computer Engineer">Computer Engineer</option>
														<option value="Software Engineer">Software Engineer</option>
														<option value="Network Administrator">Network Administrator</option>
														<option value="Digital Media Designer">Digital Media Designer</option>
														<option value="Web Developer">Web Developer</option>
														<option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
														<option value="Data Scientist">Data Scientist</option>
														<option value="Information Systems Manager">Information Systems Manager</option>
														<option value="Chef">Chef</option>
														<option value="Pastry Chef">Pastry Chef</option>
														<option value="Fashion Designer">Fashion Designer</option>
														<option value="Textile Designer">Textile Designer</option>
														<option value="Family and Consumer Sciences Educator">Family and Consumer Sciences Educator</option>
														<option value="Interior Designer">Interior Designer</option>
														<option value="Home Economics Educator">Home Economics Educator</option>
														<option value="Event Planner">Event Planner</option>
														<option value="Nutritionist">Nutritionist</option>
														<option value="Dietitian">Dietitian</option>
														<option value="Hotel Manager">Hotel Manager</option>
														<option value="Restaurant Manager">Restaurant Manager</option>
														<option value="Child Life Specialist">Child Life Specialist</option>
														<option value="Family Counselor">Family Counselor</option>
														<option value="Food Service Manager">Food Service Manager</option>
													</select>
													<label for="CareerPath1" class="form-label">Career - 1st Choice</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="CareerPath2" name="CareerPath2">
														<option value="N/A">N/A</option>
														<option value="Chemical Engineer">Chemical Engineer</option>
														<option value="Industrial Engineer">Industrial Engineer</option>
														<option value="Biologist">Biologist</option>
														<option value="Mathematician">Mathematician</option>
														<option value="Statistician">Statistician</option>
														<option value="Physicist">Physicist</option>
														<option value="Architect">Architect</option>
														<option value="Doctor">Doctor</option>
														<option value="Registered Nurse">Registered Nurse</option>
														<option value="Physical Therapist">Physical Therapist</option>
														<option value="Pharmacist">Pharmacist</option>
														<option value="Civil Engineer">Civil Engineer</option>
														<option value="Mechanical Engineer">Mechanical Engineer</option>
														<option value="Food Technologist">Food Technologist</option>
														<option value="Environmental Scientist">Environmental Scientist</option>
														<option value="Social Scientist">Social Scientist</option>
														<option value="Psychologist">Psychologist</option>
														<option value="Philosopher">Philosopher</option>
														<option value="Social Worker">Social Worker</option>
														<option value="Political Scientist">Political Scientist</option>
														<option value="Foreign Service Officer">Foreign Service Officer</option>
														<option value="Police">Police</option>
														<option value="Police">Fireman</option>
														<option value="Soldier">Soldier</option>
														<option value="Communication Specialist">Communication Specialist</option>
														<option value="Educator">Educator</option>
														<option value="Journalist">Journalist</option>
														<option value="Broadcast Journalist">Broadcast Journalist</option>
														<option value="Entrepreneur">Entrepreneur</option>
														<option value="Tourism Manager">Tourism Manager</option>
														<option value="Business Administrator">Business Administrator</option>
														<option value="Accountant">Accountant</option>
														<option value="Business Economist">Business Economist</option>
														<option value="Banking and Finance Specialist">Banking and Finance Specialist</option>
														<option value="Management Consultant">Management Consultant</option>
														<option value="IT Specialist">IT Specialist</option>
														<option value="Software Developer">Software Developer</option>
														<option value="Computer Engineer">Computer Engineer</option>
														<option value="Software Engineer">Software Engineer</option>
														<option value="Network Administrator">Network Administrator</option>
														<option value="Digital Media Designer">Digital Media Designer</option>
														<option value="Web Developer">Web Developer</option>
														<option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
														<option value="Data Scientist">Data Scientist</option>
														<option value="Information Systems Manager">Information Systems Manager</option>
														<option value="Chef">Chef</option>
														<option value="Pastry Chef">Pastry Chef</option>
														<option value="Fashion Designer">Fashion Designer</option>
														<option value="Textile Designer">Textile Designer</option>
														<option value="Family and Consumer Sciences Educator">Family and Consumer Sciences Educator</option>
														<option value="Interior Designer">Interior Designer</option>
														<option value="Home Economics Educator">Home Economics Educator</option>
														<option value="Event Planner">Event Planner</option>
														<option value="Nutritionist">Nutritionist</option>
														<option value="Dietitian">Dietitian</option>
														<option value="Hotel Manager">Hotel Manager</option>
														<option value="Restaurant Manager">Restaurant Manager</option>
														<option value="Child Life Specialist">Child Life Specialist</option>
														<option value="Family Counselor">Family Counselor</option>
														<option value="Food Service Manager">Food Service Manager</option>
													</select>
													<label for="CareerPath2" class="form-label">Career - 2nd Choice</label>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-floating mb-3">
													<select class="form-select" id="CareerPath3" name="CareerPath3">
														<option value="N/A">N/A</option>
														<option value="Chemical Engineer">Chemical Engineer</option>
														<option value="Industrial Engineer">Industrial Engineer</option>
														<option value="Biologist">Biologist</option>
														<option value="Mathematician">Mathematician</option>
														<option value="Statistician">Statistician</option>
														<option value="Physicist">Physicist</option>
														<option value="Architect">Architect</option>
														<option value="Doctor">Doctor</option>
														<option value="Registered Nurse">Registered Nurse</option>
														<option value="Physical Therapist">Physical Therapist</option>
														<option value="Pharmacist">Pharmacist</option>
														<option value="Civil Engineer">Civil Engineer</option>
														<option value="Mechanical Engineer">Mechanical Engineer</option>
														<option value="Food Technologist">Food Technologist</option>
														<option value="Environmental Scientist">Environmental Scientist</option>
														<option value="Social Scientist">Social Scientist</option>
														<option value="Psychologist">Psychologist</option>
														<option value="Philosopher">Philosopher</option>
														<option value="Social Worker">Social Worker</option>
														<option value="Political Scientist">Political Scientist</option>
														<option value="Foreign Service Officer">Foreign Service Officer</option>
														<option value="Police">Police</option>
														<option value="Police">Fireman</option>
														<option value="Soldier">Soldier</option>
														<option value="Communication Specialist">Communication Specialist</option>
														<option value="Educator">Educator</option>
														<option value="Journalist">Journalist</option>
														<option value="Broadcast Journalist">Broadcast Journalist</option>
														<option value="Entrepreneur">Entrepreneur</option>
														<option value="Tourism Manager">Tourism Manager</option>
														<option value="Business Administrator">Business Administrator</option>
														<option value="Accountant">Accountant</option>
														<option value="Business Economist">Business Economist</option>
														<option value="Banking and Finance Specialist">Banking and Finance Specialist</option>
														<option value="Management Consultant">Management Consultant</option>
														<option value="IT Specialist">IT Specialist</option>
														<option value="Software Developer">Software Developer</option>
														<option value="Computer Engineer">Computer Engineer</option>
														<option value="Software Engineer">Software Engineer</option>
														<option value="Network Administrator">Network Administrator</option>
														<option value="Digital Media Designer">Digital Media Designer</option>
														<option value="Web Developer">Web Developer</option>
														<option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
														<option value="Data Scientist">Data Scientist</option>
														<option value="Information Systems Manager">Information Systems Manager</option>
														<option value="Chef">Chef</option>
														<option value="Pastry Chef">Pastry Chef</option>
														<option value="Fashion Designer">Fashion Designer</option>
														<option value="Textile Designer">Textile Designer</option>
														<option value="Family and Consumer Sciences Educator">Family and Consumer Sciences Educator</option>
														<option value="Interior Designer">Interior Designer</option>
														<option value="Home Economics Educator">Home Economics Educator</option>
														<option value="Event Planner">Event Planner</option>
														<option value="Nutritionist">Nutritionist</option>
														<option value="Dietitian">Dietitian</option>
														<option value="Hotel Manager">Hotel Manager</option>
														<option value="Restaurant Manager">Restaurant Manager</option>
														<option value="Child Life Specialist">Child Life Specialist</option>
														<option value="Family Counselor">Family Counselor</option>
														<option value="Food Service Manager">Food Service Manager</option>
													</select>
													<label for="CareerPath3" class="form-label">Career - 3rd Choice</label>
												</div>
											</div>
										</div>
									</div>

									<div class="d-grid gap-2 d-md-flex justify-content-end">
										<button type="button" class="btn btn-update form-button-text" id="updateButton"><span class="fw-bold">UPDATE</span></button>
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
								<h4>Profile: <span style="color: red">NOT DONE</span></h4>
								<p class="text-muted">If Profile is already done, click Generate...</p>
								<form action="" method="post">
									<div class="form-floating mb-3">
										<input type="text" class="form-control" id="result" placeholder="Result">
										<label for="result">RESULT</label>
									</div>
									<div class="d-grid gap-2 d-md-flex justify-content-end">
										<button type="button" class="btn btn-add form-button-text"><span class="fw-bold">GENERATE</span></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">STATISTIC</h4>
							</div>
							<div class="card-body">
								<div class="row w-100">
									<div class="col-12">
										<canvas id="overallpieChart"></canvas>
									</div>
									<div class="col-6 col-md-4">
										<canvas id="skintpieChart"></canvas>
									</div>
									<div class="col-6 col-md-4">
										<canvas id="acadpieChart"></canvas>
									</div>
									<div class="col-6 col-md-4">
										<canvas id="careerpieChart"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center align-items-center mb-3">
						<div class="card custcard border-light text-center" style="width: 100%;">
							<div class="card-header">
								<h4 class="fw-bold card-text-header">RECOMENDATION</h4>
							</div>
							<div class="card-body">

							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="./js/password-score.js"></script>
	<script type="text/javascript" src="./js/password-score-options.js"></script>
	<script type="text/javascript" src="./js/bootstrap-strength-meter.js"></script>
	<script>
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

		var labels = ["STEM", "HUMSS", "ABM", "GAS", "TVL-ICT", "TVL-HE"];
		var skintvalues = [60, 30, 10, 0, 0, 0];
		var acadvalues = [70, 20, 10, 0, 0, 0];
		var careervalues = [90, 5, 5, 0, 0, 0];
		var overallvalues = [95, 3, 2, 0, 0, 0];
		var barColors = [
			"rgba(112,214,255,1.0)",
			"rgba(255,112,166,1.0)",
			"rgba(255,151,112,1.0)",
			"rgba(255,214,112,1.0)",
			"rgba(233,255,112,1.0)",
			"rgba(104,122,0,1.0)",
		];

		const skintpieChart = new Chart("skintpieChart", {
			type: "doughnut",
			data: {
				labels: labels,
				datasets: [{
					backgroundColor: barColors,
					data: skintvalues
				}]
			},
			options: {
				title: {
					display: true,
					text: "Skills & Interests"
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
				}
			}
		});

		const totalHouseholdIncomeSelect = document.getElementById('TotalHouseholdMonthlyIncome');
		const acadScience = document.getElementById('acadScience');
		const acadMath = document.getElementById('acadMath');
		const acadEnglish = document.getElementById('acadEnglish');
		const acadFilipino = document.getElementById('acadFilipino');
		const acadICTRelatedSub = document.getElementById('acadICTRelatedSub');
		const acadHERelatedSub = document.getElementById('acadHERelatedSub');
		const updateButton = document.getElementById('updateButton');

		updateButton.addEventListener('click', function() {
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