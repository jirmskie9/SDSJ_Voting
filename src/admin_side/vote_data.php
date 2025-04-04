<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Disable display errors to prevent HTML output

// Set header to return JSON
header('Content-Type: application/json');

// Include database connection
include '../dbcon.php';

// Check if database connection is successful
if (!isset($conn) || !$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Array to store all vote data
$allVoteData = [];

// Function to get vote data for a specific position
function getVoteDataForPosition($conn, $position) {
    try {
        $sql = "SELECT name, position, count FROM vote_counting 
                WHERE position = ? 
                ORDER BY count DESC";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return [];
        }
        
        $stmt->bind_param("s", $position);
        if (!$stmt->execute()) {
            return [];
        }
        
        $result = $stmt->get_result();
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            // Ensure count is an integer
            $row['count'] = (int)$row['count'];
            $data[] = $row;
        }
        
        return $data;
    } catch (Exception $e) {
        return [];
    }
}

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

foreach ($positions as $position) {
    $positionData = getVoteDataForPosition($conn, $position);
    $allVoteData = array_merge($allVoteData, $positionData);
}

// If no data was found, return a sample data for testing
if (empty($allVoteData)) {
    $allVoteData = [
        ['name' => 'Sample Candidate 1', 'position' => 'President', 'count' => 10],
        ['name' => 'Sample Candidate 2', 'position' => 'President', 'count' => 5],
        ['name' => 'Sample Candidate 1', 'position' => 'Vice President', 'count' => 8],
        ['name' => 'Sample Candidate 2', 'position' => 'Vice President', 'count' => 12]
    ];
}

// Return the data as JSON
echo json_encode($allVoteData);
?> 