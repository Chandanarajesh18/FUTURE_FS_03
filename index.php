<?php 
include 'config/db_connect.php';
include 'includes/header.php';
?>

<!-- ✅ HERO SECTION (ONLY ONE) -->
<section class="hero" id="home">
    <div class="hero-content">
        <h1>Be a Hero, Donate Blood</h1>
        <p>Your single donation can save up to three lives. Join our community of life savers today.</p>
        <div class="hero-buttons">
            <a href="#register" class="btn btn-primary">Become a Donor</a>
            <a href="#search" class="btn btn-outline">Find Donor</a>
        </div>
    </div>
</section>

<!-- ✅ SEARCH BOX -->
<div class="container">
    <div class="search-box" id="search">
        <form action="search.php" method="GET">
            <select name="blood_group">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
            <input type="text" name="city" placeholder="Enter City">
            <button type="submit" class="btn btn-primary">Search Donors</button>
        </form>
    </div>
</div>

<!-- ✅ STATS SECTION -->
<section class="stats" id="stats">
    <div class="container">
        <div class="section-title">
            <h2>Our Impact</h2>
            <p>Numbers that speak for themselves</p>
        </div>
        <div class="stats-grid">
            <div class="stat-card">
                <h3><?php echo $conn->query("SELECT COUNT(*) FROM donors")->fetch_row()[0]; ?></h3>
                <p>Active Donors</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $conn->query("SELECT COUNT(*) FROM requests")->fetch_row()[0]; ?></h3>
                <p>Blood Requests</p>
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
    </div>
</section>

<!-- ✅ HOW IT WORKS SECTION -->
<section class="how-it-works" id="how-it-works">
    <div class="container">
        <div class="section-title">
            <h2>How Blood Donation Works</h2>
            <p>Simple steps to save lives</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-user-plus"></i></div>
                <h3>1. Register</h3>
                <p>Sign up as a donor or create a blood request form</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-search"></i></div>
                <h3>2. Search</h3>
                <p>Search for donors by blood group and location</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3>3. Connect</h3>
                <p>Contact the donor directly to arrange donation</p>
            </div>
        </div>
    </div>
</section>

<!-- ✅ WHY DONATE SECTION -->
<section class="how-it-works" style="background: var(--secondary-color);" id="why-donate">
    <div class="container">
        <div class="section-title">
            <h2>Why Donate Blood?</h2>
            <p>Every drop counts, every life matters</p>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-heart"></i></div>
                <h3>Save Lives</h3>
                <p>One donation can save up to 3 lives</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-heartbeat"></i></div>
                <h3>Health Benefits</h3>
                <p>Regular donation improves heart health</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-users"></i></div>
                <h3>Community</h3>
                <p>Join thousands of life savers</p>
            </div>
        </div>
    </div>
</section>

<!-- ✅ REQUEST SECTION -->
<section class="container" style="padding: 80px 20px;" id="request">
    <div class="section-title">
        <h2>Request Blood</h2>
        <p>Need blood urgently? Fill the form below</p>
    </div>
    <div class="form-container">
        <form method="POST" action="request.php">
            <div class="form-group">
                <label>Patient Name</label>
                <input type="text" name="patient_name" required>
            </div>
            <div class="form-group">
                <label>Blood Group Required</label>
                <select name="blood_group" required>
                    <option value="">Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" required>
            </div>
            <div class="form-group">
                <label>Hospital Name</label>
                <input type="text" name="hospital_name">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone" required>
            </div>
            <div class="form-group">
                <label>Message (Optional)</label>
                <textarea name="message" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Request</button>
        </form>
    </div>
</section>

<!-- ✅ CTA SECTION -->
<section class="cta-section" id="register">
    <div class="container">
        <div class="cta-card">
            <div class="cta-content">
                <div class="cta-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h2>Become a Blood Donor</h2>
                <p>Register yourself to help save lives in your community. Your donation can change someone's world.</p>
                <div class="cta-features">
                    <div class="cta-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Quick Registration</span>
                    </div>
                    <div class="cta-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>24/7 Support</span>
                    </div>
                    <div class="cta-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Save Lives</span>
                    </div>
                </div>
                <a href="register.php" class="btn btn-primary btn-large">
                    <i class="fas fa-user-plus"></i> Register Now
                </a>
            </div>
            <div class="cta-decoration">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
        </div>
    </div>
</section>

<!-- ✅ TESTIMONIALS SECTION -->
<section class="testimonials" id="testimonials">
    <div class="container">
        <div class="section-title">
            <h2>Success Stories</h2>
            <p>Real stories of lives saved through blood donation</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="testimonial-info">
                        <h4>Sarah M.</h4>
                        <span>Mother of Patient</span>
                    </div>
                </div>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"My daughter needed blood urgently. Blood Connect helped us find a donor within 2 hours. Thank you!"</p>
                <div class="testimonial-date">
                    <i class="fas fa-calendar"></i>
                    <span>December 2023</span>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="testimonial-info">
                        <h4>John D.</h4>
                        <span>Regular Donor</span>
                    </div>
                </div>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"Donating blood feels amazing. I've donated 15 times and saved countless lives."</p>
                <div class="testimonial-date">
                    <i class="fas fa-calendar"></i>
                    <span>November 2023</span>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="testimonial-info">
                        <h4>Emily R.</h4>
                        <span>Patient's Daughter</span>
                    </div>
                </div>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"The platform made it so easy to find donors. Saved my father's life!"</p>
                <div class="testimonial-date">
                    <i class="fas fa-calendar"></i>
                    <span>October 2023</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ✅ FOOTER -->
<?php include 'includes/footer.php'; ?>

</body>
</html>