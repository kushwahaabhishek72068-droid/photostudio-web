<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
requireLogin();

$pageTitle = "Contact Messages";
include '../includes/header.php';

$status = $_GET['status'] ?? 'all';
$where = '';
if (in_array($status, ['unread', 'read', 'replied'])) {
    $where = "WHERE status = '$status'";
}

$contacts = $pdo->query("SELECT * FROM contacts $where ORDER BY submission_date DESC")->fetchAll();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Contact Messages</h2>
        <div class="btn-group">
            <a href="?status=all" class="btn btn-outline-secondary <?= $status === 'all' ? 'active' : '' ?>">All</a>
            <a href="?status=unread" class="btn btn-outline-secondary <?= $status === 'unread' ? 'active' : '' ?>">Unread</a>
            <a href="?status=read" class="btn btn-outline-secondary <?= $status === 'read' ? 'active' : '' ?>">Read</a>
            <a href="?status=replied" class="btn btn-outline-secondary <?= $status === 'replied' ? 'active' : '' ?>">Replied</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= htmlspecialchars($contact['name']) ?></td>
                    <td><?= htmlspecialchars($contact['email']) ?></td>
                    <td><?= htmlspecialchars($contact['subject'] ?? 'No subject') ?></td>
                    <td><?= date('M j, Y g:i a', strtotime($contact['submission_date'])) ?></td>
                    <td>
                        <span class="badge bg-<?= 
                            $contact['status'] === 'unread' ? 'danger' : 
                            ($contact['status'] === 'read' ? 'warning' : 'success')
                        ?>">
                            <?= ucfirst($contact['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="view.php?id=<?= $contact['id'] ?>" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>