<?php
  if(!empty($_SESSION['pgx'])){  
  ?>
  <script type="text/javascript">  
    window.location = <?php echo(BASE_URL); ?>;
  </script> 
 <?php 
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CrayBiz</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="homeassets/img/favicon.png" rel="icon">
  <link href="homeassets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="homeassets/vendor/aos/aos.css" rel="stylesheet">
  <link href="homeassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="homeassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="homeassets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="homeassets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="homeassets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="homeassets/css/style.css" rel="stylesheet">
  <link href="homeassets/css/custom.css" rel="stylesheet"> 
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="bi bi-list mobile-nav-toggle"></i></button> -->
  <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex flex-column justify-content-center">

    <nav id="navbar" class="navbar nav-menu">
      <ul>
        <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li><a href="#about" class="nav-link scrollto"><i class="bx bx-grid"></i> <span>About</span></a></li>
        <li><a href="#terms" class="nav-link scrollto"><i class="bx  bx-file-blank"></i> <span>Terms & Condition</span></a></li>
        <li><a href="#refund" class="nav-link scrollto"><i class="bx  bx-book-content"></i> <span>Refund Policy</span></a></li>
         <li><a href="#privacy" class="nav-link scrollto"><i class="bx bx-server"></i> <span>Privacy Policy</span></a></li>
        <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
        <li><a href="../pgx" class="nav-link scrollto" target="_blank"><i class="bx bx-right-arrow-circle"></i> <span>Login</span></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->

  <?php
    session_start(); 
    if(isset($_SESSION['pgx']["UserType"]))  {
      header("Location:".BASE_URL); 
    }  
    else{
      
    }

    ?>