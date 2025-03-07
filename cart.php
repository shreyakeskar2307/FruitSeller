<?php
     //include function file
     require_once('C:\xampp\htdocs\shreyaPHP\fruit seller\lib\function.php');

     //function call creating call object 
     $db = new class_functions();

     // Initialize the variable to avoid undefined warnings
     $db_password = null;
 

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
  if(isset($_GET['delete_id']))
  {
     $del_id = $_GET['delete_id'];
     
     //DELETE RECORD
     $db->delete_cart_record($del_id);
  }
   $var_user_id;
     if (isset($_GET['excel_export'])) {
        $filename = "user_report_" . date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
    
        $reg_data = $db->get_addtocart_report(); // Ensure this function fetches data correctly
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

        

    
    

?>
<!DOCTYPE html>
<html lang="en">
    <!-- <head> -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\shreyaPHP\css\bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\shreyaPHP\css\bootstrap-grid.css" />
    <link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\shreyaPHP\css\bootstrap-reboot.css" />
    <link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\shreyaPHP\css\bootstrap-utilities.css" />
    <link rel="stylesheet" type="text/css" href="C:\xampp\htdocs\shreyaPHP\css\bootstrap.min.css" /> -->
    <!-- <script type="text/javascript" src="C:\xampp\htdocs\shreyaPHP\js\bootstrap.js"></script>
    <script type="text/javascript" src="C:\xampp\htdocs\shreyaPHP\js\bootstrap.bundle.js"></script> -->
    

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>h1 report</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style> 
table, th, td {
  border: 1px solid;
  padding:5px;
  margin:0px;
}
/* General Body Styling */
body {
  font-family: 'Arial', sans-serif;
  background-color: #f9f9f9;
  margin: 0;
  padding: 20px;
}

/* Table Styling */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  background-color: #fff;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
  text-align: left;
}

thead {
  background-color: #007bff;
  color: #fff;
  text-align: left;
  
  
}

td{
  padding: 12px 15px;
  text-transform: uppercase;
  letter-spacing: 0.0em;
}
tr{
  text-align:center !important;
  
}


th {
  padding: 12px 0px !important;
  text-transform: uppercase;
  letter-spacing: 0.0em;
  
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}



/* Grand Total Row */
thead th:last-child {
  background-color: #ffc107;
  color: #333;
}
thead th:nth-child(even){
  background-color: #ffc107;
  color: #333;
}

td:last-child {
  font-weight: bold;
  color: #ff5722;
}

/* Buttons */
.btn-secondary {
  display: inline-block;
  margin: 20px auto;
  text-align: center;
  padding: 10px 20px;
  font-size: 16px;
  color: #fff;
  background-color: #6c757d;
  border-radius: 5px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background-color: #5a6268;
}

/* Footer */
footer {


}

    </style>
</head>
<body>
<?php
   require_once('header.php')//to get another file
?>
    <!-- <center> -->
        <P>cart REPORT</P>

<table  cellspacing="0" cellpadding="0"  style="margin-top:110px;">
    <thead style="text-align:center !important;">
        <th>Serial No</th>
        <th>product id</th>
        <th>product Name</th>
        <th>offer price</th>
        <th>original  price</th>
        <th>quantity</th>
        <th>total</th>
        <!-- <th>User Id</th> -->
        <!-- <th>Edit</th> -->
        <th>Delete</th>
    </thead>

    <tbody>
        <?php
        $res_grandtotal=0 ;
        $reg_data = array();
        $reg_data = $db->get_addtocart_report($var_user_id);

        //print_r($users_data);
        if(!empty($reg_data))
        {
            $counter =0;
            foreach($reg_data as $record)//read all data from start to end
            {
                // echo res_id         $reg_data[$counter]['id'];//row column
                $res_id          =   $reg_data[$counter]['id'];
                $res_product_id   =   $reg_data[$counter]['product_id'];
                $res_product_name         =   $reg_data[$counter]['product_name'];
                $res_offer_price         =   floatval($reg_data[$counter]['offer_price']);
                $res_original_price         =   $reg_data[$counter]['original_price'];
                $res_quantity         =   floatval($reg_data[$counter]['quantity']);
                // $res_total         =   $reg_data[$counter]['total'];
                $res_total = floatval($res_offer_price* $res_quantity);
                $res_grandtotal +=$res_total;
                // $res_user_id         =  $reg_data[$counter]['user_id'];



                ?>
                <tr >
                    <td><?php echo $counter+1;      ?></td>
                    <td><?php echo $res_product_id;  ?></td>
                    <td><?php echo $res_product_name;    ?></td>
                    <td><?php echo $res_offer_price;    ?></td>
                    <td><?php echo $res_original_price;    ?></td>
                    <td><?php echo $res_quantity;    ?></td>
                    <td><?php echo $res_total;    ?></td>
                    <!-- <td><?php //echo $res_user_id;    ?></td> -->


<!-- <td>
    <a href="report_edit.php?edit_id=<?php echo $res_id; ?>">Edit</a>
</td> -->
<td>
    <a href="cart.php?delete_id=<?php echo $res_id; ?>" 
       onclick="return confirm('Are you sure you want to delete this item?');">
       Delete
    </a>
</td>

        
                </tr>


                <?php
                $counter++;
            }

        }
        else
        {
            echo "No data found";
        }

        
        ?>
        <thead>
            <th>Grand Total</th>
        </thead>
        <tr>                    
            <td><?php echo $res_grandtotal;    ?></td>
        </tr>
</table>
<a type="submit" class="btn btn-secondary c_button" name="logout" value="Logout" href="index.php?logout">Logout</a>

<a type="submit" class="btn btn-secondary c_button" name="logout" value="Logout" href="index.php?logout">Payment Here</a>
<!-- </center> -->
<?php include('footer.php'); ?>
</body>
</html>













