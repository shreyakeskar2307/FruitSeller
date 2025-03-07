<?php

     //include function file
     require_once 'lib/function.php';
     //function call creating call object 
     $db = new class_functions();

     $flag= 0;
     //CHECK if form is submitted
     if(isset($_POST['submit_btn']))//BUTTON NAME

     {
        //variable declare

        echo $var_first_name = $_POST['first_name'];
        echo $var_last_name = $_POST['last_name'];
        echo $var_mobile_no =$_POST['mobile_no'];

        echo $var_account_type =$_POST['account_type'];
        echo $var_company_name =$_POST['company_name'];
        echo $var_company_address =$_POST['company_address'];  

        // echo $var_profile_image =$_POST['profile_image'];
        echo $var_email =$_POST['email'];
        echo $var_password=$_POST['password'];
        echo $var_con_password =$_POST['con_password'];

              
            // $var_product_image = $_FILES['product_image']['name'];
            $valid_formats=array("jpg","png","gif","bmp","jpeg","JPEG","JPG","BMP","PNG","GIF");
            if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
            {
                $name  = $_FILES['profile_image']['name'];
                $size  = $_FILES['profile_image']['size'];
                $profile_image =$name;
    
                if(strlen($name))
                {
                    list($txt,$ext) = explode(".",$name);
                    if(in_array($ext,$valid_formats))
                    {
                        $tmp =$_FILES['profile_image']['tmp_name'];
                        $img_Dir = "../fruit seller/profile_image/";
                        if(!file_exists($img_Dir))
                        {
                            mkdir($img_Dir);
                        }
                        if(move_uploaded_file($tmp, $img_Dir.$name))
                       {
                        $var_profile_image = $name;
                        echo "<p style='color: green;'>Profile Image uploaded successfully!</p>";
                       }
                       else
                        {
                            $image_error  ="failed";
                            $flag         = 1;
                        }
                    }
                }
                else
                {
                    $image_error  ="Invalid file format";
                    $flag         = 1;
                }
            }
    

         if($db->fruit_registered($var_first_name,$var_last_name,$var_mobile_no,$var_account_type,$var_company_name,$var_company_address, $var_profile_image,$var_email,$var_password,$var_con_password))
         {
            
         }
 
        else{
            $flag=1;
        }
     
    

    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="software development, website development"/>
    <meta name="description" content="description will be displayed near head content"/>
    <meta name="robots" content="index"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">

    <script src="js/bootstrap.bundle.js"></script>

    <style>
    .container {
        width: 100%; /* Full-width container */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px;
        margin-bottom: 10px;
    }

    .form {
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Default styling */
    @media (max-width: 768px) {
        .form {
            width: 100%; /* Adjust width for larger screens */
        }
    }

    .form h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form .form-control {
        width: 100%;
        margin-bottom: 15px;
    }

    .hidden {
        display: none;
    }

    .form .form-control::placeholder {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .form .btn {
        width: 100%;
    }

    .form label {
        margin-top: 15px;
        font-weight: bold;
    }

    .form .terms {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }

    .form .terms input {
        margin-right: 10px;
    }
    .com{
        width:100%;
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
    .c_button1{
      width:40% !important;
      margin-left:-360px
    }
    .c_button2{
      width:40% !important;
      margin-left: 390px;
      margin-top:-35px;
    }
</style>

    <script>
        function toggleCompanyInfo() {
            const accountType = document.getElementById("account_type").value;
            const companySection = document.getElementById("company_section");

            // Show/Hide "Company Information" based on selected account type
            if (accountType === "customer") {
                companySection.classList.add("hidden");
            } else {
                companySection.classList.remove("hidden");
            }
        }
    </script>
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


    <form action="register.php" method="post" enctype="multipart/form-data" class="form">
    <div class="container">
        <h1>Register</h1>
        <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name"required>
        <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name" >
        <input type="text" placeholder="Enter Mobile Number" class="form-control" name="mobile_no" id="mobile_no" >

        <label for="account_type" style="text-align:left; margin-right:630px;">Account Type</label>
        <select name="account_type" class="form-control" id="account_type" onchange="toggleCompanyInfo()">
            <option value="select">Please Select</option>
            <option value="customer">Customer</option>
            <option value="retailers">Retailers</option>
            <option value="hotel">Hotel</option>
            <option value="restaurant">Restaurant</option>
            <option value="canteen">Canteen</option>
        </select>

        <div id="company_section" class="hidden com">
                <h1>Company Information</h1>
                <input type="text" placeholder="Company Name" class="form-control" name="company_name" id="company_name">
                <input type="text" placeholder="Company Address" class="form-control" name="company_address" id="company_address">
            </div>


        <h1>Login Information</h1>
        <label style="text-align:left; margin-right:630px;">Profile image</label>
        <input type="file" class="form-control" name="profile_image" id="profile_image" required>
        <input type="email" placeholder="Email (e.g., myname@example.com)" class="form-control" name="email" id="email" >
        <input type="password" placeholder="Enter Password" class="form-control" name="password" id="password" >
        <input type="password" placeholder="Confirm Password" class="form-control" name="con_password" id="con_password" >

        <div class="terms">
            <input type="checkbox" id="terms" name="terms" >
            <label for="terms">I accept the terms and conditions</label>
        </div>


        <!-- <a href="login.php" class="btn btn-secondary c_button" name="submit_btn" value="home">Register</a> -->
        <button class="btn btn-secondary c_button" type="submit" name="submit_btn">Register</button></br>
        <a  href="login.php" class="btn btn-secondary c_button1" name="submit_btn" value="home">Login</a>
        <a href="home.php" class="btn btn-secondary c_button2" name="submit_btn" value="home">Home</a>


        </div>
    </form>
    <?php include('footer.php'); ?>
</body>
</html>

