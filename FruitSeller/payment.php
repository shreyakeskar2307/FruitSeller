<?php
require_once 'lib/function.php';

     //function call creating call object 
     $db = new class_functions();

     // Initialize the variable to avoid undefined warnings
     $db_password = null;
     $message="";
 

     if (isset($_GET['logout'])) {
         unset($_SESSION['login_email']);
         header("Location: ./login.php");
         exit();
     }
  
     
     if (isset($_SESSION['login_email'])) {
      $logged_in_email = $_SESSION['login_email'];
  
      // Fetch user details using the logged-in mobile number
      $reg_data = $db->get_user_details($logged_in_email); // Assume this function fetches user details as an associative array
       $var_user_id =$logged_in_email;
  }
  if (!isset($_SESSION['login_email'])) {
     header("Location: ./index.php");
  
  }

if (isset($_GET['grand_total'])) {
    $grand_total = $_GET['grand_total'];
} else {
    $grand_total = 0; // Default value if not found
}


  $var_user_id;
     if (isset($_GET['excel_export'])) {
        $filename = "user_report_" . date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
    
        $reg_data = $db->get_user_profile(); // Ensure this function fetches data correctly
        $show_column = false;
    
        if (!empty($reg_data)) {
            foreach ($reg_data as $record) {
                if (!$show_column) {
                    // Display field/column names in the first row
                    echo implode("\t", array_keys($record)) . "\n";
                    $show_column = true;
                }
                echo implode("\t", array_values($record)) . "\n";
            }
        } else {
            echo "No data found";
        }
        exit;
    }

    if(isset($_POST['submit_btn']))//BUTTON NAME

     {
        //variable declare

         $var_customer_id = $_POST['customer_id'];
         $var_customer_name = $_POST['customer_name'];
         $var_email =$_POST['email'];
         $grand_total =$_POST['grand_total'];
         $var_cardholder =$_POST['cardholder'];
         $var_cardnumber =$_POST['cardnumber'];
         $var_expiry=$_POST['expiry'];
         $var_cvv =$_POST['cvv'];


      

        if($db->payment_customer($var_customer_id,$var_customer_name,$var_email,$grand_total,$var_cardholder,$var_cardnumber,$var_expiry,$var_cvv))
        {
            $message= "<p class='success-message'>✅ Payment Done!</p>"; // Return success message
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
    <title>Payment Page</title>
    <style>
        /* General Page Styling */

        body {
    background-image: url('/shreyaPHP/fruit%20seller/profile_image/fruit5.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: 'Poppins', sans-serif;
    justify-content: center;
    font-family: Arial, sans-serif;

    align-items: center;
    height: 100vh;
    margin: 0;
}
.container {
    display:flex ;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;

}

        .payment-box {
            width: 30%;
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .payment-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Styling */
        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-size: 14px;
            color: #555;
        }

        input {
            width: 97%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
        }

        /* Row for Expiry & CVV */
        .row {
            display: flex;
            gap: 10px;
        }

        .column {
            width: 50%;
        }

        /* Pay Button */
        .pay-button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            margin-top: 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .pay-button:hover {
            background-color: #0056b3;
        }

        /* Success Message */
        .hidden {
            display: none;
        }

        .success-message {
            color: green;
            font-size: 16px;
            margin-top: 10px;
        }
        .pay-button2{
            width: 25%;
            padding: 5px;
            float:right;
            margin-top:-50px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
    }
    </style>
</head>
<body>
<div class="container">
    <!-- Success Message -->
    <!-- <p id="successMessage" class="hidden success-message">✅ Payment Done!</p> -->
     <div style="background-color:lightgreen; width:20%;">
    <?php echo $message; ?>
    </div>
    <div class="payment-box">

        <h2>Payment Details</h2>              
        <a href="cart.php" class="btn btn-secondary pay-button2" name="submit_btn" value="home">Back To Cart</a>


        <?php
        // Ensure $var_user_id contains a valid email or modify the function to fetch by ID
        $reg_data = $db->get_user_profile($var_user_id);

        if (!empty($reg_data) && isset($reg_data[0]['id'])) {
            $counter = 0;
            $res_id = $reg_data[$counter]['id']; // Now, `id` exists!
            $res_first_name = $reg_data[$counter]['first_name'] ?? '';
            $res_last_name = $reg_data[$counter]['last_name'] ?? '';
            $res_email = $reg_data[$counter]['email'] ?? '';
            $res_grand_total = $reg_data[$counter]['grand_total'] ?? '';
        ?>

        <form action="payment.php" id="paymentForm" method="post">
            <!-- Hidden Customer ID Field -->
            <input type="hidden" name="customer_id" value="<?php echo $res_id; ?>">

            <label for="customer_name">Customer Name</label>
            <input type="text" id="customer_name" name="customer_name" 
                   value="<?php echo ($res_first_name . ' ' . $res_last_name); ?>" 
                   readonly required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" 
                   value="<?php echo ($res_email); ?>" 
                   readonly required>

                   <label for="grand_total">Grand Total</label>
            <input type="grand_total" id="grand_total" name="grand_total" 
                   value="<?php echo ($grand_total); ?>"
                   readonly required>

            <label for="cardholder">Cardholder Name</label>
            <input type="text" id="cardholder" name="cardholder" placeholder="John Doe" required>

            <label for="cardnumber">Card Number</label>
            <input type="text" id="cardnumber" name="cardnumber" placeholder="1234 5678 9012 3456" required>

            <label for="expiry">Expiration Date</label>
            <input type="text" id="expiry" name="expiry" placeholder="MM/YY" required>

            <label for="cvv">CVV</label>
            <input type="password" id="cvv" name="cvv" placeholder="***" required>

            <button class="pay-button" type="submit" name="submit_btn">Pay Now</button>
             

        </form>

        <?php
        } else {
            echo "<p>No data found for the user.</p>";
        }
        ?>
    </div>
</div>

<!-- JavaScript for Success Message -->
<!-- <script>
document.getElementById("paymentForm").addEventListener("submit", function(event) {
    // Show success message
    document.getElementById("successMessage").classList.remove("hidden");

    // Optional: Delay form submission to show the success message for a few seconds
    setTimeout(() => {
        this.submit(); // Submit the form after a short delay
    }, 2000);
});
</script> -->

<!-- CSS -->
<style>
.hidden {
    display: none;
}
</style>
</body>
</html>