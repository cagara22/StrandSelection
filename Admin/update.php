<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Strand Selection</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<!-- Custom CSS -->
		<link rel="stylesheet" href="custom_css.css">
	</head>
	
	<body>
		
				<div class="col-4">
				<?php 
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');

    // Check if form was submitted
    if (isset($_POST['add'])) {
        
        // Retrieve form data
        $id = $_GET["lrn"];
        $approve = $_POST['approve'];
		$strand = $_POST['strand'];
		$status = $_POST['status'];

        // Prepare update query
        $sql = "UPDATE `student` SET `approve`='$approve', `strand`='$strand' , `status`='$status' WHERE `lrn`='$id'"; 

        // Execute update query
        $result = $conn->query($sql);

        // Check if query was successful
        if ($result) {
            // Display success message and redirect to profiles page
            echo "<script>alert('Record updated successfully!')</script>";
            echo "<script>window.location.href = 'profiles.php';</script>";
        } else {
            // Display error message and MySQL error details
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } 
    }

	if (isset($_GET['lrn'])) {

		$user_id = $_GET['lrn']; 
	
		$sql = "SELECT * FROM `student` WHERE `lrn` ='$user_id'";
	
		$result = $conn->query($sql); 
	
		if ($result->num_rows > 0) {        
	
			while ($row = $result->fetch_assoc()) {
	
				$strand1 = $row['strand'];
				$approve1 = $row['approve'];
				$status1 = $row['status'];


	
			}
}
}
?>
					<form class="row g-3" action="" method="post">
						<h2 class="form-signin-heading">Student Profile</h2>

						<div class="col-12 mb-3">
								<label for="strand" class="form-label">Qualified Strand</label>
								<input type="text" id="strand" name="strand" 
								value="<?php echo $strand1; ?>" class="form-control" placeholder="QUALIFIED STRAND" />
                           
						<div class="col-12 mb-3">
								<label class="form-label" for="approve">Approval Status</label>
								<select class="form-select" id="approve" name="approve">
									<option value="APPROVE"<?php if ($approve1 == "APPROVE") {echo " selected";}?>>APPROVE</option>
									<option value="DISAPPROVE"<?php if ($approve1 == "REJECT") {echo " selected";}?>>REJECT</option>
								</select>
							</div>

							<div class="col-12 mb-3">
								<label class="form-label" for="status">Status</label>
								<select class="form-select" id="status" name="status">
									<option value="ACTIVE" <?php if ($status1 == "ACTIVE") {echo " selected";}?>>ACTIVE</option>
									<option value="INACTIVE" <?php if ($status1 == "INACTIVE") {echo " selected";}?>>INACTIVE</option>
								</select>
							</div>
						
							<button type="submit" class="btn btn-primary" name="add" >SUBMIT</button>
					</form>
				</div>
			</div>

		</section>
	

	</body>
</html>