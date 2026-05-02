<?php 
session_start();
include 'config/db_connect.php';

if (!isset($_SESSION['donor_id'])) {
    header("Location: donor-login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];

// Get donation history
$history_sql = "SELECT * FROM donations WHERE donor_id = $donor_id ORDER BY donation_date DESC";
$history = $conn->query($history_sql);

// Get total donations
$total_sql = "SELECT COUNT(*) as total FROM donations WHERE donor_id = $donor_id";
$total = $conn->query($total_sql)->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation History - Blood Connect</title>
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
        
        .history-card {
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }
        
        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--gray-medium);
        }
        
        .history-badge {
            background: #28a745;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .history-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .history-info p {
            margin: 0;
            color: var(--text-light);
        }
        
        .history-info strong {
            color: var(--text-dark);
        }
        
        .empty-state {
            background: var(--white);
            padding: 60px 40px;
            border-radius: var(--radius);
            text-align: center;
            box-shadow: var(--shadow);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--text-light);
            margin-bottom: 20px;
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
                <li><a href="donor-requests.php"><i class="fas fa-file-medical"></i> Blood Requests</a></li>
                <li><a href="donor-history.php" class="active"><i class="fas fa-history"></i> Donation History</a></li>
                <li><a href="donor-availability.php"><i class="fas fa-calendar-check"></i> Availability</a></li>
                <li><a href="donor-settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="donor-logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-content">
            <div class="dashboard-header">
                <h1><i class="fas fa-history"></i> Donation History</h1>
                <p style="color: var(--text-light);">Total Donations: <?php echo $total; ?></p>
            </div>
            
            <?php if ($history && $history->num_rows > 0): ?>
                <?php while($donation = $history->fetch_assoc()): ?>
                    <div class="history-card">
                        <div class="history-header">
                            <h3 style="color: var(--text-dark); margin: 0;">Donation #<?php echo $donation['id']; ?></h3>
                            <span class="history-badge">Completed</span>
                        </div>
                        <div class="history-info">
                            <p><strong>Date:</strong> <?php echo date('M d, Y', strtotime($donation['donation_date'])); ?></p>
                            <p><strong>Blood Group:</strong> <?php echo $donation['blood_group']; ?></p>
                            <p><strong>Hospital:</strong> <?php echo $donation['hospital_name']; ?></p>
                            <p><strong>City:</strong> <?php echo $donation['city']; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-history"></i>
                    <h3 style="color: var(--text-dark); margin-bottom: 10px;">No Donation History</h3>
                    <p style="color: var(--text-light);">You haven't donated blood yet. Start saving lives today!</p>
                    <a href="donor-dashboard.php" class="btn btn-primary" style="margin-top: 20px;">Go to Dashboard</a>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>