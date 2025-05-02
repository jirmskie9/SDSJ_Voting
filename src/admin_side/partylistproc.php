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
    WHERE (pres = '$pres' AND pres IS NOT NULL AND pres != '')
      OR (vice = '$vice' AND vice IS NOT NULL AND vice != '')
      OR (sec = '$sec' AND sec IS NOT NULL AND sec != '')
      OR (trea = '$trea' AND trea IS NOT NULL AND trea != '')
      OR (aud = '$aud' AND aud IS NOT NULL AND aud != '')
      OR (pio1 = '$pio1' AND pio1 IS NOT NULL AND pio1 != '')
      OR (pio2 = '$pio2' AND pio2 IS NOT NULL AND pio2 != '')
      OR (pio3 = '$pio3' AND pio3 IS NOT NULL AND pio3 != '')
      OR (pio4 = '$pio4' AND pio4 IS NOT NULL AND pio4 != '')
      OR (po1 = '$po1' AND po1 IS NOT NULL AND po1 != '')
      OR (po2 = '$po2' AND po2 IS NOT NULL AND po2 != '')
      OR (po3 = '$po3' AND po3 IS NOT NULL AND po3 != '')
      OR (g7_rep = '$g7' AND g7_rep IS NOT NULL AND g7_rep != '')
      OR (g8_rep = '$g8' AND g8_rep IS NOT NULL AND g8_rep != '')
      OR (g9_rep = '$g9' AND g9_rep IS NOT NULL AND g9_rep != '')
      OR (g10_rep = '$g10' AND g10_rep IS NOT NULL AND g10_rep != '')
      OR (g11_rep = '$g11' AND g11_rep IS NOT NULL AND g11_rep != '')
      OR (g12_rep = '$g12' AND g12_rep IS NOT NULL AND g12_rep != '')";

    $checkSqlCandidate = "SELECT * FROM candidate 
    WHERE (name = '$pres' AND name IS NOT NULL AND name != '')
      OR (name = '$vice' AND name IS NOT NULL AND name != '')
      OR (name = '$sec' AND name IS NOT NULL AND name != '')
      OR (name = '$trea' AND name IS NOT NULL AND name != '')
      OR (name = '$aud' AND name IS NOT NULL AND name != '')
      OR (name = '$pio1' AND name IS NOT NULL AND name != '')
      OR (name = '$pio2' AND name IS NOT NULL AND name != '')
      OR (name = '$pio3' AND name IS NOT NULL AND name != '')
      OR (name = '$pio4' AND name IS NOT NULL AND name != '')
      OR (name = '$po1' AND name IS NOT NULL AND name != '')
      OR (name = '$po2' AND name IS NOT NULL AND name != '')
      OR (name = '$po3' AND name IS NOT NULL AND name != '')
      OR (name = '$g7' AND name IS NOT NULL AND name != '')
      OR (name = '$g8' AND name IS NOT NULL AND name != '')
      OR (name = '$g9' AND name IS NOT NULL AND name != '')
      OR (name = '$g10' AND name IS NOT NULL AND name != '')
      OR (name = '$g11' AND name IS NOT NULL AND name != '')
      OR (name = '$g12' AND name IS NOT NULL AND name != '')";

    // Execute both queries separately
    $checkResultCandidates = $conn->query($checkSqlCandidates);
    $checkResultCandidate = $conn->query($checkSqlCandidate);

    $conflictingNames = array();

    // Check candidates table
    if ($checkResultCandidates->num_rows > 0) {
        while($row = $checkResultCandidates->fetch_assoc()) {
            foreach(['pres', 'vice', 'sec', 'trea', 'aud', 'pio1', 'pio2', 'pio3', 'pio4', 'po1', 'po2', 'po3', 'g7_rep', 'g8_rep', 'g9_rep', 'g10_rep', 'g11_rep', 'g12_rep'] as $position) {
                if (isset($row[$position]) && !empty($row[$position]) && in_array($row[$position], [$pres, $vice, $sec, $trea, $aud, $pio1, $pio2, $pio3, $pio4, $po1, $po2, $po3, $g7, $g8, $g9, $g10, $g11, $g12])) {
                    $conflictingNames[] = $row[$position] . " (in candidates table)";
                }
            }
        }
    }

    // Check candidate table
    if ($checkResultCandidate->num_rows > 0) {
        while($row = $checkResultCandidate->fetch_assoc()) {
            if (isset($row['name']) && !empty($row['name']) && in_array($row['name'], [$pres, $vice, $sec, $trea, $aud, $pio1, $pio2, $pio3, $pio4, $po1, $po2, $po3, $g7, $g8, $g9, $g10, $g11, $g12])) {
                $conflictingNames[] = $row['name'] . " (in candidate table)";
            }
        }
    }

    if (!empty($conflictingNames)) {
        $_SESSION['[status]'] = "The following names are already filed for candidacy: " . implode(", ", array_unique($conflictingNames));
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