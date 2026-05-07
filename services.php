<?php 
$pageTitle = "Services";
include 'includes/header.php'; 
include 'includes/db.php';

// Fetch services from database
try {
    $stmt = $pdo->query("SELECT * FROM services ORDER BY service_order ASC");
    $services = $stmt->fetchAll();
} catch(PDOException $e) {
    $services = [];
    $error = "Error loading services: " . $e->getMessage();
}
?>

<section class="services-hero">
    <div class="container">
        <h1>Our Services</h1>
        <p>Professional photography services tailored to your needs</p>
    </div>
</section>

<section class="services-content">
    <div class="container">
        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="services-grid">
            <?php foreach($services as $service): ?>
                <div class="service-card" id="<?php echo strtolower(str_replace(' ', '-', $service['title'])); ?>">
                    <div class="service-image">
                        
                    </div>
                    <div class="service-details">
                        <h2><?php echo htmlspecialchars($service['title']); ?></h2>
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                        <div class="service-meta">
                            
                        </div>
                        <a href="contact.php?service=<?php echo urlencode($service['title']); ?>" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="pricing-info">
    <div class="container">
        <h2>Pricing Information</h2>
        <p>All our packages can be customized to fit your specific needs and budget. The prices shown are starting prices for each service.</p>
        <p>For exact pricing and availability, please <a href="contact.php">contact us</a> with details about your photography needs.</p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>