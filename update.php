<?php
session_start();
@include "dbconn.php";
//$id = $_POST['emp_id'];
if (count($_POST)>0) {
    
    $id = $_POST['id'];
    $emp_name = $_POST['name'];
    
    $overtime = $_POST['yes_no'];
    
    //$start_date = STR_TO_DATE($_POST['sdate'],'%d-%m-%Y');
    $s_date = $_POST['syear'].'-'.$_POST['smonth'].'-'.$_POST['sday'];
    $start_date = date('Y-m-d', strtotime($s_date));
    
    $e_date = $_POST['eyear'].'-'.$_POST['emonth'].'-'.$_POST['eday'];
    $end_date = date('Y-m-d', strtotime($e_date));

    
    
   mysqli_query($conn, "UPDATE employees SET emp_name='$emp_name', overtime='$overtime', emp_start='$start_date', emp_end='$end_date' WHERE emp_id='".$_POST['id']."'");
    
    $message = "<p style='color:green;'>Record updated</p>";
    //header("Location: view_emp.php");
    
}

        
$result = mysqli_query($conn, "SELECT * FROM employees WHERE emp_id='".$_GET['id']."'");
$row = mysqli_fetch_array($result);


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
      <li  class="active"><a href="home.php">Employee</a></li>
      <li><a href="ts_home.php">Timesheet</a></li>
      <li><a href="csv_backup.php">CSV Backup</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="tab-content">
      <div class="page page-active" id="employee">
        <!--h2>Add Employee</h2-->
        <form action="" method="post">
        	<div>
        		<?php if (isset($message)) {
        		    echo $message;
        		}?>
     
        	</div>
          <h4 id="nav-tab" style="text-align: right;" class="alert-heading">Hi, <strong>
                    <?php echo $_SESSION['login_id']; ?>
                </strong>
      </h4>
 			<fieldset>
 				<legend>Edit Employee Information</legend>
 				
 			 	<ul>
 			 		<li>
                  <input type="hidden" id="emp_id" name="id" value="<?php  echo $row['emp_id'];?>" />
    				</li>
                    <li>
                          <label for="name">Employee name:</label>
                          <input type="text" id="name" name="name" value="<?php echo $row['emp_name'];?>" />
                    </li>
                    
                    <li>
                      	  <label for="yes_no_radio">Overtime?</label>
               			  <input type="radio" name="yes_no" value="Y" <?php if($row['overtime'] == 'Y'){ echo "checked";} ?> >Yes
              			  <input type="radio" name="yes_no" value="N" <?php if($row['overtime'] == 'N'){ echo "checked";} ?>>No
                    </li>
    				<li>
                          <label for="sdate">Start date:</label>
                          
                          <select name = "smonth">
								<!--  option>Month</option-->
                            	<?php
                                	$res = $row['emp_start'];
                                	$ress = date('m', strtotime($res));
                                	
                                	echo "<option>".$ress." </option>";
                                	
                                	for($month = 1; $month <= 12; $month++){
                                	    echo"<option>".$month." </option>";
                                	}
                            	?>
                            	
						  </select>
                          <select name = "sday" >
                              	<!--  option>Day</option-->
                                <?php
                                    $res = $row['emp_start'];
                                    $ress = date('d', strtotime($res));
                                    
                                    echo "<option>".$ress." </option>";
                            	    for($day = 1; $day <= 31; $day++){
                            		     echo "<option value = '".$day."'>".$day."</option>";
                            		}
                            	?>
                          </select>
						  <select name = "syear" >
								<!--  option>Year</option-->
                            	<?php
                                	$res = $row['emp_start'];
                                	$ress = date('Y', strtotime($res));
                                	
                                	echo "<option>".$ress." </option>";
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
                            	<!--  option>Month</option-->
                            	<?php
                                	$res = $row['emp_end'];
                                	$res1 = '00';
                                	$ress = date('d', strtotime($res));
                        
                                	if (empty($res)) {
                                	    echo "<option>".$res1." </option>";;
                                	}else {
                                	    echo "<option>".$ress." </option>";
                                	}
                                	
                                	for($month = 1; $month <= 12; $month++){
                                	    echo"<option>".$month." </option>";
                                	}
                            	?>
						</select>
                        <select type="date" name = "eday">
                                <!--  option>Day</option-->
                                <?php
                                    $res = $row['emp_end'];
                                    $res1 = '00';
                                    $ress = date('m', strtotime($res));
                                    
                                    if (empty($res)) {
                                        echo "<option>".$res1." </option>";;
                                    }else {
                                        echo "<option>".$ress." </option>";
                                    }
                        	        for($day = 1; $day <= 31; $day++){
                        		       echo "<option value = '".$day."'>".$day."</option>";
                        		}
                        	?>
                        </select>
                        <select type="date" name = "eyear">
                            	<!--  option>Year</option-->
                            	<?php
                                	$res = $row['emp_end'];
                                	$res1 = '0000';
                                	$ress = date('Y', strtotime($res));
                                	
                                	if (empty($res)) {
                                	    echo "<option>".$res1." </option>";;
                                	}else {
                                	    echo "<option>".$ress." </option>";
                                	}
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
                 <input id="btn1" type="submit" value="Update" name="submit">
 			</fieldset>
		</form><br>
        <ul id="nav-tab1">
        	<li><a href="emp_view.php">Back</a></li>
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