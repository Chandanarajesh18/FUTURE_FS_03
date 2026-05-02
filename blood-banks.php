<?php 
include 'config/db_connect.php';
include 'includes/header.php';
?>

<section class="page-header" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1>Blood Bank Directory</h1>
        <p>Find blood banks near you</p>
    </div>
</section>

<section class="container" style="padding: 60px 20px;">
    <div class="section-title">
        <h2>Partner Blood Banks</h2>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3 style="color: var(--primary-color);">City Hospital Blood Bank</h3>
            <p><i class="fas fa-map-marker-alt"></i> 123 Main Street, City</p>
            <p><i class="fas fa-phone"></i> +91 98765 43210</p>
            <p><i class="fas fa-clock"></i> 24/7 Available</p>
            <a href="contact.php" class="btn btn-primary" style="margin-top: 15px;">Contact</a>
        </div>
        
        <div class="stat-card">
            <h3 style="color: var(--primary-color);">Health Care Blood Bank</h3>
            <p><i class="fas fa-map-marker-alt"></i> 456 Hospital Road, City</p>
            <p><i class="fas fa-phone"></i> +91 98765 43211</p>
            <p><i class="fas fa-clock"></i> 24/7 Available</p>
            <a href="contact.php" class="btn btn-primary" style="margin-top: 15px;">Contact</a>
        </div>
        
        <div class="stat-card">
            <h3 style="color: var(--primary-color);">Life Care Blood Bank</h3>
            <p><i class="fas fa-map-marker-alt"></i> 789 Medical Avenue, City</p>
            <p><i class="fas fa-phone"></i> +91 98765 43212</p>
            <p><i class="fas fa-clock"></i> 24/7 Available</p>
            <a href="contact.php" class="btn btn-primary" style="margin-top: 15px;">Contact</a>
        </div>
        
        <div class="stat-card">
            <h3 style="color: var(--primary-color);">Emergency Blood Bank</h3>
            <p><i class="fas fa-map-marker-alt"></i> 321 Emergency Lane, City</p>
            <p><i class="fas fa-phone"></i> +91 98765 43213</p>
            <p><i class="fas fa-clock"></i> 24/7 Available</p>
            <a href="contact.php" class="btn btn-primary" style="margin-top: 15px;">Contact</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>