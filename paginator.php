<?php

// conect to db
include 'dbh.php';

// how many result per page
$results_per_page = $_POST['projectsNumber'];

// find out the number of results stored in database
$sql="SELECT * FROM projects WHERE projects.project_ID IN (SELECT project_ID FROM user_projects WHERE email = '" . $_SESSION['login'] . "')";
$result = mysqli_query($mysqli, $sql);
if(!isset($_GET['search'])){
$number_of_results = mysqli_num_rows($result);
}
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
$sql="SELECT * FROM projects WHERE projects.project_ID IN (SELECT project_ID FROM user_projects WHERE email = '" . $_SESSION['login'] . "') LIMIT " . $this_page_first_result . "," .  $results_per_page;
$result = mysqli_query($mysqli, $sql);


?>
