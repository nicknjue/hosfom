<?php
require_once "databaseconn.php";

$db = new Database();
if ($db->conn) {
    echo "✅ Connection successful!";
}
$db->close();
?>
