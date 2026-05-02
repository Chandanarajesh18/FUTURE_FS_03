<?php 
session_start();
include 'config/db_connect.php';

if (!isset($_SESSION['donor_id'])) {
    header("Location: donor-login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];

// Handle availability update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $availability = $_POST['availability'];
    $sql = "UPDATE donors SET availability='$availability' WHERE id=$donor_id";
    
    if ($conn->query($sql)) {
        $success = "Availability updated successfully!";
    } else {
        $error = "Error updating availability.";
    }
}

// Get donor info
$donor_sql = "SELECT * FROM donors WHERE id = $donor_id";
$donor_result = $conn->query($donor_sql);
$donor = $donor_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability - Blood Connect</title>
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
        
        .availability-card {
            background: var(--white);
            padding: 40px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .availability-status {
            text-align: center;
            padding: 30px;
            border-radius: var(--radius);
            margin-bottom: 30px;
        }
        
        .availability-status.available {
            background: #d4edda;
            border: 2px solid #28a745;
        }
        
        .availability-status.unavailable {
            background: #f8d7da;
            border: 2px solid #dc3545;
        }
        
        .availability-status i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
       .availability-status.available i {
            color: #28a745;
        }
        
        .availability-status.unavailable i {
            color: #dc3545;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--gray-medium);
            border-radius: var(--radius);
            font-size: 1rem;
        }
        
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .btn-action {
            padding: 12px 30px;
            border-radius: var(--radius);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
        }
        
        .btn-secondary {
            background: var(--secondary-color);
            color: var(--primary-color);
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: var(--radius);
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
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
                <li><a href="donor-history.php"><i class="fas fa-history"></i> Donation History</a></li>
                <li><a href="donor-availability.php" class="active"><i class="fas fa-calendar-check"></i> Availability</a></li>
                <li><a href="donor-settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="donor-logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="dashboard-content">
            <div class="dashboard-header">
                <h1><i class="fas fa-calendar-check"></i> Update Availability</h1>
            </div>
            
            <?php if(isset($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <div class="availability-card">
                <div class="availability-status <?php echo $donor['availability'] == 'Available' ? 'available' : 'unavailable'; ?>">
                    <i class="fas fa-<?php echo $donor['availability'] == 'Available' ? 'check-circle' : 'times-circle'; ?>"></i>
                    <h3 style="color: var(--text-dark); margin-bottom: 10px;">Current Status: <?php echo $donor['availability']; ?></h3>
                    <p style="color: var(--text-light);">Update your availability to help others find you</p>
                </div>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Availability Status</label>
                        <select name="availability" required>
                            <option value="Available" <?php echo $donor['availability'] == 'Available' ? 'selected' : ''; ?>>Available to Donate</option>
                            <option value="Not Available" <?php echo $donor['availability'] == 'Not Available' ? 'selected' : ''; ?>>Not Available</option>
                            <option value="On Leave" <?php echo $donor['availability'] == 'On Leave' ? 'selected' : ''; ?>>On Leave</option>
                        </select>
                    </div>
                    
                    <div style="display: flex; gap: 15px;">
                        <button type="submit" class="btn-action btn-primary">
                            <i class="fas fa-save"></i> Update Availability
                        </button>
                        <a href="donor-dashboard.php" class="btn-action btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>