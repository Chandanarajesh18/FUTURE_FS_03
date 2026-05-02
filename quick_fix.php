<?php
include 'config/db_connect.php';

echo "<h2>Admin Fix Script</h2>";

// Check if admin table exists
$result = $conn->query("SHOW TABLES LIKE 'admin'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ Admin table exists</p>";
    
    // Check if admin user exists
    $result = $conn->query("SELECT * FROM admin");
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Admin user exists</p>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password Hash</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . substr($row['password'], 0, 30) . "...</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red;'>❌ No admin user found</p>";
        echo "<p>Creating admin user...</p>";
        
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin (username, password) VALUES ('admin', '$password')";
        if ($conn->query($sql)) {
            echo "<p style='color: green;'>✅ Admin user created!</p>";
            echo "<p><strong>Username:</strong> admin</p>";
            echo "<p><strong>Password:</strong> admin123</p>";
        } else {
            echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
        }
    }
} else {
    echo "<p style='color: red;'>❌ Admin table does not exist</p>";
    echo "<p>Creating admin table...</p>";
    
    $sql = "CREATE TABLE admin (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ Admin table created!</p>";
        
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin (username, password) VALUES ('admin', '$password')";
        if ($conn->query($sql)) {
            echo "<p style='color: green;'>✅ Admin user created!</p>";
            echo "<p><strong>Username:</strong> admin</p>";
            echo "<p><strong>Password:</strong> admin123</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>