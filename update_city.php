<?php
include 'config/db_connect.php';

echo "<h2>Update Donor City</h2>";
echo "<hr>";

// Get first donor
$donor = $conn->query("SELECT id, name, city FROM donors LIMIT 1")->fetch_assoc();

if ($donor) {
    echo "<p>Current Donor: <strong>{$donor['name']}</strong></p>";
    echo "<p>Current City: <strong>{$donor['city']}</strong></p>";
    
    // Update to match requests
    $new_city = 'New York'; // Change this to match your request city
    
    $sql = "UPDATE donors SET city = '$new_city' WHERE id = {$donor['id']}";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ City updated to: <strong>$new_city</strong></p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ No donors found!</p>";
}

echo "<p><a href='donor/donor-dashboard.php'>Go to Dashboard</a></p>";

$conn->close();
?>