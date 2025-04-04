<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header to return JSON
header('Content-Type: application/json');

// Include database connection
include '../dbcon.php';

// Check if database connection is successful
if (!isset($conn) || !$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Get position from query parameter
$position = isset($_GET['position']) ? $_GET['position'] : null;

// Array to store vote data
$voteData = [];

// Function to get vote data for a specific position
function getVoteDataForPosition($conn, $position) {
    try {
        $sql = "SELECT c.name, c.position, COUNT(v.vote_id) as count 
                FROM candidates c 
                LEFT JOIN votes v ON c.id = v.candidate_id 
                WHERE c.position = ? 
                GROUP BY c.id, c.name, c.position 
                ORDER BY count DESC";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return [];
        }
        
        $stmt->bind_param("s", $position);
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return [];
        }
        
        $result = $stmt->get_result();
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            // Ensure count is an integer
            $row['count'] = (int)$row['count'];
            $data[] = $row;
        }
        
        $stmt->close();
        return $data;
    } catch (Exception $e) {
        error_log("Error in getVoteDataForPosition: " . $e->getMessage());
        return [];
    }
}

// If position is specified, get data for that position only
if ($position) {
    $voteData = getVoteDataForPosition($conn, $position);
} else {
    // Get vote data for each position
    $positions = [
        'President',
        'Vice President',
        'Secretary',
        'Treasurer',
        'Auditor',
        'Public Information Officer',
        'Peace Officer',
        'Grade 7 Representative',
        'Grade 8 Representative',
        'Grade 9 Representative',
        'Grade 10 Representative',
        'Grade 11 Representative',
        'Grade 12 Representative'
    ];

    foreach ($positions as $pos) {
        $positionData = getVoteDataForPosition($conn, $pos);
        if (!empty($positionData)) {
            $voteData = array_merge($voteData, $positionData);
        }
    }
}

// If no data was found, return a sample data for testing
if (empty($voteData)) {
    $voteData = [
        ['name' => 'Sample Candidate 1', 'position' => $position ?: 'President', 'count' => 10],
        ['name' => 'Sample Candidate 2', 'position' => $position ?: 'President', 'count' => 5]
    ];
}

// Return the data as JSON
echo json_encode($voteData);
?> 