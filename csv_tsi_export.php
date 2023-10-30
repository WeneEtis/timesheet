<?php 
  session_start();
  @include "dbconn.php";

 
// Fetch records from database 
$query = $conn->query("SELECT * FROM timesheets_items ORDER BY tr_id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $file_path = './csv/';
    $filename = "timesheets-items-data_" . date('Y-m-d-h-i-s') . ".csv"; 

    if (!file_exists($file_path)) { 
  
        // Create a new file or direcotry 
        mkdir($file_path, 0777, true); 
    } 
    else { 
        echo "The Given file path already exists"; 
    } 

    $f= fopen($file_path.'/'.$filename, 'w');
    $myfile = fopen($file_path."index.php", "w") or die("Unable to open file!");

    // Set column headers 
    $fields = array('TR ID', 'TS ID', 'FROM', 'TO', 'DESCRIPTION', 'MODIFIED'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['tr_id'], $row['ts_id'], $row['time_from'], $row['time_out'], $row['description'], $row['modified']); 
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