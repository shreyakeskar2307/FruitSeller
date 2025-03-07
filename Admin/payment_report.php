<?php
// Include the required functions
require_once("../lib/function.php");


// Instantiate the class
$db = new class_functions();

//   $db_password = null;
 

//   if (isset($_GET['logout'])) {
//       unset($_SESSION['login_first_name']);
//       session_destroy();
//       header("Location: ./login.php");
//       exit();
//   }
//   if (isset($_SESSION['login_first_name'])) {
//      $logged_in_email = $_SESSION['login_first_name'];
 
//      // Fetch user details using the logged-in mobile number
//      $reg_data = $db->get_admin_details($logged_in_email); // Assume this function fetches user details as an associative array
//       $var_user_id =$logged_in_email;
//  }
//  if (!isset($_SESSION['login_first_name'])) {
//     header("Location: ./index.php");
//     exit();
//  }




     if(isset($_GET['delete_id']))
     {
        $del_id = $_GET['delete_id'];
        
        //DELETE RECORD
        $db->delete_payment_record($del_id);
     }
     if (isset($_GET['excel_export'])) {
        $filename = "user_report_" . date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
    
        $reg_data = $db->get_payment_report(); // Ensure this function fetches data correctly
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
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Payment report</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style> 
    
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.main-container {
    display: flex;
}

.sidebar {
    background-color: #2c3e50;
    color: white;
    height: 100vh;
    width: 200px; /* Set a fixed width */
    position: fixed;
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

.table-container {
    margin-left: 200px; /* Sidebar width + some gap */
    width: calc(100% - 200px); /* Adjust the table width */
    padding: 20px;
}
.table-wrapper {
    width: 100%;
    overflow-x: auto; 
    border-radius: 10px;
    background: white;
    padding: 10px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

thead th {
    background-color: #17a2b8;
    color: white;
    padding: 12px;
    text-align: center;
    
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
    word-wrap: break-word;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #d1ecf1;
    transition: 0.3s ease-in-out;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}
.edit-btn, .delete-btn {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s ease-in-out;
}



@media (max-width: 768px) {
    table {
        width: 100%;
    }
    th, td {
        font-size: 12px;
        padding: 8px;
    }
}


    </style>
</head>
<body>

<div class="main-container">
    <div class="sidebar">
        <h3>GREENVEG</h3>
        <a href="index.php">Dashboard</a>
        <a href="profile.php">Profile Manager</a>
        <a href="manager-cilent.php">Clients Manager</a>
        <a href="manage_inventory.php">Inventory Manage</a>
        <a href="manager_sales.php">Sales Master <span class="new-tag">new</span></a>
    </div>

    <div class="table-container">
        <h1 style="font-weight:bold;color: #28a745; text-align: center;">PRODUCT Update/Delete</h1>

        <table class="table table-striped table-hover">
            <thead>
                
        
        <th>Serial NO</th>
        <th>Customer Id</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Grand Total</th>
        <th>Card Holder</th>
        <th>Card Number</th>
        <th>Expiry Date</th>
        <th>CVV</th>
        <!-- <th>Edit</th> -->
        <th>Delete</th>
    </thead>
    <tbody>
        <?php
        $reg_data = array();
        $reg_data = $db->get_payment_report();

        //print_r($users_data);
        if(!empty($reg_data))
        {
            $counter =0;
            foreach($reg_data as $record)//read all data from start to end
            {
                // echo res_id         $reg_data[$counter]['id'];//row column
                $res_id          =   $reg_data[$counter]['id'];
                $res_customer_id   =   $reg_data[$counter]['customer_id'];
                $res_customer_name         =   $reg_data[$counter]['customer_name'];
                $res_email        =   $reg_data[$counter]['email'];
                $res_grand_total        =   $reg_data[$counter]['grand_total'];
                $res_cardholder         =   $reg_data[$counter]['cardholder'];
                $res_cardnumber         =   $reg_data[$counter]['cardnumber'];
                $res_expiry        =   $reg_data[$counter]['expiry'];
                $res_cvv   =   $reg_data[$counter]['cvv'];
                



                ?>
                <tr>
                    <td><?php echo $counter+1;      ?></td>
                    <td><?php echo $res_customer_id;  ?></td>
                    <td><?php echo $res_customer_name;    ?></td> 
                    <td><?php echo $res_email;  ?></td>
                    <td><?php echo $res_grand_total;  ?></td>
                    <td><?php echo $res_cardholder;  ?></td>
                    <td><?php echo $res_cardnumber;    ?></td>
                    <td><?php echo $res_expiry;    ?></td>
                    <td><?php echo $res_cvv;    ?></td>
    <!-- <td>
    <a href="product_edit.php?edit_id=<?php echo $res_id; ?>" class="edit-btn">
    <i class="fas fa-edit"></i> 
    </a>
</td> -->
<td>
    <a href="payment_report.php?delete_id=<?php echo $res_id; ?>" 
       class="delete-btn" 
       onclick="return confirm('Are you sure you want to delete this item?');">
       <i class="fas fa-trash-alt" style="color: red;"></i> 
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
</table>
<!-- 
<?php include('C:\xampp\htdocs\shreyaPHP\fruit seller\footer.php'); ?> -->
<!-- </center> -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>