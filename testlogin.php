<?php
session_start();
$_SESSION['test'] = "hello";
header("Location: testdashboard.php");
exit();
