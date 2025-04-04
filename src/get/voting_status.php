<?php
include('../dbcon.php');

// Query to get count of users with status 'To Vote' and 'Voted'
$sql = "SELECT 
    SUM(CASE WHEN status = 'To Vote' THEN 1 ELSE 0 END) as to_vote_count,
    SUM(CASE WHEN status = 'Voted' THEN 1 ELSE 0 END) as voted_count
FROM users 
WHERE u_type != 'Admin'";

$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $response = array(
        'to_vote' => (int)$row['to_vote_count'],
        'voted' => (int)$row['voted_count']
    );
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'Failed to fetch voting status data'));
}
?> 