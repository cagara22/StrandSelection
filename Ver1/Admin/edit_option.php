<?php
session_start();

if (!isset($_SESSION["admin"])) {

?>
    <script type="text/javascript">
        window.location = "index.php";
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                    <li class="nav-item px-4 fw-bold">
                        <a class="nav-link" href="home.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profiles.php">PROFILES</a>
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
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<?php echo $_SESSION['admin']; ?>
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="admininfo.php">ADMIN INFO</a></li>
							<li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
						</ul>
					</li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    include "connection.php";

    if (isset($_GET['id1'])) {

        $id1 = $_GET['id1'];
    }


    ?>
    <section class="d-flex flex-column justify-content-center align-items-center py-5">
        <div class="row" style="width:100%">

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Question</h1>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content mt-3">
                <div class="animated fadeIn">


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">


                                <?php


                                $conn = mysqli_connect('localhost', 'root', '', 'dss_db') or die('Unable to connect to database');
                                if (isset($_POST["submit1"])) {

                                    $id = $_GET['id'];

                                    $question = $_POST['question'];
                                    $opt1 = $_POST['opt1'];
                                    $opt2 = $_POST['opt2'];
                                    $opt3 = $_POST['opt3'];
                                    $opt4 = $_POST['opt4'];
                                    $answer = $_POST['answer'];

                                    mysqli_query($conn, "UPDATE `questions` SET 
                                        `question`='$question',
                                        `opt1`='$opt1',
                                        `opt2`='$opt2',
                                        `opt3`='$opt3',
                                        `opt4`='$opt4',
                                        `answer`='$answer'
                                        WHERE `id`= '$id'");


                                ?>
                                    <script type='text/javascript'>
                                        alert('question updated successfully');
                                        window.location = 'add_edit_questions.php?id=<?php echo $id1 ?>';
                                    </script>;

                                <?php



                                }

                                if (isset($_GET['id'])) {

                                    $user_id = $_GET['id'];

                                    $sql = "SELECT * FROM `questions` WHERE `id`='$user_id'";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {


                                            $question1 = $row['question'];
                                            $opt11 = $row['opt1'];
                                            $opt21 = $row['opt2'];
                                            $opt31 = $row['opt3'];
                                            $opt41 = $row['opt4'];
                                            $answer1 = $row['answer'];
                                        }
                                    }
                                }

                                ?>

                                <form name="form1" action="" method="post">

                                    <div class="card-body">


                                        <div class="col-lg-12">


                                            <div class="card">
                                                <div class="card-header"><strong>Update Questions with text</strong></div>

                                                <div class="card-body card-block">
                                                    <div class="form-group"><label for="company" class=" form-control-label">
                                                            Add Question</label><input type="text" name="question" placeholder="Add question" class="form-control" value="<?php echo $question1; ?>"></div>
                                                    <div class="form-group"><label for="company" class=" form-control-label">
                                                            Add option 1 </label><input type="text" name="opt1" placeholder="Add Option 1" class="form-control" value="<?php echo $opt11; ?>"></div>

                                                    <div class="form-group"><label for="company" class=" form-control-label">
                                                            Add option 2 </label><input type="text" name="opt2" placeholder="Add Option 2" class="form-control" value="<?php echo $opt21; ?>"></div>

                                                    <div class="form-group"><label for="company" class=" form-control-label">
                                                            Add option 3 </label><input type="text" name="opt3" placeholder="Add Option 3" class="form-control" value="<?php echo $opt31; ?>"></div>

                                                    <div class="form-group"><label for="company" class=" form-control-label">
                                                            Add option 4 </label><input type="text" name="opt4" placeholder="Add Option 4" class="form-control" value="<?php echo $opt41; ?>"></div>

                                                    <div class="form-group"><label for="company" class=" form-control-label">
                                                            Add answer </label><input type="text" name="answer" placeholder="Add answer" class="form-control" value="<?php echo $answer1; ?>"></div>

                                                    <br>
                                                    <div class="form-group">

                                                        <input type="submit" name="submit1" value="Update Question" placeholder="" class="btn btn-success">
                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                </form>

                            </div>
                        </div>

                    </div>


                </div><!-- .animated -->
            </div><!-- .content -->

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