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
        .error-popup {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 15px;
            max-width: 90%;
            width: 400px;
            text-align: center;
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: none;
        }
        .close-btn {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="errorPopup" class="error-popup">
        <span class="close-btn" onclick="closePopup()">×</span>
        <p id="errorMessage"></p>
    </div>

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
            <button class="hbutt">REGISTER</button>
        </div>
    </header>

    <div class="loginctnr">
        <h2>Register</h2><br>
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
            <div class="logform">
            <select class="deprt" name="deprt" required>
                <option disabled selected value> -- Select your Department -- </option>
                <option value="BSIT">BSIT</option>
                <option value="BSPSYCH">BSPSYCH</option>
                <option value="BSHRM">BSHRM</option>
                <option value="BST">BST</option>
                <option value="BSBA">BSBA</option> 
                <option value="BSA">BSA</option>
            </select>
            </div>
            <button type="submit" class="sbmitlog">Register</button>
        </form>

        <?php
            session_start();
            
            $error_message = '';
            if (isset($_SESSION['registration_error'])) {
                $error_message = $_SESSION['registration_error'];
                unset($_SESSION['registration_error']); // Clear the error after getting it
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
            
            try {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $fname = trim($_POST['fname']);
                    $lname = trim($_POST['lname']);
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    $depart = trim($_POST['deprt']);
                
                    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($depart)) {
                        $_SESSION['registration_error'] = "Please fill in all fields.";
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, role, created_at, updated_at, department) 
                                            VALUES (:fname, :lname, :email, :password, 'student', NOW(), NOW(), :depart)");
                
                        $stmt->bindParam(':fname', $fname);
                        $stmt->bindParam(':lname', $lname);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':password', $hashedPassword);
                        $stmt->bindParam(':depart', $depart);
                
                        if ($stmt->execute()) {
                            header("Location: BaseHomePage.php");
                            exit;
                        } else {
                            $_SESSION['registration_error'] = "Error: Could not complete registration.";
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit;
                        }
                    }
                }
            } catch (PDOException $e) {
                // Check if it's a duplicate email error
                if ($e->getCode() == '23000' && strpos($e->getMessage(), "Duplicate entry") !== false && strpos($e->getMessage(), "email") !== false) {
                    $error_message = "This email address is already registered. Please use a different email or try to log in.";
                } else {
                    $error_message = "Database error: " . $e->getMessage();
                }
                
                $_SESSION['registration_error'] = $error_message;
                

                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        ?>
    </div>
    <?php include("config/footer.php") ?>

    <script>

        function showErrorPopup(message) {
            document.getElementById('errorMessage').innerText = message;
            document.getElementById('errorPopup').style.display = 'block';
            
            setTimeout(function() {
                closePopup();
            }, 6000);
        }
        
       
        function closePopup() {
            document.getElementById('errorPopup').style.display = 'none';
        }
        

        <?php if (!empty($error_message)): ?>
            document.addEventListener('DOMContentLoaded', function() {
                showErrorPopup(<?php echo json_encode($error_message); ?>);
            });
        <?php endif; ?>
    </script>
</body>
</html>