<?php

// Include the required functions
require_once("../lib/function.php");

// Instantiate the class
$db = new class_functions();

//   $db_password = null;
 

//   if (isset($_GET['logout'])) {
//       unset($_SESSION['login_email']);
//       session_destroy();
//       header("Location: ./login.php");
//       exit();
//   }
//   if (isset($_SESSION['login_email'])) {
//      $logged_in_email = $_SESSION['login_email'];
 
//      // Fetch user details using the logged-in mobile number
//      $reg_data = $db->get_admin_details($logged_in_email); // Assume this function fetches user details as an associative array
//       $var_user_id =$logged_in_email;
//  }
//  if (!isset($_SESSION['login_email'])) {
//     header("Location: ./index.php");
//     exit();
//  }


     $flag= 0;
     //CHECK if form is submitted
     if(isset($_POST['submit_btn']))//BUTTON NAME

     {
        //variable declare

        echo $var_first_name = $_POST['first_name'];
        echo $var_last_name = $_POST['last_name'];
        echo $var_mobile_no =$_POST['mobile_no'];

        echo $var_account_type =$_POST['account_type'];


        echo $var_email =$_POST['email'];
        echo $var_password=$_POST['password'];
        echo $var_confirm_password =$_POST['con_password'];

        if ($var_password !== $var_confirm_password) {
            echo "<p style='color: red;'>Passwords do not match!</p>";
            $flag = 1;
        }


                    // $var_product_image = $_FILES['product_image']['name'];
                    $valid_formats=array("jpg","png","gif","bmp","jpeg","JPEG","JPG","BMP","PNG","GIF");
                    if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
                    {
                        $name  = $_FILES['admin_image']['name'];
                        $size  = $_FILES['admin_image']['size'];
                        $admin_image =$name;
            
                        if(strlen($name))
                        {
                            list($txt,$ext) = explode(".",$name);
                            if(in_array($ext,$valid_formats))
                            {
                                $tmp =$_FILES['admin_image']['tmp_name'];
                                $img_Dir = "../Admin/admin_image/";
                                if(!file_exists($img_Dir))
                                {
                                    mkdir($img_Dir);
                                }
                                if(move_uploaded_file($tmp, $img_Dir.$name))
                               {
                                $var_admin_image = $name;
                                echo "<p style='color: green;'>Image uploaded successfully!</p>";
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

  
        if ($flag == 0) {
            if ($db->admin_register($var_first_name, $var_last_name, $var_mobile_no, $var_account_type, $var_email, $var_admin_image, $var_password, $var_confirm_password)) {
                echo "<p style='color: green;'>Registration successful!</p>";
            } else {
                echo "<p style='color: red;'>Registration failed!</p>";
            }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
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
    body {
    background-image: url('/shreyaPHP/fruit%20seller/profile_image/fruit5.png');
    background-size: cover; /* Ensures the image covers the entire screen */
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
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

    

</style>

</head>
<body>

    <form action="register.php" method="post" enctype="multipart/form-data" class="form">
     <div class="container">
        <h1> Admin Register</h1>
        <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name"required>
        <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name" >
        <input type="text" placeholder="Enter Mobile Number" class="form-control" name="mobile_no" id="mobile_no" >
        <label style="text-align:left; margin-right:600px;">Profile image</label>
        <input type="file" class="form-control" name="admin_image" id="admin_image" required>
        

        <label for="account_type"  style="text-align:left; margin-right:600px;">Account Type</label>
        <select name="account_type" class="form-control" id="account_type" required>
       <option value="" disabled selected>Please Select</option>
       <option value="Admin">Admin</option>
       </select>

<input type="email" placeholder="Email (e.g., myname@example.com)" class="form-control" name="email" id="email" >

        <input type="password" placeholder="Enter Password" class="form-control" name="password" id="password" >
        <input type="password" placeholder="Confirm Password" class="form-control" name="con_password" id="con_password" >

        <div class="terms">
            <input type="checkbox" id="terms" name="terms" >
            <label for="terms">I accept the terms and conditions</label>
        </div>


        <!-- <a href="login.php" class="btn btn-secondary c_button" name="submit_btn" value="home">Register</a> -->
        <button class="btn btn-secondary c_button" type="submit" name="submit_btn">Register</button>

        </br></br>
        <a href="login.php" class="btn btn-secondary c_button" name="submit_btn" value="home">Login</a>

        </div>
    </form>

</body>
</html>

