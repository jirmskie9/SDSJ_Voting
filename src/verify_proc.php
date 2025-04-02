<?php
include('dbcon.php');
session_start();

// Retrieve the email and OTP entered by the user
$uemail = $_POST['uemail'];
$entered_otp = $_POST['login_otp'];

// Validate the OTP entered by the user
$sql = "SELECT login_otp FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $uemail);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $stored_otp = $row['login_otp'];

    // Check if the entered OTP matches the one in the database
    if ($entered_otp == $stored_otp) {
        // OTP matches, login successful
        $_SESSION['email'] = $uemail; // Store the user's email in session
        $_SESSION['[status]'] = "Login Successful!";
        $_SESSION['[status_code]'] = "success";
        $_SESSION['[status_button]'] = "Okay";

        // Redirect to the user dashboard (user_side/index.php)
        header('location: user_side/index.php');
        exit();
    } else {
        // OTP does not match
        $_SESSION['error'] = "Invalid OTP. Please try again.";
        $_SESSION['[status]'] = "Invalid OTP!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Try Again";

        // Redirect back to OTP input page
        header('location: verify_login.php?email=' . $uemail);
        exit();
    }
} else {
    // If no user record is found for the given email
    $_SESSION['error'] = "User not found.";
    $_SESSION['[status]'] = "User not found!";
    $_SESSION['[status_code]'] = "error";
    $_SESSION['[status_button]'] = "Okay";

    // Redirect back to the login page
    header('location: login.php');
    exit();
}
?>
