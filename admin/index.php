<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
requireLogin();

$pageTitle = "Dashboard";
include 'includes/header.php';

// Get counts for dashboard
$contactsCount = $pdo->query("SELECT COUNT(*) FROM contacts WHERE status = 'unread'")->fetchColumn();
$testimonialsPending = $pdo->query("SELECT COUNT(*) FROM testimonials WHERE is_approved = 0")->fetchColumn();
?>

<div class="container mt-4">
    <h2>Dashboard</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Unread Messages</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $contactsCount ?></h5>
                    <a href="contacts/" class="text-white">View Messages</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Pending Testimonials</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $testimonialsPending ?></h5>
                    <a href="testimonials/" class="text-white">Review Testimonials</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Gallery Items</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $pdo->query("SELECT COUNT(*) FROM gallery")->fetchColumn() ?></h5>
                    <a href="gallery/" class="text-white">Manage Gallery</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>