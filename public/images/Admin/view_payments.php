<?php
include '../Php/connection.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: Admin_login.php');
    exit;
}

// Action to update the status of a payment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $paymentId = $_POST['payment_id'];
    $action = $_POST['action'];

    if ($action === 'approved') {
        // Fetch the full payment record
        $paymentQuery = "SELECT * FROM payment WHERE id = ?";
        $stmt = $conn->prepare($paymentQuery);
        $stmt->bind_param("i", $paymentId);
        $stmt->execute();
        $paymentResult = $stmt->get_result();
        $paymentData = $paymentResult->fetch_assoc();
        $stmt->close();

        if ($paymentData) {
            // Check if an order for this payment already exists
            $orderCheck = "SELECT id FROM orders WHERE payment_id = ? LIMIT 1";
            $stmt = $conn->prepare($orderCheck);
            $stmt->bind_param("i", $paymentId);
            $stmt->execute();
            
            if ($stmt->get_result()->num_rows == 0) {
                // Insert the new order
                $insertOrderQuery = "INSERT INTO orders (user_id, user_name, full_name, phone, address, postal_code, total_price, tid, payment_id, status) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending Confirmation')";
                $insertStmt = $conn->prepare($insertOrderQuery);
                $insertStmt->bind_param("isssssdsi", $paymentData['user_id'], $paymentData['user_name'], $paymentData['full_name'], $paymentData['phone_number'], $paymentData['address'], $paymentData['postal_code'], $paymentData['total_price'], $paymentData['tid'], $paymentId);
                $insertStmt->execute();
                $insertStmt->close();

                // --- BEGIN: AUTOMATIC STOCK DEDUCTION LOGIC ---
                $itemsQuery = "SELECT product_name, quantity FROM cart_invoice WHERE payment_id = ?";
                $itemsStmt = $conn->prepare($itemsQuery);
                $itemsStmt->bind_param("i", $paymentId);
                $itemsStmt->execute();
                $itemsResult = $itemsStmt->get_result();

                while ($item = $itemsResult->fetch_assoc()) {
                    $updateStockQuery = "UPDATE products SET stock = stock - ? WHERE name = ?";
                    $updateStockStmt = $conn->prepare($updateStockQuery);
                    $updateStockStmt->bind_param("is", $item['quantity'], $item['product_name']);
                    $updateStockStmt->execute();
                    $updateStockStmt->close();
                }
                $itemsStmt->close();
                // --- END: AUTOMATIC STOCK DEDUCTION LOGIC ---
            }
            $stmt->close();

            // Update payment status to 'Approved'
            $updateQuery = "UPDATE payment SET status = 'Approved' WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("i", $paymentId);
            $updateStmt->execute();
            $updateStmt->close();

            // Send a notification to the user
            $notifyQuery = "INSERT INTO notifications (user_name, message) VALUES (?, 'Your payment has been approved.')";
            $notifyStmt = $conn->prepare($notifyQuery);
            $notifyStmt->bind_param("s", $paymentData['user_name']);
            $notifyStmt->execute();
            $notifyStmt->close();
        }
    } elseif ($action === 'rejected') {
        // Logic for rejecting a payment
        $updatePayment = "UPDATE payment SET status = 'Rejected' WHERE id = ?";
        $stmt = $conn->prepare($updatePayment);
        $stmt->bind_param("i", $paymentId);
        $stmt->execute();
        $stmt->close();
    }
    
    header("Location: view_payments.php");
    exit;
}

$query = "SELECT * FROM payment ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Payment Management</h2>
        <div class="row">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Payment #<?= htmlspecialchars($row['id']) ?></h5>
                                <p><strong>User ID:</strong> <?= htmlspecialchars($row['user_id']) ?></p>
                                <p><strong>User Name:</strong> <?= htmlspecialchars($row['user_name']) ?></p>
                                <!-- Rest of the payment details -->
                                <form method="POST" class="payment-actions d-flex gap-2">
                                    <input type="hidden" name="payment_id" value="<?= $row['id'] ?>" />
                                    <button type="submit" name="action" value="approved" class="btn btn-success btn-sm">Approve</button>
                                    <button type="submit" name="action" value="rejected" class="btn btn-danger btn-sm">Reject</button>
                                    <a href="invoice.php?payment_id=<?= $row['id'] ?>" target="_blank" class="btn btn-secondary btn-sm">View Invoice</a>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12"><p class="text-center">No payments found.</p></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
