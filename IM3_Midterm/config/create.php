<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: adminlogin.php");
    exit();
}

$host = 'localhost';
$db   = 'final_db';
$user = 'root';
$pass = '';



try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $depart = trim($_POST['deprt']);

    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($role) || empty($depart)) {
        $message = "Please fill in all fields.";
    } else {

        $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();
        $emailExists = $checkEmail->fetchColumn();

        if ($emailExists > 0) {
            $message = "Email address already exists. Please use a different email.";
        } else {
            try {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, role, created_at, updated_at, department, status)
                                        VALUES (:fname, :lname, :email, :password, :role, NOW(), NOW(), :depart, 'approved')");

                $stmt->bindParam(':fname', $fname);
                $stmt->bindParam(':lname', $lname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':depart', $depart);

                $stmt->execute();
                $message = "User created successfully!";
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $message = "Email address already exists. Please use a different email.";
                } else {
                    $message = "Error creating user: " . $e->getMessage();
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../BaseHomePage.css">
    <link rel="stylesheet" href="../login.css">
    <script src="basehomepage.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Sebastian College-Recoletos, Canlubang</title>
</head>
<body>
<?php include('headeradm.php')?>
<div class="loginctnr">
        <h2>Create User</h2><br>

        <form method="POST">
        <div class="logform">
                        <label>First name</label><br>
                        <input type="text" name="fname" required>
                    </div>
                    <div class="logform">
                        <label>Last name</label><br>
                        <input type="text" name="lname" required>
                    </div>
                    <div class="logform">
                        <label>Email</label><br>
                        <input type="email" name="email" required>
                    </div>
                    <div class="logform">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <select class="role" name="role" required>
                        <option disabled selected value> -- Select Role -- </option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>
                    <div class="logform">
                    <select class="deprt" name="deprt" required>
                        <option disabled selected value> -- Select Department -- </option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSPSYCH">BSPSYCH</option>
                        <option value="BSHRM">BSHRM</option>
                        <option value="BST">BST</option>
                        <option value="BSBA">BSBA</option>
                        <option value="BSA">BSA</option>
                        <option value="Professor">Professor</option>
                        <option value="admin">Admin</option>
                    </select>
                    </div>
                    <button type="submit" class="sbmitlog">Create</button>
                    <button class="sbmitlog" onclick="window.location.href='../adminpanel.php'">Go back</button>
        </form>
    </div>
<?php
    if(!empty($message)) {
       echo "<p class='infmessage'>$message</p>";
    }
?>
</body>
</html>