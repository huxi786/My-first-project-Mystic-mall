<?php 
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    echo "<script>alert('Admin is not logged in.'); window.location.href='Admin_login.php';</script>";
    exit;
}
include '../Php/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Your existing CSS styles remain here... */
        body { background-color: #f5f7fa; }
        .admin-navbar { background: linear-gradient(135deg, #4361ee, #3f37c9); }
        .page-header { background: linear-gradient(135deg, #4361ee, #3f37c9); color: white; padding: 2rem 0; margin-bottom: 2rem; }
        .order-table thead { background: #343a40; color: white; }
        .status-select { min-width: 150px; }
        #alert-container { position: fixed; top: 20px; right: 20px; z-index: 1050; }
    </style>
</head>
<body>
    <!-- Admin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-crown me-2"></i>Admin Panel</a>
            <!-- Navbar toggler and links -->
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header text-center">
        <h1 class="page-title">Order Management</h1>
    </div>
    
    <!-- This is where success/error messages will appear -->
    <div id="alert-container"></div>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover order-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Bill</th>
                        <th>Txn ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM orders ORDER BY created_at DESC";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $statuses = ['Pending Confirmation', 'Confirmed', 'Shipped', 'Delivered', 'Canceled'];
                            echo '
                            <tr>
                                <td>#' . htmlspecialchars($row['id']) . '</td>
                                <td><strong>' . htmlspecialchars($row['full_name']) . '</strong></td>
                                <td>' . number_format($row['total_price']) . ' Rs</td>
                                <td><code>' . htmlspecialchars($row['tid']) . '</code></td>
                                <td>' . date('d M, Y', strtotime($row['created_at'])) . '</td>
                                <td>
                                    <select class="form-select form-select-sm status-select" data-order-id="' . htmlspecialchars($row['id']) . '">
                                        ';
                                        foreach ($statuses as $status) {
                                            $selected = ($row['status'] == $status) ? 'selected' : '';
                                            echo '<option value="' . $status . '" ' . $selected . '>' . $status . '</option>';
                                        }
                                    echo '
                                    </select>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6" class="text-center py-5"><h4>No Orders Found</h4></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Listen for a change on any dropdown with the 'status-select' class
        $('.status-select').on('change', function() {
            const orderId = $(this).data('order-id');
            const newStatus = $(this).val();

            // Send the data to the server using AJAX
            $.ajax({
                url: 'update_order_status.php', // The script we created in Step 2
                type: 'POST',
                data: {
                    order_id: orderId,
                    status: newStatus
                },
                dataType: 'json',
                success: function(response) {
                    // Show a success or error message based on the server's response
                    if(response.success) {
                        showAlert(response.message, 'success');
                    } else {
                        showAlert(response.message, 'danger');
                    }
                },
                error: function() {
                    showAlert('An error occurred while communicating with the server.', 'danger');
                }
            });
        });

        // Function to display a temporary alert message
        function showAlert(message, type) {
            $('#alert-container').html(
                `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
            );
            // The alert will automatically fade out after 5 seconds
            setTimeout(() => {
                $('.alert').fadeOut('slow');
            }, 5000);
        }
    });
    </script>
</body>
</html>
