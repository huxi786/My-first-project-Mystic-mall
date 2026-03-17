<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    echo "Please login first";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product | Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .admin-navbar .navbar-brand {
            font-weight: 700;
            color: white;
            font-size: 1.5rem;
        }
        
        .admin-navbar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        
        .admin-navbar .nav-link:hover,
        .admin-navbar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .form-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 40px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .form-title {
            margin-bottom: 30px;
            font-size: 2.2rem;
            text-align: center;
            font-weight: 700;
            color: var(--dark-color);
            position: relative;
            padding-bottom: 15px;
        }
        
        .form-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }
        
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
        }
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .action-buttons .btn {
            min-width: 180px;
        }
        
        .file-upload-wrapper {
            position: relative;
            margin-bottom: 20px;
        }
        
        .file-upload-label {
            display: block;
            padding: 40px 20px;
            border: 2px dashed #ced4da;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload-label:hover {
            border-color: var(--accent-color);
            background-color: rgba(72, 149, 239, 0.05);
        }
        
        .file-upload-label i {
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 10px;
        }
        
        .file-upload-label span {
            display: block;
            font-size: 1rem;
            color: var(--dark-color);
        }
        
        .file-upload-label small {
            display: block;
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 15px;
            border-radius: 8px;
            display: none;
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
            margin-right: 15px;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
                margin: 20px 15px;
            }
            
            .form-title {
                font-size: 1.8rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .action-buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Admin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-crown me-2"></i>Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-plus-circle me-1"></i> Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_products.php"><i class="fas fa-list me-1"></i> View Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_payments.php"><i class="fas fa-credit-card me-1"></i> Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="send_notification.php"><i class="fas fa-bell me-1"></i> Announcements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fas fa-globe me-1"></i> Main Website</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        
        
        <div class="form-container">
            <h1 class="form-title">Add New Product</h1>
            <form action="add_product_action.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter product name" required>
                        </div>
                        
                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" name="price" step="0.01" placeholder="0.00" required>
                            </div>
                        </div>
                        
                        <!-- Stock Quantity -->
                        <div class="mb-4">
                            <label for="stock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" name="stock" placeholder="Enter available quantity" required>
                        </div>
                        
                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="New Arrivals">New Arrivals</option>
                                <option value="Formal Wears">Formal Wears</option>
                                <option value="Casual Wears">Casual Wears</option>
                                <option value="Mens Collection">Men's Collection</option>
                                <option value="Womens Collection">Women's Collection</option>
                                <option value="Kids Collection">Kid's Collection</option>
                                <option value="Accessories">Accessories</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="Enter detailed product description..." required></textarea>
                        </div>
                        
                        <!-- Product Image -->
                        <div class="mb-4">
                            <label class="form-label">Product Image</label>
                            <div class="file-upload-wrapper">
                                <label for="image" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Click to upload product image</span>
                                    <small>JPEG, PNG or JPG (Max. 5MB)</small>
                                    <img id="imagePreview" class="preview-image" alt="Preview">
                                </label>
                                <input type="file" id="image" class="file-upload-input" name="image" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i> Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Mystic Mall</h5>
                    <p class="mt-3">Premium accessories for every need. Quality products at affordable prices.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-4 mb-md-0">
                    <h5>Shop</h5>
                    <ul class="list-unstyled footer-links mt-3">
                        <li class="mb-2"><a href="../arrivals.php">New Arrivals</a></li>
                        <li class="mb-2"><a href="../mens.php">Men's Collection</a></li>
                        <li class="mb-2"><a href="../womens.php">Women's Collection</a></li>
                        <li class="mb-2"><a href="../accessories.php">Accessories</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-6 mb-4 mb-md-0">
                    <h5>Support</h5>
                    <ul class="list-unstyled footer-links mt-3">
                        <li class="mb-2"><a href="../contact.html">Contact Us</a></li>
                        <li class="mb-2"><a href="#">FAQs</a></li>
                        <li class="mb-2"><a href="#">Shipping Policy</a></li>
                        <li class="mb-2"><a href="#">Returns</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Chunian, Punjab, Pakistan</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +92 3217079965</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> mysticmallgmail.com</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2025 Shopify Store. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed with <i class="fas fa-heart text-danger"></i> by Web Developer</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            }
        });
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const price = document.querySelector('input[name="price"]');
            const stock = document.querySelector('input[name="stock"]');
            
            if (parseFloat(price.value) <= 0) {
                alert('Price must be greater than 0');
                e.preventDefault();
                price.focus();
                return false;
            }
            
            if (parseInt(stock.value) < 0) {
                alert('Stock quantity cannot be negative');
                e.preventDefault();
                stock.focus();
                return false;
            }
            
            return true;
        });
    </script>
</body>

</html>