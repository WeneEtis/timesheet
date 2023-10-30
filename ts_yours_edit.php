<?php
session_start();
@include "dbconn.php";

if (isset($_POST["addTS"]))
    {
        $id = $_GET['id'];
        $trid = $_POST['trid'];
        $emp_name = $_POST['name'];
        $s_date = $_POST['sdate'];    
        $s_time = $_POST['s_time'];
        $e_time = $_POST['e_time'];
        $f_time = $_POST['from_time'];
        $t_time = $_POST['to_time'];
        $description = $_POST['description'];

        if(is_array($description)){
          for($i=0; $i<count($f_time); $i++){
            $sql1="UPDATE timesheets_items 
            SET description='$description[$i]'
            WHERE timesheets_items.tr_id='" . $_POST['trid'][$i]. "'";
            $result1=mysqli_query($conn, $sql1);
            //$d = $description[$i];
          }
         
         }

        $message = "<p style='color:green;'>Record Updated</p>";
    }
 
$sql = "SELECT *
        FROM timesheets 
        JOIN timesheets_items ON timesheets.ts_id = timesheets_items.ts_id
        JOIN users ON timesheets.emp_id = users.user_id
        JOIN employees ON timesheets.emp_id = employees.emp_id
        WHERE timesheets_items.ts_id='".$_GET['id']."'";
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
        
         #nav-tab1{
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
      <!--li ><a href="admin_home.php">Employee</a></li-->
      <li  class="active"><a href="ts_yours.php">Your Timesheet</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="tab-content">
      <div class="page page-active" id="timesheet">
        <h4 id="nav-tab" style="text-align: right;" class="alert-heading">Hi, <strong>
                    <?php echo $_SESSION['login_id']; ?>
                </strong>
      </h4>
        <form action="" method="post">
        <div>
        		<?php if (isset($message)) {
        		    echo $message;
        		}?>
     
        	</div>
        		 
 			<fieldset>
 				<legend>Edit Timesheet</legend>
 				
 			 	<ul>
        
                    <li>
                          <!--label for="name">TS id:</label-->
                          <input type="hidden" id="id" name="id" value="<?php echo $row['ts_id'];?>" readonly="readonly"/>
    				</li>
 			 		<li>
                          <label for="name">Employee id:</label>
                          <input type="text" id="emp_id" name="emp_id" value="<?php echo $row['emp_id'];?>" readonly="readonly"/>
    				</li>
                    <li>
                          <label for="name">Employee name:</label>
                          <input type="text" id="name" name="name" value="<?php echo $row['emp_name'];?>" readonly="readonly"/>
                    </li>
                   
    				<li>
                          <label for="sdate">Timesheet date:</label>
                          
                          <select name = "sdate">
                            	<?php
                                        $tdate = $row['ts_date'];
                                        echo "<option>".$tdate." </option>";
                                       
                            	?>
						  </select>
    				</li>
                    <li>
                        <label for="s_time">Shift Start:</label>
                        <select name="s_time">
                            <?php
                                $tStart = $row['start_time'];
                                echo "<option>".$tStart." </option>";
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="e_time">Shift End:</label>
                        <select name="e_time">
                            <?php
                               $tEnd = $row['end_time'];
                               echo "<option>".$tEnd." </option>";
                            ?>
                        </select>
                    </li>
                  
  				</ul><br>
          <table class="fixed_header" >
                  
                    <thead >
                    	<tr>
                        
                          <th style="text-align: center;">From</th>
                        	<th style="text-align: center;">To</th>
                        	<th style="text-align: center;">Describe What You Did</th>
                    	</tr>
                    </thead>
                    <tbody id="tbody">
                    <?php
                           // $item = 0;
                        if ($result->num_rows > 0) {
                            //$row = $result->fetch_assoc();
                            //$_SESSION['user_id'] = $row['emp_id'];

                          //  while ($row = $result->fetch_assoc() ) {
                            foreach($result as $key=>$value)
                            {
                               // $item++;
                        ?>
                    <tr>
                        <!--td><input type='text' value="<!?php echo $item?>"></td-->
                        <td><input type="hidden" id="tr_id" name="trid[]" value="<?php echo $value['tr_id'];?>"/></td>

                        <td><input type='text' name='from_time[]' value="<?php echo $value['time_from']; ?>" readonly></td>
                        <td><input type='text' name='to_time[]' value="<?php echo $value['time_out']; ?>" readonly ></td>
                        <td>
                            <?php
                             $d = $value['description'];
                            // echo "<option>".$tStart." </option>";
                                if($row['ts_approved'] == 'Y'){
                                    echo "<input name='description[]' type='text' size='50' readonly='readonly' value='$d'></input>";
                                }else{
                                  echo "<input name='description[]' type='text' size='50' value='$d'> </input>";
                                }   
                            ?>
                        </td>
                    </tr>
                    <?php
                            } }
                    ?>
                    </tbody>
                </table>
 			</fieldset>
       <a id="nav-tab1"  href="ts_yours.php">Back</a>
       <!--button type="button" onclick="addItem();">Add Item</button-->
        <input id="btn1" type="submit" name="addTS" value="Update Timesheet">
        <!--input id="btn1" type="submit" value=Save name="submit" >
        <input id="btn2" type="reset" value="Clear" name="clear"-->
		</form><br>
      </div>
    </div>
   </div>
  
  <script src="script.js">
  </script>
  <script>
    $( document ).ready( fromTime );
</script>
</body>
</html>