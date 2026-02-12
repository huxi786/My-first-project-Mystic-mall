<?php
// Start session
session_start();

// Include database connection
include('../Php/connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute the SQL query to check credentials
    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin exists in the database
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        // Verify the password
        if ($password === $admin['password']) {
            // Login successful, set session variables
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $email;

            // Redirect to admin dashboard
            echo "<script>alert('Login  Successfully!.'); window.location.href='index.php';</script>";

            exit;
        } else {
            // Invalid password
            $error_message = "Invalid password.";
        }
    } else {
        // No admin found with this email
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Mystic Mall</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .login-container {
            max-width: 500px;
            margin: auto;
            padding: 2rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .login-header h1 {
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .form-control {
            height: 50px;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            height: 50px;
            font-weight: 600;
            border-radius: 0.375rem;
        }
        
        .btn-login:hover {
            background-color: #2e59d9;
        }
        
        .btn-user {
            background-color: var(--secondary-color);
            border: none;
            height: 50px;
            font-weight: 600;
            border-radius: 0.375rem;
        }
        
        .btn-user:hover {
            background-color: #17a673;
        }
        
        .footer {
            margin-top: auto;
            background-color: white;
            padding: 1rem 0;
            box-shadow: 0 -0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }
        
        .alert {
            border-radius: 0.375rem;
        }
        
        .input-group-text {
            background-color: #f8f9fc;
            border-right: none;
        }
        
        .input-group .form-control {
            border-left: none;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <i class="fas fa-laptop me-2"></i>Mytic Mall
            </a>
            <a href="../index.php" class="btn btn-login px-4 text-light py-3">Home</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-auto py-5">
        <div class="login-container">
            <div class="login-header">
                <i class="fas fa-lock"></i>
                <h1>Admin Portal</h1>
                <p class="text-muted">Please enter your credentials to login</p>
            </div>

            <!-- Display error message if credentials are wrong -->
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="POST" action="admin_login.php">
                <div class="mb-4">
                    <label for="email" class="form-label fw-bold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" id="email" 
                               placeholder="Enter your admin email" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" class="form-control" id="password" 
                               placeholder="Enter your password" required>
                    </div>
                </div>
                
                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-login btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                    
                    <a href="../Login.html" class="btn btn-user btn-success">
                        <i class="fas fa-user me-2"></i> Login as User
                    </a>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> Mystic Mall. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>