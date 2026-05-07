<?php 
$pageTitle = "Home";
include 'includes/header.php'; 
?>

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Capturing Life's Beautiful Moments</h1>
        <p>Professional photography services for all occasions</p>
        <a href="contact.php" class="btn btn-primary">Book a Session</a>
    </div>
</section>

<section class="featured-services">
    <div class="container">
        <h2>Our Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-camera-retro"></i>
                </div>
                <h3>Portrait Photography</h3>
                <p>Beautiful individual and family portraits in studio or on location.</p>
                <a href="services.php#portrait" class="btn btn-secondary">Learn More</a>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-ring"></i>
                </div>
                <h3>Wedding Photography</h3>
                <p>Capture your special day with our professional wedding packages.</p>
                <a href="services.php#wedding" class="btn btn-secondary">Learn More</a>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Event Photography</h3>
                <p>Corporate events, parties, and special occasions professionally documented.</p>
                <a href="services.php#event" class="btn btn-secondary">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="featured-gallery">
    <div class="container">
        <h2>Featured Work</h2>
        <div class="gallery-grid">
            <div class="gallery-item" data-category="wedding">
                <img src="images/1.jpg" alt="Wedding Photography 1">
                <div class="gallery-overlay">
                    <h3>Beautiful Wedding Moment</h3>
                    <p>Captured during a sunset ceremony</p>
                </div>
            </div>
            <div class="gallery-item" data-category="portrait">
                <img src="images/12.jpg" alt="Portrait Photography 1">
                <div class="gallery-overlay">
                    <h3>Professional Headshot</h3>
                    <p>Clean and professional look</p>
                </div>
            </div>
            <div class="gallery-item" data-category="wedding">
                <img src="images/3.jpg" alt="Wedding Photography 3">
                <div class="gallery-overlay">
                    <h3>First Dance</h3>
                    <p>The magical first dance as husband and wife</p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="gallery.php" class="btn btn-primary">View Full Gallery</a>
        </div>
    </div>
</section>

<section class="testimonials">
    <div class="container">
        <h2>What Our Clients Say</h2>
        <div class="testimonial-slider">
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"The Next Fream of Photography captured our wedding day perfectly! The photos are stunning and we'll cherish them forever."</p>
                </div>
                <div class="testimonial-author">
                    <h4>Sarah & Michael</h4>
                    <span>Wedding Clients</span>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"The family portraits turned out better than we could have imagined. Worth every penny!"</p>
                </div>
                <div class="testimonial-author">
                    <h4>The Wilson Family</h4>
                    <span>Family Portrait</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>