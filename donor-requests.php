<?php 
session_start();
include 'config/db_connect.php';

if (!isset($_SESSION['donor_id'])) {
    header("Location: donor-login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];

// Get donor info
$donor_sql = "SELECT * FROM donors WHERE id = $donor_id";
$donor_result = $conn->query($donor_sql);
$donor = $donor_result->fetch_assoc();

// Get requests in donor's city
$requests_sql = "SELECT * FROM requests WHERE city = '{$donor['city']}' ORDER BY created_at DESC";
$requests = $conn->query($requests_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Requests - Blood Connect</title>
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
        }
        
        .dashboard-header h1 {
            color: var(--text-dark);
            font-size: 2rem;
        }
        
        .request-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .request-card:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-hover);
        }
        
        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .request-badge {
            background: var(--primary-color);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 700;
        }
        
        .request-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .request-info p {
            margin: 0;
            color: var(--text-light);
        }
        
        .request-info strong {
            color: var(--text-dark);
        }
        
        .request-message {
            background: var(--gray-light);
            padding: 20px;
            border-radius: var(--radius);
            margin-bottom: 20px;
        }
        
        .btn-action {
    padding: 12px 25px;
    border-radius: var(--radius);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-block;
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

@media (max-width: 768px) {
    .dashboard-sidebar {
        width: 100%;
        position: relative;
        height: auto;
    }
    
    .dashboard-content {
        margin-left: 0;
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
                <li><a href="donor-dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="donor-profile.php"><i class="fas fa-user"></i> My Profile</a></li>
                <li><a href="donor-requests.php" class="active"><i class="fas fa-file-medical"></i> Blood Requests</a></li>
                <li><a href="donor-history.php"><i class="fas fa-history"></i> Donation History</a></li>
                <li><a href="donor-availability.php"><i class="fas fa-calendar-check"></i> Availability</a></li>
                <li><a href="donor-settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="donor-logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-content">
            <div class="dashboard-header">
                <h1><i class="fas fa-file-medical"></i> Blood Requests in Your Area</h1>
                <p style="color: var(--text-light);">Total Requests: <?php echo $requests->num_rows; ?></p>
            </div>
            
            <?php if ($requests && $requests->num_rows > 0): ?>
                <?php while($request = $requests->fetch_assoc()): ?>
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
                        <?php if (!empty($request['message'])): ?>
                            <div class="request-message">
                                <strong>Message:</strong> <?php echo $request['message']; ?>
                            </div>
                        <?php endif; ?>
                        <div style="margin-top: 20px;">
                            <a href="tel:<?php echo $request['phone']; ?>" class="btn-action btn-contact">
                                <i class="fas fa-phone"></i> Contact Now
                            </a>
                            <a href="donor-view-request.php?id=<?php echo $request['id']; ?>" class="btn-action btn-view">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="background: var(--white); padding: 40px; border-radius: var(--radius); text-align: center; box-shadow: var(--shadow);">
                    <i class="fas fa-info-circle" style="font-size: 3rem; color: var(--text-light); margin-bottom: 20px;"></i>
                    <h3 style="color: var(--text-dark);">No Blood Requests Found</h3>
                    <p style="color: var(--text-light);">There are no blood requests in your area at the moment.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>