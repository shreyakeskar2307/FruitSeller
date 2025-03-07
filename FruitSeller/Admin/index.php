<?php
// Include the required functions
require_once('C:\xampp\htdocs\shreyaPHP\fruit seller\lib\function.php');

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
    $var_user_id = $logged_in_email;
}

if (!isset($_SESSION['login_email'])) {
    // Redirect to login page if not logged in
    header("Location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenVeg Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
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
        .sidebar .new-tag {
            background-color: red;
            color: white;
            padding: 2px 5px;
            font-size: 12px;
            border-radius: 5px;
        }
        .topbar {
            margin-left: 250px;
            padding: 15px;
            background-color: #f4f4f4;
            border-bottom: 1px solid #ccc;
        }
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
        }
        .manager-card {
            height: 150px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
        }
        .manager-card i {
            font-size: 24px;
            margin-right: 10px;
        }
        .profile-manager {
            background-color: #27ae60;
        }
        .clients-manager {
            background-color: #e74c3c;
        }
        .inventory-manager {
            background-color: #3498db;
        }
        .sales-master {
            background-color: #16a085;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>GREENVEG</h3>
        <a href="index.php">Dashboard</a>
        <a href="profile.php">Profile Manager</a>
        <a href="manager-cilent.php">Clients Manager</a>
        <a href="manage_inventory.php">Inventory Manage</a>
        <a href="manager_sales.php">Sales Master <span class="new-tag">new</span></a>
    </div>

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div>
            <span class="ms-3">Admin <small>Administrator</small></span>
            <input type="text" class="form-control d-inline-block w-50" placeholder="Search...">
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row g-4">
            <div class="col-md-3">
                <a href="profile.php" style="text-decoration: none;">
                    <div class="manager-card profile-manager">
                        <i class="bi bi-person-fill"></i> Profile Manager
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="manager-cilent.php" style="text-decoration: none;">
                    <div class="manager-card clients-manager">
                        <i class="bi bi-people-fill"></i> Clients Manager
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="manage_inventory.php" style="text-decoration: none;">
                    <div class="manager-card inventory-manager">
                        <i class="bi bi-box"></i> Inventory Manage
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="manager_sales.php" style="text-decoration: none;">
                    <div class="manager-card sales-master">
                        <i class="bi bi-bar-chart"></i> Sales Master
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
