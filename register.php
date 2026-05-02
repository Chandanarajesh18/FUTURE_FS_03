<?php 
session_start();
include 'config/db_connect.php';

// Handle registration
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate password
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } else {
        // Check if phone already exists
        $check_sql = "SELECT * FROM donors WHERE phone='$phone'";
        $check_result = $conn->query($check_sql);
        
        if ($check_result->num_rows > 0) {
            $error = "Phone number already registered!";
        } else {
            // Insert donor
            $sql = "INSERT INTO donors (name, blood_group, phone, email, city, password, availability) 
                    VALUES ('$name', '$blood_group', '$phone', '$email', '$city', '$password', 'Available')";
            
            if ($conn->query($sql)) {
                $success = "Registration successful! Please login.";
                $success_phone = $phone;
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}

// Check if already logged in
if (isset($_SESSION['donor_id'])) {
    header("Location: donor-dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration - Blood Connect</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--secondary-color), #fff5f8);
        }
        
        .register-box {
            background: var(--white);
            padding: 50px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 600px;
        }
        
        .register-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 2rem;
        }
        
        .register-box .form-group {
            margin-bottom: 20px;
        }
        
        .register-box label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .register-box input,
        .register-box select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--gray-medium);
            border-radius: var(--radius);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .register-box input:focus,
        .register-box select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(183, 28, 28, 0.1);
        }
        
        .register-box .btn-primary {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .register-box .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(183, 28, 28, 0.4);
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
        
        .register-footer {
            text-align: center;
            margin-top: 25px;
            color: var(--text-light);
        }
        
        .register-footer a {
            color: var(--primary-color);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <h2><i class="fas fa-user-plus"></i> Become a Donor</h2>
            
            <?php if(isset($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                    <br><br>
                    <a href="donor-login.php" class="btn btn-primary">Go to Login</a>
                </div>
            <?php else: ?>
                <?php if(isset($error)): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Blood Group</label>
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
                        <label>Phone Number</label>
                        <input type="tel" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email (Optional)</label>
                        <input type="email" name="email" placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" placeholder="Enter your city" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Create password (min 6 characters)" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="Confirm password" required>
                    </div>
                    
                    <button type="submit" name="register" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Register Now
                    </button>
                </form>
                
                <div class="register-footer">
                    <p>Already have an account? <a href="donor-login.php">Login Here</a></p>
                    <p><a href="index.php">← Back to Home</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>