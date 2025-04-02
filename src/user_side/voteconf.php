<?php
include('../dbcon.php');

session_start();

// Function to encrypt data
function encrypt($data, $key) {
    $method = "AES-256-CBC";
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encrypted);
}

if (isset($_POST['conf'])) {
    $voter = $_POST['name_v'];
    $grade =  $_POST['grade'];
    $pass = md5($_POST['password']);
    $pres =  $_POST['voted_pres'];
    $vice =  $_POST['voted_vice'];
    $sec =  $_POST['voted_sec'];
    $trea =  $_POST['voted_trea'];
    $aud =  $_POST['voted_aud'];
    $pio1 =  $_POST['voted_pio1'];
    $pio2 = $_POST['voted_pio2'];
    $pio3 = $_POST['voted_pio3'];
    $pio4 = $_POST['voted_pio4'];
    $po1 =  $_POST['voted_po1'];
    $po2 = $_POST['voted_po2'];
    $po3 = $_POST['voted_po3'];
    $rep =  $_POST['voted_representative'];

    function isPinMatch($conn, $voter, $pass) {
        $pinCheckSql = "SELECT password FROM users WHERE name = '$voter'";
        $pinCheckResult = $conn->query($pinCheckSql);

        if ($pinCheckResult->num_rows > 0) {
            $row = $pinCheckResult->fetch_assoc();
            $storedPassword = $row['password'];
            return ($storedPassword === $pass);
        }

        return false;
    }

    if (isPinMatch($conn, $voter, $pass)) {
        
        $sql = "UPDATE votes SET status = 'Confirmed' WHERE vote_name = '$voter'";
        $result = $conn->query($sql);

        if ($result) {

                $candidates = array($pres, $vice, $sec, $trea, $aud, $pio1, $pio2, $pio3, $pio4, $po1, $po2, $po3, $rep);

                foreach ($candidates as $position => $candidate) {
                    $updateCount = "UPDATE vote_counting SET count = count + 1 WHERE name = '$candidate'";
                    echo "Debug: Update Query - $updateCount<br>"; // Add this line for debugging
                    $resultCount = $conn->query($updateCount);
                
                    if ($resultCount === false) {
                        echo "Error updating vote count for $candidate: " . $conn->error;
                        exit();
                    }
                

                    $affectedRows = $conn->affected_rows;
                    echo "Debug: Affected Rows - $affectedRows<br>"; 
                
                    if ($affectedRows === 0) {
                        echo "No rows were updated for $candidate";
                        exit();
                    }
                }
                
                $update = "UPDATE users SET status = 'Voted' WHERE name = '$voter'";
                $res_update = $conn ->query($update);

                if ($res_update) {

                    $key = 657;

                    $voter_encrypted = encrypt($voter, $key);
                    $grade_encrypted = encrypt($grade, $key);
                    $pres_encrypted = encrypt($pres, $key);
                    $vice_encrypted = encrypt($vice, $key);
                    $sec_encrypted = encrypt($sec, $key);
                    $trea_encrypted = encrypt($trea, $key);
                    $aud_encrypted = encrypt($aud, $key);
                    $pio1_encrypted = encrypt($pio1, $key);
                    $pio2_encrypted = encrypt($pio2, $key);
                    $pio3_encrypted = encrypt($pio3, $key);
                    $pio4_encrypted = encrypt($pio4, $key);
                    $po1_encrypted = encrypt($po1, $key);
                    $po2_encrypted = encrypt($po2, $key);
                    $po3_encrypted = encrypt($po3, $key);
                    $rep_encrypted = encrypt($rep, $key);

                    $insert_statement = "INSERT INTO votes (vote_name, grade, voted_pres, voted_vice, voted_sec, voted_trea, voted_aud, voted_pio1, voted_pio2, voted_pio3, voted_pio4, voted_po1, voted_po2, voted_po3, voted_representative, date_time, `status`) 
                                        VALUES ('$voter', '$grade_encrypted', '$pres_encrypted', '$vice_encrypted', '$sec_encrypted', '$trea_encrypted', '$aud_encrypted', '$pio1_encrypted', '$pio2_encrypted', '$pio3_encrypted', '$pio4_encrypted', '$po1_encrypted', '$po2_encrypted', '$po3_encrypted', '$rep_encrypted', NOW(), 'Pending')";

                    $result2 = $conn->query($insert_statement);

                    
                    $activity = "INSERT INTO voting_activity (name, description, date_time) VALUES ('$voter_encrypted', 'has Voted', NOW())";
                    $result_act = $conn->query($activity);

                    if ($result_act) {
            
                        $_SESSION['[status]'] = "Successfully Voted!";
                        $_SESSION['[status_code]'] = "success";
                        $_SESSION['[status_button]'] = "Okay";
                        header("Location: index.php");
                        exit();
                    } else {
                        echo("Error");
                    }
                } else {
                    echo("Fail");
                }
            } else {
                echo("Error");
            }
        
    } else {
        $_SESSION['[status]'] = "Password does not match!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: vote_confirmation.php");
        exit();
    }
}
?>
