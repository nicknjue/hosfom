<?php
// databaseconn.php - database connection using PDO

$servername = "localhost";
$username = "root";       // your MySQL username
$password = "4321";       // your MySQL password
$dbname = "hosform";      // the database you created

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Uncomment the line below to test connection
    // echo "✅ DB connection successful using PDO!";
} catch(PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>

