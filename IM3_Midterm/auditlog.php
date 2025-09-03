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
    <link rel="stylesheet" href="BaseHomePage.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs</title>
    <style>
        body {
            background-image: url("imgs/baste.jpg");
            background-size: cover;
            margin: 0;
            padding: 0;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: white;
        } 

        .logtab {
            width: 60%; 
            justify-self: center;
        }

        .topbar {
            display: flex;
            justify-content: center;
            gap: 15px; 
            margin-bottom: 30px; 
            background-color: rgba(0, 0, 0, 0.7); 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); 
            flex-wrap: wrap; 
        }

        .search, .filter, .date-picker {
            padding: 10px 15px; 
            border-radius: 8px; 
            border: 1px solid #ddd;
            background-color: rgba(255, 255, 255, 0.9); 
            color: #333;
            font-size: 16px; 
            flex: 1;
            min-width: 150px;
        }

        .appli {
            padding: 12px 25px; 
            background-color: #da121a;
            color: white;
            border: none;
            border-radius: 8px; 
            cursor: pointer;
            margin-top: 10px; 
            font-size: 16px; 
            cursor: pointer;
            transition: background-color 0.3s ease;
            height: 100%;
        }

        .appli:hover {
            background-color:rgb(255, 31, 39);
        }



        /*sdphjwoqgiuqeuyqwiueyqiyduyauysussssssssssssss */
        table {
            width: 100%; 
            border-collapse: collapse;
            margin-top: 30px; 
            background-color: rgba(255, 255, 255, 0.9); 
            color: #333;
            border-radius: 10px; 
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); 
        }

        th, td {
            padding: 15px 20px; 
            text-align: left;
            font-size: 16px; 
        }

        th {
            background-color: #f8f8f8; 
            font-weight: 600; 
        }

        tr:hover {
            background-color: #f9f9f9; 
        }

       

        h1 {
            text-align: center;
            margin-top: 30px; 
            color: black;
            font-size: 2.5em; 
        }
    </style>
</head>



<body> 

<?php include('config/headeradm.php')?>



    <div class="logtab">
        <h1>Audit Logs</h1>
        <div class="topbar">
            <input type="text" class="search" placeholder="Search...">

            <select class="filter">
                <option value="">All Actions</option>
                <option value="lgin">Log In</option>
                <option value="lgout">Log Out</option>
                <option value="edi">Edit</option>
                <option value="cre">Create</option>
                <option value="del">Delete</option>
            </select>

            <select class="filter">
                <option value="">All Users</option>
                <option value="admin">Admins</option>
                <option value="user">Students</option>
                <option value="system">Teachers</option>
            </select>

            <input type="date" class="date-picker" placeholder="From">
            <input type="date" class="date-picker" placeholder="To">
            <button class="appli">Apply Filters</button>
        </div>
        

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Timestamp</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-03-30 14:25:32</td>
                    <td>is.babao</td>
                    <td>Student</td>
                    <td>Log in</td>
                </tr>
                <tr>
                    <td>2025-03-30 14:22:18</td>
                    <td>de.eje</td>
                    <td>Student</td>
                    <td>Log out</td>
                </tr>
                <tr>
                    <td>2025-03-30 14:15:42</td>
                    <td>ky.cotiangco</td>
                    <td>Admin</td>
                    <td>Delete</td>
                </tr>
                <tr>
                    <td>2025-03-30 14:10:05</td>
                    <td>an.angeles</td>
                    <td>Student</td>
                    <td>Edit</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>