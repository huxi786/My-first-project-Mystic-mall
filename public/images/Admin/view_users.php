<?php
include '../Php/connection.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: Admin_login.php');
    exit;
}
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-color: #4e73df; }
        body { background-color: #f8f9fc; }
        .header { background: var(--primary-color); color: white; padding: 2rem 0; }
        .user-card { box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1); }
    </style>
</head>
<body>
    <div class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1><i class="fas fa-users me-2"></i>Users Data</h1>
            <a href="add_user.html" class="btn btn-success"><i class="fas fa-user-plus me-1"></i> Add User</a>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card user-card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                                <p class="card-text"><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                                <div class="d-flex">
                                    <!-- EDIT BUTTON ADDED HERE -->
                                    <a href="edit_user.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-info btn-sm me-2">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="../Php/delete.php" method="POST" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt me-1"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12"><p class="text-center">No users found.</p></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
