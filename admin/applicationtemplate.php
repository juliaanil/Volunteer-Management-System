<?php

require "class/db.php";

session_start();
error_reporting(0);
if(isset($_SESSION['oemail']))
{
    // $oemail='".$_SESSION["oemail"]."';
    $vemail=$_SESSION["oemail"];
    //echo $oemail;
}
else{
    header("location: login.php");
}

$eid = $_GET['eid'];
$_SESSION['eid'] = $eid;
$eid = $_SESSION['eid'];
//     $sql10="select * from tbl_activity where eid=$eid";
//     $result10 = $db->query($sql10);
// if ($result10->num_rows > 0) { 
//     while ($row = $result10->fetch_assoc()) {
//         $_SESSION['vid'] = $row['vid']; // set oid as a session variable
//     }
// }
// $vid=$_SESSION["vid"];
    
   
// $sql10 = "SELECT * FROM tbl_volunteer WHERE vemail = '".$_SESSION["vemail"]."'";
    
// $result10 = $db->query($sql10);
// if ($result10->num_rows > 0) { 
//     while ($row = $result10->fetch_assoc()) {
//         $_SESSION['vid'] = $row['vid']; // set oid as a session variable
       
//     }
// }
// $vid=$_SESSION["vid"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Organization</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript">

        function selectAll() {
        
            let main = document.getElementById("checkbox-main");
            let row = document.getElementsByClassName("checkbox-child");   // alert(row.length);
            
            for (let i = 0; i < row.length; i++) {
                if(main.checked==true)
                    row[i].checked=true;
                else 
                    row[i].checked=false;
            }
        }
        arr = [];
        function multipleSelect(clickedid) {
            let row = document.getElementsByClassName("checkbox-child");
            
            for (let i=0; i<row.length; i++) {
                if(row[i].checked==true)
                arr.push(row[i].value);
            }
            if(clickedid=='delete_multiple') {
                if(confirm("Are you sure you want to delete?")==true)
                window.location.href = "multiple-select.php?checked="+arr+"&item=delete";
            }
            else if(clickedid=='mark-complete') {
                // if(confirm("Are you sure you want to change the status to Active?")==true)
                window.location.href = "multiple-select.php?checked="+arr+"&item=complete";
            }
            else if(clickedid=='mark-incomplete') {
                // if(confirm("Are you sure you want to change the status to Inactive?")==true)
                window.location.href = "multiple-select.php?checked="+arr+"&item=incomplete";
            }

        }
    </script>

</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <div class=" sidebar-brand-text d-flex mt-3 justify-content-center">
        <image class="" src="img/logo.jpg" style="width:60px"></image>
            </div><br>
            <a class="sidebar-brand d-flex mb-3 align-items-center justify-content-center" href="index.html"><br><br>
            <style>
  .sidebar-brand-text {
    text-transform: none;
  }
</style>
                <div class="sidebar-brand-text">Volunteer Management for Non-Profits and Community Groups </div> 
            </a>
            <hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="index.php">
    <i class="fas fa-fw fa-home"></i>
        <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="events.php">
    <i class="fas fa-fw fa-calendar-alt"></i>
        <span>Events</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="new.php">
    <i class="fas fa-fw fa-plus"></i> 
        <span>Add new event</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="request.php">
    <i class="fas fa-fw fa-envelope"></i> 
        <span>Requests</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="bg-gray-200">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown  -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                           
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-gray-200 border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                           
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item">
                                <i class="fas fa-signout-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                <a class="text-decoration-none" href="logout.php">Logout</a>
                                </div>
                                <!-- <input type="submit" value="Logout" name="logout" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"/> -->
                                    <!-- 
                                    Logout -->
                                 <!-- </input> -->
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                  <!-- Begin Page Content -->
                  <div class="container-fluid">

<!-- Page Heading -->
<style>
  .h3 {
    text-transform: none;
    font-family: Arial, sans-serif;
    font-size: 36px;
    font-weight: bold;
    color: #333;
    text-align: center;
    letter-spacing: 1px;
    margin: 20px 0;
  }
</style>

<h1 class="h3 mb-2 text-gray-800 text-center">Applications from volunteers</h1>
<div>
    <?php  
        if(isset($_SESSION['msg'])) {
            echo "<div class='message'>".$_SESSION['msg']."</div>";
            unset($_SESSION['msg']);
    }
    ?>
</div>


            <div class="card">
            <form action="" method="POST">
           
                 <br> 
                 <div class="form-group">
    <label for="exampleInputEmail1">Select</label>
    <select name="vtype" class="form-control" required>
        <option value="all">All</option>
        <option value="donation">Donation</option>
        <option value="payment">Payment</option>
    </select>
</div>

                                            <div class="form-group">
                                                <button name="submit" type="submit" class="btn btn-primary ml-3 float-right">Submit</button>
                                                
											</div><br><br>
<div class="card shadow mb-4">
 
    <!-- <div class="card-body"> -->
        <div class="table-responsive">
        <?php
        if(isset($_POST["submit"]))
        {
          
$vtype = $_POST['vtype'];
$next_date = trim($_POST['eend']);


$sql1 = "SELECT * FROM tbl_event WHERE estart BETWEEN '$prev_date' AND '$next_date'";

    
$result1 = $db->query($sql1);                                                                                                       
if ($result1->num_rows > 0) {
$serial=1;
                        
                        ?>
                      
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                        <tr>
                      
                        <th style="text-align:center;"><b>S.No</b></th> 
                        <th style="text-align:center;"><b>Event</b></th>
                        <th style="text-align:center;"><b>Time</b></th>
                        <th style="text-align:center;"><b>Location</b></th>
                        <th style="text-align:center;"><b>Required volunteers</b></th>
                        <th style="text-align:center;"><b>Applied volunteers</b></th>
                        <th style="text-align:center;"><b>Wage for volunteer</b></th>
                        <th style="text-align:center;"><b>Status</b></th>


                            
                       
                        </tr>
                        <?php 

						while($row = $result1->fetch_assoc())
						{
			            ?>

                        <tr>
                        
                        
                        </form>
                        <td><?php echo $serial; ?></td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["edescription"];?></td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["etime"];?></td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["elocation"];?></td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["ereqno"];?></td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["eappliedno"];?></td>

                    
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["ewage"]; echo "Rs";$serial=$serial+1;?></td>
                        <td style="justify-content:center; text-align:center" width="10%"> 
                            <?php 
                                if($row["estatus"]=='complete') {?>
                                <span style="color:green" class="glyphicon glyphicon-edit fas fa-md mt-1 py-2 fa-check " aria-hidden="true"></span> 
                            <?php
                                }
                                else if($row["estatus"]=='incomplete') { ?> 
                                <span style="color:maroon" class="glyphicon glyphicon-edit fas fa-lg mt-1 py-2 fa-times" aria-hidden="true"></span>
                            <?php } ?>
                        </td>
                         
                       
                        </tr>
                        
                        <?php
                            }
                        }}
                       ?>
						
                </tbody>
                
            </table>

    <style>
    .card {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-primary:focus, .btn-primary.focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

.btn-lg {
    padding: 10px 30px;
    font-size: 24px;
    border-radius: 50px;
}

</style>


    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <footer class=" sticky-footer bg-white ">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SSTM 2022</span>
                    </div> 
                </div>
            </footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
 
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
   
</body>

</html>
