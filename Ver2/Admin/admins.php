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
                    <h1 class="fw-bold sub-title">ADMINS</h1>
                </div>
                <form class="row g-3" method="GET" action="">
					<div class="col-10">
						<input type="text" class="form-control" id="searchname" name="searchname" placeholder="Search...">
					</div>
					<div class="col-2">
						<button type="submit" class="btn btn-search w-100 fw-bold" name="search">SEARCH</button>
					</div>
				</form>
                <table class="table table-striped table-hover">
                    <thead>
						<tr class="text-center">
							<th scope="col">Username</th>
							<th scope="col">First Name</th>
							<th scope="col">Middle Name</th>
							<th scope="col">Last Name</th>
							<th scope="col">Suffix</th>
                            <th scope="col">Age</th>
                            <th scope="col">Sex</th>
							<th scope="col">Role</th>
							<th scope="col" colspan="2">Action</th>
						</tr>
					</thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="text-center">Admin01</td>
                            <td class="text-center">Vincent Felix</td>
                            <td class="text-center">Sabalza</td>
                            <td class="text-center">Cagara</td>
                            <td class="text-center"> </td>
                            <td class="text-center">21</td>
                            <td class="text-center">Male</td>
                            <td class="text-center">SUPER ADMIN</td>
                            <td class="text-center">
                                <a href="viewadmin.php" class="btn btn-view" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="VIEW">
                                    <img src="./images/view.png" alt="" width="20" height="20" class="">
                                </a>
                                <a href="" class="btn btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="DELETE">
                                    <img src="./images/delete.png" alt="" width="20" height="20" class="">
                                </a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-add fw-bold" href="addadmin.php" role="button">ADD NEW ADMIN</a>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>