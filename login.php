<?php
   // Include function file
   require_once 'lib/function.php';
   // Initialize the variable to avoid undefined warnings
   $db_password = null;

   // Create an object of the class
   $db = new class_functions();

   if (isset($_GET['logout'])) {
       unset($_SESSION['login_email']);
   }

   // Check if form is submitted
   if (isset($_POST['submit_btn'])) {
       $var_email = $_POST['email'];
       $var_password = $_POST['password'];
       
       // Get user password from database
       $db_password = $db->get_user_password($var_email);

       // If user is not found
       if ($db_password === false) {//       if ($db_password =="")instead this use that
           echo "This user is not registered with us. Check Your Email aaddress";
       } else {
           // Check if the password matches
           if ($var_password == $db_password) {
               $_SESSION['login_email'] = $var_email;
               header("Location: home.php");
               exit();
           } else {
               echo "Incorrect password";
           }
       }
   }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Description will be displayed near head content"/>
  <meta name="robots" content="index"/>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-utilities.css" />

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>

  <!-- Add any necessary CSS links here -->
  <style>
    /* body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
      margin: 0;
      display: relative;
      justify-content: center; /* Centers content horizontally */
      /* align-items: center;  */
      /* height: 100vh; */
/*  */

    .container {
      width: 50px; /* Set the container to take 50% of the screen width */
      display: flex;
      flex-direction: column;
      justify-content: center;
      background-color: #fff;
      border-radius: 8px;
      align-items: center;
      padding: 30px;
      margin-bottom:10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form{
      display: absolute;
      width:30%;
      margin-left:580px;
    }
    .c_placeholder{
      width:90%;
      display: relative;
      height:40px;
      margin:10px;
    }
    
    

    /* Optional: To add some spacing and ensure the login form looks good on smaller screens */
    @media (max-width: 768px) {
      .container {
        width: 80%;
        background-color:darkorange; /* For smaller screens, take up 80% of the screen width */
      }
      .form{
      width:50%;
      margin-left:150px;

    }
    }
    @media (min-width: 1024px) {
      .container {
        width: 50%; /* For smaller screens, take up 80% of the screen width */
      }

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
        <a class="nav-link navcolor px-3" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="about_us.php">About us</a>
      </li>
    </ul>
  </div>
</nav>

<form action="login.php" method="post" enctype="multipart/form-data">
<div class="form">
<div class="container">
  <h1 class="text-center">LOGIN FORM</h1>
    <div class="mb-3">
      <label for="email" class="name">Email</label>
      <input type="email" name="email" id="email" class="form-control c_placeholder" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="name">Password</label>
      <input type="password" name="password" id="password" class="form-control c_placeholder" placeholder="Enter your password" required>
    </div>

    <button class="btn btn-primary" type="submit" name="submit_btn">Login</button>
    

  <div class="mt-3">
    <a href="forgot_password.php">Forgot Password?</a>
    <br>
    <a href="register.php">Register here</a> or <a href="index.php">Go back to home</a>
  </div>
</div>
  </div>
</form>

<?php include('footer.php'); ?>

</body>
</html>
