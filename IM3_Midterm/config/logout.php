<?php
session_start();
session_unset();     
session_destroy();   

header("Location: http://localhost/IM3_Midterm/BaseHomePage.php");
exit();
?>