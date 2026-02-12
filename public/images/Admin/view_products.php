<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: Admin_login.php');
    exit;
}

include '../php/connection.php';

$limit = 6; // Products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Count total products
$totalResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
$totalRow = mysqli_fetch_assoc($totalResult);
$total = $totalRow['total'];
$pages = ceil($total / $limit);

// Fetch paginated products
$query = "SELECT * FROM products LIMIT $start, $limit";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List | Admin Panel</title>
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
            --danger-color: #f72585;
            --warning-color: #f8961e;
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
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .page-title {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .page-subtitle {
            font-weight: 300;
            opacity: 0.9;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            justify-content: center;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 10px 20px;
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
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #b5179e);
            border: none;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #b5179e, var(--danger-color));
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color), #f3722c);
            border: none;
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #f3722c, var(--warning-color));
        }
        
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            background-color: white;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }
        
        .product-img-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .product-img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }
        
        .product-body {
            padding: 20px;
        }
        
        .product-title {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--dark-color);
        }
        
        .product-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-bottom: 10px;
        }
        
        .product-stock {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .in-stock {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }
        
        .low-stock {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger-color);
        }
        
        .out-of-stock {
            background-color: rgba(33, 37, 41, 0.1);
            color: var(--dark-color);
        }
        
        .product-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 15px;
        }
        
        .product-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .product-actions .btn {
            flex: 1;
        }
        
        .search-container {
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .search-input {
            border-radius: 50px;
            padding: 12px 20px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--accent-color);
            margin-bottom: 20px;
        }
        
        .empty-state h4 {
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 50px 0 0;
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
        
        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons .btn {
                width: 100%;
            }
            
            .product-actions {
                flex-direction: column;
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
                        <a class="nav-link" href="add_product.php"><i class="fas fa-plus-circle me-1"></i> Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-list me-1"></i> View Products</a>
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

    <!-- Page Header -->
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Product Management</h1>
            <p class="page-subtitle">View and manage all your products in one place</p>
        </div>
    </div>

    <div class="container">
        <!-- Action Buttons -->
        
        
        <!-- Search Box -->
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="form-control search-input" placeholder="Search products..." id="searchInput">
                <button class="btn btn-primary" type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        
        <!-- Product Cards -->
        <div class="row" id="productContainer">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="product-card">
                            <div class="product-img-container">  
                                  <h6 class="product-stock text-secondary"><?= htmlspecialchars($row['category']) ?></h6>
                                <img src="<?= htmlspecialchars($row['image']) ?>" class="product-img" alt="<?= htmlspecialchars($row['name']) ?>">
                                <?php if ($row['stock'] == 0): ?>
                                    <span class="product-badge badge bg-danger">Out of Stock</span>
                                <?php elseif ($row['stock'] < 5): ?>
                                    <span class="product-badge badge bg-warning">Low Stock</span>
                                <?php endif; ?>
                            </div>
                            <div class="product-body">
                                <h5 class="product-title"><?= htmlspecialchars($row['name']) ?></h5>
                               
                                <div class="product-price">$<?= number_format($row['price'], 2) ?></div>
                                <p class="product-description text-muted"><?= htmlspecialchars($row['description']) ?></p>
                                <span class="product-stock <?= $row['stock'] > 10 ? 'in-stock' : ($row['stock'] == 0 ? 'out-of-stock' : 'low-stock') ?>">
                                    <?= $row['stock'] > 10 ? 'In Stock' : ($row['stock'] == 0 ? 'Out of Stock' : 'Low Stock') ?> (<?= $row['stock'] ?>)
                                </span>
                                <div class="product-actions mt-3">
                                    <!-- <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a> -->
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <h4>No Products Found</h4>
                        <p>You haven't added any products yet. Click the button below to add your first product.</p>
                        <a href="add_product.php" class="btn btn-primary mt-3">
                            <i class="fas fa-plus-circle me-2"></i> Add Product
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Pagination -->
       <!-- Pagination -->
<nav aria-label="Product pagination" class="mt-4">
    <ul class="pagination justify-content-center">
        <!-- Previous button -->
        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="<?= $page <= 1 ? 'true' : 'false' ?>">Previous</a>
        </li>

        <!-- Page numbers -->
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Next button -->
        <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-disabled="<?= $page >= $pages ? 'true' : 'false' ?>">Next</a>
        </li>
    </ul>
</nav>

    </div>
    
    <!-- Footer -->
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
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +92 3218109316</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> mysticmall@gmail.com</li>
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
    
    <!-- SweetAlert2 for confirmation dialogs -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Search functionality
        document.getElementById('searchButton').addEventListener('click', function() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            filterProducts(searchTerm);
        });
        
        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.toLowerCase();
                filterProducts(searchTerm);
            }
        });
        
        function filterProducts(searchTerm) {
            const cards = document.querySelectorAll('.product-card');
            let found = false;
            
            cards.forEach(card => {
                const title = card.querySelector('.product-title').textContent.toLowerCase();
                const description = card.querySelector('.product-description').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.closest('.col-lg-4').style.display = 'block';
                    found = true;
                } else {
                    card.closest('.col-lg-4').style.display = 'none';
                }
            });
            
            if (!found) {
                document.getElementById('productContainer').innerHTML = `
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-search"></i>
                            <h4>No Products Found</h4>
                            <p>No products match your search criteria. Try different keywords.</p>
                            <button class="btn btn-outline-primary mt-3" onclick="resetSearch()">
                                <i class="fas fa-undo me-2"></i> Reset Search
                            </button>
                        </div>
                    </div>
                `;
            }
        }
        
        function resetSearch() {
            document.getElementById('searchInput').value = '';
            location.reload();
        }
        
        // Delete confirmation
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4361ee',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `delete_product.php?id=${productId}`;
                    }
                });
            });
        });
        
        // Image loading error handler
        document.querySelectorAll('.product-img').forEach(img => {
            img.addEventListener('error', function() {
                this.src = 'https://via.placeholder.com/300x200?text=Product+Image';
                this.alt = 'Placeholder Image';
            });
        });
    </script>
</body>
</html>