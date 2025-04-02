<?php
include('../pages/dbcon.php'); 
                       
$query = "SELECT COUNT(*) AS to_vote FROM users WHERE status = 'Confirmed' AND Confirmation = 'Complete'";
$result = $conn->query($query);

if ($result) {
$row = $result->fetch_assoc();
$to_vote = $row['to_vote'];

} else {
echo "Error executing query: " . $conn->error;
}

?>