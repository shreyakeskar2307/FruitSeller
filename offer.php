<?php
require_once 'lib/function.php';
// Initialize cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = isset($_POST['product_price']) ? (float)$_POST['product_price'] : 0;
    $product_quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if ($product_price > 0 && $product_quantity > 0) {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $product_quantity,
        ];
    }
}

// Handle removal of items
if (isset($_POST['remove_item'])) {
    $remove_id = $_POST['remove_item'];
    unset($_SESSION['cart'][$remove_id]);
    header('Location: cart.php'); // Refresh the page
    exit();
}

// Handle payment process
$payment_done = false;
$total_price = 0;
$receipt_details = '';

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $item) {
        $price = (float) $item['price'];
        $quantity = (int) $item['quantity'];
        $item_total = $price * $quantity;
        $total_price += $item_total;

        // Generate receipt details (without remove button)
        $receipt_details .= "<tr>
                                <td>{$item['name']}</td>
                                <td>Rs {$price}</td>
                                <td>{$quantity}</td>
                                <td>Rs {$item_total}</td>
                             </tr>";
    }
}

if (isset($_POST['pay_now'])) {
    $_SESSION['cart'] = []; // Clear the cart
    $payment_done = true;   // Mark payment as completed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart and Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include('header.php'); ?>

<div class="container mt-5">
    <h2>Your Cart</h2>

    <?php if (!$payment_done): ?>
        <?php if (!empty($_SESSION['cart'])): ?>
            <!-- Cart Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                        <?php 
                        $price = (float) $item['price'];
                        $quantity = (int) $item['quantity'];
                        $item_total = $price * $quantity;
                        ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td>Rs <?php echo $price; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td>Rs <?php echo $item_total; ?></td>
                            <td>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="remove_item" value="<?php echo $id; ?>">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-right">Grand Total: Rs <?php echo $total_price; ?></div>
            <form method="POST" class="mt-3">
                <button type="submit" name="pay_now" class="btn btn-success btn-block">Pay Now</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty. Please add items.</p>
        <?php endif; ?>
    <?php else: ?>
        <!-- Payment Receipt -->
        <div class="receipt-container mt-5">
            <div class="receipt-header text-center">
                <h2 style="color:darkorange;">GREENVEG SUPERSTORE</h2>
                <p>Address: 123 Market Street, Solapur, Maharashtra</p>
                <p>Phone: +91 98765 43210</p>
                <p>Date: <?php echo date("d-m-Y"); ?></p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $receipt_details; ?>
                </tbody>
            </table>
            <div class="text-right font-weight-bold">Grand Total: Rs <?php echo $total_price; ?></div>
            <div class="alert alert-success mt-3 text-center">
                <h4>Payment Successful</h4>
                <p>Thank you for shopping with us!</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>

</body>
</html>
