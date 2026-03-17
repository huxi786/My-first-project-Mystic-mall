<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    // header('Location: login.php');
    echo"Login first";
    exit;
}

include '../php/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category=$_POST['category'];

    // Handle image upload
    $target_dir = "../uploads/"; // Go up one level to access 'uploads' outside 'Admin'

    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert product into the database
    $query = "INSERT INTO products (name, description, price, image, stock,category) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdsis", $name, $description, $price, $target_file, $stock,$category);
    if ($stmt->execute()) {
        // Using JavaScript for alert and redirection
        echo '<script>
                alert("Product is Added Successfully!");
                window.location.href = "add_product.php"; 
              </script>';
    } else {
        echo "Error adding product: " . $stmt->error;
    }
}
?>
 