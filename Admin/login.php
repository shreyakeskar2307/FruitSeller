<?php
   // Include function file
   require_once("../lib/function.php");

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
       $db_password = $db->get_admin_password($var_email);

       // If user is not found
       if ($db_password === false) {//       if ($db_password =="")instead this use that
           echo "This user is not registered with us. Check Your Email aaddress";
       } else {
           // Check if the password matches
           if ($var_password == $db_password) {
               $_SESSION['login_email'] = $var_email;
               header("Location: index.php");
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
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
/* General Styles */
/* General Styles */
body {
    background-image: url('/shreyaPHP/fruit%20seller/profile_image/fruit5.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: 'Poppins', sans-serif;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Centered Form Container */
.container {
    display:flex ;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;

}

/* Login Form */
.form {
    width: 40%;
    background: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 10px;
    margin-left:-100px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
}

/* Form Heading */
.form h1 {
    text-align: center;
    margin-bottom: 20px;
    font-weight: 600;
    color: #333;
}

/* Input Fields */
/* Input Fields */
.form .form-control {
    width: 100%;
    border-radius: 6px;
    border: 1px solid #ced4da;
    font-size: 1.1rem; /* Increased font size for better readability */
}


/* Input Placeholder Styling */
/* Input Placeholder Styling */
.form .form-control::placeholder {
    font-size: 1.1rem; /* Increased from 0.9rem to 1.1rem */
    color: #6c757d;
    font-weight: 500; /* Optional: Makes it slightly bolder for better readability */
    opacity: 1; /* Ensures full visibility */
}


/* Labels */
.form label {
    font-weight: 500;
    margin-bottom: 5px;
    color: #444;
}

/* Buttons */
.form .btn {
    width: 100%;
    padding: 10px;
    font-size: 18px;
    font-weight: 500;
    border-radius: 6px;
    background: #007bff;
    border: none;
    color: white;
    transition: 0.3s;
}

.form .btn:hover {
    background: #0056b3;
}

/* Links */
.form a {
    text-decoration: none;
    font-weight: 500;
    color: #007bff;
    transition: 0.3s;
}

.form a:hover {
    color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form {
        width: 90%;
    }
}

    
  </style>
</head>
<body>

<form action="login.php" method="post" enctype="multipart/form-data">

<div class="container">
<div class="form">
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
    <a href="register.php">Register here</a> or
<a href="/shreyaPHP/fruit%20seller/home.php">Go back to home</a>

  </div>
</div>
  </div>
</form>


</body>
</html>
