<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GUIDE</title>
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
						<h2 class="fw-bold card-text-header">WELCOME!</h2>
					</div>
					<div class="align-items-center p-3">
						<img src="./images/man.png" class="card-img-top rounded" alt="..." style="width: 50px; height: 50px;">
					</div>
					<div class="card-body">
						<?php
						include "connection.php"; //include the connection file for the datbase

						//If the login button is clicked
						if (isset($_POST['lrn']) && isset($_POST['password'])) {
							//get the username/lrn and password
							$username = mysqli_real_escape_string($conn, $_POST['lrn']);
							$password = mysqli_real_escape_string($conn, $_POST['password']);

							//check the database if the username/lr exists
							$sql = "SELECT * FROM studentprofile WHERE lrn = '$username'";
							$q = mysqli_query($conn, $sql);
							$num = mysqli_num_rows($q);


							if ($num == 1) { //if the username/lrn exists
								//get the username and password from the database
								$data = mysqli_fetch_assoc($q);
								$upass = $data['password'];
								$ufname = $data['Fname'];

								if (md5($password) == "$upass") { //check if the password is correct
									//Set the session variables
									$_SESSION['student'] = $username; //lrn
									$_SESSION['fname'] = $ufname; //first name
									header("Location: home.php"); //redirect to the home page

								} else {//the password is not correct
									echo "<script>Swal.fire({
												title: 'Wrong Password',
												icon: 'error',
												showConfirmButton: false,
                                                timer: 5000
												});</script>";
								}
							} else {//the usernama/lrn doesn't exist in the database
								echo "<script>Swal.fire({
											title: 'Invalid Username or Account not yet created!.',
											icon: 'error',
											showConfirmButton: false,
                                            timer: 5000
										});</script>";
							}
						}
						?>
						<form action="" method="post">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="lrn" name ="lrn" oninput="validateLRN(this)" placeholder="111111111111" required>
								<label for="lrn">LRN</label>
							</div>
							<div class="form-floating">
								<input type="password" class="form-control" id="password" name ="password" placeholder="password" required>
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
	<script type="text/javascript">
		function validateLRN(input) {
            var regex = /^[0-9]*$/; // Regular expression to allow only numbers

            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9]/g, ''); // Remove any characters that are not numeric
            }

            if (input.value.length > 12) {
                input.value = input.value.slice(0, 12); // Truncate the input value to 12 characters if it exceeds the limit
            }
        }
	</script>
</body>

</html>