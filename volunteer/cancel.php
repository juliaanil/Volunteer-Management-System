<?php 
	// error_reporting(0);
	session_start();
    
	
	require "class/db.php";

    if(isset($_SESSION['vemail']))
{
    // $oemail='".$_SESSION["oemail"]."';
    $vemail=$_SESSION["vemail"];
    //echo $oemail;
}
else{
    header("location: login.php");
}
// $eid = $_GET['eid'];
$_SESSION['eid'] = $_GET['eid'];
    //$sql1="select * from tbl_event where eid=$eid";
    
$eid=$_SESSION['eid'];

$sql1 = "SELECT * FROM tbl_volunteer WHERE vemail = '".$_SESSION["vemail"]."'";
    
$result1 = $db->query($sql1);
if ($result1->num_rows > 0) { 
    while ($row = $result1->fetch_assoc()) {
        $_SESSION['vid'] = $row['vid']; // set oid as a session variable
       
    }
}
$sql71 = "SELECT * FROM tbl_event WHERE eid = $eid";

$result71 = $db->query($sql71);

if ($result71->num_rows > 0) { 
    while ($row = $result71->fetch_assoc()) {
        $_SESSION['oid'] = $row['oid']; 
       
       
    }
}
$oid=$_SESSION['oid'];
$sql72 = "SELECT * FROM tbl_organization WHERE oid = $oid";

$result72 = $db->query($sql72);

if ($result72->num_rows > 0) { 
    while ($row = $result72->fetch_assoc()) {
        $_SESSION['obalance'] = $row['obalance']; 
       
       
    }
}
$obalance=$_SESSION['obalance'];
$sql11 = "SELECT * FROM tbl_event WHERE eid = '".$_SESSION["eid"]."'";
  
$result11 = $db->query($sql11);
if ($result11->num_rows > 0) { 
    while ($row = $result11->fetch_assoc()) {
        $_SESSION['ewage'] = $row['ewage'];
        $_SESSION['ereqno'] = $row['ereqno'];
        $_SESSION['eappliedno'] = $row['eappliedno'];
        // set oid as a session variable
       
    }
}

$ereqno= $_SESSION['ereqno'];
$eappliedno= $_SESSION['eappliedno'];


	if (isset($_POST["submit"]))
	{

           $eappliednonew=$eappliedno-1;
           $vid=$_SESSION["vid"];
           $eid=$_SESSION['eid'];
           $ewage=$_SESSION['ewage'];
           
           $date = date("Y-m-d"); 

           $sql111 = "SELECT pstatus FROM tbl_payment WHERE vid = $vid AND eid = $eid";
           $result111 = $db->query($sql111);
           
           if ($result111->num_rows > 0) { 
               while ($row111 = $result111->fetch_assoc()) {
                   $_SESSION['pstatus'] = $row111['pstatus']; // set pstatus as a session variable
               }
           }
           
           $pstatus = $_SESSION['pstatus'];
           
           if ($pstatus == "donation") {
               $obalancenew = $obalance - $ewage;
               $sql21 = "UPDATE tbl_organization SET obalance = $obalancenew WHERE oid = $oid";
               $db->query($sql21);
           }
           

           $sql = "DELETE FROM tbl_payment WHERE vid = $vid AND eid = $eid";

                
           $db->query($sql);
          
            $sql17="UPDATE tbl_event SET eappliedno = $eappliednonew WHERE eid = $eid";
           if ($db->query($sql17) === TRUE) {
               echo " ";
           } else {
               echo "Error updating record: " . $db->error;
           }
           $_SESSION['eappliedno'] = $eappliednonew;
           $sql12 = "DELETE FROM tbl_activity WHERE vid = $vid AND eid = $eid";

       
           if($db->query($sql12) == TRUE)
           {
               $_SESSION['msg'] = "Your application is cancelled ";
               header("location: index.php");
           }

         
          
          


        }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Volunteer </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/main.css" rel="stylesheet">

    <script>

        pid=0;
        sid=0;
        function getelname(val) { //val is etypeid
            etypeid=val;
            $.ajax({
                type: "POST",
                url: "get_elname.php",
                data: 'etypeid='+val,
                success: function(data) {
                    $("#eventlist").html(data);

                }
            });
        }

       
        function getsemester(val){ //val is bid
            $.ajax({
                type: "POST",
                url: "get_semester.php",
                data:'batchid='+val,
                success: function(data){
                    console.log(data);
                    $("#semlist").html(data);
                }
            })
        }

        function getsubject(val){ //val is sid
            $.ajax({
                type: "POST",
                url: "get_subject.php",
                data: 'semid='+val+'&pid='+pid,
                success: function(data){
                    console.log(data);
                    $("#subjectlist").html(data);
                }
            })
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
                <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Events</span></a>
            </li>
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                <i class="fas fa-fw fa-home"></i>
                    <span>My profile</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="interest.php">
                <i class="fas fa-fw fa-heart"></i>
                    <span>Your interests</span></a>
            </li>

          

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="activities.php">
                <i class="fas fa-fw fa-tasks"></i>
                    <span>Activities</span></a>
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
                                <a class="text-decoration-none" href="../logout.php">Logout</a>
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
                <div  class="main-panel align-middle ">
			<div style="min-height: 77vh;" class="bg-light content">

			
			

				<div class="col-md-12 ">
					<div class="card mt-4 bg-white">
						<div class="card-header">
						<div class="card-title"> 
							<!--<h3 style="font-size: 30px; display: inline-block;"> Batch </h3>-->
						</div>
						</div>
						<div class="card-body">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4  bg-white	">
									<!-- <div class="card-header">
										<div class="card-title">
											 Add new event
										</div>
									</div> -->
									<div class="card-body">
										<form action="" method="POST">

                                            <div class="form-group">
											

                                           
                                           
                                            <div class="form-group">
												<label for="exampleInputEmail1">Are you sure you want to cancel the application?</label><br>
                                               <td>
                                               <!-- <input type="radio" name="pstatus" value="donation"/>Yes
                                                <input type="radio" name="pstatus" value="pending"/>No -->
                                                </td>
                                         
                                            
											<div class="form-group">
                                                <button name="submit" type="submit" class="btn btn-primary ml-3 float-right">Yes</button>
                                                <a href="index.php"><input type="button" value="No" class="btn btn-danger float-right"></a>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class=" sticky-footer bg-white ">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SSTM 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
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