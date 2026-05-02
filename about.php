<?php 
include 'config/db_connect.php';
include 'includes/header.php';
?>

<section class="page-header" style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); padding: 80px 0; color: white; text-align: center;">
    <div class="container">
        <h1>About Us</h1>
        <p>Learn about our mission to save lives through blood donation</p>
    </div>
</section>

<section class="container" style="padding: 60px 20px;">
    <div class="section-title">
        <h2>Our Mission</h2>
        <p>Connecting donors with those in need, one life at a time</p>
    </div>
    
    <div class="stats-grid" style="margin-top: 40px;">
        <div class="stat-card">
            <h3>10,000+</h3>
            <p>Active Donors</p>
        </div>
        <div class="stat-card">
            <h3>5,000+</h3>
            <p>Blood Requests Fulfilled</p>
        </div>
        <div class="stat-card">
            <h3>50+</h3>
            <p>Cities Covered</p>
        </div>
        <div class="stat-card">
            <h3>100+</h3>
            <p>Partner Hospitals</p>
        </div>
    </div>
    
    <div style="margin-top: 60px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        <div>
            <h3>Why We Started</h3>
            <p style="margin-top: 20px; color: var(--text-light);">
                Blood Connect was founded with a simple mission: to make blood donation 
                accessible to everyone. We believe that every drop of blood can save a life, 
                and we're committed to building a community of life savers.
            </p>
        </div>
        <div>
            <h3>Our Vision</h3>
            <p style="margin-top: 20px; color: var(--text-light);">
                To create a world where no one dies due to lack of blood. We envision 
                a connected community where donors and recipients can easily find each other 
                in times of need.
            </p>
        </div>
    </div>
</section>

<section class="how-it-works" style="background: var(--secondary-color);">
    <div class="container">
        <div class="section-title">
            <h2>How We Work</h2>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-user-plus"></i></div>
                <h3>Register</h3>
                <p>Sign up as a donor or create a blood request</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-search"></i></div>
                <h3>Search</h3>
                <p>Find donors or requests by blood group and location</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3>Connect</h3>
                <p>Direct contact between donors and recipients</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>