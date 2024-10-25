<?php
session_start();
require '../database/db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the cart data from the POST request
$cart = json_decode($_POST['cart_data'], true);

// Determine customer type
$customer_type = isset($_POST['customer_type']) ? $_POST['customer_type'] : 'walk_in';
$customer_id = "null";

if ($customer_type === 'registered' && isset($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']);  // Get the customer ID from the form
} elseif ($customer_type === 'walk_in') {
    $customer_id = "null";  // Ensure customer_id is null for walk-ins
}

// Start a transaction
mysqli_begin_transaction($conn);

try {
    // Insert the order into the orders table
    $order_date = date('Y-m-d H:i:s');
    $total_price = 0;

    // Calculate total price
    foreach ($cart as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    // Log cart data for debugging
    error_log("Cart Data: " . print_r($cart, true));

    $order_query = "INSERT INTO orders (customer_id, order_date, total_price, customer_type) VALUES ($customer_id, '$order_date', $total_price, '$customer_type')";
    if (!mysqli_query($conn, $order_query)) {
        throw new Exception("Error inserting order: " . mysqli_error($conn));
    }

    $order_id = mysqli_insert_id($conn); // Get the inserted order ID

    // Insert each cart item into the order_items table
    foreach ($cart as $item) {
        $item_query = "INSERT INTO order_items (order_id, item_name, quantity, price) VALUES ($order_id, '{$item['name']}', {$item['quantity']}, {$item['price']})";
        if (!mysqli_query($conn, $item_query)) {
            throw new Exception("Error inserting order item: " . mysqli_error($conn));
        }
    }

    // Commit the transaction
    mysqli_commit($conn);

    // Redirect back to POS with success message
    header("Location: pos.php?success=true");
    exit();
} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($conn);

    // Log the error message to a file
    error_log("Checkout Error: " . $e->getMessage());
    
    // Redirect back to POS with an error message
    header("Location: pos.php?success=false");
    exit();
}

