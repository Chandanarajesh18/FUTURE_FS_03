<?php
include 'config/db_connect.php';

echo "<h2>Add Matching Requests</h2>";
echo "<hr>";

// Get donor city
$donor = $conn->query("SELECT city FROM donors LIMIT 1")->fetch_assoc();
$donor_city = $donor['city'] ?? 'New York';

echo "<p>Donor City: <strong>$donor_city</strong></p>";

// Add requests with matching city
$requests = [
    ['John Smith', 'A+', '9876543210'],
    ['Mary Johnson', 'B+', '9876543211'],
    ['Robert Brown', 'O+', '9876543212']
];

$count = 0;
foreach ($requests as $req) {
    $sql = "INSERT INTO requests (patient_name, blood_group, city, hospital_name, phone, message) 
            VALUES ('{$req[0]}', '{$req[1]}', '$donor_city', 'City Hospital', '{$req[2]}', 'Urgent need')";
    
    if ($conn->query($sql)) {
        $count++;
    }
}

echo "<p style='color: green;'>✅ Added <strong>$count</strong> request(s) with matching city!</p>";
echo "<p><a href='donor/donor-dashboard.php'>Go to Dashboard</a></p>";

$conn->close();
?>