<?php
session_start();
@include "dbconn.php";

if (isset($_POST['submit'])) {
    
    $id = $_POST['emp_id'];
    $tsid = $_POST['id'];
    $trid = $_POST['trid'];
    $emp_name = $_POST['user_name'];
    $s_date = $_POST['sdate'];
    $approved = $_POST['yes_no'];
    
    $s_time = $_POST['s_time'];
    $e_time = $_POST['e_time'];

    $f_time = $_POST['from_time'];
    $t_time = $_POST['to_time'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `timesheets`(`emp_id`, `ts_date`, `start_time`, `end_time`, `ts_approved`) 
    VALUES ('$id', '$s_date', '$s_time','$e_time','$approved')";
    $result = $conn->query($sql);

    $invoiceId = mysqli_insert_id($conn);

      for ($a = 0; $a < 9; $a++)
      {
              $sqli = "INSERT INTO `timesheets_items`(`ts_id`,`time_from`, `time_out`, `description`) 
              VALUES ('$invoiceId', '$f_time[$a]','$t_time[$a]','$description[$a]')";
              $result = $conn->query($sqli);
      }

    $message = "<p style='color:green;'>Record modified</p>";
    header("Location: ts_search.php");
    
}

$sql = "SELECT *
        FROM timesheets 
        JOIN timesheets_items ON timesheets.ts_id = timesheets_items.ts_id
        JOIN users ON timesheets.emp_id = users.user_id
        JOIN employees ON timesheets.emp_id = employees.emp_id";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
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
          background-color: blue; 
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
          background-color: red; 
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
        
         #nav-tab1 {
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
        height: 110px;
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
        text-align: left;
        width: 200px;
      }
  </style>
</head>
<body>
   <div class="container">
    <ul id="nav-tab">
      <li ><a href="admin_home.php">Employee</a></li>
      <li  class="active"><a href="ts_home.php">Timesheet</a></li>
      <li><a href="csv_backup.php">CSV Backup</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="tab-content">
      <div class="page page-active" id="timesheet">
        <h4 id="nav-tab" style="text-align: right;" class="alert-heading">Hi, <strong>
                    <?php echo $_SESSION['login_id']; ?>
                </strong>
      </h4>
        <form action="" method="post">
        	
        		 
 			<fieldset>
 				<legend>Add Timesheet</legend>
 				<div>
        		<?php if (isset($message)) {
        		    echo $message;
        		}?>
     
        	</div>
 			 	<ul>
            <li>
              <!--label for="name">Tr id:</label-->
              <input type="hidden" id="trid" name="trid" value="<?php echo $row['tr_id'];?>" readonly="readonly"/>
    				</li>
            <li>
              <!--label for="name">TS id:</label-->
              <input type="hidden" id="id" name="id" value="<?php echo $row['ts_id'];?>" readonly="readonly"/>
    				</li>
 			 		<li> 
                          <label for="name">Employee id:</label>
                          <input type="text" id="emp_id" name="emp_id" />
    				</li>
                    <!--li>
                          <label for="name">Employee name:</label>
                          <input type="text" id="name" name="user_name" />
                    </li-->
                   
    				<li>
                          <label for="sdate">Timesheet date:</label>
                          
                          <select name = "sdate">
								<!--option>Month</option-->
                            	<?php
                                        //$date1 = strtotime("-2 week");
                                        //$date2 = strtotime("now");
                                        date_default_timezone_set( 'America/Edmonton' );
                                        $current = strtotime("-2week");
                                        $date2 = strtotime("now");
                                        $stepVal = '+1 day';
                                        while( $current <= $date2 ) {
                                           $dates = date('Y-M-d', $current);
                                           $current = strtotime($stepVal, $current);
                                           echo "<option>$dates</option>";
                                           
                                        }
                            	?>
						  </select>
    				</li>
                    <li>
                        <label for="s_time">Shift Start:</label>
                        <select name="s_time">
                            <option>09:00am</option>
                            <?php
                                $start = "00:00"; //you can write here 00:00:00 but not need to it
                                $end = "23:30";
                            
                                $tStart = strtotime($start);
                                $tEnd = strtotime($end);
                                $tNow = $tStart;
                                while($tNow <= $tEnd){
                                    echo '<option value="'.date("H:i a",$tNow).'">'.date("H:i a",$tNow).'</option>';
                                    $tNow = strtotime('+60 minutes',$tNow);
                                }
                                
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="e_time">Shift End:</label>
                        <select name="e_time">
                            <option>17:00pm</option>
                            <?php
                                $start = "00:00"; //you can write here 00:00:00 but not need to it
                                $end = "23:30";
                            
                                $tStart = strtotime($start);
                                $tEnd = strtotime($end);
                                $tNow = $tStart;
                                while($tNow <= $tEnd){
                                    echo '<option value="'.date("H:i a",$tNow).'">'.date("H:i a",$tNow).'</option>';
                                    $tNow = strtotime('+60 minutes',$tNow);
                                }
                                
                            ?>
                        </select>
                    </li>
                     
                    <li>
                      	  <label for="yes_no_radio">Approved?</label>
               			  <input type="radio" name="yes_no" value="Y" required >Yes
              			  <input type="radio" name="yes_no" value="N" required>No
                    </li>
  				</ul><br>
                  <table class="fixed_header" >
                  
                  <thead>
                      <tr>
                      <!--th>#</th-->
                        <th>From</th>
                          <th>To</th>
                          <th>Describe What You Did</th>
                      </tr>
                  </thead>
                  <tbody id="tbody">
                  <?php
                         // $item = 0;
                          for($i=0; $i<9; $i++){
                             // $item++;
                      ?>
                  <tr>
                      <!--td><input type='text' value="<!?php echo $item?>"></td-->
                      <td><input type='text' name='from_time[]' readonly></td>
                      <td><input type='text' name='to_time[]' readonly ></td>
                      <td>
                      <input name="description[]" type="text" size="50" required>
                      </td>
                  </tr>
                  <?php
                          }
                  ?>
                  </tbody>
              </table>
  				  
 			</fieldset>
                    <a id="nav-tab1" href="ts_home.php">Back</a>
                    <input id="btn1" type="submit" value=Save name="submit">
                     <input id="btn2" type="reset" value="Clear" name="clear">
		</form><br>
        
      </div>
    </div>
   </div>
  <script src="script.js"></script>
  <script>
  $( document ).ready( fromTime );
</script>
</body>
</html>