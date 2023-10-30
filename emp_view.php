<?php
session_start();
@include "dbconn.php";

$sql = "SELECT * FROM employees";

$result = $conn->query($sql);
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
        .center {
  margin: auto;
  width: 100%;
  border: 3px solid #73AD21;
  padding: 10px;
}
        #employee h2 {
          background-color: #5c2358;
          color: white;
          padding: 5px 10px;
        }
        
        .fixed_header {
        width: 700px;
        table-layout: fixed;
        border-collapse: collapse;
        margin: auto;
        padding: 10px;
      }
      
      .fixed_header tbody {
        display: block;
        width: 100%;
        overflow: auto;
        height: 300px;
      }
      .fixed_header thead tr {
        display: block;
      }
      .fixed_header thead {
        background: purple;
        color: #fff;
      }
      .fixed_header th,
      .fixed_header td {
        padding: 5px;
        text-align: center;
        width: 200px;
      }
      
       #btn {
          background-color: green; 
          border: none;
          border-radius: 12px;
          color: white;
          padding: 5px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
        }
        
        #nav-tab1 a{
          background-color: gray; 
          border: none;
          border-radius: 12px;
          color: white;
          padding: 5px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 12px;
          margin: 4px 2px;
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
    <div class="tab-content">
      <div class="page page-active" id="employee">
      <h4 id="nav-tab" style="text-align: right;" class="alert-heading">Hi, <strong>
                    <?php echo $_SESSION['login_id']; ?>
                </strong>
      </h4>
      <h2>Employee Information</h2>
      
 			<div > 				
         			<table class="fixed_header">
                    <thead>
                    	<tr>
                        	<th>ID</th>
                        	<th>Name</th>
                        	<th>Start Date</th>
                        	<th>Overtime Eligible</th>
                        	<th>Last Updated</th>
                        	<th>Action</th>
                    	</tr>
                    </thead>
                    <tbody>
                    	 <?php
                             if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                         ?>
        
                         <tr>
                            <td><?php echo $row['emp_id']; ?></td>
                            <td><?php echo $row['emp_name']; ?></td>
                            <td><?php echo $row['emp_start']; ?></td>
                            <td><?php echo $row['overtime']; ?></td>
                            <td><?php echo $row['modified']; ?></td>
                         	<td>
                         		<a id="btn" href="update.php?id=<?php echo $row['emp_id']; ?>">Edit</a>
                         		<!-- &nbsp;
                         		<a class="btn btn-danger" href="delete.php?id=>Delete</a-->
                         	</td>
        				 </tr>                       
        				<?php }
                                }
                         ?>     
                    </tbody>
                </table>
  				   
 			</div>
 			<br>
        <ul id="nav-tab1">
        	<li><a href="admin_home.php">Back</a></li>
        </ul>
      </div>
      <!--div class="page" id="timesheet">
        <h2>Timesheet</h2>
        
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore voluptates atque magnam molestiae odit cum autem maxime distinctio omnis nam porro, itaque, eius deserunt fugit aut doloremque facere velit esse. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, autem.</p>
      </div-->
      
   
    </div>
   </div>
  <script src="script.js"></script>
</body>
</html>