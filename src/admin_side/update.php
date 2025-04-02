<?php
include('../dbcon.php');
session_start();

if (isset($_POST['filec'])) {
    $id = $_POST['partid'];
    $slogan = $_POST['slogan'];
    $plist = $_POST['plist'];
    $plist2 = $_POST['plist'];
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
    $g7 = $_POST['g7'];
    $g8 = $_POST['g8'];
    $g9 = $_POST['g9'];
    $g10 = $_POST['g10'];
    $g11 = $_POST['g11'];
    $g12 = $_POST['g12'];

    // Check for existing candidates in the "candidates" table
    $checkSqlCandidates = "SELECT * FROM candidates 
                      WHERE (pres = '$pres' 
                        OR vice = '$vice' 
                        OR sec = '$sec' 
                        OR trea = '$trea' 
                        OR aud = '$aud' 
                        OR pio1 = '$pio1' 
                        OR pio2 = '$pio2' 
                        OR pio3 = '$pio3' 
                        OR pio4 = '$pio4' 
                        OR po1 = '$po1' 
                        OR po2 = '$po2' 
                        OR po3 = '$po3' 
                        OR g7_rep = '$g7' 
                        OR g8_rep = '$g8' 
                        OR g9_rep = '$g9' 
                        OR g10_rep = '$g10' 
                        OR g11_rep = '$g11' 
                        OR g12_rep = '$g12')
                      AND can_id != $id";

    
    $checkSqlCandidate = "SELECT * FROM candidate 
                     WHERE (name = '$pres' OR name = '$vice' OR name = '$sec' OR name = '$trea' OR name = '$aud' OR name = '$pio1' OR name = '$pio2' OR name = '$pio3' OR name = '$pio4' OR name = '$po1' OR name = '$po2' OR name = '$po3' OR name = '$g7' OR name = '$g8' OR name = '$g9'OR name = '$g10'
                     OR name = '$g11' OR name = '$g12')
                     AND can_id != $id";

   
    $checkSql = "$checkSqlCandidates OR EXISTS ($checkSqlCandidate)";

    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $_SESSION['[status]'] = "There are names already filed candidacy!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: partylist.php");
        exit();
    } else {
        $sql = "UPDATE candidates SET 
                partylist = '$plist',
                pres = '$pres',
                vice = '$vice',
                sec = '$sec',
                trea = '$trea',
                aud = '$aud',
                pio1 = '$pio1',
                pio2 = '$pio2',
                pio3 = '$pio3',
                pio4 = '$pio4',
                po1 = '$po1',
                po2 = '$po2',
                po3 = '$po3',
                g7_rep = '$g7',
                g8_rep = '$g8',
                g9_rep = '$g9',
                g10_rep = '$g10',
                g11_rep = '$g11',
                g12_rep = '$g12',
                slogan = '$slogan'
                WHERE can_id = $id";

        $result = $conn->query($sql);

        if (!$result) {
            die("Error in SQL query: " . $conn->error);
        }

        if ($result) {

            $countsql = "UPDATE vote_counting SET partylist = '$plist' WHERE partylist ='$plist2'";
            $rescount = $conn->query($countsql);
            
            if($rescount){

                $activity = "INSERT INTO activity_log (action, description, date_time) VALUES ('Update Partylist', 'Admin updated a Partylist', NOW())";
                $result2 = $conn->query($activity);
                
                }else{
                    echo("Error Updating ");
                }

            if($result2){           

                $_SESSION['[status]'] = "Updated Successfully!";
                $_SESSION['[status_code]'] = "success";
                $_SESSION['[status_button]'] = "Okay";
                header("Location: partylist.php");
                exit();

            }else{
                echo("Error Activity");
            }
        } else {
            $_SESSION['[status]'] = "Error in SQL query: " . $conn->error;
            $_SESSION['[status_code]'] = "error";
            $_SESSION['[status_button]'] = "Okay";
            header("Location: partylist.php");
            exit();
        }
    }
}
?>