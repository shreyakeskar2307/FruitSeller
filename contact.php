<?php

     //include function file
     require_once('C:\xampp\htdocs\shreyaPHP\fruit seller\lib\function.php');

     //function call creating call object 
     $db = new class_functions();

     $flag= 0;
     //CHECK if form is submitted
     if(isset($_POST['submit_btn']))//BUTTON NAME

     {
        //variable declare

        echo $var_full_name = $_POST['full_name'];
        echo $var_email = $_POST['email'];
        echo $var_message =$_POST['message'];


         if($db->contact_details($var_full_name,$var_email,$var_message))
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <title>Contact Us - GREENVEG</title>
  <style>
    .contact-form {
      max-width: 600px;
      margin: 50px auto;
    }
    .contact-header {
      text-align: center;
      margin-bottom: 40px;
    }
    .contact-info {
      margin-top: 30px;
    }
    .container{
        width:60%;

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

<?php include('header.php'); ?>

  <!-- Contact Us Section -->
   <div class="form" style="margin-top:80px;">
  <div class="container contact-form">
    <h2 class="contact-header">Contact Us</h2>
    <form method="POST" action="contact.php" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="full_name" placeholder="Enter your full name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your message" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="submit_btn">Send Message</button>
    </form>

    <div class="contact-info">
      <h3>Our Contact Information</h3>
      <p>Phone: (123) 456-7890</p>
      <p>Email: contact@greenveg.com</p>
      <p>Address: 123 GreenVeg St., VegCity, Country</p>
    </div>
  </div>
</div>
</body>
</html>
