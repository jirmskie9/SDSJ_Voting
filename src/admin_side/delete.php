<?php
include('../dbcon.php');

session_start();

if (isset($_POST['delete'])) {
    $id = $_POST['part_id'];
    $plist = $_POST['plist'];
    $pin = md5($_POST['pin']);

   
    function isPinMatch($conn, $pin) {
        $pinCheckSql = "SELECT * FROM pin WHERE pin_id = 1 AND pin = '$pin'";
        $pinCheckResult = $conn->query($pinCheckSql);
        return ($pinCheckResult->num_rows > 0);
    }

    if (isPinMatch($conn, $pin)) {

        $delete = "DELETE FROM vote_counting WHERE partylist = '$plist'";
        $result_del = $conn->query($delete);

        $sql = "DELETE FROM candidates WHERE can_id = '$id'";
        $result = $conn->query($sql);

        if ($result) {

            $activity = "INSERT INTO activity_log (action, description, date_time) VALUES ('Deleted $plist', 'Admin deleted a Partylist', NOW())";
            $result2 = $conn->query($activity);

            if($result2){           

            $_SESSION['[status]'] = "Deleted Successfully!";
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
    } else {
        $_SESSION['[status]'] = "PIN does not match!";
        $_SESSION['[status_code]'] = "error";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: edit.php?id=" . urlencode($id));
        exit();
    }
}
?>