<!DOCTYPE html>
<html lang="en">
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
            <button class="headbutton">OFFICIAL WEBSITE</button>
        </div>
        <div class="lowerhead">
            <button class="hbutt" onclick="location.href='../BaseHomePage.php'">HOME</button>
            <button class="hbutt" onclick="window.open('imgs/docu.pdf', '_blank');">DOCUMENTATION</button>
            <button class="hbutt">PROFILE</button>
            <div class="dropdown">
                <button class="hbutt" id="dropbtn">LOGIN <i class="glyphicon glyphicon-triangle-bottom" style="font-size: 12px;"></i></button>
                <div class="dropship">
                    <a href="../admlogin.php">Admin Login</a>
                    <a href="../proflogin.php">Teacher Login</a>
                    <a href="../userlogin.php">Student Login</a>
                </div>
            </div>
            <button class="hbutt">REGISTER</button>
        </div>
    </header>

    <div class="loginctnr">
        <h2>Forgot Password</h2><br>
        <form method="POST" action="passwordreset.php">
            <div class="logform">
                <label>Email</label><br>
                <input type="email" name="email" required>
            <button type="submit" class="sbmitlog">Submit</button>
        </form>

    </div>
</div>
<div class="poop">

</div>
    <?php include("footer.php") ?>

</body>


</html>