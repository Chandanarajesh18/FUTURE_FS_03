<?php
echo "<h2>MySQL Connection Test (Port 3307)</h2>";
echo "<hr>";

// Test 1: Connect with port 3307
echo "<h3>Test 1: Connection with Port 3307</h3>";
$conn1 = @new mysqli("localhost:3307", "root", "");
if ($conn1->connect_error) {
    echo "<p style='color:red;'>❌ Cannot connect to MySQL on port 3307</p>";
    echo "<p>Error: " . $conn1->connect_error . "</p>";
} else {
    echo "<p style='color:green;'>✅ MySQL Connected on Port 3307!</p>";
    echo "<p>Version: " . $conn1->server_info . "</p>";
    echo "<p>Port: " . $conn1->port . "</p>";
    $conn1->close();
}

echo "<hr>";

// Test 2: Check Database
echo "<h3>Test 2: Database Check</h3>";
$conn2 = @new mysqli("localhost:3307", "root", "", "blood_portal_db");
if ($conn2->connect_error) {
    echo "<p style='color:red;'>❌ Cannot connect to database: " . $conn2->connect_error . "</p>";
} else {
    echo "<p style='color:green;'>✅ Database Connection Successful!</p>";
    $result = $conn2->query("SHOW TABLES");
    if ($result->num_rows > 0) {
        echo "<p style='color:green;'>✅ Tables Found!</p>";
        echo "<ul>";
        while($row = $result->fetch_row()) {
            echo "<li>" . $row[0] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color:red;'>❌ No tables found! Import database.sql</p>";
    }
    $conn2->close();
}

echo "<hr>";

// Test 3: Try Different Ports
echo "<h3>Test 3: Try Different Ports</h3>";
$ports = ["3306", "3307", "3308"];
foreach ($ports as $port) {
    $conn = @new mysqli("localhost:" . $port, "root", "");
    if ($conn->connect_error) {
        echo "<p style='color:red;'>❌ Port $port - Failed</p>";
    } else {
        echo "<p style='color:green;'>✅ Port $port - Success!</p>";
        $conn->close();
    }
}
?>