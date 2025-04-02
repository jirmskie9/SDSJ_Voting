<?php
include('../dbcon.php');

session_start();



if (isset($_POST['conf'])) {
    $id = $_POST['id'];
    $pin = md5($_POST['pin']);

    // Function to check if PIN matches
    function isPinMatch($conn, $pin) {
        $pinCheckSql = "SELECT * FROM pin WHERE pin_id = 1 AND pin = '$pin'";
        $pinCheckResult = $conn->query($pinCheckSql);
        return ($pinCheckResult->num_rows > 0);
    }

    if (isPinMatch($conn, $pin)) {
        // Function to check if description is "Already Started" and exit
function checkAlreadyStarted($conn) {
    $sql_check_started = "SELECT * FROM signal_db WHERE description = 'Started'";
    $result_check_started = $conn->query($sql_check_started);

    if ($result_check_started->num_rows > 0) {
        $_SESSION['[status]'] = "Voting is already started!";
        $_SESSION['[status_code]'] = "warning";
        $_SESSION['[status_button]'] = "Okay";
        header('Location: admin.php');
        exit();
    }
}

// Check for "Already Started" status and exit if needed
checkAlreadyStarted($conn);
        $sql = "UPDATE signal_db SET description = 'Started'";
        $result = $conn->query($sql);

        if ($result) {
            $insert = "INSERT INTO activity_log (action, description, date_time) VALUES ('Voting Started', 'The admin started the voting', NOW())";
            $result2 = $conn->query($insert);

            if ($result2) {
                $_SESSION['[status]'] = "Voting Started!";
                $_SESSION['[status_code]'] = "success";
                $_SESSION['[status_button]'] = "Okay";
                header("Location: admin.php");
                exit();
            } else {
                echo("Fail");
            }
        } else {
            $_SESSION['[status]'] = "Error in SQL query: " . $conn->error;
            $_SESSION['[status_code]'] = "error";
            $_SESSION['[status_button]'] = "Okay";
            header("Location: admin.php");
            exit();
        }
    } else {
        $_SESSION['[status]'] = "PIN does not match!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: admin.php");
        exit();
    }
}
?>