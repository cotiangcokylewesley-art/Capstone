<?php
require("database.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: basehomepage.php");
    exit();
}

// Binding
function getUserRole($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT role FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['role'];
    }
    return null; 
}

?>