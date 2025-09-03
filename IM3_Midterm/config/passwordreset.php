<?php
$email = $_POST['email'];

$host = "localhost";     
$username = "root";     
$password = "";        
$database = "final_db"; 

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// First check if the email exists in the database
$check_sql = "SELECT * FROM users WHERE email = ?";
$check_stmt = $mysqli->prepare($check_sql);
$check_stmt->bind_param('s', $email);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows === 0) {
    echo "Email not found in database.";
    exit();
}

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$sql = "UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sss', $token_hash, $expiry, $email);
$stmt->execute();

if ($mysqli->affected_rows) {
    $mail = require("mailer.php");

    $mail->setFrom("wesleykyle20@gmail.com", 'noreply@gmail.com');
    $mail->addAddress($email);
    $mail->Subject = 'Password Reset';
        
    $mail->Body = <<<END
    <p>Click <a href="http://localhost/IM3_Midterm/config/passwordmail.php?token=$token">here</a> to reset your password.</p>
    <p>If you did not request a password reset, please ignore this email.</p>
    <p>This link will expire in 30 minutes.</p>
    END;

    try {
        $mail->send();
        echo 'Password reset email sent. Please check your inbox.     <a href="javascript:history.back()">Go Back</a>';
    } catch(Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}     <a href='javascript:history.back()'>Go Back</a>";
    }
} else {
    echo "Error updating password reset information.";
}

?>