<?php
// Include the required functions
require_once('C:\xampp\htdocs\shreyaPHP\fruit seller\lib\function.php');

// Instantiate the class
$db = new class_functions();

if (isset($_SESSION['login_email'])) {
    $logged_in_email = $_SESSION['login_email'];
 
    // Fetch user details using the logged-in mobile number
  
}
// Handle delete request
if (isset($_GET['delete_id'])) {
    $del_id = $_GET['delete_id'];
    $db->delete_user_record($del_id);
}

// Handle Excel export
if (isset($_GET['excel_export'])) {
    $filename = "user_report_" . date('Ymd') . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    $reg_data = $db->get_user_report_product();
    $show_column = false;

    if (!empty($reg_data)) {
        foreach ($reg_data as $record) {
            if (!$show_column) {
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

$flag= 0;
//CHECK if form is submitted
if(isset($_POST['submit']))//BUTTON NAME
{
    //variable declare

     $var_product_id = $_POST['product_id'];
     $var_product_name = $_POST['product_name'];
     $var_offer_price =$_POST['offer_price'];
     $var_original_price =$_POST['original_price'];
     $var_quantity=$_POST['quantity'];
     $var_total =$_POST['total'];
     $var_user_id =$logged_in_email;
      $var_user_id;
     if($db->addtocart($var_product_id,$var_product_name,$var_offer_price,$var_original_price,$var_quantity,$var_total,$var_user_id))
     {
        
     }

    else{
        $flag=1;
    }
}

  // Initialize the variable to avoid undefined warnings
  $db_password = null;
 
 
  if (isset($_GET['logout'])) {
      unset($_SESSION['login_email']);
      header("Location: ./login.php");
      exit();
  }

  

if (!isset($_SESSION['login_email'])) {
  header("Location: ./shreyaPHP/fruit seller/index.php");

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Seller Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f8ff; /* Softer light blue */
}



.carousel-item img {
    height: 800px;
    object-fit: cover;
    border-radius: 10px;
}

.carousel-buttons-wrapper {
    position:flex;
    top: 50%;
    left: 0;
    width: 100%;
    transform: translateY(-50%);
    z-index: 10;
    margin-top: 24px;
    margin-bottom:-20px;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px 0;
    text-align: center;
}



.carousel-buttons-wrapper a {
    margin: 10px 5px;
    padding: 10px 15px;
    font-size: 16px;
    color: #fff;
    background-color: #ff7f50; /* Coral color */
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.carousel-buttons-wrapper a:hover {
    background-color: #ff6347; /* Tomato color on hover */
}

.card {

    width: 21rem;
    margin: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.card img {
    height: 290px;
    /* width:350px; */
    object-fit: cover;
}

.card-body {
    padding: 15px;
    text-align: center;
}

.card-title {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
}

.card-text {
    font-size: 1rem;
    color: #555;
    margin-bottom: 15px;
}
.btn{
    margin-left:10px;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    height:37px;
    width:170px;

    color: white;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}
.color{
    color:black !important;
}
.qun{
padding-left:20px;
padding-bottom:17px;
padding-top:12px;
height:35px;
font-size:18px;

}.image-container {
    position: relative;

    border: 1px solid #ddd;
    overflow: hidden;
}

.product-image {
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




@media (max-width: 768px) {
    .content {
        padding: 10px;
    }

    .card {
        width: 100%;
    }
}

    </style>
    <script>

// document.querySelectorAll(".image-container").forEach(container => {
//     const img = container.querySelector("img");

//     container.addEventListener("mousemove", (e) => {
//         let rect = container.getBoundingClientRect();
//         let x = (e.clientX - rect.left) / rect.width * 100;
//         let y = (e.clientY - rect.top) / rect.height * 100;
        
//         img.style.transformOrigin = `${x}% ${y}%`;
//         img.style.transform = "scale(2)"; // Adjust zoom level
//     });

//     container.addEventListener("mouseleave", () => {
//         img.style.transform = "scale(1)";
//     });
// });

// let imageZoom = document.getElementById('imageZoom');
// imageZoom.addEventListener('mousemove', (event) => {
//     imageZoom.style.setProperty('--display', 'block');
//     let pointer = {
//         x: (event.offsetX * 100) / imageZoom.offsetWidth,
//         y: (event.offsetY * 100) / imageZoom.offsetHeight
//     }

//     imageZoom.style.setProperty('--zoom-x', pointer.x + '%');
//     imageZoom.style.setProperty('--zoom-y', pointer.y + '%');
// });





document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".image-container").forEach(container => {
        const image = container.querySelector(".product-image");
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
</head>
<body>

<?php include('header.php'); ?>

<div class="content">
    <!-- Carousel Section -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div>
            <img class="d-block w-100 img-fluid" src="image/fruit4.jpg" alt="Fruit">
        </div>
    </div>

    <!-- Cards Section -->
    <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
    <?php
        $reg_data = array();
        $reg_data = $db->get_user_report_product();

        // usort($reg_data, function ($a, $b) {
        //     return strcmp($a['product_name'], $b['product_name']);
        // });
        usort($reg_data, function ($a, $b) {
            return strcasecmp(trim($a['product_name']), trim($b['product_name']));
        });
//It compares two strings lexicographically (alphabetically) without considering case (uppercase/lowercase differences).
//The trim() function removes whitespace and predefined characters from both the beginning and end of a string.

        //print_r($users_data);
        if(!empty($reg_data))        
        {
            $counter =0;
            foreach($reg_data as $record)//read all data from start to end
            {
                $res_product_id       =  $reg_data[$counter]['product_id'];//row column
                $res_product_name         =   $reg_data[$counter]['product_name'];
                $res_description        =   $reg_data[$counter]['description'];     
                $res_category     =   $reg_data[$counter]['category'];
                $res_original_price     =   $reg_data[$counter]['original_price'];
                $res_offer_price   =   $reg_data[$counter]['offer_price'];
                $res_product_image         =   $reg_data[$counter]['product_image']; 
                ?>
<div class="card">
    <div class="image-container" id="imageZoom<?php echo $res_product_id; ?>">
        <img src="product_image/<?php echo $res_product_image; ?>" 
             alt="<?php echo $res_product_name; ?>" 
             class="product-image">
        <div class="zoom-lens"></div> <!-- Zoom Lens -->
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $res_product_name; ?></h5>

        <h4 class="card-text">
    <span class="text-danger" ><del> Rs <?php echo $res_original_price; ?> </del></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rs <?php echo $res_offer_price; ?>
</h4>


        <!-- <p class=""> <?php echo $res_description;; ?></p> -->
        <!-- <form action="home.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $res_product_id; ?>">
            <input type="hidden" name="product_name" value="<?php echo $res_product_name; ?>">
            <input type="hidden" name="offer_price" value="<?php echo $res_offer_price; ?>">
            <input type="number" name="quantity" value="1" min="1" max="10" class="qun">
            <button type="submit" name="submit" class="btn btn-primary">Add to Cart</button>
        </form> -->
        <form action="home.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $res_product_id; ?>">
    <input type="hidden" name="product_name" value="<?php echo $res_product_name; ?>">
    <input type="hidden" name="offer_price" value="<?php echo $res_offer_price; ?>">
    <input type="hidden" name="original_price" value="100"> <!-- Replace with dynamic value -->
    <input type="hidden" name="total" value="100"> <!-- Replace with dynamic calculation -->
    <input class="qun" type="number" name="quantity" value="1" min="1" max="10">
    <!-- <input type="hidden" name="user_id" value="<?php //echo $user_id; ?>"> -->

    <button type="submit" name="submit" class="btn btn-primary">Add to Cart</button>
</form>


    </div>
</div>


        <?php
                $counter++;
            }
        } else {
            echo "<p>No data found</p>";
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>