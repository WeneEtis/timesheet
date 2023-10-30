<?php
//session_start();
@include 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    #nav-tab1{
          background-color: blueviolet; 
          border: none;
          border-radius: 12px;
          color: white;
          padding: 5px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 20px;
          justify-content: center;
          cursor: pointer;
        }
  </style>
</head>
<body>
   <div class="wrapper">
        <div style="text-align:center">
        <div class="input-box">
            <a id="nav-tab1" href="admin_signin.php">Admin Login</a><br><br>
            </div>
            <div class="input-box">
      		  <a id="nav-tab1" href="emp_signin.php">Employee Login</a>
            </div>
        </div>
        
   </div>
   
   
</body>
</html>

