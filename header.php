<?php
     //include function file
     require_once 'lib/function.php';
     //function call creating call object 
     $db = new class_functions();

     
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
 }
 if (!isset($_SESSION['login_email'])) {
    header("Location: ./index.php");
 
 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>

    /* Style for the first navbar */
    .nav_color1 {
      background-color: white !important;
      margin: 0;
    }
    

    /* Center the navbar brand (GreenVeg) */
    .navbar-brand.head {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      margin: 0;
    }
    .hcolor{
      color: darkorange ;
    }

    /* Adjust search bar position */
    .navbar .search-bar-container {
      position: absolute;
      right: 20px; /* Fixes search bar to the right */
    }

    /* Style for the second navbar */
    .nav_color2 {
      padding:0px !important;
      background-color: darkorange !important;
      color: white !important;
    }

    .nav_color2 .navbar-nav .nav-link {
      color: white;
    }

    .nav_color2 .navbar-nav .nav-link:hover {
      background-color: #f39c12; /* Optional: Slight hover effect */
    }
    .navbarh{
      margin: 30px;
      color:darkorange;
    }
    .navcolor{
      color:white !important;
      background-color:darkorange !important;
    }

 /* General Dropdown Styling */
 .custom-dropdown {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    min-width: 180px;
    transition: all 0.3s ease-in-out;
  }

  .custom-dropdown .dropdown-item {
    color: #333;
    padding: 10px 15px;
    font-weight: 500;
    transition: background 0.3s ease-in-out;
  }

  .custom-dropdown .dropdown-item:hover {
    background-color: darkorange;
    color: white;
  }

  /* Responsive Dropdown for Small Screens */
  @media (max-width: 768px) {
    .navbar-nav {
      flex-direction: column; /* Stack items vertically */
    }

    .nav-item {
      text-align: center; /* Center menu items */
    }

    .dropdown-menu {
      width: 100%; /* Full width dropdown */
      text-align: center;
    }
  }
  /* Fix the navbar at the top */
.fixed-navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  background-color: white; /* Ensure navbar background stays visible */
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Optional shadow for better visibility */
}

/* Push the page content down so it doesn't get hidden behind the navbar */
body {
  padding-top: 50px; /* Adjust based on your navbar height */
}

  </style>

</head>
<body>
<div class="fixed-navbar">
  <!-- First Navbar with the center title and search bar -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark ">
    <div class="container-fluid">
      <div class="d-flex ms-auto">
        <span class="navbar-brand mb-0 h1 me-3">Hi,
        <?php
        $reg_data = $db->get_user_details($logged_in_email);

        //print_r($users_data);
        if(!empty($reg_data))
        {

                // echo res_id         $reg_data[$counter]['id'];//row column

                $res_first_name   =   $reg_data['first_name'];
                ?>
                <?php echo ($reg_data['first_name'] ?? 'Student'); ?>!</b>
                <?php
            

        }
        else
        {
            echo "No data found";
        }
        ?>
        </span>
        <a class="navbar-brand mb-0 h1 me-3"  href="profile.php">Profile</a>
        <a class="navbar-brand mb-0 h1" href="cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
      </div>
    </div>
  </nav>

  <!-- Second Navbar with GREENVEG centered and search bar on the right -->
  <nav class="navbar navbar-expand-lg nav_color1">
    <div class="container-fluid navbarh">
      <!-- Brand logo, centered in the navbar -->
      <a class="navbar-brand head hcolor" href="#"><h1 class="hcolor">GREENVEG</h1></a>

      <!-- Navbar Toggler for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search bar container, aligned to the right -->
        <div class="search-bar-container">
          <form class="d-flex">
            <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>

<!-- Third Navbar with menu links displayed inline on all screen sizes -->
<nav class="navbar navbar-expand-lg bg-light nav_color2 navcolor">
  <div class="container-fluid navcolor d-flex">
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item">
        <a class="nav-link active navcolor px-3" aria-current="page" href="home.php">Home</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Categorey</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Vegetables</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Fruit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Staples</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Dryfriut</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Groceries</a>
      </li> -->
      <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle navcolor px-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Categories
  </a>
  <ul class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item" href="vegetable.php">Vegetables</a></li>
    <li><a class="dropdown-item" href="fruit.php">Fruit</a></li>
    <li><a class="dropdown-item" href="dryfruit.php">Dryfruit</a></li>
    <li><a class="dropdown-item" href="groceries.php">Groceries</a></li>
  </ul>
</li>

      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="#">Offer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link navcolor px-3" href="about_us.php">About us</a>
      </li>
    </ul>
  </div>
</nav>
</div>

</body>
</html>

