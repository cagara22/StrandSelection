<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GUIDE Admin</title>
	<link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
	<header class="index container-fluid" id="Header">
		<div class="row" style="height: 100vh;">
			<div class="col-12 d-flex justify-content-center align-items-end">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<img src="./images/LNHSlogo.png" style="width: 100px; height: 100px;" alt="Sample image">
					</div>
					<div class="col-12 d-flex justify-content-center">
						<img src="./images/SystemBrandBlackVer2.png" style="width: 200px; height: 40px;" alt="Sample image">
					</div>
				</div>
			</div>
			<div class="col-12 d-flex justify-content-center align-items-start">
				<div class="card custcard border-light text-center" style="width: 22rem;">
					<div class="card-header">
						<h4 class="fw-bold card-text-header">ADMIN LOGIN</h4>
					</div>
					<div class="align-items-center p-3">
						<img src="./images/man.png" class="card-img-top rounded" alt="..." style="width: 50px; height: 50px;">
					</div>
					<div class="card-body">
						<?php
						include "connection.php";

						if (isset($_POST['username']) && isset($_POST['password'])) {
							$username = $_POST['username'];
							$password = $_POST['password'];
						
							$sql = "SELECT * FROM adminprofile WHERE username = '$username'";
							$q = mysqli_query($conn, $sql);
							$num = mysqli_num_rows($q);
						
							if ($num == 1) {
						
								$data = mysqli_fetch_assoc($q);
						
								$upass = $data['password'];
						
								if (md5($password) == "$upass") {
									$_SESSION['admin'] = $username;
									$_SESSION['role'] = $data['role'];
						
									// Concatenate fname, mname, and lname to create the full name
									
									$fullname = $data['fname']; // Initialize with the first name

									if (!empty($data['mname'])) {
										$fullname .= ' ' . $data['mname']; // Add the middle name if it exists
									}

									if (!empty($data['lname'])) {
										$fullname .= ' ' . $data['lname']; // Add the last name if it exists
									}

									$_SESSION['fullname'] = $fullname;
								
									if (isset($_SESSION['fullname'])) {
										$admin_username = $_SESSION['fullname'];
										$log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Logged in', '$admin_username logged in', '$admin_username')";
										$conn->query($log);
									} else {
										// Handle the case when the admin username is not set in the session
										echo "Admin username not found in the session.";
									}
									header("Location: dashboard.php");
								} else {
									echo "<script>swal({
                title: 'Login Failed!',
                text: 'Invalid Username or Password.',
                icon: 'error',
                button: 'OK',
              });</script>";
									echo "<script>document location ='index.php';</script>";
								}
							} else {
								echo "<script>swal({
            title: 'Login Failed!',
            text: 'Invalid Username or Password.',
            icon: 'error',
            button: 'OK',
          });</script>";
								echo "<script>document location ='index.php';</script>";
							}
						}


						?>
						<form action="" method="post">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="username" name="username" placeholder="111111111111">
								<label for="username">USERNAME</label>
							</div>
							<div class="form-floating">
								<input type="password" class="form-control" id="password" name="password" placeholder="password">
								<label for="password">PASSWORD</label>
							</div>
							<div class="d-grid gap-2 my-2">
								<button type="submit" class="btn btn-warning form-button-text"><span class="fw-bold">LOGIN</span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</header>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>
