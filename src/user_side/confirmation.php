<?php
include('../dbcon.php');
session_start();

if (isset($_POST['conf'])) {
    $name = $_POST['voter'];
    $pres = $_POST['pres'];
    $vice = $_POST['vice'];
    $sec = $_POST['sec'];
    $trea = $_POST['trea'];
    $aud = $_POST['aud'];
    $pio1 = $_POST['pio1'];
    $pio2 = $_POST['pio2'];
    $pio3 = $_POST['pio3'];
    $pio4 = $_POST['pio4'];
    $po1 = $_POST['po1'];
    $po2 = $_POST['po2'];
    $po3 = $_POST['po3'];
    $rep = $_POST['rep']; 
    $grade = $_POST['grade']; 
    
    $insert = "INSERT INTO votes (vote_name, grade, voted_pres, voted_vice, voted_sec, voted_trea, voted_aud, voted_pio1, voted_pio2, voted_pio3, voted_pio4, voted_po1, voted_po2, voted_po3, voted_representative, date_time, `status`) 
    VALUES ('$name', '$grade', '$pres', '$vice', '$sec', '$trea', '$aud', '$pio1', '$pio2', '$pio3', '$pio4', '$po1', '$po2', '$po3', '$rep', NOW(), 'Pending')";
    $result2 = $conn->query($insert);
    if ($result2) {                   
            $_SESSION['voter'] = $name;
            $_SESSION['pres'] = $pres;
            $_SESSION['vice'] = $vice;
            $_SESSION['sec'] = $sec;
            $_SESSION['trea'] = $trea;
            $_SESSION['aud'] = $aud;
            $_SESSION['pio1'] = $pio1;
            $_SESSION['pio2'] = $pio2;
            $_SESSION['pio3'] = $pio3;
            $_SESSION['pio4'] = $pio4;
            $_SESSION['po1'] = $po1;
            $_SESSION['po2'] = $po2;
            $_SESSION['po3'] = $po3;
            $_SESSION['rep'] = $rep;
            $_SESSION['grade'] = $grade;
            $_SESSION['[status]'] = "Review your Vote!";
            $_SESSION['[status_code]'] = "info";
            $_SESSION['[status_button]'] = "Okay";
            header("Location: vote_confirmation.php");
            exit();
        } else {
            echo("Error Update");
        }
    } else {
        echo "Insertion failed";
    }
?>