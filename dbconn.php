<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = 'tsheet3';
$_SESSION['success'] = "";
$conn= new mysqli($dbhost, $dbuser, $dbpass, $db);

if($conn->connect_errno ) {
    printf("Connect failed: %s<br />", $conn->connect_error);
    exit();
}

?>