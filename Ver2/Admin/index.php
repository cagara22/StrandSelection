<?php
session_start(); //Start the session
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

	<!-- Custom CSS -->
	<link rel="stylesheet" href="custom_css.css">
</head>

<body>
	<header class="index container-fluid" id="Header">
		<div class="row" style="height: 100vh;">
			<div class="col-12 d-flex justify-content-center align-items-end">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<img src="./images/LNHSlogo.png" style="width: 80px; height: 80px;" alt="Sample image">
					</div>
					<div class="col-12 d-flex justify-content-center pb-4">
						<img src="./images/GUIDE_Logo_3.png" style="width: 200px; height: 70px;" alt="Sample image">
					</div>
				</div>
			</div>
			<div class="col-12 d-flex justify-content-center align-items-start">
				<div class="card custcard border-light text-center" style="width: 22rem;">
					<div class="card-header" style="padding-bottom: 0px;">
						<h2 class="fw-bold card-text-header">ADMIN LOGIN</h2>
					</div>
					<div class="align-items-center p-3">
						<img src="./images/man.png" class="card-img-top rounded" alt="..." style="width: 50px; height: 50px;">
					</div>
					<div class="card-body">
						<?php
						include "connection.php"; //include the connection file

						//check if the login button is clicked
						if (isset($_POST['username']) && isset($_POST['password'])) {
							//get the username and password
							$username = $_POST['username'];
							$password = $_POST['password'];

							//check if the username exists in the database
							$sql = "SELECT * FROM adminprofile WHERE BINARY username = '$username'";
							$q = mysqli_query($conn, $sql);
							$num = mysqli_num_rows($q);

							if ($num == 1) { //user exists

								$data = mysqli_fetch_assoc($q); //get the user data

								$upass = $data['password'];// get the ussers password

								if (md5($password) == "$upass") { //password is correct
									$_SESSION['admin'] = $username; //get the username
									$_SESSION['role'] = $data['role']; //get the role
									$_SESSION['adminID'] = $data['adminID']; //get the admin ID

									//concatenate fname, mname, and lname to create the full name
									$fullname = $data['fname']; // Initialize with the first name

									if (!empty($data['mname'])) {
										$fullname .= ' ' . $data['mname']; // Add the middle name if it exists
									}

									if (!empty($data['lname'])) {
										$fullname .= ' ' . $data['lname']; // Add the last name if it exists
									}

									$_SESSION['fullname'] = $fullname;

									//record the login in the logs
									$admin_username = $_SESSION['fullname'];
									$role = $_SESSION['role'];
									$log = "INSERT INTO logs (Action, Details, Doer) VALUES ('Logged in', '$admin_username logged in as $role', '$admin_username')";
									$conn->query($log);
									
									//redirect to the dashboard
									header("Location: dashboard.php");
								} else { //password is incorrect
									echo "<script>Swal.fire({
										title: 'Login Failed!',
										text: 'Invalid Username or Password.',
										icon: 'error',
										showConfirmButton: false,
										timer: 5000
										});</script>";
								}
							} else { //user doesn't exist
								echo "<script>Swal.fire({
										title: 'Login Failed!',
										text: 'Invalid Username or Password.',
										icon: 'error',
										showConfirmButton: false,
										timer: 5000
										});</script>";
							}
						}


						?>
						<form action="" method="post">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="username" name="username" placeholder="111111111111" required>
								<label for="username">USERNAME</label>
							</div>
							<div class="form-floating">
								<input type="password" class="form-control" id="password" name="password" placeholder="password" required>
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