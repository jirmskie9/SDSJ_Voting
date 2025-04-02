<?php
include('../pages/dbcon.php'); 
                       
$query = "SELECT COUNT(*) AS total_ind FROM candidate";
$result = $conn->query($query);

if ($result) {
 $row = $result->fetch_assoc();
 $total_ind = $row['total_ind'];

} else {
echo "Error executing query: " . $conn->error;
}

?>