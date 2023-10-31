<?php
//Starts the sessin and checks if the student is logged in or not
session_start();

if (!isset($_SESSION["student"])) {

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
    <title>GUIDE</title>
    <link rel="icon" type="images/x-icon" href="images/SystemLogoWhite.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="custom_css.css">
</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top">
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
                        <a class="nav-link" href="strand.php">STRAND</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">PROFILE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="result.php">RESULT</a>
                    </li>
                    <li class="nav-item px-4 fw-bold">
                        <a class="nav-link active" aria-current="page" href="about.php">ABOUT</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['fname']; //The name off the Student?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero d-flex flex-column justify-content-center align-items-center text-center" id="aboutHeader">
        <div class="bgblur d-flex flex-column justify-content-center align-items-center text-center">
            <div class="about-pic1">
                <img src="./images/LNHSlogo.png" class="img-fluid" alt="...">
            </div>
            <div class="about-pic2">
                <img src="./images/SystemBrandWhiteVer2.png" class="img-fluid" alt="...">
            </div>
            <h1 class="title2 fst-italic fw-bold my-3">"Dream, Discover, Decide: Senior High Strands - Your Choice, Your Legacy."</h1>
        </div>
    </div>

    <section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
        <div class="w-75">
            <div class="card border-light mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-3 text-center">
                        <img src="./images/decision.png" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h3 class="card-title fw-bold sub-title">ABOUT</h3>
                            <p class="card-text fw-bold">Welcome to our Decision Support System (DSS) for Senior High School Students! Our DSS is designed to help incoming senior high school students at Leyte National High School in selecting the most suitable strand based on their academic performance, interests, skills, socio-economic background, and future job ambitions. Our system uses a structured and objective approach to decision-making, ensuring that students make informed choices and align their academic and career aspirations with the most suitable strand. Our web-based application provides an easy-to-use interface for students, making the process of selecting a strand efficient and stress-free. Join us and discover your path today!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
        <h1 class="sub-title fw-bold">DEVELOPERS</h1>
        <div class="row w-100">
            <div class="col-12 col-md-6">
                <div class="card border-light mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 text-center">
                            <img src="./images/man.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h4 class="card-title fw-bold sub-title">[NAME]</h3>
                                    <h5 class="fw-bold">[ROLE]</h5>
                                    <h5 class="fw-bold">[CONTACT]</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-light mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 text-center">
                            <img src="./images/man.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h4 class="card-title fw-bold sub-title">[NAME]</h3>
                                    <h5 class="fw-bold">[ROLE]</h5>
                                    <h5 class="fw-bold">[CONTACT]</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-light mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 text-center">
                            <img src="./images/man.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h4 class="card-title fw-bold sub-title">[NAME]</h3>
                                    <h5 class="fw-bold">[ROLE]</h5>
                                    <h5 class="fw-bold">[CONTACT]</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card border-light mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 text-center">
                            <img src="./images/woman.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h4 class="card-title fw-bold sub-title">[NAME]</h3>
                                    <h5 class="fw-bold">[ROLE]</h5>
                                    <h5 class="fw-bold">[CONTACT]</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="d-flex flex-column flex-md-row text-center justify-content-center py-4 px-4 px-xl-5">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2023. All rights reserved.
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>