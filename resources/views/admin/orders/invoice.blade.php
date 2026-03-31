<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: {{ isset($isPreview) ? '80px 0 0 0' : '0' }};
        }
        .preview-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: #2e0249;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        .btn-download-pdf {
            background: #D4AF37;
            color: #1a0033;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 13px;
            transition: background 0.3s;
        }
        .btn-download-pdf:hover {
            background: #ffc800;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
        }
        .header {
            display: table;
            width: 100%;
            margin-bottom: 40px;
        }
        .brand {
            display: table-cell;
            vertical-align: top;
        }
        .brand h1 {
            font-family: 'Times New Roman', serif;
            color: #2e0249;
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .brand p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
        }
        .invoice-details {
            display: table-cell;
            text-align: right;
            vertical-align: top;
        }
        .invoice-details h2 {
            margin: 0;
            color: #2e0249;
            font-size: 24px;
        }
        .invoice-details p {
            margin: 5px 0 0 0;
            color: #888;
            font-size: 14px;
        }
        .divider {
            border-bottom: 2px solid #2e0249;
            margin: 20px 0;
        }
        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .info-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .info-col h4 {
            margin: 0 0 10px 0;
            color: #D4AF37; /* Gold */
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }
        .info-col p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table th {
            background: #2e0249;
            color: #fff;
            text-align: left;
            padding: 12px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .table td {
            padding: 12px;
            border-bottom: 1px solid #f2f2f2;
            font-size: 14px;
        }
        .table tr:last-child td {
            border-bottom: none;
        }
        .total-section {
            text-align: right;
        }
        .total-table {
            float: right;
            width: 250px;
        }
        .total-table td {
            padding: 8px 12px;
        }
        .total-table .label {
            text-align: left;
            font-weight: bold;
            color: #666;
        }
        .total-table .value {
            text-align: right;
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }
        .total-row {
            background: #f8f9fa;
        }
        .grand-total {
            font-size: 18px;
            color: #2e0249;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
        .stamp {
            display: inline-block;
            border: 3px solid #198754;
            color: #198754;
            padding: 5px 15px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 5px;
            transform: rotate(-5deg);
            opacity: 0.8;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @if(isset($isPreview))
    <div class="preview-bar">
        <div>
            <strong>Preview Mode:</strong> Please review your invoice before downloading.
        </div>
        <a href="{{ Auth::user()->is_admin ? route('admin.orders.invoice', $order->id) : route('orders.invoice', $order->id) }}" class="btn-download-pdf">
            <i class="fas fa-download"></i> Download as PDF
        </a>
    </div>
    @endif
    <div class="invoice-box">
        <div class="header">
            <div class="brand">
                <h1>Mystic Mall</h1>
                <p>Premium E-Commerce Experience</p>
            </div>
            <div class="invoice-details">
                <h2>INVOICE</h2>
                <p>#INV-{{ date('Y') }}-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p>Date: {{ $order->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="divider"></div>

        <div class="info-section">
            <div class="info-col">
                <h4>Bill To:</h4>
                <p><strong>{{ $order->full_name }}</strong></p>
                <p>{{ $order->address }}</p>
                <p>{{ $order->postal_code }}</p>
                <p>Phone: {{ $order->phone }}</p>
            </div>
            <div class="info-col" style="text-align: right;">
                <h4>Payment Info:</h4>
                <p>Status: <strong>{{ strtoupper($order->status) }}</strong></p>
                <p>Method: Cash on Delivery</p>
                <p>Transaction ID: {{ $order->tid ?: 'N/A' }}</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th width="50%">Product Description</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">Rs. {{ number_format($item->product_price) }}</td>
                    <td style="text-align: right;">Rs. {{ number_format($item->product_price * $item->quantity) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <table class="total-table">
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="value">Rs. {{ number_format($order->total_price) }}</td>
                </tr>
                <tr class="total-row">
                    <td class="label grand-total">Grand Total:</td>
                    <td class="value grand-total">Rs. {{ number_format($order->total_price) }}</td>
                </tr>
            </table>
            <div style="clear: both;"></div>
        </div>

        @if($order->status == 'Delivered')
        <div style="text-align: center;">
            <div class="stamp">Verified & Paid</div>
        </div>
        @endif

        <div class="footer">
            <p>Thank you for choosing Mystic Mall. This is an electronically generated document.</p>
            <p>&copy; {{ date('Y') }} Mystic Mall Premium Store. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
