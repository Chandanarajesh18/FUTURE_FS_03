<?php 
session_start();
include 'config/db_connect.php';

// Handle login
if (isset($_POST['login'])) {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM donors WHERE phone='$phone' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['donor_id'] = $row['id'];
        $_SESSION['donor_name'] = $row['name'];
        header("Location: donor-dashboard.php");
        exit();
    } else {
        $error = "Invalid phone number or password!";
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
    <title>Donor Login - Blood Connect</title>
        <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--secondary-color), #fff5f8);
        }
        
        .login-box {
            background: var(--white);
            padding: 50px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 450px;
        }
        
        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 2rem;
        }
        
        .login-box .form-group {
            margin-bottom: 25px;
        }
        
        .login-box label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .login-box input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--gray-medium);
            border-radius: var(--radius);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .login-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(183, 28, 28, 0.1);
        }
        
        .login-box .btn-primary {
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
        
        .login-box .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(183, 28, 28, 0.4);
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: var(--text-light);
        }
        
        .login-footer a {
            color: var(--primary-color);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2><i class="fas fa-heartbeat"></i> Donor Login</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" placeholder="Enter your phone number" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" name="login" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="login-footer">
                <p>Don't have an account? <a href="donor-register.php">Register Here</a></p>
                <p><a href="index.php">← Back to Home</a></p>
            </div>
        </div>
    </div>
</body>
</html>