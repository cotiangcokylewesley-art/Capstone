<?php
require("config/authuser.php");
if ($_SESSION['role'] != 'admin') {
    header('Location: config/unauth.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="shortcut icon" href="imgs/favicon1.ico"type="image/x-icon">  
    <meta charset="UTF-8">
    <link rel="stylesheet" href="BaseHomePage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
         body {
            background-image: url("imgs/baste.jpg");
            background-size: cover;
            margin: 0;
            padding: 0;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: rgba(255, 255, 255);
            color: #333;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .table-container {
            width: 70%;
            justify-self: center;
            margin-top: 100px;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            font-size: 16px;
        }

        td {
            background-color: rgba(255, 255, 255, 0.7);
        }

        th {
            background-color: #f8f8f8;
            font-weight: 600;
        }

        .admpanel {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .admpanel th, .admpanel td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .admpanel th {
            background-color: #f2f2f2;
            font-weight: bold;
        }


        .editbtn, .deletbtn, .creabtn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; 
            display: inline-block; 
        }

        .editbtn {
            background-color: #4CAF50;
            color: white;
        }

        .creabtn {
            background-color:rgb(255, 191, 0);
            color: white;
            font-size: 20px;
        }

        .deletbtn {
            background-color: #f44336;
            color: white;
        }

        .editbtn:hover {
            background-color: #45a049;
        }

        .deletbtn:hover {
            background-color: #d32f2f;
        }

    </style>
</head>
<body> 

<?php include('config/headeradm.php')?>

    <div class="table-container">
    <a class="creabtn" href="adminpanel.php" role="button">Go Back</a>
        <table class="table">
        <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>Full name</th>
                    <th>Role</th>
                    <th>E-mail</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $panel = $conn->prepare('SELECT user_id, first_name, last_name, role, email, created_at FROM users WHERE status = "pending"');
                $panel->execute();
                $results = $panel->get_result();

                while($row = $results->fetch_assoc()) {
                    echo "
                <tr>
                    <td>$row[user_id]</td>
                    <td>$row[first_name] $row[last_name]</td>
                    <td>$row[role]</td>
                    <td>$row[email]</td>
                    <td>$row[created_at]</td>   
                    <td>
                        <a class='editbtn' href='config/approve.php?user_id=$row[user_id]'>APPROVE</a>
                    </td>
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include('config/footer.php')?>

                
</body>
</html>