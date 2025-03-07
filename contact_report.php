<?php
     //include function file
     require_once 'lib/function.php';
     //function call creating call object 
     $db = new class_functions();

     
     if(isset($_GET['delete_id']))
     {
        $del_id = $_GET['delete_id'];
        
        //DELETE RECORD
        $db->delete_user_contact_record($del_id);
     }
     if (isset($_GET['excel_export'])) {
        $filename = "user_report_" . date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
    
        $reg_data = $db->get_user_contact_report(); // Ensure this function fetches data correctly
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
   require_once('header.php')
?>

        <P>CONTACT REPORT</P>


<table  cellspacing="0" cellpadding="5">
    <thead>
        <th>Serial No</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Message</th>

    </thead>
    <tbody>
        <?php
        $reg_data = array();
        $reg_data = $db->get_user_contact_report();

        if(!empty($reg_data))
        {
            $counter =0;
            foreach($reg_data as $record)//read all data from start to end
            {
                // echo res_id         $reg_data[$counter]['id'];//row column
                $res_id          =   $reg_data[$counter]['id'];
                $res_full_name   =   $reg_data[$counter]['full_name'];
                $res_email       =   $reg_data[$counter]['email'];
                $res_message     =   $reg_data[$counter]['message'];


                ?>
                <tr>
                    <td><?php echo $counter+1;      ?></td>
                    <td><?php echo $res_full_name;  ?></td>
                    <td><?php echo $res_email;    ?></td>
                    <td><?php echo $res_message;    ?></td>

                    <td>
                    <a href="contact_report.php?delete_id=<?php echo $res_id; ?>">Delete</a>
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

</body>
</html>