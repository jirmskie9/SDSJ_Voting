<?php
include('../dbcon.php');
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$uname = isset($_GET['name']) ? $_GET['name'] : null;
$uemail = isset($_GET['email']) ? $_GET['email'] : null;

$sql = "UPDATE users SET confirmation = 'Complete' WHERE user_id = '$id'";
$result = $conn->query($sql);

if ($result) {
    $activity = "INSERT INTO activity_log (action, description, date_time) VALUES ('Confirmed Account', 'Admin confirmed account pending', NOW())";
    $result2 = $conn->query($activity);

    if ($result2) {
        $_SESSION['status'] = "Account Confirmed!";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_button'] = "Okay";
        header("Location: admin.php");
        exit();
    } else {
        echo "Error Activity";
    }
} else {
    $_SESSION['status'] = "Error in SQL query: " . $conn->error;
    $_SESSION['status_code'] = "error";
    $_SESSION['status_button'] = "Okay";
    header("Location: pending_acc.php");
    exit();
}
