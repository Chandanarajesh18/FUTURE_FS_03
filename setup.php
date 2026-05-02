<?php
echo "<h2>Project Setup Check</h2>";

$checks = [
    "Project Root" => __DIR__,
    "index.php exists" => file_exists(__DIR__ . '/index.php'),
    "config/db_connect.php exists" => file_exists(__DIR__ . '/config/db_connect.php'),
    "assets/css/style.css exists" => file_exists(__DIR__ . '/assets/css/style.css'),
    "admin/index.php exists" => file_exists(__DIR__ . '/admin/index.php'),
    "includes/header.php exists" => file_exists(__DIR__ . '/includes/header.php'),
    "includes/footer.php exists" => file_exists(__DIR__ . '/includes/footer.php'),
];

foreach ($checks as $name => $result) {
    echo "<p><strong>$name:</strong> " . ($result ? "✅ Yes" : "❌ No") . "</p>";
}

echo "<hr>";
echo "<h3>Folder Structure:</h3>";
echo "<ul>";
foreach (glob(__DIR__ . '/*', GLOB_ONLYDIR) as $dir) {
    echo "<li>" . basename($dir) . "</li>";
}
echo "</ul>";
?>