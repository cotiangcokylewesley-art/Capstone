<?php
session_start();
include('database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: adminlogin.php");
    exit();
}

if (isset($_GET['user_id'])) {
    $user_id = (int)$_GET['user_id'];
    
    $stmt = $conn->prepare("UPDATE users SET status = 'approved' WHERE user_id = ?");
    $stmt->bind_param("i", $user_id); // Changed "s" to "i" for integer
    
    if (!$stmt->execute()) {
        $_SESSION['error_message'] = "Error updating user: " . $conn->error;
    } else {
        $_SESSION['success_message'] = "User successfully approved";
    }
    
    $stmt->close();
}

header('Location: ../adminapproval.php'); 
exit;
?>