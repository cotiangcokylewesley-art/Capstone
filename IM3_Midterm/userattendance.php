<?php
require("config/authuser.php"); 
if ($_SESSION['role'] != 'student') {
    header('Location: config/unauth.php'); 
    exit; 
}

$host = "localhost";
$username = "root"; 
$password = "";     
$database = "final_db"; 

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); 
}

function calculateDuration($in_time, $out_time) {
    if ($in_time === null || $out_time === null) {
        return "N/A";
    }
    $start_time = strtotime($in_time);
    $end_time = strtotime($out_time);
    $duration_seconds = $end_time - $start_time;

    if ($duration_seconds < 0) {
        return "N/A"; 
    }

    $hours = floor($duration_seconds / 3600);
    $minutes = floor(($duration_seconds % 3600) / 60);
    return sprintf("%dh %dm", $hours, $minutes);
}

function getAttendanceStatus($in_time, $out_time) {
    if ($in_time === null && $out_time === null) {
        return "Absent";
    }
    if ($in_time === null || $out_time === null){
        return "Incomplete";
    }

    $in_time_obj = DateTime::createFromFormat('H:i:s', date('H:i:s', strtotime($in_time)));
    $late_time_obj = DateTime::createFromFormat('H:i:s', '08:10:00'); 

    if ($in_time_obj > $late_time_obj) {
        return "Late";
    }
    return "Present";
}

$search_term = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$course_filter = isset($_GET['course']) ? mysqli_real_escape_string($conn, $_GET['course']) : '';
$date_filter = isset($_GET['date']) ? mysqli_real_escape_string($conn, $_GET['date']) : '';

$filter_conditions = []; 
if (!empty($search_term)) {
    $filter_conditions[] = "(first_name LIKE '%$search_term%' OR last_name LIKE '%$search_term%' OR user_id LIKE '%$search_term%')";
}
if (!empty($course_filter)) {
    $filter_conditions[] = "course = '$course_filter'";
}
if (!empty($date_filter)) {
    $filter_conditions[] = "attendance_date = '$date_filter'";
}

$where_clause = '';
if (!empty($filter_conditions)) {
    $where_clause = "WHERE " . implode(" AND ", $filter_conditions);
}

$sql = "SELECT attendance_id, user_id, first_name, last_name, course, in_time, out_time, attendance_date FROM attendance_time $where_clause";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error retrieving data: " . mysqli_error($conn)); 
}

//count stuff
$total_students = mysqli_num_rows($result);
$present_count = 0;
$late_count = 0;
$absent_count = 0;
$incomplete_count = 0;

$student_data = []; 
while ($row = mysqli_fetch_assoc($result)) {
    $status = getAttendanceStatus($row['in_time'], $row['out_time']);
    $duration = calculateDuration($row['in_time'], $row['out_time']);

    if ($status == "Present") {
        $present_count++;
    } elseif ($status == "Late") {
        $late_count++;
    } elseif ($status == "Absent") {
        $absent_count++;
    }
    elseif ($status == "Incomplete"){
        $incomplete_count++;
    }

    $student_data[] = [
        'attendance_id' => $row['attendance_id'],
        'user_id' => $row['user_id'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'course' => $row['course'],
        'in_time' => $row['in_time'],
        'out_time' => $row['out_time'],
        'attendance_date' => $row['attendance_date'],
        'duration' => $duration,
        'status' => $status,
    ];
}

mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="imgs/favicon1.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="BaseHomePage.css">
    <title>Attendance</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body {
        background-image: url("imgs/baste.jpg");
        background-size: cover;
        justify-content: center;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .mainshit {
        width: 60%;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        margin: 50px auto;
    }

    .heading {
        margin-bottom: 20px;
        border-bottom: 3px solid #da121a;
        padding-bottom: 10px;
    }

    .search {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        flex-grow: 1;
        margin-left: 10px;
    }

    .topbar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
    }

    .filter {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
    }

    .date-picker {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .appli {
        padding: 8px 16px;
        background-color: #da121a;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .appli:hover {
        background-color: rgb(255, 31, 39);
    }



    .filter-summary {
        margin-top: 10px;
        padding: 8px;
        background-color: #f8f9fa;
        border-radius: 4px;
        border-left: 4px solid #17a2b8;
        display: none;
    }

    .disp1, .disp2 {
        display: flex;
        background-color: white;
        width: 100%;
        margin-bottom: 15px;
        border-radius: 5px;
        overflow: hidden;
    }

    .totalst, .presentday, .lateday, .absentday, .incompleteday {
        width: 45%;
        flex: 1;
        padding: 15px;
        text-align: center;
        transition: background-color 0.3s;
    }

    .totalst:hover, .presentday:hover, .lateday:hover, .absentday:hover, .incompleteday:hover {
        background-color: #f9f9f9;
    }

    .totalst {
        border-left: 4px solid blue;
    }

    .presentday {
        border-left: 4px solid #2ecc71;
    }

    .lateday {
        border-left: 4px solid #f39c12;
    }

    .absentday {
        border-left: 4px solid #e74c3c;
    }
    .incompleteday{
        border-left: 4px solid #9b59b6;
    }

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

    .pres {
        background-color: #2ecc71;
        border-radius: 20px;
        padding: 3px 8px;
        font-size: 0.8em;
        color: white;
    }

    .late {
        background-color: #f39c12;
        border-radius: 20px;
        padding: 3px 8px;
        font-size: 0.8em;
        color: white;
    }

    .abse {
        background-color: #e74c3c;
        border-radius: 20px;
        padding: 3px 8px;
        font-size: 0.8em;
        color: white;
    }
    .incom {
        background-color: #9b59b6;
        border-radius: 20px;
        padding: 3px 8px;
        font-size: 0.8em;
        color: white;
    }

    td:last-child {
        position: relative;
    }

    .attendance {
        appearance: none;
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        cursor: pointer;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 10;
    }

    .attendance:hover {
        opacity: 0.9;
    }

    td:last-child span {
        position: relative;
        z-index: 5;
    }

    .no-data {
        text-align: center;
        padding: 20px;
        font-size: 18px;
        color: #6c757d;
    }
</style>
<body>
<?php include('config/headeruser.php')?>

    <div class="mainshit">
        <h1 class="heading">Student Attendance</h1>
        <div class="topbar">
            <form method="GET" action="">
                <i class="glyphicon glyphicon-search">
                    <input type="text" class="search" placeholder="Search..." name="search" value="<?php echo htmlspecialchars($search_term); ?>">
                </i>
                <select class="filter" name="course">
                    <option value="">All Courses</option>
                    <option value="BSIT" <?php if ($course_filter == 'BSIT') echo 'selected'; ?>>BSIT</option>
                    <option value="BSPSYCH" <?php if ($course_filter == 'BSPSYCH') echo 'selected'; ?>>BSPSYCH</option>
                    <option value="BSHRM" <?php if ($course_filter == 'BSHRM') echo 'selected'; ?>>BSHRM</option>
                    <option value="BSA" <?php if ($course_filter == 'BSA') echo 'selected'; ?>>BSA</option>
                    <option value="BST" <?php if ($course_filter == 'BST') echo 'selected'; ?>>BST</option>
                    <option value="BSBA" <?php if ($course_filter == 'BSBA') echo 'selected'; ?>>BSBA</option>
                </select>
                <input type="date" class="date-picker" placeholder="Date" name="date" value="<?php echo htmlspecialchars($date_filter); ?>">
                <button class="appli" type="submit">Apply Filter</button>
                <button type="button" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'" class="appli">Clear Filters</button>
            </form>
        </div>

        <?php if (!empty($search_term) || !empty($course_filter) || !empty($date_filter)): ?>
        <div class="filter-summary" style="display: block;">
            <strong>Filters Applied:</strong> 
            <?php 
                $filters = [];
                if (!empty($search_term)) $filters[] = "Search: \"" . htmlspecialchars($search_term) . "\"";
                if (!empty($course_filter)) $filters[] = "Course: " . htmlspecialchars($course_filter);
                if (!empty($date_filter)) $filters[] = "Date: " . date('F j, Y', strtotime($date_filter));
                echo implode(' | ', $filters);
            ?>
        </div>
        <?php endif; ?>

        <div class="disp1">
            <div class="totalst">
                <h4>Total Students</h4>
                <h1><?php echo $total_students; ?></h1>
            </div>
            <div class="presentday">
                <h4>Present</h4>
                <h1><?php echo $present_count; ?></h1>
            </div>
        </div>
        <div class="disp2">
            <div class="lateday">
                <h4>Late</h4>
                <h1><?php echo $late_count; ?></h1>
            </div>
            <div class="absentday">
                <h4>Absent</h4>
                <h1><?php echo $absent_count; ?></h1>
            </div>
            <div class="incompleteday">
                <h4>Incomplete</h4>
                <h1><?php echo $incomplete_count; ?></h1>
            </div>
        </div>

        <?php if (count($student_data) > 0): ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Duration</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($student_data as $student): ?>
                    <tr>
                        <td><?php echo $student['user_id']; ?></td>
                        <td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
                        <td><?php echo $student['course']; ?></td> 
                        <td><?php echo ($student['in_time'] != null) ? date('h:i A', strtotime($student['in_time'])) : 'N/A'; ?></td>
                        <td><?php echo ($student['out_time'] != null) ? date('h:i A', strtotime($student['out_time'])) : 'N/A'; ?></td>
                        <td><?php echo $student['duration']; ?></td>
                        <td>
                            <?php
                            $status_class = '';
                            switch ($student['status']) {
                                case 'Present':
                                    $status_class = 'pres';
                                    break;
                                case 'Late':
                                    $status_class = 'late';
                                    break;
                                case 'Absent':
                                    $status_class = 'abse';
                                    break;
                                case 'Incomplete':
                                    $status_class = 'incom';
                                    break;
                                default:
                                    $status_class = '';
                            }
                            ?>
                            <span class="<?php echo $status_class; ?>"><?php echo $student['status']; ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="no-data">
            <p>No attendance records found for the selected filters.</p>
        </div>
        <?php endif; ?>
    </div>

 

<?php include('config/footer.php')?>

</body>
</html>