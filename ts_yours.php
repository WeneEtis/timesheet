<?php
session_start();
@include "dbconn.php";

$sql = "SELECT * FROM timesheets 
        JOIN timesheets_items ON timesheets.ts_id = timesheets_items.ts_id
        JOIN users ON timesheets.emp_id = users.user_id
        JOIN employees ON timesheets.emp_id = employees.emp_id";

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
      <li  class="active"><a href="ts_yours_edit.php">Your Timesheet</a></li>
      <!--li><a href="ts_yours_edit.php">View Timesheet</a></li-->
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
                        	<th>Employee ID</th>
                        	<th>Employee Name</th>
                        	<th>Timesheet Date</th>
                        	<th>Approved</th>
                            <th>Action</th>
                    	</tr>
                    </thead>
                    <tbody id="data">
                    	 <?php
                             if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc() ) {
                                    
                                   if($_SESSION['user_id'] == $row['user_id']){
                         ?>
        
                         <tr>
                            <td><?php echo $row['emp_id']; ?></td>
                            <td><?php echo $row['emp_name']; ?></td>
                            <td><?php echo $row['ts_date']; ?></td>
                            <td><?php echo $row['ts_approved']; ?></td>
                         	<td>
                         		<a id="btn" href="ts_yours_edit.php?id=<?php echo $row['ts_id']; ?>">Edit</a-->
                         		<!-- &nbsp;
                         		<a class="btn btn-danger" href="delete.php?id=>Delete</a-->
                         	</td>
        				 </tr>                       
        				<?php }
                                } }
                         ?>     
                    </tbody>
                </table>
  				   
 			</div>
 			<br>
      </div>
    </div>
   </div>
  <script src="script.js"></script>
</body>
</html>