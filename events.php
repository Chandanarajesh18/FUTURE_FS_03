<?php 
include 'config/db_connect.php';
include 'includes/header.php';
?>

<section class="page-header" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1>Upcoming Events</h1>
        <p>Join our blood donation camps</p>
    </div>
</section>

<section class="container" style="padding: 60px 20px;">
    <div class="section-title">
        <h2>Donation Camps</h2>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div style="background: var(--secondary-color); padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);">15</h3>
                <p>DEC</p>
            </div>
            <h3>College Blood Donation Camp</h3>
            <p><i class="fas fa-map-marker-alt"></i> City College Auditorium</p>
            <p><i class="fas fa-clock"></i> 9:00 AM - 5:00 PM</p>
            <a href="register.php" class="btn btn-primary" style="margin-top: 15px;">Register to Donate</a>
        </div>
        
        <div class="stat-card">
            <div style="background: var(--secondary-color); padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);">22</h3>
                <p>DEC</p>
            </div>
            <h3>Community Blood Drive</h3>
            <p><i class="fas fa-map-marker-alt"></i> City Community Center</p>
            <p><i class="fas fa-clock"></i> 10:00 AM - 4:00 PM</p>
            <a href="register.php" class="btn btn-primary" style="margin-top: 15px;">Register to Donate</a>
        </div>
        
        <div class="stat-card">
            <div style="background: var(--secondary-color); padding: 20px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);">05</h3>
                <p>JAN</p>
            </div>
            <h3>Hospital Blood Donation Drive</h3>
            <p><i class="fas fa-map-marker-alt"></i> City Hospital</p>
            <p><i class="fas fa-clock"></i> 8:00 AM - 6:00 PM</p>
            <a href="register.php" class="btn btn-primary" style="margin-top: 15px;">Register to Donate</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>