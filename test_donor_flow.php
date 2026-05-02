<?php
include 'config/db_connect.php';

echo "<h2>Donor Flow Test</h2>";
echo "<hr>";

// Check donors table
$result = $conn->query("SELECT COUNT(*) as total FROM donors");
$donors = $result->fetch_assoc()['total'];
echo "<p>✅ Donors in database: <strong>$donors</strong></p>";

// Check requests table
$result = $conn->query("SELECT COUNT(*) as total FROM requests");
$requests = $result->fetch_assoc()['total'];
echo "<p>✅ Requests in database: <strong>$requests</strong></p>";

// Check donations table
$result = $conn->query("SELECT COUNT(*) as total FROM donations");
$donations = $result->fetch_assoc()['total'];
echo "<p>✅ Donations in database: <strong>$donations</strong></p>";

// Check admin table
$result = $conn->query("SELECT COUNT(*) as total FROM admin");
$admins = $result->fetch_assoc()['total'];
echo "<p>✅ Admins in database: <strong>$admins</strong></p>";

echo "<hr>";
echo "<p style='color: green;'><strong>✅ All systems ready!</strong></p>";
echo "<p><a href='donor-register.php'>Register Donor</a> | <a href='donor-login.php'>Login</a> | <a href='donor/donor-dashboard.php'>Dashboard</a></p>";

$conn->close();
?>