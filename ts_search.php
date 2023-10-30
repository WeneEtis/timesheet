<?php
session_start();
@include "dbconn.php";
$searchErr = '';
$employee_details='';
if(isset($_POST['save']))
{
	if(!empty($_POST['search']))
	{
		$search = $_POST['search'];
    
    $sql = "SELECT *  
      FROM  employees
      JOIN timesheets ON employees.emp_id = timesheets.emp_id
      WHERE employees.emp_id like '%$search%' or employees.emp_name like '%$search%'";
		$employee_details = $conn->query($sql);
    $count = mysqli_num_rows($employee_details);
    

    if($count == 0){
      $searchErr = "<p style='color:red;'>Employee Information Not Found </p>";
    }
 
	}
	/*else
	{
		$searchErr = "<p style='color:red;'>No results</p>";

	}*/
   
}

/*$sql = "SELECT * FROM timesheets 
        JOIN users ON timesheets.emp_id = users.user_id
        JOIN employees ON timesheets.emp_id = employees.emp_id";*/

/*$sql = "SELECT * FROM employees 
        JOIN timesheets ON employees.emp_id = timesheets.emp_id
        JOIN users ON timesheets.emp_id = users.user_id";*/
$sql = "SELECT * FROM employees 
        JOIN timesheets ON employees.emp_id = timesheets.emp_id
        JOIN timesheets_items ON timesheets.ts_id = timesheets_items.ts_id";


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <link rel="stylesheet" href="stylesheet.css">
  <style>
        fieldset {
          background-color: #eeeeee;
        }
        
        label {
          display: inline-block;
          width: 120px;
        }
        
        legend {
          background-color: #5c2358;
          color: white;
          padding: 5px 10px;
        }
        
        input {
          margin: 5px;
        }
        ul {
              list-style: none;
              padding: 0;
              margin: 0;
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
        #btn1 {
          background-color: blue; /* Green */
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
        .container1{
  max-width: 800px;
  background-color: #ecf0f1;
  border-radius: 3px;
  box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;
}

form {
        color: #555;
        display: flex;
        padding: 2px;
        border: 1px solid currentColor;
        border-radius: 5px;
        }

        .input-icons i {
            position: absolute;
        }
         
        .input-icons {
            width: 100%;
            margin-bottom: 10px;
            text-align: center;
        }
         
        .icon {
            padding: 10px;
            color: grey;
            min-width: 50px;
            text-align: center;
        }
         
        .input-field {
            width: 50%;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
    
        
  </style>
</head>
<body>
   <div class="container1">
    <ul id="nav-tab">
      <li><a href="admin_home.php">Employee</a></li>
      <li   class="active"><a href="ts_home.php">Timesheet</a></li>
      <li><a href="csv_backup.php">CSV Backup</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
      <div class="tab-content">
        <div class="page page-active" id="timesheet">
        <h4 id="nav-tab" style="text-align: right;" class="alert-heading">Hi, <strong>
                    <?php echo $_SESSION['login_id']; ?>
                </strong>
      </h4>
 			<div > 				
         			<table class="fixed_header">
                     <form class="form-horizontal" action="#" method="post">
                            <div class="row">
                                <div class="form-group">
                                    <div class="input-icons">
                                    <i class="fa fa-search fa-flip-horizontal icon"></i>

                                    <input type="text" class="input-field" name="search" placeholder="search here">

                                    <input id="btn2" type="submit" name="save" class="btn btn-success btn-sm" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    <thead>
                    	<tr>
                          <th>Employee ID</th>
                        	<th>Employee Name</th>
                        	<th>Timesheet Date</th>
                        	<th>Approved</th>
                          <th>Action</th>
                    	</tr>
                    </thead>
                    <tbody>
                    	 <?php
                            if (isset($searchErr)) {
                                echo $searchErr;
                            }
                            if($employee_details){
                                echo '<tr>Search Results:</tr>';
                                foreach($employee_details as $key=>$value)
                                {
                                    ?>
                                <tr>
                                <td><?php echo $value['emp_id']; ?></td>
                                <td><?php echo $value['emp_name']; ?></td>
                                <td><?php echo $value['ts_date']; ?></td>
                                <td><?php echo $value['ts_approved']; ?></td>
                                <td>
                                    <a id="btn" href="ts_admin_edit.php?id=<?php echo $value['ts_id']; ?>">Edit</a>
                                    <!-- &nbsp;
                                    <a class="btn btn-danger" href="delete.php?id=>Delete</a-->
                                </td>
                                    
                                </tr>
                                    
                                    <?php
                                }
                            }
                             else if ($result->num_rows > 0) {
                                //$row = $result->fetch_assoc();
                                //$_SESSION['user_id'] = $row['emp_id'];

                                while ($row = $result->fetch_assoc() ) {
                                    
                         ?>
        
                         <tr>
                            <td><?php echo $row['emp_id']; ?></td>
                            <td><?php echo $row['emp_name']; ?></td>
                            <td><?php echo $row['ts_date']; ?></td>
                            <td><?php echo $row['ts_approved']; ?></td>
                         	<td>
                         		<a id="btn" href="ts_admin_edit.php?id=<?php echo $row['ts_id']; ?>">Edit</a>
                         		<!-- &nbsp;
                         		<a class="btn btn-danger" href="delete.php?id=>Delete</a-->
                         	</td>
        				 </tr>                       
        				<?php }
                                } 
                               
                                else{
                                    echo '<tr>No data found</tr>';
                                }
                         ?>     
                    </tbody>
                </table>
  				   
 			</div>
 			<br>
        <ul id="nav-tab1">
        	<li><a href="ts_home.php">Back</a></li>
        </ul>
      </div>
      <!--div class="page" id="timesheet">
        <h2>Timesheet</h2>
        
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore voluptates atque magnam molestiae odit cum autem maxime distinctio omnis nam porro, itaque, eius deserunt fugit aut doloremque facere velit esse. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, autem.</p>
      </div-->
      
   
    
	</div>

        </div>
      </div>
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script src="script.js"></script>
</body>
</html>