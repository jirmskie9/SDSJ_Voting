<?php
    include("../dbcon.php");

    if (isset($_POST['conf'])) {
        $id = $_POST['id'];

    }    

    $couting = "UPDATE vote_counting SET count = 0";
    $update_c = $conn->query($couting);

    $del = "DELETE FROM votes";
    $delres = $conn->query($del);

    if($update_c){
        $_SESSION['[status]'] = "Voting Ended";
        $_SESSION['[status_code]'] = "info";
        $_SESSION['[status_button]'] = "Okay";
        header("Location: admin.php");
        exit();

    }else{
        echo("Error Updating");
    }
?>