<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<title>Home</title>

<head>
    <?php

    include 'php/head.php'

    ?>


</head>

<body>

    <!-- header starts -->
    <?php

    include 'php/header.php'

    ?>
    <!-- header ends -->

    <section id="hero-animated" class="hero-animated d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
            <img src="assets/img/NEWLOGO.png" class="img-fluid animated">
            <h2>Welcome to <span>VESIT PLACEMENT'S</span></h2>
            <p>For Your Entire Placement Journey.</p>
            <div class="d-flex">
                <a href="login.php" class="btn-get-started scrollto">Login</a>

            </div>
        </div>
    </section>

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <!-- <section id="featured-services" class="featured-services">
            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-activity icon"></i></div>
                            <h4><a href="" class="stretched-link">Login</a></h4>
                            <p>Students can login using their credentials. </p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="" class="stretched-link">Register</a></h4>
                            <p>Register yourself here.</p>
                        </div>
                    </div>

        <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="400">
            <div class="service-item position-relative">
                <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                <h4><a href="" class="stretched-link">Look for companies</a></h4>
                <p>You can search for companies.</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
            <div class="service-item position-relative">
                <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                <h4><a href="" class="stretched-link">Apply for Drives</a></h4>
                <p>Look for eligibilty criteria and apply for companies accordingly.</p>
            </div>
        </div><!-- End Service Item -->

        </div>

        </div>
        </section><!-- End Featured Services Section -->




        <!-- ======= Call To Action Section ======= -->
        <section id="cta" class="cta">
            <div class="container" data-aos="zoom-out">

                <div class="row g-5">

                    <div class="col-lg-8 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
                        <h3>VESIT<em>PLACEMENT</em> </h3>
                        <p>The VESIT TPC helps  students find job opportunities by staying connected with top companies and industries. 
<br>The TPC works throughout the year to build links between students and companies. The number of students getting placed through campus interviews is increasing every year.</p>

                        </p>
                        <a class="cta-btn align-self-start" href="#">Get Started</a>
                    </div>

                    <div class="col-lg-4 col-md-6 order-first order-md-last d-flex align-items-center">
                        <div class="img">
                            <img src="assets/img/feature-7.jpg" alt="" class="img-fluid">
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Call To Action Section -->


       


        <!-- ======= Features Section ======= -->
        <section id="objectives" class="features" name="objectives">
            <div class="container" data-aos="fade-up">



                <div class="tab-content">

                    <div class="tab-pane active show" id="tab-1">
                        <div class="row gy-4">
                            <div class="col-lg-8 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                                <h3>Objectives</h3>
                                <p class="fst-itali">
                                    Our Placement Portal serves various objectives:
                                </p>
                                <ul>
                                    <li><i class="bi bi-check-circle-fill"></i> Connect students with suitable job opportunities.
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i> Simplify the placement registration and application process.
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i>Provide real-time updates and notifications about placement activities.</li>

                                </ul>
                            </div>
                            <!-- <div class="col-lg-4 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                                <img src="assets/img/features-1.svg" alt="" class="img-fluid">
                            </div> -->
                        </div>
                    </div>
                    <!-- End Tab Content -->





                   
                    <!-- ======= F.A.Q Section ======= -->


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <?php

    include 'php/footer.php';
    ?>

    <!-- End Footer -->

    <!-- TPO bot -->



    <!-- tpo bot ends -->



</body>

</html>