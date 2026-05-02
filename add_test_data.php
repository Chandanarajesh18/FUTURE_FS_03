<?php
include 'config/db_connect.php';

echo "<h2>Add Test Data</h2>";
echo "<hr>";

// Check if donors exist
$donor_check = $conn->query("SELECT COUNT(*) as total FROM donors");
$donor_count = $donor_check->fetch_assoc()['total'];

if ($donor_count == 0) {
    echo "<p style='color: orange;'>⚠️ No donors found. Register a donor first!</p>";
    echo "<p><a href='donor-register.php'>Register Donor</a></p>";
} else {
    echo "<p>✅ Found <strong>$donor_count</strong> donor(s)</p>";
    
    // Get first donor ID
    $first_donor = $conn->query("SELECT id FROM donors LIMIT 1")->fetch_assoc();
    $donor_id = $first_donor['id'];
    
    // Add test donations
    $test_donations = [
        [
            'donor_id' => $donor_id,
            'blood_group' => 'O+',
            'hospital_name' => 'City Hospital',
            'city' => 'New York',
            'donation_date' => '2024-01-15'
        ],
        [
            'donor_id' => $donor_id,
            'blood_group' => 'O+',
            'hospital_name' => 'City Hospital',
            'city' => 'New York',
            'donation_date' => '2024-02-20'
        ],
        [
            'donor_id' => $donor_id,
            'blood_group' => 'O+',
            'hospital_name' => 'City Hospital',
            'city' => 'New York',
            'donation_date' => '2024-03-10'
        ]
    ];
    
    $count = 0;
    foreach ($test_donations as $donation) {
        $sql = "INSERT INTO donations (donor_id, blood_group, hospital_name, city, donation_date) 
                VALUES ('{$donation['donor_id']}', '{$donation['blood_group']}', '{$donation['hospital_name']}', '{$donation['city']}', '{$donation['donation_date']}')";
        
        if ($conn->query($sql)) {
            $count++;
        }
    }
    
    echo "<p style='color: green;'>✅ Added <strong>$count</strong> test donation(s)</p>";
}

// Add test blood requests
$request_check = $conn->query("SELECT COUNT(*) as total FROM requests");
$request_count = $request_check->fetch_assoc()['total'];

if ($request_count == 0) {
    echo "<p>Adding test blood requests...</p>";
    
    $test_requests = [
        [
            'patient_name' => 'John Smith',
            'blood_group' => 'A+',
            'city' => 'New York',
            'hospital_name' => 'City Hospital',
            'phone' => '9876543210',
            'message' => 'Urgent need for blood'
        ],
        [
            'patient_name' => 'Mary Johnson',
            'blood_group' => 'B+',
            'city' => 'New York',
            'hospital_name' => 'City Hospital',
            'phone' => '9876543211',
            'message' => 'Blood needed for surgery'
        ],
        [
            'patient_name' => 'Robert Brown',
            'blood_group' => 'O+',
            'city' => 'New York',
            'hospital_name' => 'City Hospital',
            'phone' => '9876543212',
            'message' => 'Emergency blood donation needed'
        ]
    ];
    
    $count = 0;
    foreach ($test_requests as $request) {
        $sql = "INSERT INTO requests (patient_name, blood_group, city, hospital_name, phone, message) 
                VALUES ('{$request['patient_name']}', '{$request['blood_group']}', '{$request['city']}', '{$request['hospital_name']}', '{$request['phone']}', '{$request['message']}')";
        
        if ($conn->query($sql)) {
            $count++;
        }
    }
    
    echo "<p style='color: green;'>✅ Added <strong>$count</strong> test request(s)</p>";
} else {
    echo "<p>✅ Found <strong>$request_count</strong> request(s) already</p>";
}

echo "<hr>";
echo "<p style='color: green;'><strong>✅ Test data added successfully!</strong></p>";
echo "<p><a href='donor/donor-dashboard.php'>Go to Dashboard</a></p>";

$conn->close();
?>