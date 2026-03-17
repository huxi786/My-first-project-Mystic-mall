<?php
include '../php/connection.php';

$stmt = $conn->prepare("SELECT user_name, message, sent_at FROM notifications WHERE direction = 'user_to_admin' ORDER BY sent_at DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages from Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f5f7ff;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            overflow: hidden;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        h1 {
            color: var(--primary-dark);
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .message-count {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 800px;
        }
        
        thead {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }
        
        th {
            padding: 1.2rem 1.5rem;
            text-align: left;
            font-weight: 600;
            position: sticky;
            top: 0;
        }
        
        td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--light-gray);
            vertical-align: top;
            color: var(--dark);
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover td {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .user-cell {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .message-cell {
            max-width: 400px;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
        
        .timestamp {
            color: var(--gray);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--light-gray);
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            
            .dashboard-card {
                padding: 1.5rem;
            }
            
            th, td {
                padding: 1rem;
            }
        }
        .fa-times{
            position: relative;
            left:28vw;
            bottom:5vh;
           color:blue;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-card">
            <div class="header">
                <h1><i class="fas fa-envelope-open-text"></i> Messages from Users</h1> <I class="fas fa-times" onclick="goback();"></I> 
                <div class="message-count">
                  
                    <?= $result->num_rows ?> message<?= $result->num_rows != 1 ? 's' : '' ?>
                </div>
            </div>
            
            <div class="table-responsive">
                <?php if ($result->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Message</th>
                                <th>Sent At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
                                            <?= strtoupper(substr($row['user_name'], 0, 1)) ?>
                                        </div>
                                        <?= htmlspecialchars($row['user_name']) ?>
                                    </div>
                                </td>
                                <td class="message-cell"><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                <td class="timestamp">
                                    <i class="far fa-clock"></i>
                                    <?= date('M j, Y g:i A', strtotime($row['sent_at'])) ?>
                                </td>
                                  <td>
    <button onclick="openReplyModal('<?= htmlspecialchars($row['user_name']) ?>')" 
            style="background-color: var(--primary); color:white; border:none; padding: 6px 12px; border-radius: 6px; cursor:pointer;">
        <i class="fas fa-reply"></i> Reply
    </button>
</td>

                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="far fa-comment-dots"></i>
                        <h3>No messages yet</h3>
                        <p>Users haven't sent any messages yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Modal Structure -->
<div id="replyModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:2rem; border-radius:10px; width:90%; max-width:500px; position:relative;">
        <h2 style="margin-bottom: 1rem;">Send Reply</h2>
        <form method="POST" action="reply.php">
            <input type="hidden" name="user_name" id="modalUserName">
            <textarea name="message" rows="5" style="width:100%; padding:0.5rem;" placeholder="Type your reply..." required></textarea>
            <div style="margin-top:1rem; text-align:right;">
                <button type="button" onclick="closeReplyModal()" style="margin-right:0.5rem;">Cancel</button>
                <button type="submit" style="background:var(--primary); color:white; border:none; padding:0.5rem 1rem; border-radius:5px;  ">Send</button>
            </div>
        </form>
        <i class="fas fa-times" onclick="closeReplyModal()" style="position:absolute; top:1rem; right:1rem; cursor:pointer; color:var(--gray); font-size:1.2rem;"></i>
    </div>
</div>

</body>
<script>
    function goback()
    {
        window.location.href='index.php';
    }
    
   function openReplyModal(userName) {
    document.getElementById('modalUserName').value = userName;
    const modal = document.getElementById('replyModal');
    modal.style.display = 'flex';
    modal.style.justifyContent = 'center';
    modal.style.alignItems = 'center';
}


    function closeReplyModal() {
        document.getElementById('replyModal').style.display = 'none';
    }
 

</script>
</html>