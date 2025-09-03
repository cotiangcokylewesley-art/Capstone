<?php
$token = $_POST['token'];

$token_hash = hash('sha256', $token);

require ('database.php');

$sql = 'SELECT * FROM users WHERE reset_token = ?';

$stmt = $conn->prepare($sql);

$stmt->bind_param('s' , $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["token_expiry"]) <= time()) {
    die("token has expired <a href=\"javascript:history.go(-1)\">GO BACK</a>");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match <a href=\"javascript:history.go(-1)\">GO BACK</a>");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password = ?,
            reset_token = NULL,
            token_expiry = NULL
        WHERE user_id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["user_id"]);

$stmt->execute();

echo "Password updated. You can now login.<a href = '../basehomepage.php'>Go back to home page</a>";
?>