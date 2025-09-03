<?php
// Set secure session parameters BEFORE session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
session_start();

$host = 'localhost';
$db   = 'final_db';
$user = 'root';
$pass = '';
$message = '';
$error = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Email and password are required";
    } else {
        $stmt = $conn->prepare("SELECT user_id, email, password, role, status FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                if ($user['role'] === 'student' && $user['status'] === 'approved') {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];

                    session_regenerate_id(true);

                    header("Location: usermainpage.php");
                    exit();
                } elseif ($user['role'] === 'teacher') {
                    $error = "Please use the teacher login page";
                } elseif ($user['status'] === 'pending') {
                    $error = "Your account is pending approval";
                } else {
                    $error = "Account not approved or invalid status";
                }
            } else {
                $error = "Invalid email or password";
            }
        } else {
            $error = "Invalid email or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="BaseHomePage.css">
    <link rel="stylesheet" href="login.css">
    <script src="basehomepage.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Sebastian College-Recoletos, Canlubang</title>
    <style>
        .message-container {
            margin: 10px 0;
            min-height: 20px;
        }
        .error {
            color: #e74c3c;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
        .infmessage {
            color: #3498db;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <div class="upperhead">
            <img src="imgs/header.png" class="headlogo">
            <button class="headbutton">OFFICIAL WEBSITE</button>
        </div>
        <div class="lowerhead">
            <button class="hbutt" onclick="location.href='BaseHomePage.php'">HOME</button>
            <button class="hbutt" onclick="window.open('imgs/docu.pdf', '_blank');">DOCUMENTATION</button>
            <button class="hbutt">PROFILE</button>
            <div class="dropdown">
                <button class="hbutt" id="dropbtn">LOGIN <i class="glyphicon glyphicon-triangle-bottom" style="font-size: 12px;"></i></button>
                <div class="dropship">
                    <a href="admlogin.php">Admin Login</a>
                    <a href="proflogin.php">Teacher Login</a>
                    <a href="userlogin.php">Student Login</a>
                </div>
            </div>
            <button class="hbutt" onclick="location.href='register.php'">REGISTER</button>
        </div>
    </header>

    <div class="loginctnr">
        <h2>Student Login</h2>
        <div class="message-container">
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if (!empty($message)): ?>
                <div class="infmessage"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
        </div>
        <form method="POST">
            <div class="logform">
                <label>Email</label><br>
                <input type="email" name="email" required>
            </div>
            <div class="logform">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="remfor">
                <a href="config/passwordforgot.php">Forgot Password?</a>
            </div>
            <button type="submit" class="sbmitlog">Login</button>
        </form>
    </div>

    <?php include("config/footer.php") ?>
</body>
</html>