<?php
include("../dbcon.php");
$database_name = "svnhs_voting";
$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}
$sqlScript = "";
foreach ($tables as $table) { 
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $sqlScript.= "\n\n". $row[1]. ";\n\n";
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $columnCount = mysqli_num_fields($result); 
    while ($row = mysqli_fetch_row($result)) {
        $sqlScript.= "INSERT INTO $table VALUES(";
        for ($j = 0; $j < $columnCount; $j ++) {
            if (isset($row[$j])) {
                $sqlScript.= '"'. addslashes($row[$j]). '"';
            } else {
                $sqlScript.= '""';
            }
            if ($j < ($columnCount - 1)) {
                $sqlScript.= ',';
            }
        }
        $sqlScript.= ");\n";
    }
    $sqlScript.= "\n"; 
}
if(!empty($sqlScript))
{
    $backup_file_name = $database_name. '_backup_'. time(). '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='. basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: '. filesize($backup_file_name));
    ob_clean();
    flush(); 
    readfile($backup_file_name);
    unlink($backup_file_name); 
    exit;
}
?>