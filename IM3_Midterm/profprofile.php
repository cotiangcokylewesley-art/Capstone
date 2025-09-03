<?php
require("config/authuser.php");
if ($_SESSION['role'] != 'teacher') {
    header('Location: config/unauth.php');
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <link rel="shortcut icon" href="imgs/favicon1.ico"type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="BaseHomePage.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
</head>
<style>
body {
    background-image: url("imgs/baste.jpg");
    background-size: cover;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f4f4f4; 
    margin: 0;
    padding: 0;
    align-items: center;
}
 
h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.imgcontainer {
    width: 100%;
    max-width: 600px;
    display: flex;
    align-items: center;
    background-color: #fff; 
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.profpic {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


.text-container {
    padding-left: 30px;
}

.text-container h2, .text-container h4 {
    margin: 0;
    padding: 0;
    color: #333;
}

.formfile {
    background-color: #fff; 
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

.info {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 10px 0;
    border-bottom: 1px solid #eee; 
}

.info p {
    margin: 0;
    color: #555;
}

.info p:first-child {
    font-weight: bold;
}

.info p a {
    color: #007bff; 
}

#pencil {
    color: #007bff; 
    margin-bottom: 10px;
    display: block;
}   

.omergerd {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-items: center;
}
</style>
<body>

<?php include("config/headerprof.php")?>



<div class="omergerd">
    <h1><b>My Profile</b></h1>
    <div class="imgcontainer">
        <img src='imgs/profpic.png' alt='Profile Picture' class='profpic'>
        <div class="text-container">
            <h2>Kyle Wesley Cotiangco</h2>
            <h4>College Student</h4>
        </div>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="formfile">
        <i class="glyphicon glyphicon-pencil" id="pencil"><a href="#">Edit Information</a></i>
        <div class="info">
            <p>First Name</p>
            <p class="fname">Kyle Wesley</p>
        </div>
        <div class="info">
            <p>Last Name</p>
            <p class="lname">Cotiangco</p>
        </div>
        <div class="info">
            <p>Role</p>
            <p class="role">College Student</p>
        </div>
        <div class="info">
            <p>E-mail</p>
            <p class="email">kycotiangco@sscrcan.edu.ph</p>
        </div>
        <div class="info">
            <p>Phone number</p>
            <p class="pnum">+63 916 282 4681</p>
        </div>
        <div class="info">
            <p>Password</p>
            <p><a href="#">Change password</a></p>
        </div>
    </form>
</div>

    <?php include("config/footer.php") ?>

</body>
</html>