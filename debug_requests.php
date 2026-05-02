<?php
session_start();
include 'config/db_connect.php';

// Check if logged in
if (!isset($_SESSION['donor_id'])) {
    echo "<p style='color: red;'>❌ Not logged in! <a href='donor-login.php'>Login</a></p>";
    exit();
}

$donor_id = $_SESSION['donor_id'];

// Get donor info
$donor = $conn->query("SELECT name, city FROM donors WHERE id = $donor_id")->fetch_assoc();

echo "<h2>Debug Requests</h2>";
echo "<hr>";
echo "<p>Donor: <strong>{$donor['name']}</strong></p>";
echo "<p>City: <strong>{$donor['city']}</strong></p>";
echo "<hr>";

// Check requests in donor's city
$requests = $conn->query("SELECT * FROM requests WHERE city = '{$donor['city']}'");

echo "<p>Requests in your city: <strong>{$requests->num_rows}</strong></p>";

if ($requests->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Patient</th><th>Blood Group</th><th>City</th><th>Phone</th></tr>";
    while($req = $requests->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$req['patient_name']}</td>";
        echo "<td>{$req['blood_group']}</td>";
        echo "<td>{$req['city']}</td>";
        echo "<td>{$req['phone']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: orange;'>⚠️ No requests found in your city!</p>";
    echo "<p><a href='add_matching_requests.php'>Add Matching Requests</a></p>";
}

$conn->close();
?>