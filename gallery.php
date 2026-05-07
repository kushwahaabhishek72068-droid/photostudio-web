<?php 
$pageTitle = "Gallery";
include 'includes/header.php'; 
?>

<section class="gallery-hero">
    <div class="container">
        <h1>Our Gallery</h1>
        <p>Explore our collection of beautiful moments captured through the lens</p>
    </div>
</section>

<section class="gallery-content">
    <div class="container">
        <div class="gallery-filter">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="wedding">Weddings</button>
            <button class="filter-btn" data-filter="portrait">Portraits</button>
            <button class="filter-btn" data-filter="nature">Nature</button>
            <button class="filter-btn" data-filter="commercial">Commercial</button>
        </div>

        <div class="gallery-grid">
            <!-- Wedding Images -->
            <div class="gallery-item" data-category="wedding">
                <img src="images/1.jpg" alt="Wedding Photography 1">
                <div class="gallery-overlay">
                    <h3>Beautiful Wedding Moment</h3>
                    <p>Captured during a sunset ceremony</p>
                </div>
            </div>
            <div class="gallery-item" data-category="wedding">
                <img src="images/2.jpeg" alt="Wedding Photography 2">
                <div class="gallery-overlay">
                    <h3>Bride Preparation</h3>
                    <p>Emotional getting ready moments</p>
                </div>
            </div>
            <div class="gallery-item" data-category="wedding">
                <img src="images/3.jpg" alt="Wedding Photography 3">
                <div class="gallery-overlay">
                    <h3>First Dance</h3>
                    <p>The magical first dance as husband and wife</p>
                </div>
            </div>
            <div class="gallery-item" data-category="wedding">
                <img src="images/4.jpg" alt="Wedding Photography 4">
                <div class="gallery-overlay">
                    <h3>Wedding Details</h3>
                    <p>Beautiful decor and details</p>
                </div>
            </div>
            <div class="gallery-item" data-category="wedding">
                <img src="images/5.jpeg" alt="Wedding Photography 5">
                <div class="gallery-overlay">
                    <h3>Bridal Party</h3>
                    <p>Fun with the bridesmaids</p>
                </div>
            </div>
            <div class="gallery-item" data-category="wedding">
                <img src="images/6.jpeg" alt="Wedding Photography 6">
                <div class="gallery-overlay">
                    <h3>Romantic Portraits</h3>
                    <p>Newlywed couple portraits</p>
                </div>
            </div>

            <!-- Portrait Images -->
            <div class="gallery-item" data-category="portrait">
                <img src="images/12.jpg" alt="Portrait Photography 1">
                <div class="gallery-overlay">
                    <h3>Professional Headshot</h3>
                    <p>Clean and professional look</p>
                </div>
            </div>
            <div class="gallery-item" data-category="portrait">
                <img src="images/13.jpg" alt="Portrait Photography 2">
                <div class="gallery-overlay">
                    <h3>Creative Portrait</h3>
                    <p>Artistic lighting and composition</p>
                </div>
            </div>
            <div class="gallery-item" data-category="portrait">
                <img src="images/14.jpg" alt="Portrait Photography 3">
                <div class="gallery-overlay">
                    <h3>Family Portrait</h3>
                    <p>Beautiful family memories</p>
                </div>
            </div>
            <div class="gallery-item" data-category="portrait">
                <img src="images/15.jpg" alt="Portrait Photography 4">
                <div class="gallery-overlay">
                    <h3>Maternity Portrait</h3>
                    <p>Celebrating new life</p>
                </div>
            </div>

            <!-- Nature Images -->
            <div class="gallery-item" data-category="nature">
                <img src="images/b.jpg" alt="Nature Photography 1">
                <div class="gallery-overlay">
                    <h3>Sunset Landscape</h3>
                    <p>Beautiful natural colors</p>
                </div>
            </div>
            <div class="gallery-item" data-category="nature">
                <img src="images/d.jpeg" alt="Nature Photography 2">
                <div class="gallery-overlay">
                    <h3>Mountain View</h3>
                    <p>Majestic natural scenery</p>
                </div>
            </div>

            <!-- Commercial Images -->
            <div class="gallery-item" data-category="commercial">
                <img src="images/11.jpg" alt="Commercial Photography 1">
                <div class="gallery-overlay">
                    <h3>Product Photography</h3>
                    <p>Showcasing products beautifully</p>
                </div>
            </div>
            <div class="gallery-item" data-category="commercial">
                <img src="images/10.jpg" alt="Commercial Photography 3">
                <div class="gallery-overlay">
                    <h3>Architecture</h3>
                    <p>Building and design photography</p>
                </div>
            <div class="gallery-item" data-category="commercial">
                <img src="images/9.jpg" alt="Commercial Photography 3">
                <div class="gallery-overlay">
                    <h3>Architecture</h3>
                    <p>Building and design photography</p>
                </div>
            </div>
            <div class="gallery-item" data-category="commercial">
                <img src="images/8.jpg" alt="Commercial Photography 4">
                <div class="gallery-overlay">
                    <h3>Fashion Photography</h3>
                    <p>Stylish clothing presentation</p>
                </div>
            </div>
            <div class="gallery-item" data-category="commercial">
                <img src="images/7.jpg" alt="Commercial Photography 5">
                <div class="gallery-overlay">
                    <h3>Corporate Event</h3>
                    <p>Professional business photography</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>