<?php 
	// error_reporting(0);
	session_start();
	
	require "class/db.php";

    if(!isset($_SESSION['oemail'])) 
    {
        header("location: login.php");
    }
    $eid = $_GET['eid'];
    $sql1="select * from tbl_event where eid=$eid";
    
   
    
    $result1=$db->query($sql1);
    if($result1->num_rows >0)
    { 
        while($row =$result1->fetch_assoc())
        {
        
            $eid = $row['eid'];
            $elid = $row['elid'];
            $oid = $row['oid'];
            $edescription = $row['edescription'];
            $estart = $row['estart'];
            $eend = $row['eend'];
            $etime = $row['etime'];
            $elocation = $row['elocation'];
            $eagell = $row['eagell'];
            $eageul = $row['eageul'];
            $ereqno = $row['ereqno'];
            $eappliedno = $row['eappliedno'];
            $ewage = $row['ewage'];
            $estatus = $row['estatus'];
        }
    }
   
    
	if (isset($_POST["submit"]))
	{
        if($_POST["pbid"]!=" ")
        { 
            $pname_new = $_POST['pName']; 
            //if name already exists print error message else insert
            $sql_select = "select * from tbl_program where pName='$pname_new'";
            $result = $db->query($sql_select);
            if($result->num_rows)
            {
                ?> 
                <script> alert("Program name already exists!"); </script>
                <?php 
            }
            else
            {
                $pname = $_GET['pname'];
                $sql = "update tbl_program set pName = '$pname_new' where pName = '$pname'";
                if($db->query($sql) == TRUE)
                { 
                $_SESSION['msg'] = "Program updated successfully!";
                header("location: index.php");
                }
                else
                {  
                ?> 
                <script> alert("Error!!"); </script>
                <?php
                echo " ".$db->error; 
                }
            }
            
        }
        else
        { ?> 
          <script> alert("Program name is empty!! "); </script>
          <?php 
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

    <title>Volunteer Management System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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

            <li class="nav-item">
                <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-chart-bar"></i>

                    <span>Reports</span></a>
            </li>

           

            <hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="donations.php">
    <i class="fas fa-money-bill"></i>

        <span>Donations</span></a>
</li>
 <!-- Divider -->
 <hr class="sidebar-divider my-0">
 <li class="nav-item">
    <a class="nav-link" href="preference.php">
    <i class="fas fa-fw fa-sliders-h"></i>



        <span>Volunteer preference</span></a>
</li>
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
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <!-- <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2"> -->
                            <div class="input-group-append">
                                <!-- <button class="btn btn-primary" type="button">
                                     <i class="fas fa-search fa-sm"></i> 
                                </button> -->
                            </div>
                        </div>
                    </form>

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
                <div  class="main-panel align-middle ">
			<div style="min-height: 77vh;" class="bg-light content">

			
			

				<div class="col-md-12 ">
					<div class="card mt-4 bg-white">
						<div class="card-header">
						<div class="card-title"> 
							<!--<h3 style="font-size: 30px; display: inline-block;"> Program </h3>-->
						</div>
						</div>
						<div class="card-body">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4  bg-white	">
									<div class="card-header">
                                    <style>
  .card-title {
    text-align: center;
    font-weight: bold;
    font-size: 20px;
    letter-spacing: 1px;
    
    font-family: Arial, sans-serif;
  }
</style>
										<div class="card-title">
											Event Details
										</div>
									</div>
									<div class="card-body">
										<form action="" method="POST">
                                        <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Description</label></div>
                                                <div style="width:10%"> <label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $edescription?></label></div>
											</div>
                                             <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Start Date</label></div>
                                                <div style="width:10%"> <label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $estart?></label></div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">End Date</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column"  for="exampleInputEmail1"><?php echo $eend?></label></div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Time</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $etime?></label> </div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Location</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $elocation?></label> </div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Minimum age for volunteer</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $eagell?></label> </div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Maximum age for volunteer</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $eageul?></label> </div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Required number of volunteers</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $ereqno?></label> </div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Number of volunteers applied</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $eappliedno?></label> </div>
											</div>
                                            <div class="form-group" style="display:flex">
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1">Wage for volunteer</label></div>
                                                <div style="width:10%"><label>:</label></div>
                                                <div style="width:50%"><label class="column" for="exampleInputEmail1"><?php echo $ewage?> Rs</label> </div>
											</div>
											</div>
											<div class="form-group">
												
											</div>
											<!-- <a href="organizationedit.php"><input type="button" value="Edit" class="btn btn-danger float-right"></a> -->
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
                        <span>Copyright &copy; SSTM 2022</span>
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