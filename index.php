<?php 
session_start();
include '../config/db_connect.php';

// Handle login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: index.php");
            exit();
        }
    }
    $error = "Invalid credentials!";
}

// Check if logged in
if (!isset($_SESSION['admin_logged_in'])) {
    include 'login.php';
    exit();
}

// Handle delete donor
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM donors WHERE id = $id");
    header("Location: index.php");
}

// Handle delete request
if (isset($_GET['delete_request'])) {
    $id = $_GET['delete_request'];
    $conn->query("DELETE FROM requests WHERE id = $id");
    header("Location: index.php");
}

// Get counts
$donor_count = $conn->query("SELECT COUNT(*) FROM donors")->fetch_row()[0];
$request_count = $conn->query("SELECT COUNT(*) FROM requests")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Blood Connect</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="donors.php"><i class="fas fa-users"></i> Donors</a></li>
                <li><a href="requests.php"><i class="fas fa-file-medical"></i> Requests</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header>
                <h1>Dashboard</h1>
                <p>Welcome, Admin!</p>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3><?php echo $donor_count; ?></h3>
                    <p>Total Donors</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $request_count; ?></h3>
                    <p>Total Requests</p>
                </div>
            </div>

            <h2 style="margin-top: 40px;">Recent Donors</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Blood Group</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM donors ORDER BY created_at DESC LIMIT 10");
                    while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td>
                            <a href="?delete=<?php echo $row['id']; ?>" class="btn-danger" onclick="return confirm('Delete this donor?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>