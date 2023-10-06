<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Strand Selection Admin Ver2</title>
    <link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                        <a href="./profiles.php" class="nav-link link-body-emphasis">
                            <img src="./images/profiles.png" alt="" width="16" height="16" class="bi pe-none me-2">
                            PROFILES
                        </a>
                    </li>
                    <li>
                        <a href="./admins.php" class="nav-link active" aria-current="page">
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
                    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
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
                    <h1 class="fw-bold sub-title">[ADMIN USERNAME]</h1>
                </div>
                <div class="card custcard border-light text-center" style="width: 100%;">
                    <div class="card-header">
                        <h4 class="fw-bold card-text-header">Admin Details</h4>
                    </div>
                    <div class="card-body">
                        <form class="row" action="" method="post">
                            <div class="col-12 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" oninput="validateName(this)" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fname" oninput="validateName(this)" placeholder="First Name" required>
                                    <label for="fname">First Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mname" oninput="validateName(this)" placeholder="Middle Name">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lname" oninput="validateName(this)" placeholder="Last Name" required>
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="suffix" oninput="validateName(this)" placeholder="Suffix">
                                    <label for="suffix">Suffix</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="address" oninput="validateAddress(this)" placeholder="Address" required>
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="sex" name="sex" value="">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    <label for="sex">Sex</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="age" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3" placeholder="Age" required>
                                    <label for="age">Age</label>
                                </div>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="role" name="role" value="">
                                        <option value="Admin">ADMIN</option>
                                        <option value="Super Admin">SUPER ADMIN</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating mb-1">
                                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass1" placeholder="Password">
                                    <label for="pass1">PASSWORD</label>
                                </div>
                                <div class="col-sm-6" id="passstrength" style="font-weight:bold;padding:6px 12px;">

                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-1">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass2" placeholder="Confirm Password">
                                    <label for="pass2">CONFIRM PASSWORD</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-end">
                                <button type="button" class="btn btn-update form-button-text"><span class="fw-bold">UPDATE</span></button>
                            </div>
                        </form>
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

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>