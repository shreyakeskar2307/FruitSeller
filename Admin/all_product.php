<?php
// Include the required functions
require_once("../lib/function.php");

// Instantiate the class
$db = new class_functions();

  $db_password = null;
 

  if (isset($_GET['logout'])) {
      unset($_SESSION['login_email']);
      session_destroy();
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
    exit();
 }

?>

<html>
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
    <title>product report</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style> 
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    margin-top: 40px;
}

.table-container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table {
    width: 88.6% !important;
    border-collapse: collapse;
    margin-left: 192px;
}

thead th {
    background-color: #17a2b8 !important;
    color: white;
    padding: 12px;
    text-transform: uppercase;
    text-align: center;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #d1ecf1;
    transition: 0.3s ease-in-out;
}

.sidebar {
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            width:190px;
            padding-top:20px;
            margin-top:-50px;
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
.btn-container {
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
}

.btn-container a, .btn-container button {
    text-decoration: none;
    padding: 10px 15px;
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    transition: background-color 0.3s;
    border: none;
    cursor: pointer;
}

.btn-container a:hover, .btn-container button:hover {
    background-color: #218838;
}

    </style>
</head>
<body>

    <!-- <center> -->
        <h1 style="font-weight:bold;color: #28a745; text-align: center;">PRODUCT REPORT</h1>
        <!-- <a href="report.php?excel_export">Excel Export</a>
        <a href="https://raz.io/i/xF2dv8f">PAT NOW</a>
        <button id="raz-button1">PAY</button>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
        $data = [
    "key"               => $YOUR_KEY_ID, // Enter the Key ID generated from the Dashboard
    "amount"            => $1000,// Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency"          => $INR,
    "name"              => "Acme Corp",
    "description"       => "Test transaction",
    "image"             => "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
    "prefill"           => [
    "name"              => "Gaurav Kumar",
    "email"             => "gaurav.kumar@example.com",
    "contact"           => "9000090000",
    ],
    "notes"             => [
    "address"           => "Razorpay Corporate Office",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#3399cc"
    ],
    "order_id"          => $order_IluGWxBm9U8zJ8, // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
];

$json = json_encode($data);
require("checkout/{$checkout}.php");
</script> -->

<div class="sidebar">
        <h3>GREENVEG</h3>
        <a href="index.php">Dashboard</a>
        <a href="profile.php">Profile Manager</a>
        <a href="manager-cilent.php">Clients Manager</a>
        <a href="manage_inventory.php">Inventory Manage</a>
        <a href="manager_sales.php">Sales Master <span class="new-tag">new</span></a>
    </div>
<table class="table table-striped table-hover">
            <thead>
        
        <th>Serial No</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Available Stock</th>
        <th>Manufactore</th>
        <th>MFG Date</th>
        <th>BestBefore</th>
        <th>Category</th>
        <th>Original Price</th>
        <th>Offer Price</th>
        <th>Product Image</th>
        <!-- <th>Edit</th>
        <th>Delete</th> -->
    </thead>
    <tbody>
        <?php
        $reg_data = array();
        $reg_data = $db->get_user_report_product();

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
                $res_description        =   $reg_data[$counter]['description'];
                $res_quantity         =   $reg_data[$counter]['quantity'];
                $res_available_stock         =   $reg_data[$counter]['available_stock'];
                $res_manufactore        =   $reg_data[$counter]['manufactore'];
                $res_mfg_date   =   $reg_data[$counter]['mfg_date'];
                $res_bestbefore         =   $reg_data[$counter]['bestbefore'];        
                $res_category     =   $reg_data[$counter]['category'];
                $res_original_price        =   $reg_data[$counter]['original_price'];
                $res_offer_price   =   $reg_data[$counter]['offer_price'];
                $res_product_image         =   $reg_data[$counter]['product_image']; 



                ?>
                <tr>
                    <td><?php echo $counter+1;      ?></td>
                    <td><?php echo $res_product_id;  ?></td>
                    <td><?php echo $res_product_name;    ?></td> 
                    <td><?php echo $res_description;  ?></td>
                    <td><?php echo $res_quantity;  ?></td>
                    <td><?php echo $res_available_stock;    ?></td>
                    <td><?php echo $res_manufactore;    ?></td>
                    <td><?php echo $res_mfg_date;    ?></td>
                    <td><?php echo $res_bestbefore;    ?></td>
                    <td><?php echo $res_category;    ?></td>
                    <td><?php echo $res_original_price;  ?></td>
                    <td><?php echo $res_offer_price;        ?></td>
                    <td alt='Product Image' height='50px' width='50px'><?php echo $res_product_image;    ?> </td>


                    <!-- <td>
                        <a href="product_edit.php?edit_id=<?php echo $res_id; ?>">Edit</a>
                    </td>
                    <td>
    <a href="product.php?delete_id=<?php echo $res_id; ?>" 
       onclick="return confirm('Are you sure you want to delete this item?');">
       Delete
    </a>
</td> -->
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

<?php include('C:\xampp\htdocs\shreyaPHP\fruit seller\footer.php'); ?>
<!-- </center> -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>