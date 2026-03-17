 <?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login page (or homepage)
 echo "<script>alert('Logout Successfully!.'); window.location.href='Admin_login.php';</script>";
exit();
?>
