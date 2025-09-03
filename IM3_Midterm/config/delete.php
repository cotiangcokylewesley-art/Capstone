<?php
session_start();
include('database.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: adminlogin.php");
    exit();
}


if (isset($_GET['user_id'])) {

    $user_id = (int)$_GET['user_id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute(); 
    $stmt->close();
}

header('location: ../adminpanel.php');
exit;
?>
