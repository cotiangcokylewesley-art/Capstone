<?php
$token = $_GET['token'];

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
    die("token has expired");
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../BaseHomePage.css">
    <link rel="stylesheet" href="../login.css">
    <script src="../basehomepage.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Sebastian College-Recoletos, Canlubang</title>
</head>
<body>
<header>
        <div class="upperhead">
            <img src="imgs/header.png" class="headlogo">
            <a href="https://sscrmnl.edu.ph" target="_blank"><button class="headbutton">OFFICIAL WEBSITE</button></a>
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
                    <a href="userlogin.php" >Student Login</a>
                </div>
            </div>
            <button class="hbutt" onclick="location.href='register.php'">REGISTER</button>
        </div>
    </header>

    <div class="loginctnr">
        <h2>Password reset</h2><br>
        <form method="POST" action="passwordresetprocess.php" >       
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    
            <div class="logform">
                <label>New Password</label><br>
                <input type="password" name="password" id="password" required>
            </div>  
            <div class="logform">
                <label>Repeat Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>  
            <button type="submit" class="sbmitlog">Login</button>
        </form>
    </div>

    <?php include('footer.php')?>

</body>
</html>