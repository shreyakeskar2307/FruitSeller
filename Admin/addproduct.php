
<?php

     //include function file
     require_once("../lib/function.php");

     //function call creating call object 
     $db = new class_functions();

     $db_password = null;
 

     if (isset($_GET['logout'])) {
         unset($_SESSION['login_email']);
         header("Location: ./login.php");
         exit();
     }
     if (isset($_SESSION['login_email'])) {
        $logged_in_email = $_SESSION['login_email'];
    
        // Fetch user details using the logged-in mobile number
        $reg_data = $db->get_admin_details($logged_in_email); // Assume this function fetches user details as an associative array
         $var_user_id =$logged_in_email;
    }
    if (!isset($_SESSION['login_email'])) {
       header("Location: ./index.php");
    
    }
     $flag= 0;
     $var_product_image="";
     //CHECK if form is submitted
     if(isset($_POST['submit_btn']))//BUTTON NAME

     {
        //variable declare

        echo $var_product_id = $_POST['product_id'];
        echo $var_product_name = $_POST['product_name'];
        echo $var_description =$_POST['description'];
        echo $var_quantity =$_POST['quantity'];
        echo $var_available_stock =$_POST['available_stock'];
        echo $var_manufactore=$_POST['manufactore'];
        echo $var_mfg_date =$_POST['mfg_date'];
        echo $var_bestbefore =$_POST['bestbefore'];
        echo $var_category =$_POST['category'];
        echo $var_original_price =$_POST['original_price'];
        echo $var_offer_price =$_POST['offer_price'];
      
            // $var_product_image = $_FILES['product_image']['name'];
        $valid_formats=array("jpg","png","gif","bmp","jpeg","JPEG","JPG","BMP","PNG","GIF");
        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            $name  = $_FILES['product_image']['name'];
            $size  = $_FILES['product_image']['size'];
            $product_image =$name;

            if(strlen($name))
            {
                list($txt,$ext) = explode(".",$name);
                if(in_array($ext,$valid_formats))
                {
                    $tmp =$_FILES['product_image']['tmp_name'];
                    $img_Dir = "../product_image/";
                    if(!file_exists($img_Dir))
                    {
                        mkdir($img_Dir);
                    }
                    if(move_uploaded_file($tmp, $img_Dir.$name))
                   {
                    $var_product_image = $name;
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

        if($db->addproduct($var_product_id,$var_product_name,$var_description,$var_quantity,$var_available_stock,$var_manufactore,$var_mfg_date,$var_bestbefore,$var_category,$var_original_price,$var_offer_price,$var_product_image))
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenVeg Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            padding-top: 20px;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .sidebar .new-tag {
            background-color: red;
            color: white;
            padding: 2px 5px;
            font-size: 12px;
            border-radius: 5px;
        }
        .topbar {
            margin-left: 250px;
            padding: 15px;
            background-color: #f4f4f4;
            border-bottom: 1px solid #ccc;
        }
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
        }
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
        </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>GREENVEG</h3>
        <a href="index.php">Dashboard</a>
        <a href="profile.php">Profile Manager</a>
        <a href="manager-cilent.php">Clients Manager</a>
        <a href="manage_inventory.php">Inventory Manage</a>
        <a href="manager_sales.php">Sales Master <span class="new-tag">new</span></a>
    </div>

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <div>
         <span class="ms-3">Admin <small>Administrator</small></span>
            <input type="text" class="form-control d-inline-block w-50" placeholder="Search...">
        </div>
    </div>

    <div class="dashboard-content">
<form action="addproduct.php" method="post" enctype="multipart/form-data" class="form">
    <div class="container">
        <h1> Add Product</h1>
        <h6>Product id</h6>
        <input type="text" placeholder=" potato1kgPack" class="form-control" name="product_id" id="product_id"required>
        <h6>product name</h6>
        <input type="text" placeholder="Enter product name" class="form-control" name="product_name" id="product_name" >
        <h6>Description</h6>
        <input type="text" placeholder="Enter Description" class="form-control" name="description" id="description" >
        <h6>Quantity</h6>
        <input type="text" placeholder="Mesurment of the product like 5Kg" class="form-control" name="quantity" id="quantity" >
        <h6>Available Stock</h6>
        <input type="text" placeholder="Available Stock in numbers" class="form-control" name="available_stock" id="available_stock" >
        <h6>manufactore</h6>
        <input type="text" placeholder="Manufactore name" class="form-control" name="manufactore" id="manufactore" >
        <h6>mfg date</h6>
        <input type="date" name="mfg_date"  class="form-control"  id="mfg_date" required>
        <h6>bestbefore</h6>
        <input type="text" placeholder="1 Year" class="form-control" name="bestbefore" id="bestbefore" >
        <h6>category</h6>
        <input type="text" placeholder=" Fruit/ Vegetable/ Staples/ DryFruit/ Groceries " class="form-control" name="category" id="category" >
        <h6>original price</h6>
        <input type="text" placeholder="123.00 " class="form-control" name="original_price" id="original_price" >
        <h6>offer price</h6>
        <input type="text" placeholder="100.00" class="form-control" name="offer_price" id="offer_price" >
        <h6>product image</h6>
        <input type="file" class="form-control" name="product_image" id="product_image" required>
        </br>
        <!-- <a href="login.php" class="btn btn-secondary c_button" name="submit_btn" value="home">Register</a> -->
        <button class="btn btn-secondary c_button" type="submit" name="submit_btn">Add Product</button>

        </br></br>
        <a href="home.php" class="btn btn-secondary c_button" name="submit_btn" value="home">Reset</a>

        </div>
    </form>
    </div>
</body>
</html>