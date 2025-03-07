<?php
require_once 'lib/function.php';
     //function call creating call object 
     $db = new class_functions();

     
     if(isset($_GET['delete_id']))
     {
        $del_id = $_GET['delete_id'];
        
        //DELETE RECORD
        $db->delete_user_record($del_id);
     }
     if (isset($_GET['excel_export'])) {
        $filename = "user_report_" . date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
    
        $reg_data = $db->get_user_report(); // Ensure this function fetches data correctly
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
    <title>h1 report</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style> 
table, th, td {
  border: 1px solid;
  padding:5px;
  margin:0px;
}
    </style>
</head>
<body>
<?php
   require_once('header.php')//to get another file
?>
    <!-- <center> -->
        <P>USER REPORT</P>
        <a href="report.php?excel_export">Excel Export</a>
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
</script>

<table  cellspacing="0" cellpadding="5">
    <thead>
        <th>Serial No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile Number</th>
        <th>Account Types</th>
        <th>Company Name</th>
        <th>Company Address</th>
        <th>Email</th>
        <th>Password</th>
        <th>Confirm Password</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?php
        $reg_data = array();
        $reg_data = $db->get_user_report();

        //print_r($users_data);
        if(!empty($reg_data))
        {
            $counter =0;
            foreach($reg_data as $record)//read all data from start to end
            {
                // echo res_id         $reg_data[$counter]['id'];//row column
                $res_id          =   $reg_data[$counter]['id'];
                $res_first_name   =   $reg_data[$counter]['first_name'];
                $res_last_name         =   $reg_data[$counter]['last_name'];
                $res_mobile_no         =   $reg_data[$counter]['mobile_no'];
                $res_account_type         =   $reg_data[$counter]['account_type'];
                $res_company_name         =   $reg_data[$counter]['company_name'];
                $res_company_address        =   $reg_data[$counter]['company_address'];
                $res_email   =   $reg_data[$counter]['email'];
                $res_password         =   $reg_data[$counter]['password'];        
                $res_con_password     =   $reg_data[$counter]['con_password'];


                ?>
                <tr>
                    <td><?php echo $counter+1;      ?></td>
                    <td><?php echo $res_first_name;  ?></td>
                    <td><?php echo $res_last_name;    ?></td>
                    <td><?php echo $res_mobile_no;    ?></td>
                    <td><?php echo $res_account_type;    ?></td>
                    <td><?php echo $res_company_name;    ?></td>
                    <td><?php echo $res_company_address;    ?></td>
                    <td><?php echo $res_email;  ?></td>
                    <td><?php echo $res_password;        ?></td>
                    <td><?php echo $res_con_password;    ?></td>

                    <td>
                        <a href="report_edit.php?edit_id=<?php echo $res_id; ?>">Edit</a>
                    </td>
                    <td>
                        <a href="report.php?delete_id=<?php echo $res_id;  ?>">Delete</a>
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
<!-- </center> -->
<?php include('footer.php'); ?>
</body>
</html>