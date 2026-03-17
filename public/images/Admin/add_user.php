<?php
session_start(); // Start a session
include '../Php/connection.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);

    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = '<div class="alert alert-danger" role="alert">
  Sorry! Name is Required <a href="../Signup.html" class="alert-link">Go Back</a>. Click and Fill Again the Form.
</div>';
    }
    if (empty($email)) {
        $errors[] = '<div class="alert alert-success" role="alert">
  Sorry! Email is Required <a href="../Signup.html" class="alert-link">Go Back</a>. Click and Fill Again the Form.
</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = '<div class="alert alert-warning" role="alert">
  Error ! Invalid Email Format <a href="../Signup.html" class="alert-link">Go Back</a>. Click and Fill Again the Form.
</div>';
    }
    if (empty($password)) {
        $errors[] = '<div class="alert alert-info" role="alert">
  Dear User! Password is Required <a href="../Signup.html" class="alert-link">Go Back</a>. Click and Fill Again the Form.
</div>';
    }
    if (empty($address)) {
        $errors[] = '<div class="alert alert-info" role="alert">
  Dear User! Address is Required <a href="../Signup.html" class="alert-link">Go Back</a>. Click and Fill Again the Form.
</div>';
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Check if the email already exists in the database
        $checkEmailSql = "SELECT * FROM users WHERE email = ?";
        if ($checkStmt = $conn->prepare($checkEmailSql)) {
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {
                echo '<div class="alert alert-warning" role="alert">
  Error! This email is already registered. <a href="add_user.html" class="alert-link">Go Back</a>. Click and Fill Again the Form.
</div>';
            } else {
                // Prepare an insert statement
                $sql = "INSERT INTO users (name, email, password, address) VALUES (?, ?, ?, ?)";

                if ($stmt = $conn->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("ssss", $name, $email, $password, $address);
                    
                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        // Store user information in session
                        $_SESSION['username'] = $name; // Store the username or other session variables
                        $_SESSION['email'] = $email; // You can store other user information as needed
                        header("location:view_users.php"); // Redirect to a welcome page or any other page
                        exit();
                    } else {
                        echo '<div class="card w-75 mb-3">
  <div class="card-body">
    <h5 class="card-title">ERROR</h5>
    <p class="card-text">Something Went Wrong! </p>
    <a href="../Signup.html" class="btn btn-primary">Please Try Again</a>
  </div>
</div>';
                    }
                } else {
                    echo '<div class="card w-75 mb-3">
  <div class="card-body">
    <h5 class="card-title">ERROR</h5>
    <p class="card-text">Something Went Wrong! </p>
    <a href="../Signup.html" class="btn btn-primary">Please Try Again</a>
  </div>
</div>';
                }

                // Close statement
                $stmt->close();
            }
            // Close the check statement
            $checkStmt->close();
        }
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
