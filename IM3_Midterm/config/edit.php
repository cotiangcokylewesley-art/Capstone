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

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$user_id = '';
$fname = '';
$lname = '';
$email = '';
$password = '';
$role = '';
$depart = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $sql = "SELECT user_id, first_name, last_name, email, password, role, department FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $email = $row['email'];
            $password = $row['password'];
            $role = $row['role'];
            $depart = $row['department'];
        } else {
            $message = "User not found";
        }
        $stmt->close();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form submission
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];
    $depart = $_POST['deprt'];
    
    if(isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        // Update existing user
        $user_id = $_POST['user_id'];
        $sql = "UPDATE users SET first_name=?, last_name=?, email=?, password=?, role=?, department=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $fname, $lname, $email, $password, $role, $depart, $user_id);
        
        if($stmt->execute()) {
            $message = "User updated successfully!";
        } else {
            $message = "Error updating user: " . $conn->error;
        }
    } else {
        // Create new user
        $sql = "INSERT INTO users (first_name, last_name, email, password, role, department) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fname, $lname, $email, $password, $role, $depart);
        
        if($stmt->execute()) {
            $message = "User created successfully!";
            // Clear form fields after successful creation
            $fname = $lname = $email = $password = $role = $depart = '';
        } else {
            $message = "Error creating user: " . $conn->error;
        }
    }
    $stmt->close();
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
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="logform">
                        <label>First name</label><br>
                        <input type="text" name="fname" value="<?php echo $fname; ?>" required>
                    </div>
                    <div class="logform">
                        <label>Last name</label><br>
                        <input type="text" name="lname" value="<?php echo $lname; ?>" required>
                    </div>
                    <div class="logform">
                        <label>Email</label><br>
                        <input type="email" name="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="logform">
                        <label>Password</label>
                        <input type="password" name="password" <?php if(!empty($user_id)): ?>placeholder="Leave blank to keep current password"<?php else: ?>required<?php endif; ?>>
                    </div>
                    <select class="role" name="role" required>
                        <option disabled <?php echo empty($role) ? 'selected' : ''; ?> value> -- Select Role -- </option>
                        <option value="student" <?php echo ($role == 'student') ? 'selected' : ''; ?>>Student</option>
                        <option value="teacher" <?php echo ($role == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
                        <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                    <div class="logform">
                    <select class="deprt" name="deprt" required>
                        <option disabled <?php echo empty($depart) ? 'selected' : ''; ?> value> -- Select Department -- </option>
                        <option value="BSIT" <?php echo ($depart == 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
                        <option value="BSPSYCH" <?php echo ($depart == 'BSPSYCH') ? 'selected' : ''; ?>>BSPSYCH</option>
                        <option value="BSHRM" <?php echo ($depart == 'BSHRM') ? 'selected' : ''; ?>>BSHRM</option>
                        <option value="BST" <?php echo ($depart == 'BST') ? 'selected' : ''; ?>>BST</option>
                        <option value="BSBA" <?php echo ($depart == 'BSBA') ? 'selected' : ''; ?>>BSBA</option>
                        <option value="BSA" <?php echo ($depart == 'BSA') ? 'selected' : ''; ?>>BSA</option>
                        <option value="Professor" <?php echo ($depart == 'Professor') ? 'selected' : ''; ?>>Professor</option>
                        <option value="admin" <?php echo ($depart == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                    </div>
                    <button type="submit" class="sbmitlog"><?php echo !empty($user_id) ? 'Update' : 'Create'; ?></button>
                    <a href="../adminpanel.php" class="sbmitlog" style="text-decoration:none; display:inline-block; text-align:center;">Go back</a>
        </form>
    </div>
<?php
    if(!empty($message)) {
       echo "<p class='infmessage'>$message</p>";
    }
?>
</body>
</html>