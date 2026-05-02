<?php 
include 'config/db_connect.php';
include 'includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_name = $_POST['patient_name'];
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];
    $hospital_name = $_POST['hospital_name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO requests (patient_name, blood_group, city, hospital_name, phone, message) 
            VALUES ('$patient_name', '$blood_group', '$city', '$hospital_name', '$phone', '$message')";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Blood Request Submitted Successfully!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<section class="form-container">
    <div class="section-title">
        <h2>Request Blood</h2>
        <p>Fill the form to request blood urgently</p>
    </div>
    <form method="POST" action="">
        <div class="form-group">
            <label>Patient Name</label>
            <input type="text" name="patient_name" required>
        </div>
        <div class="form-group">
            <label>Blood Group Required</label>
            <select name="blood_group" required>
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" required>
        </div>
        <div class="form-group">
            <label>Hospital Name</label>
            <input type="text" name="hospital_name">
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" name="phone" required>
        </div>
        <div class="form-group">
            <label>Message (Optional)</label>
            <textarea name="message" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Request</button>
    </form>
</section>

<?php include 'includes/footer.php'; ?>