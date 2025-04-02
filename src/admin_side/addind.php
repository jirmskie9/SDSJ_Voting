<?php
include('../dbcon.php');
session_start();

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];

    $checkSql = "SELECT * FROM candidates 
    WHERE (pres = '$name' 
       OR vice = '$name' 
       OR sec = '$name' 
       OR trea = '$name' 
       OR aud = '$name' 
       OR pio1 = '$name' 
       OR pio2 = '$name' 
       OR pio3 = '$name' 
       OR pio4 = '$name' 
       OR po1 = '$name' 
       OR po2 = '$name' 
       OR po3 = '$name' 
       OR g7_rep = '$name' 
       OR g8_rep = '$name' 
       OR g9_rep = '$name' 
       OR g10_rep = '$name' 
       OR g11_rep = '$name' 
       OR g12_rep = '$name')
    OR EXISTS (SELECT * FROM candidate WHERE name = '$name')";


    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $_SESSION['status'] = "Already filed candidacy!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_button'] = "Okay";
        header("Location: independent.php");
        exit();

    } else {
        $positionColumns = array(
            'President' => 'President',
            'Vice President' => 'Vice President',
            'Secretary' => 'Secretary',
            'Treasurer' => 'Treasurer',
            'Auditor' => 'Auditor',
            'PIO' => 'PIO',
            'PO' => 'PO',
            'Grade7' => 'Grade 7 Representative',
            'Grade8' => 'Grade 8 Representative',
            'Grade9' => 'Grade 9 Representative',
            'Grade10' => 'Grade 10 Representative',
            'Grade11' => 'Grade 11 Representative',
            'Grade12' => 'Grade 12 Representative',
        );

        
        if (array_key_exists($position, $positionColumns)) {
            $column = $positionColumns[$position];

            $sql = "INSERT INTO candidate (`name`, `running_for`, `partylist`, `date_time`)
            VALUES ('$name', '$column', 'Independent', NOW())";


            $result = $conn->query($sql);

            if ($result) {

                $activity= "INSERT INTO activity_log (action, description, date_time) VALUES ('Added $name', 'Admin add independent candidate', NOW())";
                $result2 = $conn->query($activity);

                if($result2){
                    $countsql = "INSERT INTO vote_counting (name, position, partylist, count) VALUES ('$name', '$column', 'Independent', 0)";
                    $rescount = $conn->query($countsql);
                    
                    if($countsql){
               
                        $_SESSION['status'] = "Successfully filed Candidacy";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_button'] = "Okay";
                        header("Location: independent.php");
                        exit();
                    }else{
                        echo("Error Count");
                    }
                } else {
                    echo("Error Activity");
                }
            } else {
                $_SESSION['status'] = "Error in SQL query: " . $conn->error;
                $_SESSION['status_code'] = "error";
                $_SESSION['status_button'] = "Okay";
                header("Location: independent.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid position selected";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_button'] = "Okay";
            header("Location: independent.php");
            exit();
        }
    }
} else {
    $_SESSION['status'] = "Invalid position selected";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_button'] = "Okay";
    header("Location: candidates.independent.php");
    exit();
}
?>