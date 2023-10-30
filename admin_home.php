<?php
  session_start();
  @include "dbconn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="stylesheet.css">
  <style>
    #nav-tab1{
          background-color: gray; 
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
   <div class="container">
    <ul id="nav-tab">
      <li  class="active"><a href="admin_home.php">Employee</a></li>
      <li><a href="ts_home.php">Timesheet</a></li>
      <li><a href="csv_backup.php">CSV Backup</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    
    <div class="tab-content" >
      <div class="page page-active" id="employee" >
      <h4 id="nav-tab" style="text-align: right;" class="alert-heading">Hi, <strong>
                    <?php echo $_SESSION['login_id']; ?>
                </strong>
      </h4>
        <div style="text-align:center">    
       		<br><br><br><br><br><br>
       		<a id="nav-tab1" href="emp_add.php">Add Employee</a><br><br>
      		<a id="nav-tab1" href="emp_view.php">View Employee List</a>
		    </div>
      </div>
      <div class="page" id="timesheet">
        <div style="text-align:center">    
       		<br><br><br><br><br><br>
      		<a id="nav-tab1" href="ts_home.php">Add Timesheet List</a>
		    </div>      
      </div>
      
   
    </div>
   </div>
  <script src="script.js"></script>
</body>
</html>