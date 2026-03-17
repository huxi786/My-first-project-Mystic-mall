 <?php

include'../Php/stats.php';
 
include'../php/connection.php';
$sql="SELECT * FROM admin";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
  while($row=mysqli_fetch_assoc($result)){
    $admin_name= $row['name'];
    $admin_email=$row['email'];
  }
}
else
{
  echo"";
  
}
 
 

$query = "SELECT name, email, address  FROM users ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $query);
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>Mystic Mall - Admin Panel</title>
</head>
<body>


	<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
         
        <i><?php echo $admin_name;?></i>
        <span class="text" id="logo_name"> </span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="index.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class='bx bxs-user'></i>
                <span class="text">User Management</span>
                <i class='bx bx-chevron-down'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="view_users.php">All Users</a></li>
                <li><a href="add_user.html">Add New User</a></li>
             
            
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class='bx bxs-box'></i>
                <span class="text">Product Management</span>
                <i class='bx bx-chevron-down'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="view_products.php">Products List</a></li>
                <li><a href="add_product.php">Add New Product</a></li>
               
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
               	<i class='bx bxs-receipt'></i>
                <span class="text">Order Management</span>
                <i class='bx bx-chevron-down'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="view_orders.php">Product Orderes List</a></li>
                 
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class='bx bxs-tag'></i>
                <span class="text">Payment Management</span>
                <i class='bx bx-chevron-down'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="view_payments.php">Payments</a></li>
              
                
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class='bx bxs-message-alt-error'></i>
                <span class="text">Updates</span>
                <i class='bx bx-chevron-down'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="send_notification.php">Announcement</a></li>
                <li><a href="notification.php">Inbox Messages</a></li>
                <li><a href="queries.php">General Messages</a></li>
            
            </ul>
        </li>
        
        
		<li>
            <a href="#" class="dropdown-toggle">
                <i class='bx bx-cog'></i>
                <span class="text">Settings</span>
                <i class='bx bx-chevron-down'></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="profile.php">Profile Update</a></li>
                <li><a href="change_password.php">Update Password</a></li>
                
            </ul>
        </li>
    </ul>
    <ul class="side-menu">
	
        <li>
            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->



	<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Quick Actions</a>
        
        
   
       
        <a href="notification.php" class="notification">
            <i class='bx bxs-bell'></i>
        
          
        </a>
         <a href="../index.php" class="notification">
            <i class='bx bxs-home'></i>
        
          
        </a>
         
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Mystic Mall Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Overview</a>
                    </li>
                </ul>
            </div>
            <a href="add_product.php" class="btn-download">
                <i class='bx bxs-cart'></i>
                <span class="text">Add New Product</span>
            </a>
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-user'></i>
                <span class="text">
                    <h3><?php echo $total_users;?></h3>
                    <p>Total Users</p>
                    <a href="view_users.php">Click Here</a>
                </span>
            </li>
            <li>
                <i class='bx bxs-cart'></i>
                <span class="text">
                    <h3><?php echo $total_products;?></h3>
                    <p>Available Products</p>
                    <a href="view_products.php">Click Here</a>
                </span>
            </li>
            <li>
                <i class='bx bxs-inbox'></i>
                <span class="text">
                    <h3><?php echo $notification;?></h3>
                    <p>Inbox</p>
                    <a href="notification.php">See More</a>
                </span>
            </li>
            <li>
                <i class='bx bxs-file'></i>
                <span class="text">
                    <h3><?php echo $total_orders;?></h3>
                    <p>Canceled Orders</p>
                    <a href="view_orders.php">Click Here</a>
                </span>
            </li>
            <li>
                <i class='bx bxs-trash'></i>
                <span class="text">
                    <h3><?php echo $reject_orders;?></h3>
                    <p>Pending Payments</p>
                    <a href="view_payments.php">Click Here</a>
                </span>
            </li>
            <li>
            <i class='bx bxs-credit-card'></i>


                <span class="text">
                   <h3><?php echo $total_payments;?></h3>
                    <p>Revenue Generated</p>
                </span>
            </li>
        </ul>

        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Recent Clients</h3>
                    
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                   <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td>
                 <!-- Optional: Can be dynamic too -->
                <p><?php echo $row['name']; ?></p>
            </td>
            <td><?php echo $row['email']; ?> </td>
            <td>
                 <td><?php echo $row['address']; ?> </td>
            </td>
        </tr>
    <?php } ?>
</tbody>
                </table>
            </div>
           <?php
 

 
// Fetch latest 5 notifications from DB
$sql = "SELECT * FROM notifications WHERE direction = 'user_to_admin' ORDER BY sent_at DESC LIMIT 5";
$result = $conn->query($sql);
?>

<div class="todo">
  

    <!-- Notifications Section -->
 <div class="notifications-container">
    <div class="notifications-header">
        <h4 class="notifications-title">
            <i class='fas fa-bell'></i> User Notifications
            <span class="badge"><?= $result->num_rows > 0 ? $result->num_rows : '0' ?></span>
        </h4>
         
    </div>
    
    <ul class="notifications-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="notification-item <?= strtotime($row['sent_at']) > strtotime('-24 hours') ? 'new' : '' ?>">
                    <div class="notification-icon">
                        <i class='fas fa-bell'></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <span class="user-name"><?= htmlspecialchars($row['user_name']) ?></span>
                            <span class="notification-time"><?= time_elapsed_string($row['sent_at']) ?></span>
                        </div>
                        <p class="notification-message"><?= htmlspecialchars($row['message']) ?></p>
                    </div>
                    <button class="notification-dismiss">
                        <i class="fas fa-times"></i>
                    </button>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li class="notification-item empty">
                <div class="notification-icon">
                    <i class='fas fa-inbox'></i>
                </div>
                <p class="empty-message">No new notifications</p>
            </li>
        <?php endif; ?>
    </ul>
    
    <div class="notifications-footer">
        <a href="notification.php" class="view-all">View all notifications</a>
    </div>
</div>

<style>
.notifications-container {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    font-family: 'Segoe UI', Roboto, sans-serif;
    max-width: 400px;
    margin: 0 auto;
}

.notifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    background: #4361ee;
    color: white;
}

.notifications-title {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.notifications-title .badge {
    background: #f72585;
    border-radius: 10px;
    padding: 2px 8px;
    font-size: 12px;
    font-weight: 600;
}

.mark-all-read {
    background: transparent;
    border: none;
    color: white;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 4px;
    opacity: 0.9;
    transition: opacity 0.2s;
}

.mark-all-read:hover {
    opacity: 1;
}

.notifications-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 400px;
    overflow-y: auto;
}

.notification-item {
    display: flex;
    padding: 14px 16px;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.2s;
    position: relative;
}

.notification-item.new {
    background: #f8f9ff;
}

.notification-item.new::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #4361ee;
}

.notification-item.empty {
    flex-direction: column;
    align-items: center;
    padding: 30px 20px;
    text-align: center;
}

.notification-icon {
    width: 36px;
    height: 36px;
    background: #f0f4ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4361ee;
    margin-right: 12px;
    flex-shrink: 0;
}

.notification-item.empty .notification-icon {
    margin: 0 0 12px 0;
    font-size: 20px;
}

.notification-content {
    flex: 1;
    min-width: 0;
}

.notification-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 4px;
}

.user-name {
    font-weight: 600;
    font-size: 14px;
    color: #333;
}

.notification-time {
    font-size: 12px;
    color: #888;
}

.notification-message {
    margin: 0;
    font-size: 13px;
    color: #555;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.empty-message {
    margin: 0;
    color: #888;
    font-size: 14px;
}

.notification-dismiss {
    background: transparent;
    border: none;
    color: #aaa;
    cursor: pointer;
    margin-left: 8px;
    align-self: flex-start;
    transition: color 0.2s;
}

.notification-dismiss:hover {
    color: #f72585;
}

.notifications-footer {
    padding: 12px 20px;
    text-align: center;
    background: #f9f9f9;
}

.view-all {
    color: #4361ee;
    font-size: 13px;
    text-decoration: none;
    font-weight: 500;
}

.view-all:hover {
    text-decoration: underline;
}

/* Time elapsed function (add this to your PHP) */
<?php 
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
</style>

<script>
// Add some interactive functionality
document.querySelectorAll('.notification-dismiss').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.notification-item').style.opacity = '0';
        setTimeout(() => {
            this.closest('.notification-item').remove();
            updateBadgeCount();
        }, 300);
    });
});

document.querySelector('.mark-all-read').addEventListener('click', function() {
    document.querySelectorAll('.notification-item.new').forEach(item => {
        item.classList.remove('new');
    });
    updateBadgeCount();
});

function updateBadgeCount() {
    const count = document.querySelectorAll('.notification-item:not(.empty)').length;
    const badge = document.querySelector('.badge');
    badge.textContent = count > 0 ? count : '0';
    
    if (count === 0) {
        const list = document.querySelector('.notifications-list');
        list.innerHTML = `
            <li class="notification-item empty">
                <div class="notification-icon">
                    <i class='fas fa-inbox'></i>
                </div>
                <p class="empty-message">No new notifications</p>
            </li>
        `;
    }
}
</script>


    
    
</div>


        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

	<script src="script.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all dropdown toggles
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    // Add click event to each toggle
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Close all other open dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== this.nextElementSibling) {
                    menu.style.display = 'none';
                }
            });
            
            // Toggle the current dropdown
            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
            }
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-toggle') && !e.target.closest('.dropdown-menu')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>