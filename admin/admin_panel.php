<?php
session_start();

// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "studio_kelly_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle delete action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_panel.php");
    exit;
}

// Handle status update
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE contacts SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    header("Location: admin_panel.php");
    exit;
}

// Fetch all contact messages
$stmt = $conn->prepare("SELECT * FROM contacts ORDER BY submission_date DESC");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Studio Kelly</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Admin Panel - Contact Messages</h1>
        
        <!-- Logout Button -->
        <div class="mb-4">
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
        </div>

        <!-- Contact Messages Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Subject</th>
                        <th class="px-4 py-2">Message</th>
                        <th class="px-4 py-2">Submission Date</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                    <tr class="border-b">
                        <td class="px-4 py-2"><?php echo htmlspecialchars($contact['id']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($contact['name']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($contact['phone']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($contact['subject']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($contact['message']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($contact['submission_date']); ?></td>
                        <td class="px-4 py-2">
                            <form method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="unread" <?php echo $contact['status'] == 'unread' ? 'selected' : ''; ?>>Unread</option>
                                    <option value="read" <?php echo $contact['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                                    <option value="replied" <?php echo $contact['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                                </select>
                                <input type="hidden" name="update_status" value="1">
                            </form>
                        </td>
                        <td class="px-4 py-2">
                            <a href="?delete=<?php echo $contact['id']; ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>