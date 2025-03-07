<?php

     //include function file
     require_once('lib/function.php');
     //function call creating call object 
     $db = new class_functions();

     if (isset($_GET['edit_id'])) {
        $res_edit_id = $_GET['edit_id'];
        $_SESSION['edit_id'] = $res_edit_id;
    }
    

      $edit_id = $_SESSION['edit_id'];
     // Ensure the session variable exists before accessing it
    //    $edit_id = $_SESSION['edit_id'] ?? null;

// if (!$edit_id) {
//     // Handle the case where 'edit_id' is not set
//     die("Edit ID is not provided. Please check the URL or try again.");
// }


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
        echo $var_email =$_POST['email'];
        echo $var_password =$_POST['password'];
        echo $var_con_password =$_POST['con_password'];

        //catch the form value

        $db->update_entery($var_first_name,$var_last_name,$var_mobile_no,$var_account_type,$var_company_name,$var_company_type,$var_email,$var_password,$var_con_password,$edit_id);
     }
     $user_data = array();
     $user_data = $db->get_user_data_from_id($edit_id);

    //   print_r($user_data);
    if(!empty($user_data))
    {

        $res_id                =$user_data['id'];
        $res_first_name        =$user_data['first_name'];
        $res_last_name         =$user_data['last_name'];
        $res_mobile_no         =$user_data['mobile_no'];
        $res_account_type      =$user_data['account_type'];
        $res_company_name      =$user_data['company_name'];
        $res_company_address   =$user_data['company_address'];
        $res_email             =$user_data['email'];
        $res_password          =$user_data['password'];
        $res_con_password      =$user_data['con_password'];
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
      width: 50px; /* Set the container to take 50% of the screen width */

      flex-direction: column;
      justify-content: center;

      align-items: center;
      padding: 30px;
      margin-bottom:10px;

    }

        .form {

            margin-left:420px;
            width: 50%;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form .form-control {
            width: 100%;
            margin-bottom: 15px;
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
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <form action="create_account.php" method="post" enctype="multipart/form-data" class="form">
    <div class="container">
        <h1>Register</h1>
        <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name" >
        <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name" >
        <input type="text" placeholder="Enter Mobile Number" class="form-control" name="mobile_no" id="mobile_no" >

        <label for="account_type">Account Type</label>
        <select name="account_type" class="form-control" id="account_type" >
            <option value="select">Please Select</option>
            <option value="customer">Customer</option>
            <option value="retailers">Retailers</option>
            <option value="hotel">Hotel</option>
            <option value="restaurant">Restaurant</option>
            <option value="canteen">Canteen</option>
        </select>

        account type== retailer/hotel/restaurant/canteen /!not for customer
        <h1>Company Information</h1>
        <input type="text" placeholder="Company Name" class="form-control" name="company_name" id="company_name" >
        <input type="text" placeholder="Company Address" class="form-control" name="company_address" id="company_address" >

        <h1>Login Information</h1>
        <input type="email" placeholder="Email (e.g., myname@example.com)" class="form-control" name="email" id="email" >
        <input type="password" placeholder="Enter Password" class="form-control" name="password" id="password" >
        <input type="password" placeholder="Confirm Password" class="form-control" name="con_password" id="con_password" >

        <div class="terms">
            <input type="checkbox" id="terms" name="terms" >
            <label for="terms">I accept the terms and conditions</label>
        </div>


        <a href="login.php" class="btn btn-secondary c_button" name="submit_btn" value="home">Register</a>

        </br></br>
        <a href="home.php" class="btn btn-secondary c_button" name="submit_btn" value="home">Home</a>

        </div>
    </form>
    <?php include('footer.php'); ?>
</body>
</html>

