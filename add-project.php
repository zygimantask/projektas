<?php
  include 'dbh.php';

$_SESSION['added'] = "no";

  if (mysqli_connect_errno()) {
      printf("Failed to connect to database: ", mysqli_connect_error());
      exit();


  } else {

      if(isset($_POST['submit-project-btn2'])){

        $sql = "INSERT INTO projects (project_name, status, description) VALUES ('".htmlentities($_POST['project-title-input'])."', '2', '".htmlentities($_POST['comment-area'])."')";
        $res = mysqli_query($mysqli, $sql);



        if($res){
          $_SESSION['added']='yes';
        }

        $row=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT project_ID FROM projects ORDER BY project_ID DESC LIMIT 1"));
        $_SESSION['project-id'] =$row['project_ID'] ;
        $row=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT project_name FROM projects ORDER BY project_ID DESC LIMIT 1"));
        $_SESSION['project-name'] =$row['project_name'] ;
      }

  }

  mysqli_close($mysqli);

?>
