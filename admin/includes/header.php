<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Kelly Admin | <?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: calc(100vh - 56px);
        }
        .sidebar .nav-link {
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
        }
        .sidebar .nav-link.active {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Studio Kelly Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['full_name'] ?? 'Admin') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>" href="index.php">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'contacts/') !== false ? 'active' : '' ?>" href="contacts/">
                                <i class="bi bi-envelope"></i> Contacts
                                <?php
                                $unreadCount = $pdo->query("SELECT COUNT(*) FROM contacts WHERE status = 'unread'")->fetchColumn();
                                if ($unreadCount > 0): ?>
                                    <span class="badge bg-danger float-end"><?= $unreadCount ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'gallery/') !== false ? 'active' : '' ?>" href="gallery/">
                                <i class="bi bi-images"></i> Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'services/') !== false ? 'active' : '' ?>" href="services/">
                                <i class="bi bi-collection"></i> Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'testimonials/') !== false ? 'active' : '' ?>" href="testimonials/">
                                <i class="bi bi-chat-square-quote"></i> Testimonials
                                <?php
                                $pendingTestimonials = $pdo->query("SELECT COUNT(*) FROM testimonials WHERE is_approved = 0")->fetchColumn();
                                if ($pendingTestimonials > 0): ?>
                                    <span class="badge bg-warning float-end"><?= $pendingTestimonials ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'settings/') !== false ? 'active' : '' ?>" href="settings/">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                        </li>
                        <?php if (isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= strpos($_SERVER['PHP_SELF'], 'users/') !== false ? 'active' : '' ?>" href="users/">
                                <i class="bi bi-people"></i> Users
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">