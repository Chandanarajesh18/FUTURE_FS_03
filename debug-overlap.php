<?php
include 'config/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Debug Overlap</title>
    <style>
        * {
            outline: 2px solid red !important;
        }
        
        header {
            outline: 2px solid blue !important;
        }
        
        .hero {
            outline: 2px solid green !important;
        }
        
        .search-box {
            outline: 2px solid yellow !important;
        }
        
        main {
            outline: 2px solid purple !important;
        }
        
        footer {
            outline: 2px solid orange !important;
        }
    </style>
</head>
<body>
    <h1>Debug Overlap - All Elements Outlined</h1>
    <p>Red = All Elements</p>
    <p>Blue = Header</p>
    <p>Green = Hero</p>
    <p>Yellow = Search Box</p>
    <p>Purple = Main Content</p>
    <p>Orange = Footer</p>
    <br>
    <a href="index.php">Back to Homepage</a>
</body>
</html>