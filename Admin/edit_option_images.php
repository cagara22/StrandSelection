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

                    <li class="nav-item">
                        <a class="nav-link"><?php
                                            echo $_SESSION['admin']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admininfo.php">ADMIN INFO</a>
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

    if (isset($_GET['id1'])) {

        $id1 = $_GET['id1'];
        $opt1 = "";
        $opt2 = "";
        $opt3 = "";
        $opt4 = "";
        $answer = "";
    }
    ?>

    <section class="d-flex flex-column justify-content-center align-items-center py-5">
        <div class="row" style="width:100%">

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Update Questions with Images</h1>
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
                                if (isset($_POST["submit2"])) {

                                    $id = $_GET['id'];

                                    $question = $_POST['fquestion'];

                                    $opt1 = $_FILES["fopt1"]["name"];
                                    $opt2 = $_FILES["fopt2"]["name"];
                                    $opt3 = $_FILES["fopt3"]["name"];
                                    $opt4 = $_FILES["fopt4"]["name"];
                                    $answer = $_FILES["fanswer"]["name"];

                                    $tm = md5(time());

                                    if ($opt1 != "") {

                                        $dst1 = "./opt_images/" . $tm . $opt1;
                                        $dst_db1 = "opt_images/" . $tm . $opt1;
                                        move_uploaded_file($_FILES["fopt1"]["tmp_name"], $dst1);

                                        mysqli_query($conn, "UPDATE questions SET 
                                                                    question ='$question',
                                                                    opt1 = '$dst_db1'
                                                                     WHERE id = $id");
                                    }

                                    if ($opt2 != "") {

                                        $dst2 = "./opt_images/" . $tm . $opt2;
                                        $dst_db2 = "opt_images/" . $tm . $opt2;
                                        move_uploaded_file($_FILES["fopt2"]["tmp_name"], $dst2);

                                        mysqli_query($conn, "UPDATE questions SET 
                                                                    question ='$question',
                                                                    opt2 = '$dst_db2'
                                                                     WHERE id = $id");
                                    }

                                    if ($opt3 != "") {

                                        $dst3 = "./opt_images/" . $tm . $opt3;
                                        $dst_db3 = "opt_images/" . $tm . $opt3;
                                        move_uploaded_file($_FILES["fopt3"]["tmp_name"], $dst3);

                                        mysqli_query($conn, "UPDATE questions SET 
                                                                    question ='$question',
                                                                    opt3 = '$dst_db3'
                                                                     WHERE id = $id");
                                    }

                                    if ($opt4 != "") {

                                        $dst4 = "./opt_images/" . $tm . $opt4;
                                        $dst_db4 = "opt_images/" . $tm . $opt4;
                                        move_uploaded_file($_FILES["fopt4"]["tmp_name"], $dst4);

                                        mysqli_query($conn, "UPDATE questions SET 
                                                                    question ='$question',
                                                                    opt4 = '$dst_db4'
                                                                     WHERE id = $id");
                                    }

                                    if ($answer != "") {

                                        $dst5 = "./opt_images/" . $tm . $answer;
                                        $dst_db5 = "opt_images/" . $tm . $answer;
                                        move_uploaded_file($_FILES["fanswer"]["tmp_name"], $dst5);

                                        mysqli_query($conn, "UPDATE questions SET 
                                                                    question ='$question',
                                                                    answer = '$dst_db5'
                                                                     WHERE id = $id");
                                    }


                                    mysqli_query($conn, "UPDATE questions SET 
                                                                question ='$question'
                                                                 WHERE id = $id");

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

                                <form name="form1" action="" method="post" enctype="multipart/form-data">

                                    <div class="card-body">
                                        <div class="col-lg-12">

                                            <div class="card">
                                                <div class="card-header"><strong>Update Questions with images</strong></div>
                                                <div class="card-body card-block">


                                                    <div class="form-group">
                                                        <label for="company" class=" form-control-label">
                                                            Add Question</label><input type="text" name="fquestion" placeholder="Add question" class="form-control" value="<?php echo $question1 ?>">
                                                    </div>


                                                    <div class="form-group">
                                                        <img src="<?php echo $opt11; ?>" height="50" width="50">
                                                        <label for="company" class=" form-control-label">
                                                            Add option 1 </label><input type="file" name="fopt1" class="form-control" style="padding-bottom:45px""></div>

    <div class=" form-group">
                                                        <img src="<?php echo $opt21; ?>" height="50" width="50">
                                                        <label for="company" class=" form-control-label">
                                                            Add option 2 </label><input type="file" name="fopt2" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <img src="<?php echo $opt31; ?>" height="50" width="50">
                                                        <label for="company" class=" form-control-label">
                                                            Add option 3 </label>
                                                        <input type="file" name="fopt3" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <img src="<?php echo $opt11; ?>" height="50" width="50">
                                                        <label for="company" class=" form-control-label">
                                                            Add option 4 </label><input type="file" name="fopt4" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <img src="<?php echo $answer1; ?>" height="50" width="50">
                                                        <label for="company" class=" form-control-label">
                                                            Add answer </label><input type="file" name="fanswer" placeholder="Add answer" class="form-control">
                                                    </div>


                                                    <div class="form-group">

                                                        <input type="submit" name="submit2" value="Update Question" placeholder="" class="btn btn-success">
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>

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