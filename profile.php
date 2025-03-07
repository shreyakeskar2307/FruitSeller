<?php
     //include function file
     require_once 'lib/function.php';
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
.profile-container {
    margin: 20px auto;
    width: 80%;
    text-align: center;
}

.profile-container img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    margin-bottom: 15px;
}

.container {
      width: 50px; /* Set the container to take 50% of the screen width */
      display: flex;
      flex-direction: column;
      justify-content: center;
      background-color: #fff;
      border-radius: 8px;
      align-items: center;
      padding: 10px;
      margin-bottom:10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    .form{
      display:flex;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      width:40%;
      justify-content: center;
      margin-left:480px;
    }

    @media (max-width: 768px) {
      .container {
        width: 100%;
        justify-content: center;

      }
      .form{
      width:75%;
      margin-left:70px;

    }
    }
    @media (min-width: 1024px) {
      .container {
        width: 100%; 
        justify-content: center;
      }

    }
    .profile-container {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    /* border: 1px solid #ddd; */
    overflow: hidden;
}

.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.zoom-lens {
    position: absolute;
    width: 20px;  /* Lens size */
    height: 20px;
    border: 2px solid rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.4);
    border-radius: 50%;  /* Circle lens */
    pointer-events: none;
    display: none;
    transform: translate(-50%, -50%);
}


    </style>
    <script>



document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".profile-container").forEach(container => {
        const image = container.querySelector(".profile-image");
        const lens = container.querySelector(".zoom-lens");

        container.addEventListener("mousemove", (event) => {
            let rect = container.getBoundingClientRect();
            let x = event.clientX - rect.left;
            let y = event.clientY - rect.top;

            lens.style.left = `${x}px`;
            lens.style.top = `${y}px`;
            lens.style.display = "block";

            let percentX = (x / rect.width) * 100;
            let percentY = (y / rect.height) * 100;
            image.style.transformOrigin = `${percentX}% ${percentY}%`;
            image.style.transform = "scale(2)";
        });

        container.addEventListener("mouseleave", () => {
            lens.style.display = "none";
            image.style.transform = "scale(1)";
        });
    });
});

        </script>

    </style>
</head>
<body>
<?php
   require_once('header.php')//to get another file
?>
<div class="form">
<div class="container" style="margin-top:100px;">
    <!-- <center> -->
        <h5>Profile Picture</h5>
        <!-- <div class="profile-container">
        <img src="product_image/soy.jpeg" alt="Profile Picture">
    </div> -->


        <?php
        $reg_data = array();
        $reg_data = $db->get_user_profile($var_user_id);


        //print_r($users_data);
        if(!empty($reg_data))
        {
            $counter =0;
                // echo res_id         $reg_data[$counter]['id'];//row column
                $res_first_name   =   $reg_data[$counter]['first_name'];
                $res_last_name         =   $reg_data[$counter]['last_name'];
                $res_mobile_no         =   $reg_data[$counter]['mobile_no'];
                $res_account_type         =   $reg_data[$counter]['account_type'];
                $res_company_name         =   $reg_data[$counter]['company_name'];
                $res_company_address        =   $reg_data[$counter]['company_address'];
                $res_profile_image         =   $reg_data[$counter]['profile_image']; 
                $res_email   =   $reg_data[$counter]['email'];


                ?>

<div class="profile-container" id="imageZoom ">
        <img src="profile_image/<?php echo $res_profile_image; ?>" 
             alt="profile image<?php echo $res_profile_image; ?>" 
             class="profile-image">
        <div class="zoom-lens"></div> <!-- Zoom Lens -->
    </div>
                    <p >Name :<?php echo $res_first_name;  ?> <?php echo $res_last_name;    ?></p>
                    <p> Mobile NO :<?php echo $res_mobile_no;    ?></p>
                    <p> Account Type :<?php echo $res_account_type;    ?></p>
                    <!-- <p>Company Name : <?php echo $res_company_name ; ?></p>
                    <p> Company Address :<?php echo $res_company_address;    ?></p> -->
                    <?php 

                    if (!empty($res_company_address)) { 
                        echo "<p>Company Name: $res_company_name</p>";
                        echo "<p>Company Address: $res_company_address</p>";
                    } 
                    ?>
                    <p> Email :<?php echo $res_email;  ?></p>
        </div>


                <?php
                $counter++;
            }

        
        else
        {
            echo "No data found";
        }

        
        ?>
</div>
</div>
<!-- </center> -->
<?php include('footer.php'); ?>
</body>
</html>