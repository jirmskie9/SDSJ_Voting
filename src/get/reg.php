<?php
include('../pages/dbcon.php');
$query = "SELECT COUNT(*) AS registered FROM users WHERE confirmation = 'Complete' AND u_type = 'Voter'";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $total_reg = $row['registered'];
    echo $total_reg; // Echo the updated count as the response
} else {
    echo "Error executing query: " . $conn->error;
}
?>
