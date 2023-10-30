<?php 
  session_start();
  @include "dbconn.php";

 
// Fetch records from database 
$query = $conn->query("SELECT * FROM employees ORDER BY emp_id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $file_path = './csv/';
    $filename = "employees-data_" . date('Y-m-d-h-i-s') . ".csv"; 
     
    // Checking whether file exists or not 
if (!file_exists($file_path)) { 
  
    // Create a new file or direcotry 
    mkdir($file_path, 0777, true); 
} 
else { 
    echo "The Given file path already exists"; 
} 

   $f= fopen($file_path.'/'.$filename, 'x');
   $myfile = fopen($file_path."index.php", "w") or die("Unable to open file!");
  // fread($myfile,filesize("index.php"));
   //fclose($myfile);
    // Set column headers 
    $fields = array('ID', 'LOGIN ID', 'EMPLOYEE NAME', 'OVERTIME', 'START DATE', 'END DATE', 'MODIFIED'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['emp_id'], $row['login_id'], $row['emp_name'], $row['overtime'], $row['emp_start'], $row['emp_end'], $row['modified']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>