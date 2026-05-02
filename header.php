<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Connect - Save a Life</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <i class="fas fa-heartbeat"></i> Blood Connect
                </div>
                <ul class="nav-links">
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#search">Find Donor</a></li>
                    <li><a href="index.php#request">Request Blood</a></li>
                    <li><a href="index.php#register">Become Donor</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="admin/index.php">Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>