<?php
include 'config/db_connect.php';

echo "<h2>Donor Dashboard Fix</h2>";
echo "<hr>";

// Check if donors table exists
$result = $conn->query("SHOW TABLES LIKE 'donors'");
if ($result->num_rows == 0) {
    echo "<p style='color: red;'>❌ donors table missing - Creating...</p>";
    
    $sql = "CREATE TABLE donors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        blood_group VARCHAR(10) NOT NULL,
        phone VARCHAR(20) NOT NULL UNIQUE,
        email VARCHAR(100),
        city VARCHAR(100) NOT NULL,
        address TEXT,
        password VARCHAR(255),
        availability VARCHAR(50) DEFAULT 'Available',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ donors table created!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✅ donors table exists</p>";
}

// Check if requests table exists
$result = $conn->query("SHOW TABLES LIKE 'requests'");
if ($result->num_rows == 0) {
    echo "<p style='color: red;'>❌ requests table missing - Creating...</p>";
    
    $sql = "CREATE TABLE requests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        patient_name VARCHAR(100) NOT NULL,
        blood_group VARCHAR(10) NOT NULL,
        city VARCHAR(100) NOT NULL,
        hospital_name VARCHAR(100),
        phone VARCHAR(20) NOT NULL,
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ requests table created!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✅ requests table exists</p>";
}

// Check if donations table exists
$result = $conn->query("SHOW TABLES LIKE 'donations'");
if ($result->num_rows == 0) {
    echo "<p style='color: red;'>❌ donations table missing - Creating...</p>";
    
    $sql = "CREATE TABLE donations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        donor_id INT,
        blood_group VARCHAR(10),
        hospital_name VARCHAR(100),
        city VARCHAR(100),
        donation_date DATE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (donor_id) REFERENCES donors(id)
    )";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ donations table created!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✅ donations table exists</p>";
}

// Check if admin table exists
$result = $conn->query("SHOW TABLES LIKE 'admin'");
if ($result->num_rows == 0) {
    echo "<p style='color: red;'>❌ admin table missing - Creating...</p>";
    
    $sql = "CREATE TABLE admin (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ admin table created!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✅ admin table exists</p>";
}

// Add password column to donors if not exists
$columns = $conn->query("SHOW COLUMNS FROM donors LIKE 'password'");
if ($columns->num_rows == 0) {
    echo "<p style='color: red;'>❌ password column missing - Adding...</p>";
    
    $sql = "ALTER TABLE donors ADD COLUMN password VARCHAR(255) DEFAULT NULL";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ password column added!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✅ password column exists</p>";
}

// Add availability column to donors if not exists
$columns = $conn->query("SHOW COLUMNS FROM donors LIKE 'availability'");
if ($columns->num_rows == 0) {
    echo "<p style='color: red;'>❌ availability column missing - Adding...</p>";
    
    $sql = "ALTER TABLE donors ADD COLUMN availability VARCHAR(50) DEFAULT 'Available'";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ availability column added!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✅ availability column exists</p>";
}

// Add address column to donors if not exists
$columns = $conn->query("SHOW COLUMNS FROM donors LIKE 'address'");
if ($columns->num_rows == 0) {
    echo "<p style='color: red;'>❌ address column missing - Adding...</p>";
    
    $sql = "ALTER TABLE donors ADD COLUMN address TEXT DEFAULT NULL";
    
    if ($conn->query($sql)) {
        echo "<p style='color: green;'>✅ address column added!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: green;'>✅ address column exists</p>";
}

echo "<hr>";
echo "<p style='color: green;'><strong>✅ Fix Complete! Try accessing donor-dashboard.php again.</strong></p>";

$conn->close();
?>