<?php
// admin_dashboard.php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
// At the top of admin_dashboard.php
$db = new mysqli('localhost', 'root', '', 'studio_kelly_db');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
// Handle message deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $db->query("DELETE FROM contacts WHERE id = $id");
    $_SESSION['message'] = "Message deleted successfully";
    header("Location: admin_dashboard.php");
    exit();
}

// Handle message status update
if (isset($_POST['update_status'])) {
    $id = intval($_POST['message_id']);
    $status = $db->real_escape_string($_POST['status']);
    $db->query("UPDATE contacts SET status = '$status' WHERE id = $id");
    $_SESSION['message'] = "Status updated successfully";
    header("Location: admin_dashboard.php");
    exit();
}

// Get all contact messages
$messages = $db->query("SELECT * FROM contacts ORDER BY submission_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Kelly - Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .header { background: #333; color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .header a { color: #fff; text-decoration: none; }
        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
        .message { background: #fff; border: 1px solid #ddd; border-radius: 5px; padding: 15px; margin-bottom: 15px; }
        .message-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .message-meta { color: #666; font-size: 0.9em; }
        .status { padding: 3px 8px; border-radius: 3px; font-size: 0.8em; }
        .status-unread { background: #ffebee; color: #c62828; }
        .status-read { background: #e8f5e9; color: #2e7d32; }
        .status-replied { background: #e3f2fd; color: #1565c0; }
        .actions a { margin-right: 10px; color: #333; text-decoration: none; }
        .actions a:hover { text-decoration: underline; }
        .success { background: #e8f5e9; color: #2e7d32; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
        select { padding: 5px; border-radius: 3px; border: 1px solid #ddd; }
        button { padding: 5px 10px; background: #333; color: #fff; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Studio Kelly Admin Panel</h1>
        <div>
            <span>Welcome, <?php echo $_SESSION['admin_name']; ?></span>
            <a href="logout.php" style="margin-left: 20px;">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>
        
        <h2>Contact Messages</h2>
        
        <?php while ($message = $messages->fetch_assoc()): ?>
            <div class="message">
                <div class="message-header">
                    <h3><?php echo htmlspecialchars($message['subject']); ?></h3>
                    <span class="status status-<?php echo $message['status']; ?>">
                        <?php echo ucfirst($message['status']); ?>
                    </span>
                </div>
                
                <div class="message-meta">
                    From: <?php echo htmlspecialchars($message['name']); ?> &lt;<?php echo htmlspecialchars($message['email']); ?>&gt;
                    <?php if ($message['phone']): ?>
                        | Phone: <?php echo htmlspecialchars($message['phone']); ?>
                    <?php endif; ?>
                    | Date: <?php echo date('M j, Y g:i a', strtotime($message['submission_date'])); ?>
                </div>
                
                <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                
                <div class="actions">
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                        <select name="status">
                            <option value="unread" <?php echo $message['status'] == 'unread' ? 'selected' : ''; ?>>Unread</option>
                            <option value="read" <?php echo $message['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                            <option value="replied" <?php echo $message['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                        </select>
                        <button type="submit" name="update_status">Update Status</button>
                    </form>
                    <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>?subject=Re: <?php echo rawurlencode($message['subject']); ?>">Reply</a>
                    <a href="?delete=<?php echo $message['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>