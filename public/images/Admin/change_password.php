<?php
include '../Php/connection.php';
session_start();

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = "New password and confirm password do not match.";
    } else {
        // Check if email or password matches
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $match = false;
        if ($user) {
            if ($user['email'] === $email || ( $current_password ===  $user['password'])) {
                $match = true;
            }
        }

        if ($match) {
            $hashed_password = ($new_password);
            $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $email);
            if ($stmt->execute()) {
                $success = "Password changed successfully.";
            } else {
                $error = "Failed to update password: " . $conn->error;
            }
        } else {
            $error = "Email or current password is incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Change Password</h4>
            </div>
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php elseif ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
               <form method="POST">
    <div class="mb-3">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Current Password</label>
        <div class="input-group">
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword('current_password', this)">
                👁️
            </button>
        </div>
    </div>

    <div class="mb-3">
        <label>New Password</label>
        <div class="input-group">
            <input type="password" name="new_password" id="new_password" class="form-control" required>
            <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword('new_password', this)">
                👁️
            </button>
        </div>
    </div>

    <div class="mb-3">
        <label>Confirm New Password</label>
        <div class="input-group">
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePassword('confirm_password', this)">
                👁️
            </button>
        </div>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Update Password</button><br>
        <button  class="btn btn-dark" onclick="window.location.href='index.php'">Cancel</button>
    </div>
</form>

            </div>
        </div>
    </div>
</body>
<script>
function togglePassword(fieldId, button) {
    const field = document.getElementById(fieldId);
    const isPassword = field.type === "password";
    field.type = isPassword ? "text" : "password";
    button.textContent = isPassword ? "🙈" : "👁️";
}
</script>

</html>

<?php $conn->close(); ?>
