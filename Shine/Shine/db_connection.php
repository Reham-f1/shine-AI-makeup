<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = ""; // إذا كنت تستخدم XAMPP الافتراضي، اتركه فارغًا
$dbname = "feedbacksystem"; // اسم قاعدة البيانات

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
}

?>