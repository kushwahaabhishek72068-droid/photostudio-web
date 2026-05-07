<?php 
$pageTitle = "Contact";
include 'includes/header.php'; 
?>

<section class="contact-hero">
    <div class="container">
        <h1>Get in Touch</h1>
        <p>We'd love to hear from you and discuss your photography needs</p>
    </div>
</section>

<section class="contact-content">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form action="submit_contact.php" method="POST" id="contactForm">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject">
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Booking Request">Booking Request</option>
                            <option value="Pricing Question">Pricing Question</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="contact-info">
                <h2>Contact Information</h2>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Studio Location</h3>
                    <p>parvatiya colony ,faridabad gouncchi,haryana ,jeevan nagar pir baba</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <h3>Phone</h3>
                    <p>+91 9811742138</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p>vermajisv9811@gmail.com</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <h3>Business Hours</h3>
                    <p>all days <br>any time <br>Sunday: Closed</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <div class="container">
        <h2>Find Us</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1dd.latitude!2ddd.longitude!3d14!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTHCsDQ3JzUxLjkiTiA3N8KwMTgnNTAuOSJF!5e0!3m2!1sen!2sin!4v1234567890123!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>