<?php
session_start();
require_once 'db_connection.php'; // Database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Get current user info
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Only allow admins
if ($user['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Handle message actions (delete, mark as read/replied)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_message'])) {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$_POST['message_id']]);
        $_SESSION['message'] = "Message deleted successfully!";
    } elseif (isset($_POST['update_status'])) {
        $stmt = $pdo->prepare("UPDATE contacts SET status = ? WHERE id = ?");
        $stmt->execute([$_POST['new_status'], $_POST['message_id']]);
        $_SESSION['message'] = "Message status updated!";
    }
    header("Location: admin.php");
    exit();
}

// Get all contact messages
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY submission_date DESC");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Studio Kelly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .message-card {
            transition: all 0.3s;
        }
        .message-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .unread {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
        }
        .read {
            border-left: 4px solid #6c757d;
        }
        .replied {
            border-left: 4px solid #198754;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            
            <a class="navbar-brand" href="#">The next frame of photography</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Welcome, <?= htmlspecialchars($user['full_name']) ?></span>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h2 class="mb-4">Contact Messages</h2>
        
        <div class="row">
            <?php foreach ($messages as $message): ?>
                <div class="col-md-6 mb-4">
                    <div class="card message-card <?= $message['status'] ?>">
                        <div class="card-header d-flex justify-content-between">
                            <span>
                                <strong><?= htmlspecialchars($message['name']) ?></strong>
                                <small class="text-muted ms-2"><?= htmlspecialchars($message['email']) ?></small>
                            </span>
                            <span class="badge bg-<?= 
                                $message['status'] === 'unread' ? 'primary' : 
                                ($message['status'] === 'read' ? 'secondary' : 'success')
                            ?>">
                                <?= ucfirst($message['status']) ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($message['subject']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($message['message'])) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <?= date('M j, Y g:i a', strtotime($message['submission_date'])) ?>
                                    <?= $message['phone'] ? ' | ' . htmlspecialchars($message['phone']) : '' ?>
                                </small>
                                <div class="btn-group">
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                                        <select name="new_status" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                                            <option value="unread" <?= $message['status'] === 'unread' ? 'selected' : '' ?>>Unread</option>
                                            <option value="read" <?= $message['status'] === 'read' ? 'selected' : '' ?>>Read</option>
                                            <option value="replied" <?= $message['status'] === 'replied' ? 'selected' : '' ?>>Replied</option>
                                        </select>
                                        <input type="hidden" name="update_status">
                                    </form>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                                        <button type="submit" name="delete_message" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>