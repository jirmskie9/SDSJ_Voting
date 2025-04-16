<?php
include('dbcon.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$otp = rand(100000, 999999);

if (isset($_POST['reg'])) {
    $uid = $_POST['lrn'];
    $uname = $_POST['name'];
    $uemail = $_POST['email'];
    $upass = md5($_POST['pass']);
    $grade = $_POST['grade'];
    $bday = $_POST['bday'];
    
    // Check if LRN and name exist in students table
    $checkStudentSql = "SELECT * FROM students WHERE lrn = '$uid' AND name = '$uname'";
    $checkStudentResult = $conn->query($checkStudentSql);
    
    if ($checkStudentResult->num_rows == 0) {
        $_SESSION['[status]'] = "You are not enrolled in the school. Please contact the administrator.";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: register.php");
        exit();
    }

    // Check if user is not 12 years old or above
    $dob = new DateTime($bday);
    $today = new DateTime();
    $age = $today->diff($dob)->y;

    if ($age < 12) {
        $_SESSION['[status]'] = "You must be at least 12 years old to register.";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: login.php");
        exit();
    }

    $checkSql = "SELECT * FROM users WHERE email = '$uemail' OR student_id = '$uid'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $_SESSION['[status]'] = "Account already exists!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: login.php");
        exit();
    } else {
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'kent29david@gmail.com';
            $mail->Password   = 'ibpf nxhq izsn qbwm';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients should not be enclosed in single quotes
            $mail->setFrom('kent29david@gmail.com', 'Verification Code');
            $mail->addAddress($uemail, $uname);

             // Disable SSL verification
             $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );


            // Content
            $mail->isHTML(false);
            $mail->Subject = 'SDSJ SSG Election SY. 2024-2025';
            $mail->Body    = "Hello $uname, your verification code is: $otp";

            $mail->send();
            echo 'Email sent successfully.';
        } catch (Exception $e) {
            echo "Failed to send email. Error: {$mail->ErrorInfo}";
            exit(); 
        }

        $sql = "INSERT INTO users (`student_id`, `name`, `email`, `password`, `grade`, `birthday`, `u_type`, `status`, `confirmation`, `otp`)
        VALUES ('$uid', '$uname', '$uemail', '$upass', '$grade', '$bday', 'Voter', 'To Vote', 'Pending', '$otp')";

        $result = $conn->query($sql);

        if ($result) {
            $_SESSION['uemail'] = $uemail;
            $_SESSION['[status]'] = "Confirm your email";
            $_SESSION['[status_code]'] = "info";
            $_SESSION['[status_button]'] = "Okay";
            header("Location: confirmation.php");
            exit();
        } else {
            $_SESSION['[status]'] = "Error in SQL query: " . $conn->error;
            $_SESSION['[status_code]'] = "error";
            $_SESSION['[status_button]'] = "Okay";
            header("Location: login.php");
            exit();
        }
    }
}
?>