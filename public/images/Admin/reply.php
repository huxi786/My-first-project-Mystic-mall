<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($user_name) && !empty($message)) {
        $direction = 'admin_to_user';
        $sent_at = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO notifications (user_name, message, direction, sent_at) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssss", $user_name, $message, $direction, $sent_at);

        if ($stmt->execute()) {
            echo '<script>alert("Reply sent successfully."); window.history.back();</script>';
        } else {
            die("Execution failed: " . $stmt->error);
        }
        $stmt->close();
    } else {
        echo "Error: Empty fields.";
    }
}
?>
