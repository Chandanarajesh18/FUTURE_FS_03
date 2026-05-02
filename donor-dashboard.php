<?php 
session_start();
include 'config/db_connect.php';

// Check if donor is logged in
if (!isset($_SESSION['donor_id'])) {
    header("Location: donor-login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];

// Get donor info
$donor_sql = "SELECT * FROM donors WHERE id = $donor_id";
$donor_result = $conn->query($donor_sql);

// Check if query failed
if (!$donor_result) {
    die("Query Error: " . $conn->error . "<br>SQL: $donor_sql");
}

$donor = $donor_result->fetch_assoc();

// Get total requests in donor's city
$requests_sql = "SELECT COUNT(*) as total FROM requests WHERE city = '{$donor['city']}'";
$requests_result = $conn->query($requests_sql);

if (!$requests_result) {
    die("Query Error: " . $conn->error . "<br>SQL: $requests_sql");
}

$requests_count = $requests_result->fetch_assoc()['total'];

// Get recent requests
$recent_requests_sql = "SELECT * FROM requests WHERE city = '{$donor['city']}' ORDER BY created_at DESC LIMIT 5";
$recent_requests = $conn->query($recent_requests_sql);

if (!$recent_requests) {
    die("Query Error: " . $conn->error . "<br>SQL: $recent_requests_sql");
}

// Get donation stats
$donation_stats_sql = "SELECT COUNT(*) as total FROM donations WHERE donor_id = $donor_id";
$donation_stats = $conn->query($donation_stats_sql);

if (!$donation_stats) {
    die("Query Error: " . $conn->error . "<br>SQL: $donation_stats_sql");
}

$donation_count = $donation_stats->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard - Blood Connect</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background: #f5f5f5;
        }
        
        .dashboard-sidebar {
            width: 280px;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: white;
            padding: 30px 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .dashboard-sidebar h2 {
            margin-bottom: 40px;
            color: var(--primary-color);
            font-size: 1.5rem;
            text-align: center;
        }
        
        .dashboard-sidebar ul {
            list-style: none;
        }
        
        .dashboard-sidebar ul li {
            margin-bottom: 10px;
        }
        
        .dashboard-sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            border-radius: var(--radius);
            transition: all 0.3s ease;
        }
        
        .dashboard-sidebar ul li a:hover,
        .dashboard-sidebar ul li a.active {
            background: rgba(255,255,255,0.1);
            color: var(--primary-color);
        }
        
        .dashboard-content {
            flex: 1;
            margin-left: 280px;
            padding: 40px;
        }
        
        .dashboard-header {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dashboard-header h1 {
            color: var(--text-dark);
            font-size: 2rem;
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }
        
        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }
        
        .stat-icon.primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
        }
        
        .stat-icon.success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .stat-icon.warning {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: white;
        }
        
        .stat-icon.info {
            background: linear-gradient(135deg, #17a2b8, #0c849f);
            color: white;
        }
        
        .stat-info h3 {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: var(--text-light);
            font-size: 0.95rem;
        }
        
        .dashboard-section {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }
        
        .dashboard-section h2 {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 1.5rem;
        }
        
        .request-card {
            background: var(--gray-light);
            padding: 20px;
            border-radius: var(--radius);
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .request-card:hover {
            background: var(--white);
            box-shadow: var(--shadow);
            transform: translateX(5px);
        }
        
        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .request-badge {
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .request-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .request-info p {
            margin: 0;
            color: var(--text-light);
        }
        
        .request-info strong {
            color: var(--text-dark);
        }
        
        .btn-action {
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-contact {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-contact:hover {
            background: var(--primary-light);
        }
        
        .btn-view {
            background: var(--secondary-color);
            color: var(--primary-color);
        }
        
        .btn-view:hover {
            background: #fce4ec;
        }
        
        .profile-card {
            text-align: center;
            padding: 30px;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 3rem;
            font-weight: 700;
        }
        
        .profile-info {
            margin-top: 20px;
        }
        
        .profile-info p {
            margin: 10px 0;
            color: var(--text-light);
        }
        
        .profile-info strong {
            color: var(--text-dark);
        }
        
        .notification-badge {
            background: #dc3545;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.75rem;
            margin-left: 10px;
        }
        
        @media (max-width: 768px) {
            .dashboard-sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
            
            .dashboard-content {
                margin-left: 0;
            }
            
            .dashboard-header {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <h2><i class="fas fa-heartbeat"></i> Blood Connect</h2>
            <ul>
                <li><a href="donor-dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="donor-profile.php"><i class="fas fa-user"></i> My Profile</a></li>
                <li><a href="donor-requests.php"><i class="fas fa-file-medical"></i> Blood Requests <span class="notification-badge"><?php echo $requests_count; ?></span></a></li>
                <li><a href="donor-history.php"><i class="fas fa-history"></i> Donation History</a></li>
                <li><a href="donor-availability.php"><i class="fas fa-calendar-check"></i> Availability</a></li>
                <li><a href="donor-settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="donor-logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-content">
            <!-- Header -->
            <div class="dashboard-header">
                <div>
                    <h1>Welcome, <?php echo $donor['name']; ?>!</h1>
                    <p style="color: var(--text-light);">Here's what's happening in your area</p>
                </div>
                <div>
                    <a href="donor-availability.php" class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i> Update Availability
                    </a>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $donation_count; ?></h3>
                        <p>Total Donations</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $donor['blood_group']; ?></h3>
                        <p>Blood Group</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $requests_count; ?></h3>
                        <p>Requests in Area</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon info">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $donor['city']; ?></h3>
                        <p>Your City</p>
                    </div>
                </div>
            </div>
            
            <!-- Recent Requests -->
            <div class="dashboard-section">
                <h2><i class="fas fa-bell"></i> Recent Blood Requests Near You</h2>
                
                <?php if ($recent_requests && $recent_requests->num_rows > 0): ?>
                    <?php while($request = $recent_requests->fetch_assoc()): ?>
                        <div class="request-card">
                            <div class="request-header">
                                <h3 style="color: var(--text-dark); margin: 0;">Patient: <?php echo $request['patient_name']; ?></h3>
                                <span class="request-badge"><?php echo $request['blood_group']; ?></span>
                            </div>
                            <div class="request-info">
                                <p><strong>City:</strong> <?php echo $request['city']; ?></p>
                                <p><strong>Hospital:</strong> <?php echo $request['hospital_name']; ?></p>
                                <p><strong>Phone:</strong> <?php echo $request['phone']; ?></p>
                                <p><strong>Date:</strong> <?php echo date('M d, Y', strtotime($request['created_at'])); ?></p>
                            </div>
                            <div style="margin-top: 15px;">
                                <a href="tel:<?php echo $request['phone']; ?>" class="btn-action btn-contact">
                                    <i class="fas fa-phone"></i> Contact
                                </a>
                                <a href="donor-view-request.php?id=<?php echo $request['id']; ?>" class="btn-action btn-view">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="text-align: center; color: var(--text-light); padding: 40px;">
                        <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 15px;"></i>
                        <br>No blood requests in your area at the moment.
                    </p>
                <?php endif; ?>
            </div>
            
            <!-- Quick Actions -->
            <div class="dashboard-section">
                <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                                        <a href="donor-history.php" class="btn btn-secondary" style="text-align: center; padding: 20px;">
                        <i class="fas fa-history" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <br>Donation History
                    </a>
                    <a href="donor-requests.php" class="btn btn-secondary" style="text-align: center; padding: 20px;">
                        <i class="fas fa-file-medical" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <br>Blood Requests
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>