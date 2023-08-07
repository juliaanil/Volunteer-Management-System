<?php

require "class/db.php";

session_start();

if(!isset($_SESSION['oemail'])) 
{
    header("location: login.php");
}
else{
    // header("location: login.php");
}
$sql1="select * from tbl_organization where oemail='".$_SESSION["oemail"]."'";
    
    $result1=$db->query($sql1);
    if($result1->num_rows >0)
    { 
        while($row =$result1->fetch_assoc())
        {
        
            $oid = $row['oid'];}}


            $sql11 = "SELECT SUM(eappliedno) AS total_volunteers FROM tbl_event WHERE oid = $oid";
            $result11 = $db->query($sql11);
            
            if ($result11 === false) {
                echo "Error executing query: " . $db->error;
            } else {
                $row11 = $result11->fetch_assoc();
            
                if ($row11 === null) {
                    echo "No results found.";
                } else {
                    $total_volunteers = $row11['total_volunteers'];
                    // echo $total_volunteers;
                }
            }
            

$total_events = mysqli_num_rows($db->query("select * from tbl_event WHERE oid =$oid"));
$total_donations = mysqli_num_rows($db->query("SELECT * FROM tbl_payment WHERE pstatus = 'donation' AND eid IN (SELECT eid FROM tbl_event WHERE oid = $oid)"));
 
$sql = "SELECT obalance FROM tbl_organization WHERE oid = $oid";

$result = $db->query($sql);

// Check if the query executed successfully
if ($result === false) {
    echo "Error executing query: " . $conn->error;
} else {
    // Retrieve the total_amount value
    $row = $result->fetch_row();
    $total_amount = $row[0];

    // Output the total_amount value
    // echo "Total amount: " . $total_amount;
}
$sql2 = "SELECT SUM(pamt) FROM tbl_payment WHERE eid IN (SELECT eid FROM tbl_event WHERE oid = $oid)";

$result2 = $db->query($sql2);

// Check if the query executed successfully
if ($result2 === false) {
    echo "Error executing query: " . $conn->error;
} else {
    // Retrieve the total_amount value
    $row1 = $result2->fetch_row();
    $total_remuneration = $row1[0];

    // Output the total_amount value
    // echo "Total amount: " . $total_amount;
}




$sql3 = "SELECT edescription FROM tbl_event WHERE ereqno = (SELECT MAX(ereqno) FROM tbl_event WHERE oid = $oid)";


$result3 = $db->query($sql3);

if ($result3) {
    $row3 = mysqli_fetch_assoc($result3);
    $vevent = $row3['edescription'];

    // Use $vevent as needed in your code
    // echo "The value of \$vevent is: " . $vevent;
} else {
    echo "Failed to retrieve the highest value from tbl_event.";
}





$sql4 = "SELECT COUNT(*) AS count1 FROM tbl_payment WHERE pstatus IN ('pending', 'paid') AND eid IN (SELECT eid FROM tbl_event WHERE oid = $oid)";

$result4 = $db->query($sql4);

// Count rows with pstatus as 'donation'
$sql5 = "SELECT COUNT(*) AS count2 FROM tbl_payment WHERE pstatus = 'donation' AND eid IN (SELECT eid FROM tbl_event WHERE oid = $oid)";

$result5 = $db->query($sql5);

if ($result4 && $result5) {
    $row4 = mysqli_fetch_assoc($result4);
    $count1 = $row4['count1'];

    $row5 = mysqli_fetch_assoc($result5);
    $count2 = $row5['count2'];

    // Determine the preference based on the row counts
    if ($count1 > $count2) {
        $preference = "Financial";
    } else if ($count1 < $count2) {
        $preference = "Donation";
    } else {
        $preference = "Equal preference";
    }
    

    // Use $preference as needed in your code
    // echo "The preference is: " . $preference;
} else {
    echo "Failed to fetch row counts from tbl_payment.";
}

// Remember to c
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
            <a class="sidebar-brand d-flex mb-3 align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text">Volunteer Management for Non-Profits and Community Groups</div> 
            </a>
            
            
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

<!-- color palette 
#DDFBD2
#f7f0f5
D5FFF3
-->

            <!-- Main Content -->
            <div id="content" class="" style="background-color:#e0fff6;">

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
                        <!-- <h1 class="h3 mb-0 text-gray-800" style="text-align: center;">Dashboard</h1> -->
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                        <h1 class="h3 mb-0 text-gray-800" style="text-align: center;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h1>
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
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <style>
              .container-fluid {
  padding: 20px;
  background-color: #f1f8ff;
}

h1 {
  text-align: center;
  color: #043565;
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 30px;
}

.card-deck {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}

.card {
  border-left-color: #043565;
  border-left-width: 7px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  transition: all 0.3s ease;
  cursor: pointer;
  width: 100%;
  max-width: 400px;
}

.card:hover {
  transform: translateY(-5px);
}

.card-body {
  padding: 20px;
  text-align: center;
}

.card-body .text-primary {
  font-size: 14px;
  color: #043565;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.card-body .h5 {
  font-size: 24px;
  font-weight: bold;
  margin-top: 10px;
  margin-bottom: 0;
  color: #043565;
}

.card-body i {
  color: #043565;
}

.timetable-msg {
  background-color: #e9f7fe;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 20px;
  color: #043565;
  text-align: center;
}

@media (max-width: 576px) {
  .card {
    width: 100%;
  }
}

h1 {
  text-align: center;
  color: #043565;
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 30px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

                    </style>
                <!-- <div class="container-fluid">

                    <div style="display: flex; justify-content: center;">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div> -->


                    <div class="">
                        <!-- <div class="card-body d-flex" >
                                <div class="mr-2">
                                    <a href="timetable/algorithm.php" class="btn btn-md btn-primary shadow-sm">
                                    <i class="fas fa-clock fa-sm text-white-50"></i>
                                    <span>Generate Timetable<span>
                                    </a>
                                </div>
                                <div class="">
                                    <a href="timetable/display.php" class="btn btn-md btn-primary shadow-sm">
                                    <i class="fas fa-file fa-sm text-white-50"></i> 
                                    <span>View Timetable</span>
                                    </a>
                                </div>
                              
                                
                        </div> -->
                    </div>
                    <div>
                        <?php  
                            if(isset($_SESSION['msg'])) {?>
                                <div class="timetable-msg">
                                <?php echo $_SESSION['msg']; ?>
                                </div>
                                <?php unset($_SESSION['msg']);
                            }
                        ?>
                    </div>
                    <hr>
                    <!-- <div class="mb-3 pl-3">
                            <h1 class="h4 mb-0 py-3 text-gray-800">Dashboard</h1>
                    </div> -->
    
                    <!-- Content Row -->
                    <div class="card-deck">
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
    

<div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="border-left-color:#043565; border-left-width:7px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1 text-truncate">
                            Total volunteer <br>applications
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $total_volunteers?>
                        </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-fw fa-hands-helping fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="border-left-color:#043565; border-left-width:7px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1 text-truncate">
                            Total events
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $total_events?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="border-left-color:#043565; border-left-width:7px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Total volunteer<br> contribution
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $total_donations?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-hands fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



                        

    <div class="d-inline-block col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="border-left-color:#043565; border-left-width:7px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1 text-truncate">
                        Volunteer-intensive <br>event
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php echo $vevent?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
                        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2" style="border-left-color:#043565; border-left-width:7px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                            Total<br> donation</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_amount;echo " Rs";?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-money-bill"></i>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow h-100 py-2" style="border-left-color:#043565; border-left-width:7px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                            Total <br>remuneration</div>
                                           
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
    <?php
    if ($total_remuneration == 0) {
        echo "0 Rs";
    } else {
        echo $total_remuneration . " Rs";
    }
    ?>
</div>

                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-money-bill"></i>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        

                        <div class="card shadow h-100 py-2" style="border-left-color:#043565; border-left-width:7px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                        Volunteer <br>Compensation<br> Preference </div>(Financial/Donation
                        
                        )
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $preference;?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-star"></i>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>



                        </div> </div>
</div>
                        <div class="mx-auto">   


                <div>
                 
                </div>
             
                </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<br><br><br><br><br><br><br><br><br><br><br><br>
            <!-- Footer -->
            <footer class="sticky-footer bg-white ">
              
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