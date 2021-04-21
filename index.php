<!DOCTYPE html>

<?php

//Verification
session_start();

if (empty($_SESSION['login'])){
   header ('Location: login.php');
}

if (isset($_POST['logout'])) {
   session_destroy();
   header ('Location: login.php');
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Project Managment</title>
    <meta name="description" content="a">
    <meta name="author" content="SitePoint">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> 

</head>
<body>

<?php
$greetingName = "";

if (empty($_SESSION['name'])) {
    $greetingName = $_SESSION['login'];
}else {
    $greetingName = $_SESSION['name'];
}
?>


<!--Page top-->
<header class="bg-primary mb-4">
    <div class="container">
        <div class="navigation pt-1">
            <div class="row justify-content-between">


                <div class="col-1 col-sm-3">

                    <div id="user" class="text-white d-flex text-center username">
                        <div class="row">
                            <a href="#" class=" text-white " id="username"><?php echo $greetingName?><i class="fas fa-user mt-2 ml-2"></i></a>
                        </div>
                    </div>
                </div>

                <div>
                    <form action="" method="POST">
                        <button type="submit" name="logout" id="logout-btn" class="btn mr-4"><h3><i class="fas fa-sign-out-alt text-white"></i></h3></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</header>


<!-- Add new project modal -->
<div class="modal fade bd-add-project-lg" id="add-project-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content p-5">

            <form id="add-project-form">

                <div class="form-group">
                    <label for="project-title-input">Enter Project Title</label>
                    <input type="text" class="form-control border" id="project-title-input " placeholder="">
                </div>

                <div class="form-group">

                    <label for="description">Enter Project Comment</label>
                    <textarea class="form-control bg-light" id="comment-area" ></textarea>
                </div>


                <div class="d-flex justify-content-center mt-5">
                    <button class="btn bg-success text-white m-1" id="submit-project-btn"><i class="fas fa-check"></i>Submit</button>
                    <button class="btn bg-danger text-white m-1" id="close-modal-btn" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </form>


        </div>
    </div>
</div>




<!-- Edit project modal -->

<div class="modal fade bd-edit-project-lg" id="edit-project-modal" tabindex="-1" role="dialog" aria-labelledby="edit-project-modal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content p-5">

            <form id="add-project-form">

                <div class="form-group">
                    <label for="project-title-input">Edit Project Title</label>
                    <input type="text" class="form-control border" id="project-title-input " placeholder="">
                </div>

                <div class="form-group">

                    <label for="description">Edit Project Comment</label>
                    <textarea class="form-control bg-light" id="comment-area" ></textarea>
                </div>


                <div class="d-flex justify-content-center mt-5">
                    <button class="btn bg-success text-white m-1" id="submit-project-btn"><i class="fas fa-check"></i>Submit</button>
                    <button class="btn bg-danger text-white m-1" id="close-modal-btn" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </form>


        </div>
    </div>
</div>


<!--PROJECT INFO-->

<?php
include 'dbh.php';

$sqlAllProjects= "SELECT * FROM projects";
$resultAllProjects =mysqli_query($mysqli,$sqlAllProjects);
$queryResultAllProjects = mysqli_num_rows($resultAllProjects);

$sqlCompletedProjects= "SELECT * FROM projects WHERE status='2' ";
$resultCompletedProjects =mysqli_query($mysqli,$sqlCompletedProjects);
$queryResultCompletedProjects = mysqli_num_rows($resultCompletedProjects);

$sqlPendingProjects= "SELECT * FROM projects WHERE status='1'";
$resultPendingProjects =mysqli_query($mysqli,$sqlPendingProjects);
$queryResultPendingProjects = mysqli_num_rows($resultPendingProjects);

?>

<div class="container">
    <div class="row">

        <div class="col-xl-4 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fas fa-archive text-primary"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"><?php echo $queryResultAllProjects?></h5>
                    <p class="text-muted mb-0">Total Projects</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fas fa-check text-primary"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"><?php echo $queryResultCompletedProjects?></h5>
                    <p class="text-muted mb-0">Completed Projects</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-file text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"><?php echo $queryResultPendingProjects?></h5>
                    <p class="text-muted mb-0">Pending Projects</p>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->



    <div class="card">
        <div class="card-body">
            <div class="table-responsive project-list">
                <table class="table project-table table-centered table-nowrap">
                    <thead>
                    <tr>
                        <div class="d-flex justify-content-between">

                            <div>
                                <button id="add-new-project-btn" type="button" class="btn bg-success text-white" data-toggle="modal" data-target=".bd-add-project-lg"><i class="fas fa-plus"></i> Add project</button>
                            </div>

                            <div class="form-group">

                                <div class="input-group mb-1">
                                    <input type="text" class="form-control" placeholder="Search..." aria-describedby="project-search-addon" />
                                    <div class="input-group-append">
                                        <button class="btn bg-primary text-white" type="button" id="project-search-addon"><i class="fa fa-search search-icon font-1"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </tr>
                    </thead>
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Projects</th>
                        <th scope="col">Description</th>
<!--                        <th scope="col">Start Date</th>-->
<!--                        <th scope="col">Updated</th>-->
<!--                        <th scope="col">Finish Date</th>-->
                        <th scope="col">Status</th>
                        <th scope="col">Total tasks</th>
                        <th scope="col">Tasks pending</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

<?php
   include 'dbh.php';
   if($mysqli -> connect_error) {
       die("Connection failed:".$mysqli-> connect_error);
   }

   $sqlProjectTable = "SELECT projects.project_name, projects.description, statuses.status,
ROW_NUMBER() OVER (ORDER BY projects.project_ID) AS row_number,
(SELECT COUNT(*) FROM tasks WHERE project = projects.project_ID) AS project_total,
(SELECT COUNT(*) FROM tasks WHERE status=1 AND project=projects.project_ID) AS pending_project
FROM projects, statuses 
WHERE projects.status=statuses.status_ID";
   $resultProjectTable= $mysqli->query($sqlProjectTable);

   if ($resultProjectTable -> num_rows > 0) {
       while($rowProjectTable = $resultProjectTable -> fetch_assoc()) {
           echo " <tr class='text-center'>
                        <th scope='row'>".$rowProjectTable["row_number"]."</th> 
                        <td><a href=''>".$rowProjectTable["project_name"]."</a></td>
                        <td>".$rowProjectTable["description"]."</td>
                        
                        <td id='status'>
                            <span class='font-12 text-success'><i class='mdi mdi-checkbox-blank-circle mr-1'></i>".$rowProjectTable["status"]."</span>
                        </td>
                        <td>".$rowProjectTable["project_total"]."</td>
                        <td>".$rowProjectTable["pending_project"]."</td>
                        <td>
                            <div class='action m-1'>
                                <a href='#' class='text-success mr-1' data-toggle='tooltip' data-placement='top' title='' data-original-title='Download'><i class='fas fa-file-download'></i></a>
                                <a href='#' data-toggle='modal' data-target='.bd-edit-project-lg' class='text-success mr-1' data-toggle='tooltip' data-placement='top' title='' data-original-title='.bd-edit-project-lg'><i class='far fa-edit text-primary'></i></a>
                                <a href='#' class='text-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete'><i class='fas fa-trash'></i></a>
                            </div>
                        </td>
                    </tr>";
       }
   } else {
       echo "There was no results found!";
}

?>

                    </tbody>
                </table>
            </div>
            <!-- end project-list -->

<!--LIMIT AMOUNT OF PROJECT LINES ON ONE PAGE-->

<!--            <div class="pt-3">-->
<!--                <ul class="pagination justify-content-end mb-0">-->
<!--                    <li class="page-item disabled">-->
<!--                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>-->
<!--                    </li>-->
<!--                    <li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--                    <li class="page-item active"><a class="page-link" href="#">2</a></li>-->
<!--                    <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--                    <li class="page-item">-->
<!--                        <a class="page-link" href="#">Next</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>
</div>

<!-- end row -->
</div>



<script src="js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>




