<?php
include('../dbcon.php');
session_start();

if (isset($_POST['filec'])) {
    $plist = $_POST['plist'];
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
    $slogan = $_POST['slogan'];
    $projects = $_POST['projects'];
    $g11_strand = $_POST['g11_strand'];
    $g12_strand = $_POST['g12_strand'];

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
      OR g12_rep = '$g12'
      OR slogan = '$slogan'
      OR projects = '$projects')";


    $checkSqlCandidate = "SELECT * FROM candidate 
   WHERE (name = '$pres' OR name = '$vice' OR name = '$sec' OR name = '$trea' OR name = '$aud' OR name = '$pio1' OR name = '$pio2' OR name = '$pio3' OR name = '$pio4' OR name = '$po1' OR name = '$po2' OR name = '$po3' OR name = '$g7' OR name = '$g8' OR name = '$g9'OR name = '$g10'
   OR name = '$g11' OR name = '$g12')";


    $checkSql = "$checkSqlCandidates OR EXISTS ($checkSqlCandidate)";

    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $_SESSION['[status]'] = "There are names already filed candidacy!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: partylist.php");
        exit();

    } else {

        $sql = "INSERT INTO candidates (`partylist`, `pres`, `vice`, `sec`, `trea`, `aud`, `pio1`, `pio2`, `pio3`, `pio4`, `po1`, `po2`, `po3`, `g7_rep`, `g8_rep`, `g9_rep`, `g10_rep`, `g11_rep`, `g11_strand`, `g12_rep`, `g12_strand`, `date_time`, `slogan`, `projects`)
        VALUES ('$plist', '$pres', '$vice', '$sec', '$trea', '$aud', '$pio1', '$pio2', '$pio3', '$pio4', '$po1', '$po2', '$po3', '$g7', '$g8', '$g9', '$g10', '$g11', '$g11_strand', '$g12', '$g12_strand', NOW(), '$slogan', '$projects')";


        $result = $conn->query($sql);

        if ($result) {

            $activity = "INSERT INTO activity_log (action, description, date_time) VALUES ('Added $plist', 'Admin added a Partylist', NOW())";
            $result2 = $conn->query($activity);

            if ($result2) {

                // Start a transaction
                $conn->begin_transaction();

                try {
                    // Execute all vote_counting insertions
                    $countsqls = [
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$pres', 'President', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$vice', 'Vice President', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$sec', 'Secretary', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$trea', 'Treasurer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$aud', 'Auditor', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$pio1', 'Public Information Officer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$pio2', 'Public Information Officer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$pio3', 'Public Information Officer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$pio4', 'Public Information Officer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$po1', 'Peace Officer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$po2', 'Peace Officer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$po3', 'Peace Officer', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$g7', 'Grade 7 Representative', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$g8', 'Grade 8 Representative', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$g9', 'Grade 9 Representative', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$g10', 'Grade 10 Representative', '$plist', 0)",
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$g11', 'Grade 11 Representative', '$plist', 0)",
                        
                        "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$g12', 'Grade 12 Representative', '$plist', 0)"
                    ];

                    // Loop through each query and execute
                    foreach ($countsqls as $sql) {
                        if (!$conn->query($sql)) {
                            throw new Exception("Error in query: " . $conn->error);
                        }
                    }

                    // Commit the transaction
                    $conn->commit();

                    $_SESSION['[status]'] = "Successfully filed Candidacy";
                    $_SESSION['[status_code]'] = "success";
                    $_SESSION['[status_button]'] = "Okay";
                    header("Location: partylist.php");
                    exit();
                } catch (Exception $e) {
                    // Rollback the transaction on error
                    $conn->rollback();

                    // Log the error
                    $_SESSION['[status]'] = "Error: " . $e->getMessage();
                    $_SESSION['[status_code]'] = "error";
                    $_SESSION['[status_button]'] = "Okay";
                    header("Location: partylist.php");
                    exit();
                }


            } else {
                echo ("Error Activity");
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