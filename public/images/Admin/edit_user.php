<?php
session_start();
include '../Php/connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: Admin_login.php');
    exit;
}

$message = '';
$user = null;
$userId = $_GET['id'] ?? null;

if ($userId) {
    $stmt = $conn->prepare("SELECT id, name, email, address FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userIdToUpdate = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $address, $userIdToUpdate);
    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>User updated successfully!</div>";
        // Refresh data
        $stmt = $conn->prepare("SELECT id, name, email, address FROM users WHERE id = ?");
        $stmt->bind_param("i", $userIdToUpdate);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
    } else {
        $message = "<div class='alert alert-danger'>Update failed.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2>Edit User</h2>
            </div>
            <div class="card-body">
                <?php echo $message; ?>
                <?php if ($user): ?>
                <form method="POST">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <a href="view_users.php" class="btn btn-secondary">Cancel</a>
                </form>
                <?php else: ?>
                <div class="alert alert-warning">User not found or ID not provided.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
