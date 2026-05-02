<?php 
session_start();
include '../config/db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['delete_request'])) {
    $id = $_GET['delete_request'];
    $conn->query("DELETE FROM requests WHERE id = $id");
    header("Location: requests.php");
}

$requests = $conn->query("SELECT * FROM requests ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Requests - Admin Panel</title>
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
                <h1>Blood Requests</h1>
            </header>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Blood Group</th>
                        <th>City</th>
                        <th>Hospital</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $requests->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['patient_name']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['hospital_name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo substr($row['message'], 0, 50); ?>...</td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="?delete_request=<?php echo $row['id']; ?>" class="btn-danger" onclick="return confirm('Delete this request?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>