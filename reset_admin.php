<?php
include 'config/db_connect.php';

// Generate new password hash
$new_password = 'admin123';
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update admin password
$sql = "UPDATE admin SET password = '$hashed_password' WHERE username = 'admin'";

if ($conn->query($sql)) {
    echo "<h2 style='color: green;'>✅ Admin Password Reset Successfully!</h2>";
    echo "<p><strong>Username:</strong> admin</p>";
    echo "<p><strong>Password:</strong> admin123</p>";
    echo "<p><a href='admin/login.php'>Go to Admin Login</a></p>";
} else {
    echo "<h2 style='color: red;'>❌ Error: " . $conn->error . "</h2>";
}

$conn->close();
?>