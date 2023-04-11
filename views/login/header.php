<?php
  if(!empty($_SESSION['pgx'])){  
  ?>
  <script type="text/javascript">  
    window.location = <?php echo(BASE_URL); ?>;
  </script> 
 <?php 
 }
 ?>
 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?php echo(BASE_URL); ?>assets/images/favicon.png">
    <script src="<?php echo(BASE_URL); ?>assets/js/jquery.js" ></script>
    <script src="<?php echo(BASE_URL); ?>assets/js/jquery-3.6.0.min.js" ></script>  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="<?php echo(BASE_URL); ?>assets/css/login.css">
    <link rel="stylesheet" href="<?php echo(BASE_URL); ?>assets/bootstrap/css/bootstrap.min.css">
  <title>pgx</title>
  </head>
  <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
          body {
        font-size: .875rem;
        background-color:  #7ee0ed66 !important;
      }

      .feather {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
      }

      /*
      * Sidebar
      */

      .sidebar {
        position: fixed;
        top: 0;
        /* rtl:raw:
        right: 0;
        */
        bottom: 0;
        /* rtl:remove */
        left: 0;
        z-index: 100; /* Behind the navbar */
        padding: 48px 0 0; /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
      }

      @media (max-width: 767.98px) {
        .sidebar {
          top: 5rem;
        }
      }

      .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
      }

      .sidebar .nav-link {
        font-weight: 500;
        color: #333;
      }

      .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #727272;
      }

      .sidebar .nav-link.active {
        color: #2470dc;
      }

      .sidebar .nav-link:hover .feather,
      .sidebar .nav-link.active .feather {
        color: inherit;
      }

      .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
      }

      /*
      * Navbar
      */

      .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
      }

      .navbar .navbar-toggler {
        top: .25rem;
        /* right: 1rem; */
      }

      .navbar .form-control {
        /* padding: .75rem 1rem; */
        border-width: 0;
        border-radius: 0;
      }

      .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
      }

      .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
      }
      .navbar{
  z-index: 999;
}
.nav-item {
        font-size:12 px;
        text-transform:uppercase;
        height:82px;
        line-height:64px;        
      }
      .flare {
        background:#ef662b;
      }
      .flare a.nav-link {
        color:#fff !important
      }
      .topbarElements > div:nth-of-type(1){
        font-size:48px;
        margin:12px 32px;
        color:#ef662b
      }
      @media screen and (min-width:1040px){
        .flare { margin-right:-15px; }
      }
      @media screen and (max-width:1029px){
        .navbar-nav {
          margin-bottom:15px;
          text-align:center
        }
        .nav-item {
          background : rgba(255,255,255,0.1);
          margin:2px;
        }
      }
      .section-heading h6 {
    font-size: 15px;
    font-weight: 700;
    color: #33ccc5;
    text-transform: uppercase;
    margin-bottom: 15px;    
}
.service-item{
  padding: 30px 10px;
}


/* Style tab links */
/* .tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 15%;
}

.tablink:hover {
  background-color: #777;
} */

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  
  display: none;
  padding: 65px 20px;
  height: 100%;
}
.pos-fix{ position: fixed;
}
.tablink {
  border: 1px solid #c3c9c9;
}
  </style>
    <script>
    BASEURL="<?php echo(BASE_URL); ?>";
    ASSETURL="<?php echo(ASSETS_URL); ?>";
    ERP_BASE_URL="<?php echo(ERP_BASE_URL); ?>";
  </script>
  <body >
  <?php
    session_start(); 
    if(isset($_SESSION['pgx']["UserType"]))  {
      header("Location:".BASE_URL); 
    }  
    else{
      
    }

    ?>
  <div class="pos-fix">
    <button class="tablink" onclick="openPage('Terms', this, 'none')">Terms & Conditions</button>
    <button class="tablink" onclick="openPage('Privacy', this, 'none')" >Privacy Policy</button>
    <button class="tablink" onclick="openPage('Contact', this, 'none')">Contact</button>
    <button class="tablink" onclick="openPage('Login', this, 'none')" id="defaultOpen">Login</button>
  </div>
   