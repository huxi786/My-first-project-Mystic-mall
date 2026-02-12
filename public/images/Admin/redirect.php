<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    echo "<script>
        alert('First Login to access the  panel!\\nRedirecting to Login Page!');
        window.location.href = 'Admin_login.php';
    </script>";
    exit;
} else {
    echo "<script>
        window.location.href = 'index.php';
    </script>";
    exit;
}
?>
