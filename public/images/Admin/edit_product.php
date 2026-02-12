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

    // Fetch product details
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Product not found!";
        exit;
    }
} else {
    echo "No product ID provided!";
    exit;
}

// Update product details when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Handle product image update
    if ($_FILES['image']['name']) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = $product['image']; // Keep old image if no new image uploaded
    }

    // Update query
    $updateQuery = "UPDATE products SET name = ?, description = ?, price = ?, stock = ?, image = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssdisi", $name, $description, $price, $stock, $image, $productId);
    
    if ($updateStmt->execute()) {
        echo "Product updated successfully!";
        header('Location: view_products.php'); // Redirect to product list after update
    } else {
        echo "Error updating product!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Product</h1>
    <form action="edit_product.php?id=<?= $productId ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control" required><br>

        <label for="description">Description:</label>
        <textarea name="description" class="form-control" required><?= $product['description'] ?></textarea><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" value="<?= $product['price'] ?>" class="form-control" required><br>

        <label for="image">Product Image:</label>
        <input type="file" name="image" class="form-control"><br>
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="100"><br>

        <label for="stock">Stock Quantity:</label>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" class="form-control" required><br>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
