<?php
@include "dbconn.php";
if (isset($_POST['submit'])) {
    
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['user_name'];
    
    $overtime = $_POST['yes_no'];
    
    //$start_date = STR_TO_DATE($_POST['sdate'],'%d-%m-%Y');
    $s_date = $_POST['syear'].'-'.$_POST['smonth'].'-'.$_POST['sday'];
    $start_date = date('Y-m-d', strtotime($s_date));
    
    $e_date = $_POST['eyear'].'-'.$_POST['emonth'].'-'.$_POST['eday'];
    $end_date = date('Y-m-d', strtotime($e_date));
    
    if ( $end_date == '1970-01-01') {
        $sql = "INSERT INTO `employees`(`emp_id`, `emp_name`, `overtime`, `emp_start`) VALUES ('$emp_id', '$emp_name','$overtime','$start_date')";
    } else {
        //$end_date = date('Y-m-d', strtotime($e_date));
        $sql = "INSERT INTO `employees`(`emp_id`, `emp_name`, `overtime`, `emp_start`, `emp_end`) VALUES ('$emp_id', '$emp_name','$overtime','$start_date','$end_date')";
    }
    
    $result = $conn->query($sql);
    
    if ($result == TRUE) {
        
        header("Location: emp_view.php");
        
    }else{
        
        echo "Error:". $sql . "<br>". $conn->error;
        
    }
    
    $conn->close();
    
}

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
        
        #btn2 {
          background-color: red; /* Green */
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
        <!--h2>Add Employee</h2-->
        <form action="" method="post">
        	
        		 
 			<fieldset>
 				<legend>Add New Employee Information</legend>
 				
 			 	<ul>
 			 		<li>
                          <label for="name">Employee id:</label>
                          <input type="text" id="emp_id" name="emp_id" />
    				</li>
                    <li>
                          <label for="name">Employee name:</label>
                          <input type="text" id="name" name="user_name" />
                    </li>
                    
                    <li>
                      	  <label for="yes_no_radio">Overtime?</label>
               			  <input type="radio" name="yes_no" value="Y" >Yes
              			  <input type="radio" name="yes_no" value="N" >No
                    </li>
    				<li>
                          <label for="sdate">Start date:</label>
                          
                          <select name = "smonth">
								<option>Month</option>
                            	<?php
                                	for($month = 1; $month <= 12; $month++){
                                	    echo"<option>".$month." </option>";
                                	}
                            	?>
                            	
						  </select>
                          <select name = "sday" >
                              	<option>Day</option>
                                <?php
                            	    for($day = 1; $day <= 31; $day++){
                            		     echo "<option value = '".$day."'>".$day."</option>";
                            		}
                            	?>
                          </select>
						  <select name = "syear" >
								<option>Year</option>
                            	<?php
                            		$y = date("Y", strtotime("+8 HOURS"));
                            		for($year = 1950; $y >= $year; $y--){
                            			echo "<option value = '".$y."'>".$y."</option>";
                            		}
                            	?>
						  </select>

    				</li>
       				<li>
      					<label for="edate">End date:</label>
      					<select type="date" name = "emonth">
                            	<option>Month</option>
                            	<?php
                                	for($month = 1; $month <= 12; $month++){
                                	    echo"<option>".$month." </option>";
                                	}
                            	?>
						</select>
                        <select type="date" name = "eday">
                                <option>Day</option>
                                <?php
                        	        for($day = 1; $day <= 31; $day++){
                        		       echo "<option value = '".$day."'>".$day."</option>";
                        		}
                        	   ?>
                        </select>
                        <select type="date" name = "eyear">
                            	<option>Year</option>
                            	<?php
                            		$y = date("Y", strtotime("+8 HOURS"));
                            		for($year = 1950; $y >= $year; $y--){
                            			echo "<option value = '".$y."'>".$y."</option>";
                            		}
                            	?>
                        </select>
					</li>
  				</ul>
  				   <br>
  				   		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <input id="btn1" type="submit" value=Save name="submit">
                     <input id="btn2" type="reset" value="Clear" name="clear">
  				   
 			</fieldset>
		</form><br>
        <ul id="nav-tab1">
        	<li><a href="admin_home.php">Back</a></li>
        </ul>
      </div>
      <div class="page" id="timesheet">
        <h2>Timesheet</h2>
        
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore voluptates atque magnam molestiae odit cum autem maxime distinctio omnis nam porro, itaque, eius deserunt fugit aut doloremque facere velit esse. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, autem.</p>
      </div>
      
   
    </div>
   </div>
  <script src="script.js"></script>
</body>
</html>