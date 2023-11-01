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
                <img src="./images/GUIDE_Logo_3.png" alt="Logo" width="150" height="37" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">HOME</a>
                    </li>
                    <li class="nav-item px-4 fw-bold">
                        <a class="nav-link active" aria-current="page" href="strand.php">STRAND</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">PROFILE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="result.php">RESULT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">ABOUT</a>
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

    <section class="section-100 d-flex flex-column justify-content-center align-items-center py-5">
        <div class="row w-100">
            <div class="col-12 p-5">
                <div class="card border-light mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 text-center">
                            <img src="./images/stem.png" class="cust-img-50 rounded-start" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h3 class="card-title fw-bold sub-title">1. Science, Technology, Engineering, and Mathematics</h3>
                                <p class="card-text fw-bold">This strand is focused on developing skills and knowledge in the fields of science, technology, engineering, and math, and is ideal for students who want to pursue careers in these fields.</p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a class="btn btn-warning fw-bold" href="./strand/stem.php" role="button">EXPLORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5 bglightgrey">
                <div class="card border-light mb-3 bglightgrey" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 order-1 order-md-2 text-center">
                            <img src="./images/humss.png" class="cust-img-50 rounded-start" alt="...">
                        </div>
                        <div class="col-md-9 order-2 order-md-1">
                            <div class="card-body">
                                <h3 class="card-title fw-bold sub-title">2. Humanities and Social Sciences</h3>
                                <p class="card-text fw-bold">This strand is focused on developing skills and knowledge in the areas of language, literature, history, philosophy, psychology, and the social sciences. It is ideal for students who are interested in pursuing careers in fields such as law, teaching, social work, or journalism.</p>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a class="btn btn-warning fw-bold" href="./strand/humss.php" role="button">EXPLORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5">
                <div class="card border-light mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 text-center">
                            <img src="./images/abm.png" class="cust-img-50 rounded-start" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h3 class="card-title fw-bold sub-title">3. Accountancy, Business, and Management</h3>
                                <p class="card-text fw-bold">This strand is focused on developing skills and knowledge in the areas of accounting, business, and management. It is ideal for students who are interested in pursuing careers in fields such as business, finance, economics, or entrepreneurship.</p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a class="btn btn-warning fw-bold" href="./strand/abm.php" role="button">EXPLORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5 bglightgrey">
                <div class="card border-light mb-3 bglightgrey" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 order-1 order-md-2 text-center">
                            <img src="./images/gas.png" class="cust-img-50 rounded-start" alt="...">
                        </div>
                        <div class="col-md-9 order-2 order-md-1">
                            <div class="card-body">
                                <h3 class="card-title fw-bold sub-title">4. General Academic Strand</h3>
                                <p class="card-text fw-bold">This strand is designed to provide students with a broad range of knowledge and skills across various academic disciplines. It is ideal for students who are still exploring their interests and are undecided about their career paths.</p>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a class="btn btn-warning fw-bold" href="./strand/gas.php" role="button">EXPLORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5">
                <div class="card border-light mb-3" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 text-center">
                            <img src="./images/tvlict.png" class="cust-img-50 rounded-start" alt="...">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h3 class="card-title fw-bold sub-title">5. Technical-Vocational Livelihood - Information Communication and Technology</h3>
                                <p class="card-text fw-bold">TVL-ICT (Information and Communications Technology) is a technical-vocational strand that focuses on the skills needed for information and communication technology.</p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a class="btn btn-warning fw-bold" href="./strand/tvlict.php" role="button">EXPLORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5 bglightgrey">
                <div class="card border-light mb-3 bglightgrey" style="max-width: 100%;">
                    <div class="row g-0">
                        <div class="col-md-3 order-1 order-md-2 text-center">
                            <img src="./images/tvlhe.png" class="cust-img-50 rounded-start" alt="...">
                        </div>
                        <div class="col-md-9 order-2 order-md-1">
                            <div class="card-body">
                                <h3 class="card-title fw-bold sub-title">6. Technical-Vocational Livelihood - Home Economics</h3>
                                <p class="card-text fw-bold">TVL-HE (Home Economics) is a technical-vocational strand that focuses on the skills needed for home economics and entrepreneurship.</p>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a class="btn btn-warning fw-bold" href="./strand/tvlhe.php" role="button">EXPLORE</a>
                                </div>
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