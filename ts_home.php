<?php
  session_start();
  @include "dbconn.php";
  //include "signin.php";
 
  //$userId = $_SESSION['login_id'];
  //$sql = "SELECT * FROM users WHERE login_id = '$userId' ";
  
    //$sql = "SELECT * FROM users WHERE user_id='".$_GET['user_id']."'";
    //$result = mysqli_query($conn, "SELECT * FROM employees WHERE emp_id='".$_GET['id']."'");

   // $row = mysqli_fetch_array($result);
   // $result = $conn->query($sql);

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
      <li ><a href="admin_home.php">Employee</a></li>
      <li class="active"><a href="ts_home.php">Timesheet</a></li>
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
       		<a id="nav-tab1" href="ts_create.php">Add Employee Timesheet</a><br><br>
      		<a id="nav-tab1" href="ts_search.php">View Timesheet List</a>
		    </div>
      </div>
     
      <div class="page" id="timesheet">
        <div style="text-align:center">    
       		<br><br><br><br><br><br>
      		<a id="nav-tab1" href="ts_create.php">Add Timesheet List</a>
		    </div>      
      </div>
      
   
    </div>
   </div>
  <script src="script.js"></script>
</body>
</html>