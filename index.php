<?php

// Include the required functions
require_once 'lib/function.php';
// Instantiate the class
$db = new class_functions();

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['login_email']);
    header("Location: login.php"); // Redirect to login page after logout
    exit();
}

// Check if user is not logged in, then redirect to login
if (!isset($_SESSION['login_email'])) {
    header("Location: login.php"); // Redirect to login instead of index.php
    exit();
}

// Fetch logged-in user details
$logged_in_email = $_SESSION['login_email'];

?>


<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-utilities.css" />

    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 5px;
            margin: 0;
            background-color: lightblue;
        }

        .content {
            border: 5px solid lightblue;
            justify-content: center;
            padding: 10px;

        }

        .carousel-item img {
            height: 600px; /* Adjust based on your design */
            max-height: 100vh; /* Prevents the image from exceeding viewport height */
        }

        /* Transparent navbar-style line behind buttons */
        .carousel-buttons-wrapper {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            transform: translateY(-50%);
            z-index: 10;
            margin-top:124px;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 10px 0;
            text-align: center;
        }

        .carousel-buttons-wrapper a {
            margin: 25px 15px;
   
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color:darkorange;
        }
        .img-fluid{

        }

        
    /* Style for the first navbar */
    .nav_color1 {
      background-color: white !important;
      margin: 0;
    }
    

    /* Center the navbar brand (GreenVeg) */
    .navbar-brand.head {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      margin: 0;
    }
    .hcolor{
      color: darkorange ;
    }

    /* Adjust search bar position */
    .navbar .search-bar-container {
      position: absolute;
      right: 20px; /* Fixes search bar to the right */
    }

    /* Style for the second navbar */
    .nav_color2 {
      background-color: darkorange !important;
      color: white !important;
    }

    .nav_color2 .navbar-nav .nav-link {
      color: white;
    }

    .nav_color2 .navbar-nav .nav-link:hover {
      background-color: #f39c12; /* Optional: Slight hover effect */
    }
    .navbarh{
      margin: 30px;
      color:darkorange;
    }
    .navcolor{
      color:white !important;
      background-color:darkorange !important;
    }
    </style>
</head>
<body>
  <!-- Second Navbar with GREENVEG centered and search bar on the right -->
  <nav class="navbar navbar-expand-lg nav_color1">
    <div class="container-fluid navbarh">
      <!-- Brand logo, centered in the navbar -->
      <a class="navbar-brand head hcolor" href="#"><h1 class="hcolor">GREENVEG</h1></a>

      <!-- Navbar Toggler for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search bar container, aligned to the right -->
        <div class="search-bar-container">
          <form class="d-flex">
            <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

<!-- Third Navbar with menu links displayed inline on all screen sizes -->
<nav class="navbar navbar-expand-lg bg-light nav_color2 navcolor">
  <div class="container-fluid navcolor d-flex">
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item">
        <a class="nav-link active navcolor px-3" aria-current="page" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Vegetables</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Fruit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Offer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">About us</a>
      </li>
    </ul>
  </div>
</nav>


<form action="index.php" method="post" enctype="multipart/form-data">
<div class="content">

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-buttons-wrapper">
            <a href="create_account.php" class="btn btn-secondary c_button" name="submit_btn" value="register">Register</a>
            <a href="login.php" class="btn btn-secondary c_button" name="submit_btn" value="login">Login</a>
        </div>

            <div >
                <img class="d-block w-100 img-fluid" src="image/fruit4.jpg" alt="Fruit">
            </div>
    </div>

</div>
</form>

<?php include('footer.php'); ?>
</body>
</html>





