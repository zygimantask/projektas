<?php

include 'dbh.php';

$_SESSION['editedTask'] = "no";
$_SESSION['statusTableEdit'] = "no";

if (mysqli_connect_errno()) {
    printf("Failed to connect to database: ", mysqli_connect_error());
    exit();

} else {
    if (isset($_POST['submit-task-btn']) && isset($_POST['edit-task-id'])) {

        $row=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT executant FROM tasks WHERE task_ID=".$_POST['edit-task-id'].""));
        $userBefore=$row['executant'];

        $row=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT status FROM tasks WHERE task_ID=".$_POST['edit-task-id'].""));
        $_SESSION['beforeChange'] =$row['status'];

              $sql = "UPDATE tasks set title='" . trim($_POST['edit-task-title-input']) . "', description='" . $_POST['edit-task-description-area'] . "', update_date='" . date("Y-m-d") . "', status = '" . htmlentities($_POST['edit-status-select']) . "', priority = '" . htmlentities($_POST['edit-priority-select']) ."', executant = '".  $_POST['user-selection'] ."' where task_ID=" . $_POST['edit-task-id'];

        $res = mysqli_query($mysqli, $sql);

        if ($res) {
            $_SESSION['editedTask'] = "yes";
            if($userBefore!=$_POST['user-selection']){
              $_SESSION['addedUserEditTask']='yes';
              $_SESSION['addedUsersEditTask']=$_POST['user-selection'];
            }
        }
    }

    if (isset($_POST['submit-task-btn']) && ($_POST['status-table-item-click'] == "true")) {
        $_SESSION['statusTableEdit'] = "yes";
    }
}
mysqli_close($mysqli);
