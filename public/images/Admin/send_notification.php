<?php
// Fetch username from URL or default to 'All'
$username = isset($_GET['user']) && !empty($_GET['user']) ? htmlspecialchars($_GET['user']) : 'All';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Shipment Notification</title>
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
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .notification-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .notification-header {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }
        
        .notification-header h2 {
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .notification-header p {
            color: #6c757d;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .btn-send {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 15px;
        }
        
        .btn-send:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }
        
        .status-submitted {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }
        
        .status-shipped {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
        
        .status-ontheway {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .status-delivered {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }
        
        .status-cancelled {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .user-badge {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            padding: 8px 15px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 15px;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .notification-container {
                margin: 20px;
                padding: 20px;
            }
        }
        .fa-times-circle{
            position: relative;
            left:25vw;
            bottom:13vh;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <div class="notification-container">
        <div class="notification-header">
            <h2><i class="fas fa-truck-fast me-2"></i> Shipment Notification</h2>
            <p>Update customers about their order status</p>
            <i class="fas fa-times-circle" onclick="window.location.href='index.php';"></i>
        </div>
        
        <form method="POST" action="">
            <div class="mb-4">
                <div class="user-badge">
                    <i class="fas fa-user me-2"></i> 
                    <?= $username === 'All' ? 'Sending to: All Users' : 'Customer: ' . $username ?>
                </div>
                <input type="hidden" name="user_name" value="<?= $username ?>">
            </div>
            
            <div class="mb-4">
                <label for="message" class="form-label">
                    <i class="fas fa-envelope me-2"></i> Notification Message
                </label>
                <textarea class="form-control" id="message" name="message" required rows="5" 
                          placeholder="Enter your notification message here..."></textarea>
            </div>
            
            <div class="mb-4">
                <label for="status" class="form-label">
                    <i class="fas fa-truck me-2"></i> Shipment Status
                </label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Submitted">Submitted</option>
                    <option value="Shipped">Shipped</option>
                    <option value="On the Way">On the Way</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-send">
                <i class="fas fa-paper-plane me-2"></i> Send Notification
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // SweetAlert confirmation before submission
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const status = form.querySelector('#status').value;
            const message = form.querySelector('#message').value;
            const user = form.querySelector('input[name="user_name"]').value;
            
            Swal.fire({
                title: 'Confirm Notification',
                html: `You are about to send a <strong>${status}</strong> notification to <strong>${user}</strong>.<br><br>
                      <strong>Message:</strong> ${message}`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, send it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($stmtSuccess) && $stmtSuccess): ?>
        Swal.fire({
            title: 'Success!',
            text: 'Notification sent successfully.',
            icon: 'success',
            confirmButtonColor: '#4361ee'
        }).then(() => {
            window.history.back();
        });
        <?php endif; ?>
    </script>
</body>
</html>

<?php
include '../Php/connection.php';

$stmtSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['user_name']) && !empty($_POST['user_name']) ? $_POST['user_name'] : 'All';
    $message = $_POST['message'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO notifications (user_name, message, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $message, $status);

    if ($stmt->execute()) {
        $stmtSuccess = true;
    }

    $stmt->close();
    $conn->close();
}
?>