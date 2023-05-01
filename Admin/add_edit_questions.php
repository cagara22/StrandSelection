<?php
session_start();

if(!isset($_SESSION["admin"]))
{

    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php

}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Strand Selection</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
		
		<!-- Custom CSS -->
		<link rel="stylesheet" href="custom_css.css">
	</head>
	
	<body>
		<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
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
							<a class="nav-link" href="profiles.php">PROFILES</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admins.php">ADMINS</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">ABOUT</a>
						</li>

                        <li class="nav-item">
							<a class="nav-link" href="exam_category.php">EXAM CATEGORIES</a>
						</li>

                        <li class="nav-item px-4 fw-bold">
							<a class="nav-link active" aria-current="page" href="add_edit_exam_questions.php">EXAM QUESTIONS</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" ><?php 
														echo $_SESSION['admin']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">LOGOUT</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

<?php  
         include "connection.php";

        
       if (isset($_GET["id"])) {
        $id = $_GET["id"]; 
                                $exam_category='';
                               
                            
                                $sql = "SELECT * FROM `exam_category` WHERE `id`='$id'";
                            
                                $result = $link->query($sql); 
                            
                                if ($result->num_rows > 0) {        
                            
                                    while ($row = $result->fetch_assoc()) {
                            
                                        $exam_category = $row['category'];

        
        
                            
                                    }
						}
                            }
         ?> 

<section class="d-flex flex-column justify-content-center align-items-center py-5">
<div class="row" style="width:100%">

        <div class="breadcrumbs">
            <div class="col-sm-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add question inside <?php echo $exam_category;?></h1>
                    </div>
                </div>
            </div>
           
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            
                        <form name = "form1" action="" method="post" enctype ="multipart/form-data">
                            <div class="card-body">
                                <!-- Credit Card -->

                                <div class="col-lg-8">

                                
                        <div class="card">
                            <div class="card-header"><strong>Add New Questions</strong></div>

                            <div class="card-body card-block">
                                <div class="form-group"><label for="company" class=" form-control-label">
                                    Add Question</label><input type="text" name ="question" placeholder="Add question" class="form-control"></div>
                                    <div class="form-group"><label for="company" class=" form-control-label">
                                    Add option 1 </label><input type="text" name ="opt1"   placeholder="Add Option 1" class="form-control"></div>

                                    <div class="form-group"><label for="company" class=" form-control-label">
                                    Add option 2 </label><input type="text" name ="opt2"   placeholder="Add Option 2" class="form-control"></div>

                                    <div class="form-group"><label for="company" class=" form-control-label">
                                    Add option 3 </label><input type="text" name ="opt3"   placeholder="Add Option 3" class="form-control"></div>

                                    <div class="form-group"><label for="company" class=" form-control-label">
                                    Add option 4 </label><input type="text" name ="opt4"   placeholder="Add Option 4" class="form-control"></div>

                                    <div class="form-group"><label for="company" class=" form-control-label">
                                    Add answer </label><input type="text" name ="answer"   placeholder="Add answer" class="form-control"></div>

                                    <br>
                                    <div class="form-group"> 

                                        <input type="submit" name = "submit1" value = "Add Question"  placeholder="" class="btn btn-success"></div>
                                   
                            </div>
                        </div>
                        </div>

                    
                    
                            <div class="col-lg-8">

                    <div class="card">
                    <div class="card-header"><strong>Add New Questions with images</strong></div>

                    <div class="card-body card-block">
                    <div class="form-group"><label for="company" class=" form-control-label">
                        Add Question</label><input type="text" name ="fquestion" placeholder="Add question" class="form-control"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">
                        Add option 1 </label><input type="file" name ="fopt1" class="form-control"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">
                        Add option 2 </label><input type="file" name ="fopt2"  class="form-control"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">
                        Add option 3 </label><input type="file" name ="fopt3"  class="form-control"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">
                        Add option 4 </label><input type="file" name ="fopt4"  class="form-control"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">
                        Add answer </label><input type="file" name ="fanswer"   placeholder="Add answer" class="form-control"></div>


                        <br>
                        <div class="form-group"> 

                            <input type="submit" name = "submit2" value = "Add Question"  placeholder="" class="btn btn-success"></div>
                    

                    </div>
                    </div>
                    </div>

                    </form>

                    </div>
               
                    


                        </div>

                        
                        </div>
                    </div>

</div>

<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                        <div class="card-body">
<table class = "table table-bordered">

<tr>
    <th>No</th>
    <th>Questions</th>
    <th>Opt1</th>
    <th>Opt2</th>
    <th>Opt3</th>
    <th>Opt4</th>

    
</tr>

                        <?php
                       $res = mysqli_query($link, "select * from questions where category = '$exam_category' order by question_no asc ");

                       while($row=mysqli_fetch_array($res)){
                           echo "<tr>";
                           echo "<td>"; echo $row["question_no"]; echo "</td>";
                           echo "<td>"; echo $row["question"]; echo "</td>";
                           echo "<td>";
                           if (strpos($row["opt1"], 'opt_images/')!==false){
                               ?>
                               <img src="<?php echo $row["opt1"];?>" height="50" width="50">
                               <?php
                           }
                           else{
                               echo $row["opt1"];
                           }
                           echo "</td>";
                           echo "<td>"; 
                           if (strpos($row["opt2"], 'opt_images/')!==false){
                            ?>
                            <img src="<?php echo $row["opt2"];?>" height="50" width="50">
                            <?php
                        }
                        else{
                            echo $row["opt2"];
                        }
                           echo "</td>";
                           echo "<td>"; 
                           if (strpos($row["opt3"], 'opt_images/')!==false){
                            ?>
                            <img src="<?php echo $row["opt3"];?>" height="50" width="50">
                            <?php
                        }
                        else{
                            echo $row["opt3"];
                        }
                           echo "</td>";
                           echo "<td>"; 
                           if (strpos($row["opt4"], 'opt_images/')!==false){
                            ?>
                            <img src="<?php echo $row["opt4"];?>" height="50" width="50">
                            <?php
                        }
                        else{
                            echo $row["opt4"];
                        }
                           echo "</td>";

                           echo "<td>";
                           if (strpos($row["opt4"], 'opt_images/')!==false){
                            ?>
                            <a  class="btn btn-info" href ="edit_option_images.php? id=<?php echo $row ['id'];?>
                            &id1=<?php echo $id; ?>">Edit</a>
                            <?php
                        }
                        else{
                           ?>
                            <a class="btn btn-info" href ="edit_option.php? id=<?php echo $row ["id"]; ?> &id1=<?php echo $id; ?> ">Edit</a>

                           <?php
                        }
                           echo "</td>";


                           echo "<td>";
                           ?>
                           <a  class="btn btn-danger" href="delete_option.php? id=<?php echo $row["id"]; ?> &id1=<?php echo $id; ?>">Delete</a>
                           <?php
                           echo "</td>";


                           echo "</tr>";
                       }
                        ?>
</table>
                        </div>

</div>
</div>

</div>

</div>

</div>
                  

                                        </div><!-- .animated -->
                                    </div><!-- .content -->

<?php

if (isset($_POST["submit1"]))
{

    
    $question = $_POST['question'];

    $opt1 = $_POST['opt1'];

    $opt2 = $_POST['opt2'];

    $opt3 = $_POST['opt3'];

    $opt4 = $_POST['opt4'];
    $answer = $_POST['answer'];

    $loop = 0;

    $count= 0;
    $res=mysqli_query($link, "select * from questions where category ='$exam_category'") or die (mysqli_error($link));

    $count=mysqli_num_rows($res);

    if ($count==0)
    {
      

    }
    else{
        while($row=mysqli_fetch_array($res))
        {
            $loop=$loop + 1;
            mysqli_query($link, "update questions set question_no='$loop' where id =$row[id]");
        }
    }
    $loop=$loop+1;

    mysqli_query($link, "INSERT INTO `questions`(`question_no`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `category`) VALUES 
    ('$loop','$question', '$opt1','$opt2', '$opt3','$opt4', '$answer', '$exam_category')") or die(mysqli_error($link));

    ?>

<script type = "text/javascript">
alert("question added successfully");
window.location.href=window.location.href;
</script>
<?php
}

?>


<?php

if (isset($_POST["submit2"]))
{

    
    $fquestion = $_POST['question'];

    $opt1 = $_POST['opt1'];


    $opt2 = $_POST['opt2'];

    $opt3 = $_POST['opt3'];

    $opt4 = $_POST['opt4'];
    $answer = $_POST['answer'];

    $loop = 0;

    $count= 0;
    $res=mysqli_query($link, "select * from questions where category ='$exam_category'") or die (mysqli_error($link));

    $count=mysqli_num_rows($res);

    if ($count==0)
    {
      

    }
    else{
        while($row=mysqli_fetch_array($res))
        {
            $loop=$loop + 1;
            mysqli_query($link, "update questions set question_no='$loop' where id =$row[id]");
        }
    }
    $loop=$loop+1;

    $tm=md5(time());

    $fnm1=$_FILES["fopt1"]["name"];
    $dst1="./opt_images/".$tm.$fnm1;
    $dst_db1="opt_images/".$tm.$fnm1;
    move_uploaded_file($_FILES["fopt1"]["tmp_name"], $dst1);

    
    $fnm2=$_FILES["fopt2"]["name"];
    $dst2="./opt_images/".$tm.$fnm2;
    $dst_db2="opt_images/".$tm.$fnm2;
    move_uploaded_file($_FILES["fopt2"]["tmp_name"], $dst2);

    $fnm3=$_FILES["fopt3"]["name"];
    $dst3="./opt_images/".$tm.$fnm3;
    $dst_db3="opt_images/".$tm.$fnm3;
    move_uploaded_file($_FILES["fopt3"]["tmp_name"], $dst3);

    $fnm4=$_FILES["fopt4"]["name"];
    $dst4="./opt_images/".$tm.$fnm4;
    $dst_db4="opt_images/".$tm.$fnm4;
    move_uploaded_file($_FILES["fopt4"]["tmp_name"], $dst4);

    $fnm5=$_FILES["fanswer"]["name"];
    $dst5="./opt_images/".$tm.$fnm5;
    $dst_db5="opt_images/".$tm.$fnm5;
    move_uploaded_file($_FILES["fanswer"]["tmp_name"], $dst5);

    mysqli_query($link, "INSERT INTO `questions`(`question_no`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `category`) VALUES 
    ('$loop','$fquestion', '$dst_db1','$dst_db2', '$dst_db3','$dst_db4', '$dst_db5', '$exam_category')") or die(mysqli_error($link));

    ?>

<script type = "text/javascript">
alert("question added successfully");
window.location.href=window.location.href;
</script>
<?php
}

?>

</section>

                                    <footer class="d-flex flex-column flex-md-row text-center justify-content-center py-4 px-4 px-xl-5 bg-dark">
			<!-- Copyright -->
			<div class="text-white mb-3 mb-md-0">
			  Copyright © 2022. All rights reserved.
			</div>
			<!-- Copyright -->
		</footer>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
		<script src="customjs.js"></script>
	</body>
</html>