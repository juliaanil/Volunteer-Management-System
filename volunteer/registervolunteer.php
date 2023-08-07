<?php 
	// error_reporting(0);
	session_start();
	
	require "class/db.php";
    // require "organization/class/db.php";

   /* if(!isset($_SESSION['adminid'])) 
    {
        header("location: ../login.php");
    }*/
    $vid=0;

	if (isset($_POST["submit"]))
	{
                // $bname = $_POST['bName'];
               
                $vpswd = $_POST['vpswd'];
                $confirmvpswd = $_POST['confirmvpswd'];
                // $age=$_POST['dob_year'];
                
                if($vpswd != $confirmvpswd){
                    // $sql = "insert into tbl_volunteer (vname,vphone,vemail,vpswd,vaddr,vage,vgender) VALUES ('".$_POST["vname"]."','".$_POST["vphone"]."','".$_POST["vemail"]."','".$_POST["vpswd"]."','".$_POST["vaddr"]."',$age,'".$_POST["vgender"]."')";
                    // $db->query($sql);
                   
                    // if($db->query($sql) == TRUE)
                    // { 
                        ?><script> alert("Your passwords do not match!!"); </script><?php
                       
                    //     $sql5 = "SELECT vid FROM tbl_volunteer WHERE vpswd = '$vpswd'";

                    //    echo "Registration Successful!";
                    //     $result5=$db->query($sql5);
                      
                    //     if (mysqli_num_rows($result5) > 0) {
                   
                    //       $row = mysqli_fetch_assoc($result5);
                     
                    //       $vid = $row["vid"];
                    //     }
                      
                       
                    //     if (isset($_POST['eltype'])) {
                    //         // Get the selected checkboxes as an array
                    //         $selectedCheckboxes = $_POST['eltype'];
                        
                    //         // Loop through the selected checkboxes
                    //         foreach ($selectedCheckboxes as $checkbox) {
                    //           //echo $checkbox . "<br>";
                    //           $sql = "insert into tbl_volunteerevents (vid,eltype) VALUES ($vid,$checkbox)";
                    //           // Do something with the selected checkbox, such as inserting into a database
                    //         }
                    //       }
                        
                        
                        header("location: login.php");
                    }
                    // else
                    // {   
                    // echo " ".$db->error;
                     
                    // }
                // }
                else {
                  echo  $sql = "insert into tbl_volunteer (vname,vphone,vemail,vpswd,vaddr,vage,vgender) VALUES ('".$_POST["vname"]."','".$_POST["vphone"]."','".$_POST["vemail"]."','".$_POST["vpswd"]."','".$_POST["vaddr"]."','".$_POST["dob_year"]."','".$_POST["vgender"]."')";
                    $db->query($sql);
                    
                    ?>
                    
                    <!-- <script> alert("Your registration details have been successfully submitted. Please note that your account is currently pending approval by the admin"); </script> -->
                    
                    <?php
                
                    if (isset($_POST['etypeid'])) { 
                        
                        $selectedCheckboxes = $_POST['etypeid'];
                
                        // Loop through the selected checkboxes
                        foreach ($selectedCheckboxes as $checkbox) {
                            $sql5 = "SELECT vid FROM tbl_volunteer WHERE vpswd = '$vpswd'";
                            $result5 = $db->query($sql5);
                          
                            if (mysqli_num_rows($result5) > 0) {
                                $row = mysqli_fetch_assoc($result5);
                                $vid = $row["vid"];
                                $sql6 = "insert into tbl_volunteerevents (vid,etypeid) VALUES ($vid,$checkbox)";
                                $db->query($sql6);
                                // header("location: login.php");
                            }
                        }
                    }
                } // Move the closing brace here

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

    <title>Volunteer</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/main.css" rel="stylesheet">
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <!-- <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar"> -->

            <!-- <div class=" sidebar-brand-text d-flex mt-3 justify-content-center">
                <image class="" src="img/scms-logo.jpg" style="width:60px"></image>
            </div> -->
            <!-- <a class="sidebar-brand d-flex mb-3 align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text">Timetable Management System </div> 
            </a>
             -->
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <!-- <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-clock"></i> 
                    <span>Timetable</span></a> -->
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            

            <li class="nav-item">
                <!-- <a class="nav-link" href="..program/index.php" >
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Program</span>
                </a> -->
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            

            <li class="nav-item">
                <!-- <a class="nav-link" href="index.php" >
                    <i class="fas fa-fw fa-users"></i>
                    <span>Batch</span>
                </a> -->
            </li>
    </ul>    
 
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
                        <!-- <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2"> -->
                            <!-- <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div> -->
                        <!-- </div> -->
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
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span> -->
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
							<!--<h3 style="font-size: 30px; display: inline-block;"> Batch </h3>-->
						</div>
						</div>
						<div class="card-body">
							<div class="col-md-5 mr-auto ml-auto ">
								<div class="card mt-4  bg-white	">
									<div class="card-header">
										<!-- <div class="card-title"> -->
                                        <!-- <div class="card-title" style="text-align: center;">
											 Register your organization
										</div> -->
                                        <div class="card-title" style="text-align: center; font-size: 24px; font-weight: bold;">
   Register here
</div>
                                        
  
									</div>
									<div class="card-body">
										<!-- <form action="" method="POST"> -->
                                        <form action="process_registration.php" method="POST" enctype="multipart/form-data">
    <!-- Existing form fields -->
                                        
											<div class="form-group">
												<label for="exampleInputEmail1">Enter your name</label>
                                                <input type="text" autofocus name="vname" class="form-control" placeholder="Name" required />
												<!--<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Enter phone number</label>
                                                <input type="int" autofocus name="vphone" class="form-control" placeholder="Phone no" required />
												<!--<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Enter email id</label>
                                                <input type="text" autofocus name="vemail" class="form-control" placeholder="Email id" required />
												<!--<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
</div>
                                           
                                            <div class="form-group">
												<label for="exampleInputEmail1">Enter password</label>
                                                <input type="password" autofocus name="vpswd" class="form-control" placeholder="Password" required />
												<!--<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Confirm password</label>
                                                <input type="password" autofocus name="confirmvpswd" class="form-control" placeholder="Confirm password" required />
												<!--<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
											</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Enter address</label>
                                                <input type="text" autofocus name="vaddr" class="form-control" placeholder="Address" required />
												 
											</div>
                                            <div class="form-group">
    <label for="exampleInputDOB">Enter date of birth</label>
    <div class="form-inline">
        <input type="text" autofocus name="dob_day" class="form-control" placeholder="DD" maxlength="2" style="width: 60px" required />
        <input type="text" name="dob_month" class="form-control" placeholder="MM" maxlength="2" style="width: 60px; margin-left: 10px; margin-right: 10px" required />
        <input type="text" name="dob_year" class="form-control" placeholder="YYYY" maxlength="4" style="width: 70px" required />
    </div>
</div>
                                            <div class="form-group">
												<label for="exampleInputEmail1">Select gender</label><br>
                                               <td>
                                               <input type="radio" name="vgender" value="male"/>Male
                                                <input type="radio" name="vgender" value="female"/>Female
                                                 <input type="radio" name="vgender" value="others"/>Others
                                                </td>
                                                <!--<input type="text" autofocus name="fGender" class="form-control" placeholder="female/male" required />
												<p style = "color: red;"><?php echo $errMsg; ?></p>  --> 
											</div>
                                            <div class="form-group">
  <label for="exampleInputEmail1">Choose event types you are interested to volunteer</label><br>
  
  <input type="checkbox" name="etypeid[]" value="1"/>Fundraising events&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="2"/>Awareness programs&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="3"/>Community works&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="4"/>Food and clothing&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="5"/>Health fairs&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="6"/>Educational workshops&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="7"/>Mentorship&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="8"/>Shelter building&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="9"/>Cultural programs&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="10"/>Disaster relief&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="11"/>Advocay&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="12"/>Job fair&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="13"/>Youth programs&emsp;<br>
  <input type="checkbox" name="etypeid[]" value="14"/>Senior citizen programs&emsp;<br>
</div>
<label for="exampleInputIDCard">Upload your ID Card (Aadhaar Card, College ID Card, or Driving License)</label>
    <input type="file" name="id_card" id="id_card">
    
    <!-- <input type="submit" value="Submit"> -->
                                            
                                          
<div class="d-flex justify-content-center">
  <button name="submit" type="submit" class="btn btn-primary">Register</button>
</div>

                                                <!-- <button name="submit" type="submit" class="btn btn-primary ml-3 float-right">Register</button> -->
                                                <!-- <a href="index.php"><input type="button" value="Back" class="btn btn-danger float-right"></a> -->
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