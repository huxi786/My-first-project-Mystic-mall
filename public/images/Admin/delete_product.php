<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: Admin_login.php');
    exit;
}

include '../php/connection.php';

// Check if product ID is passed
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Prepare delete query
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);

    // Execute the query
    if ($stmt->execute()) {
        echo "Product deleted successfully!";
        header('Location: view_products.php'); // Redirect back to product list after deletion
    } else {
        echo "Error deleting product!";
    }
} else {
    echo "No product ID provided!";
}
?>
