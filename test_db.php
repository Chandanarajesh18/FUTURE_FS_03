<?php
include 'config/db_connect.php';

echo "<h2>Check Donor & Request Cities</h2>";
echo "<hr>";

// Check donor city
$donor = $conn->query("SELECT id, name, city FROM donors LIMIT 1")->fetch_assoc();
if ($donor) {
    echo "<p>✅ Donor: <strong>{$donor['name']}</strong></p>";
    echo "<p>📍 Donor City: <strong>{$donor['city']}</strong></p>";
} else {
    echo "<p style='color: red;'>❌ No donors found!</p>";
}

echo "<hr>";

// Check requests
$requests = $conn->query("SELECT patient_name, blood_group, city FROM requests");
echo "<p>📋 Blood Requests:</p>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Patient</th><th>Blood Group</th><th>City</th></tr>";
while($req = $requests->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$req['patient_name']}</td>";
    echo "<td>{$req['blood_group']}</td>";
    echo "<td><strong>{$req['city']}</strong></td>";
    echo "</tr>";
}
echo "</table>";

echo "<hr>";
echo "<p><strong>⚠️ Make sure donor city matches request city!</strong></p>";

$conn->close();
?>