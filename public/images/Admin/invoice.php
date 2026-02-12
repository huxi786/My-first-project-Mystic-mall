<?php
include '../Php/connection.php';

if (!isset($_GET['payment_id'])) {
    die('Invalid access');
}

$paymentId = intval($_GET['payment_id']);

// Fetch payment and user data using JOIN
$query = "
    SELECT p.*, u.id AS user_id, u.name AS user_name
    FROM payment p
    LEFT JOIN users u ON p.user_name = u.name
    WHERE p.id = $paymentId
";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die('Payment not found');
}

$userName = $data['user_name']; // string username

// Assign payment_id to cart items where it is NULL (1st time only)
$updateCart = "UPDATE cart_invoice SET payment_id = $paymentId 
               WHERE user_name = '$userName' AND payment_id IS NULL";
mysqli_query($conn, $updateCart);

// Fetch cart items linked to this payment
$cartQuery = "SELECT product_name, quantity, product_price 
              FROM cart_invoice
              WHERE user_name = '$userName' AND payment_id = $paymentId";
$cartResult = mysqli_query($conn, $cartQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?= $data['id'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --white: #ffffff;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 0;
            margin: 0;
        }
        
        .invoice-container {
            max-width: 900px;
            margin: 30px auto;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .invoice-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .invoice-title {
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }
        
        .invoice-subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin-top: 5px;
        }
        
        .invoice-body {
            padding: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 15px;
            border-bottom: 2px solid #eee;
            padding-bottom: 8px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: var(--light);
            border-radius: 8px;
            padding: 15px;
        }
        
        .info-label {
            font-size: 13px;
            color: var(--gray);
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 500;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }
        
        .status-approved {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success);
        }
        
        .status-pending {
            background-color: rgba(248, 150, 30, 0.1);
            color: var(--warning);
        }
        
        .status-rejected {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger);
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        
        .invoice-table th {
            background-color: var(--primary);
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        
        .invoice-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .invoice-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .invoice-table tr:hover {
            background-color: #f1f1f1;
        }
        
        .total-row {
            font-weight: 600;
            background-color: #f8f9fa !important;
        }
        
        .grand-total {
            font-size: 18px;
            color: var(--primary);
        }
        
        .proof-container {
            margin: 30px 0;
            text-align: center;
        }
        
        .proof-label {
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }
        
        .proof-img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .proof-img:hover {
            transform: scale(1.02);
        }
        
        .footer-note {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: var(--gray);
        }
        
        .print-btn {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            text-decoration: none;
        }
        
        .print-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        @media print {
            body {
                background: none;
                padding: 0;
            }
            
            .invoice-container {
                box-shadow: none;
                margin: 0;
                max-width: 100%;
            }
            
            .print-btn {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .invoice-body {
                padding: 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="invoice-header">
        <h1 class="invoice-title">INVOICE</h1>
        <p class="invoice-subtitle">Payment Confirmation</p>
    </div>
    
    <div class="invoice-body">
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">Invoice Number</div>
                <div class="info-value">#<?= $data['id'] ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Date Issued</div>
                <div class="info-value"><?= date("F j, Y", strtotime($data['created_at'])) ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Transaction ID</div>
                <div class="info-value"><?= $data['tid'] ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Status</div>
                <div class="status-badge status-<?= strtolower($data['status']) ?>">
                    <?= ucfirst($data['status']) ?>
                </div>
            </div>
        </div>
        
        <h3 class="section-title">Customer Information</h3>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">Customer Name</div>
                <div class="info-value"><?= $data['user_name'] ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Phone Number</div>
                <div class="info-value"><?= $data['phone_number'] ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Delivery Address</div>
                <div class="info-value"><?= $data['address'] ?></div>
            </div>
            <div class="info-card">
                <div class="info-label">Postal Code</div>
                <div class="info-value"><?= $data['postal_code'] ?></div>
            </div>
        </div>
        
        <h3 class="section-title">Payment Details</h3>
        <div class="table-responsive">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount (Rs)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Payment</td>
                        <td><?= number_format($data['total_price']) ?></td>
                    </tr>
                    <tr class="total-row">
                        <td>Amount Paid</td>
                        <td class="grand-total"><?= number_format($data['total_price']) ?> Rs</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <?php if (!empty($data['payment_screenshot'])): ?>
        <div class="proof-container">
            <span class="proof-label">Payment Proof:</span>
            <a href="../<?= $data['payment_screenshot'] ?>" target="_blank">
                <img src="../<?= $data['payment_screenshot'] ?>" alt="Payment Proof" class="proof-img">
            </a>
        </div>
        <?php endif; ?>
        
        <h3 class="section-title">Order Summary</h3>
        <div class="table-responsive">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grandTotal = 0;
                    mysqli_data_seek($cartResult, 0); // Reset pointer to start
                    while($item = mysqli_fetch_assoc($cartResult)) {
                        $itemTotal = $item['product_price'] * $item['quantity'];
                        $grandTotal += $itemTotal;
                    ?>
                    <tr>
                        <td><?= $item['product_name'] ?></td>
                        <td><?= number_format($item['product_price']) ?> Rs</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($itemTotal) ?> Rs</td>
                    </tr>
                    <?php } ?>
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;">Grand Total:</td>
                        <td class="grand-total"><?= number_format($grandTotal) ?> Rs</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <a href="javascript:window.print()" class="print-btn">
            <i class="fas fa-print"></i> Print Invoice
        </a>
        
        <div class="footer-note">
            <p>Thank you for your purchase! For any inquiries, please contact our customer support.</p>
            <p><i class="fas fa-phone"></i> +92 321 7079965 | <i class="fas fa-envelope"></i> mysticmallgmail.com</p>
        </div>
    </div>
</div>
</body>
</html>