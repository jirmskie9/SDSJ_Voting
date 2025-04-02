<?php
include('../dbcon.php');

session_start();

if (isset($_POST['conf'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pin = md5($_POST['pin']);

    // Function to check if PIN matches
    function isPinMatch($conn, $pin) {
        $pinCheckSql = "SELECT * FROM pin WHERE pin_id = 1 AND pin = '$pin'";
        $pinCheckResult = $conn->query($pinCheckSql);
        return ($pinCheckResult->num_rows > 0);
    }

    if (isPinMatch($conn, $pin)) {

        $delete = "DELETE FROM vote_counting WHERE name = '$name'";
        $result_del = $conn->query($delete);

        $sql = "DELETE FROM candidate WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result) {

            $activity = "INSERT INTO activity_log (action, description, date_time) VALUES ('Deleted $name', 'Admin deleted a candidate', NOW())";
            $result2 = $conn->query($activity);

            if($result2){           

            $_SESSION['[status]'] = "Deleted Successfully!";
            $_SESSION['[status_code]'] = "success";
            $_SESSION['[status_button]'] = "Okay";
            header("Location: independent.php");
            exit();

            }else{
                echo("Error Activity");
            }
        } else {
            $_SESSION['[status]'] = "Error in SQL query: " . $conn->error;
            $_SESSION['[status_code]'] = "error";
            $_SESSION['[status_button]'] = "Okay";
            header("Location: independent.php");
            exit();
        }
    } else {
        $_SESSION['[status]'] = "PIN does not match!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: independent.php");
        exit();
    }
}
?>