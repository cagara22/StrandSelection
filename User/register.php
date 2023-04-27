<?php

$conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
if (isset($_POST['add'])) {
  // Get form data
  $lrn = $_POST["username"];
  $fname = $_POST["Fname"];
  $mname = $_POST["Mname"];
  $lname = $_POST["Lname"];
  $address = $_POST["address"];
  $sex = $_POST["sex"];
  $age = $_POST["age"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  

  $sql = "SELECT * FROM `student` WHERE username = '$lrn' ";

								$result =  mysqli_query($conn,$sql);

								if ($result) {
								$num= mysqli_num_rows($result);
								if ($num>0){
									echo"<script>swal({
										title: 'User record has already existed.',
										icon: 'error',
										button: 'OK',
									  });</script>";
								echo "<script>document location =index.php;</script>";
									
								
								}else{
								$sql = "INSERT INTO `student`(username, password, Fname, address, `sex`,
								 `Mname`, `age`, Lname, email) VALUES 
								('$lrn', MD5('$password'),'$fname','$address','$sex', '$mname', '$age',
								'$lname', '$email')";


							$result = $conn->query($sql);
							if ($result == TRUE) {

								echo"<script>swal({
									title: 'New record added successfully!',
									icon: 'success',
									button: 'OK',
								  });</script>";
								echo "<script>document location =index.php;</script>";

							}else{

							echo "Error:". $sql . "<br>". $conn->error;

							} 


							}
							}
						
						}
							?>