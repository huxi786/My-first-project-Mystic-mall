<?php
// File: /Admin/update_order_status.php

session_start();
include '../Php/connection.php';

// Security Check: Ensure an admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // If not logged in, send an error response and exit
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized access. Please log in.']);
    exit;
}

// Check if the required data (order ID and new status) was sent via POST
if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];

    // Define the allowed statuses to prevent invalid data from being inserted
    $allowedStatuses = ['Confirmed', 'Shipped', 'Delivered', 'Canceled'];

    // Check if the provided status is one of the allowed values
    if (in_array($newStatus, $allowedStatuses)) {
        
        // Use a prepared statement to securely update the database
        $query = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $newStatus, $orderId);

        // Execute the update
        if ($stmt->execute()) {
            // If successful, send back a success response
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Order status updated successfully!']);
        } else {
            // If the database update fails, send an error response
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Database update failed.']);
        }
        $stmt->close();
    } else {
        // If the status is not valid, send an error response
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid status provided.']);
    }
} else {
    // If order_id or status is missing, send an error response
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Missing required parameters.']);
}

$conn->close();
?>
