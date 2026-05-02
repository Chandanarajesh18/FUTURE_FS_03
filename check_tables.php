<?php
include 'config/db_connect.php';

echo "<h2>Database Table Check</h2>";
echo "<hr>";

// Check donors table
$result = $conn->query("SHOW TABLES LIKE 'donors'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ donors table exists</p>";
    
    // Check columns
    $columns = $conn->query("DESCRIBE donors");
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th></tr>";
    while($row = $columns->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ donors table does not exist</p>";
}

echo "<hr>";

// Check requests table
$result = $conn->query("SHOW TABLES LIKE 'requests'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ requests table exists</p>";
} else {
    echo "<p style='color: red;'>❌ requests table does not exist</p>";
}

echo "<hr>";

// Check donations table
$result = $conn->query("SHOW TABLES LIKE 'donations'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ donations table exists</p>";
} else {
    echo "<p style='color: red;'>❌ donations table does not exist</p>";
}

echo "<hr>";

// Check admin table
$result = $conn->query("SHOW TABLES LIKE 'admin'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ admin table exists</p>";
} else {
    echo "<p style='color: red;'>❌ admin table does not exist</p>";
}

$conn->close();
?>