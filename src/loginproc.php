<?php
include('dbcon.php');
session_start();



// Function to get cooldown remaining time in seconds
function getCooldownRemaining($email)
{
    global $conn;

    $cooldown_time = 30; // 30 seconds cooldown period
    $sql = "SELECT TIMESTAMPDIFF(SECOND, last_attempt, NOW()) AS cooldown, attempts FROM login_attempts WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            // Check if the attempts have reached 3 or more
            if ($row['attempts'] >= 3 && $row['cooldown'] < $cooldown_time) {
                return $cooldown_time - $row['cooldown']; // Return the remaining cooldown time
            }
        }
    }
    return 0; // No cooldown if no attempts or enough time has passed
}

function getAttemptCount($email)
{
    global $conn;

    $sql = "SELECT attempts FROM login_attempts WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $row = $result->fetch_assoc();
        return $row ? $row['attempts'] : 0; // Return the number of attempts or 0 if no record
    }
    return 0; // No attempts record
}

$uemail = $_POST['email'];
$pass = md5($_POST['pass']);

// Check if the user is on cooldown
$cooldown_remaining = getCooldownRemaining($uemail);

if ($cooldown_remaining > 0) {
    $_SESSION['cooldown_remaining'] = $cooldown_remaining;
    $_SESSION['error'] = "You have attempted login too many times. Please try again in $cooldown_remaining seconds.";
    header('location: login.php');
    exit();
}

// Prepare and execute the SQL query to check the user credentials
$sql = "SELECT * FROM users WHERE email = ? AND password = ? AND confirmation = 'Complete'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $uemail, $pass);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $result->num_rows;

if ($count == 1) {
    $_SESSION['email'] = $uemail;


    if ($row['u_type'] == 'Admin') {
        $_SESSION['[status]'] = "Welcome Admin";
        $_SESSION['[status_code]'] = "info";
        $_SESSION['[status_button]'] = "Okay";
        header('location: admin_side/admin.php');
        exit();
    }
    // If the user is a Voter
    elseif ($row['u_type'] == 'Voter') {
        $name = $row['name'];
        $insert = "INSERT INTO audit_log (name, description, date_time) VALUES (?, 'Has Logged in', NOW())";
        $stmt3 = $conn->prepare($insert);
        $stmt3->bind_param('s', $name);
        $stmt3->execute();

        $_SESSION['[status]'] = "Welcome Student";
        $_SESSION['[status_code]'] = "info";
        $_SESSION['[status_button]'] = "Okay";
   
        header("location: user_side/index.php");
        exit();
    }
    // Default redirect
    else {
        header('location: default.php');
    }
} else {
    // Failed login attempt, update the attempt count and timestamp in the database
    $attempts = getAttemptCount($uemail);
    $new_attempts = $attempts + 1;

    // Update the login attempts and last attempt timestamp
    if ($attempts > 0) {
        $update = "UPDATE login_attempts SET attempts = ?, last_attempt = NOW() WHERE email = ?";
        $stmt3 = $conn->prepare($update);
        $stmt3->bind_param('is', $new_attempts, $uemail);
        $stmt3->execute();
    } else {
        // First failed attempt, insert a new record
        $insert = "INSERT INTO login_attempts (email, attempts, last_attempt) VALUES (?, 1, NOW())";
        $stmt4 = $conn->prepare($insert);
        $stmt4->bind_param('s', $uemail);
        $stmt4->execute();
    }

    $_SESSION['error'] = "Invalid credentials";
    $_SESSION['[status]'] = "Invalid credentials!";
    $_SESSION['[status_code]'] = "error";
    $_SESSION['[status_button]'] = "Okay";
    header('location: login.php');
}
