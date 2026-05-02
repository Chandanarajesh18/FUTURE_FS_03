<?php 
include 'config/db_connect.php';
include 'includes/header.php';

// Handle contact form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Store in database or send email
    echo "<script>alert('Message sent successfully!'); window.location='contact.php';</script>";
}
?>

<section class="page-header" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with our team</p>
    </div>
</section>

<section class="container" style="padding: 60px 20px;">
    <div class="stats-grid" style="margin-bottom: 60px;">
        <div class="stat-card">
            <h3><i class="fas fa-phone"></i></h3>
            <p>+91 98765 43210</p>
        </div>
        <div class="stat-card">
            <h3><i class="fas fa-envelope"></i></h3>
            <p>support@bloodconnect.com</p>
        </div>
        <div class="stat-card">
            <h3><i class="fas fa-map-marker-alt"></i></h3>
            <p>123 Health Street, City</p>
        </div>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        <div class="form-container" style="margin: 0;">
            <h2>Send Us a Message</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
            </form>
        </div>
        
        <div>
            <h2>Our Office</h2>
            <p style="margin-top: 20px; color: var(--text-light);">
                We're here to help! Reach out to us for any questions about blood donation, 
                registration, or blood requests.
            </p>
            
            <div style="margin-top: 30px;">
                <h3>Office Hours</h3>
                <ul style="list-style: none; margin-top: 15px;">
                    <li><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</li>
                    <li><strong>Saturday:</strong> 10:00 AM - 4:00 PM</li>
                    <li><strong>Sunday:</strong> Closed</li>
                </ul>
            </div>
            
            <div style="margin-top: 30px;">
                <h3>Emergency Contact</h3>
                <p style="color: var(--primary-color); font-weight: bold; font-size: 1.2rem;">
                    🚨 24/7 Helpline: +91 98765 43210
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>