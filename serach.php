<?php 
include 'config/db_connect.php';
include 'includes/header.php';

// Get search parameters
$blood_group = isset($_GET['blood_group']) ? $_GET['blood_group'] : '';
$city = isset($_GET['city']) ? $_GET['city'] : '';

// Build query
$sql = "SELECT * FROM donors WHERE 1=1";
if ($blood_group) {
    $sql .= " AND blood_group = '$blood_group'";
}
if ($city) {
    $sql .= " AND city LIKE '%$city%'";
}
$sql .= " ORDER BY created_at DESC";

$result = $conn->query($sql);
?>

<section class="container" style="padding: 80px 20px;">
    <div class="section-title">
        <h2>Find Blood Donors</h2>
        <p>Search by blood group and city</p>
    </div>

    <!-- Search Form -->
    <div class="search-box" style="margin-bottom: 40px;">
        <form action="search.php" method="GET">
            <select name="blood_group">
                <option value="">All Blood Groups</option>
                <option value="A+" <?php echo $blood_group == 'A+' ? 'selected' : ''; ?>>A+</option>
                <option value="A-" <?php echo $blood_group == 'A-' ? 'selected' : ''; ?>>A-</option>
                <option value="B+" <?php echo $blood_group == 'B+' ? 'selected' : ''; ?>>B+</option>
                <option value="B-" <?php echo $blood_group == 'B-' ? 'selected' : ''; ?>>B-</option>
                <option value="O+" <?php echo $blood_group == 'O+' ? 'selected' : ''; ?>>O+</option>
                <option value="O-" <?php echo $blood_group == 'O-' ? 'selected' : ''; ?>>O-</option>
                <option value="AB+" <?php echo $blood_group == 'AB+' ? 'selected' : ''; ?>>AB+</option>
                <option value="AB-" <?php echo $blood_group == 'AB-' ? 'selected' : ''; ?>>AB-</option>
            </select>
            <input type="text" name="city" placeholder="Enter City" value="<?php echo $city; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Results -->
    <div class="stats-grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="stat-card">
                    <h3 style="color: var(--primary-color); font-size: 2rem;"><?php echo $row['blood_group']; ?></h3>
                    <h4><?php echo $row['name']; ?></h4>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $row['city']; ?></p>
                    <p><i class="fas fa-phone"></i> <?php echo $row['phone']; ?></p>
                    <p><i class="fas fa-envelope"></i> <?php echo $row['email']; ?></p>
                    <p><i class="fas fa-check-circle"></i> <?php echo $row['availability']; ?></p>
                    <a href="mailto:<?php echo $row['email']; ?>" class="btn btn-primary" style="margin-top: 15px;">Contact</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; grid-column: 1/-1;">No donors found matching your criteria.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>