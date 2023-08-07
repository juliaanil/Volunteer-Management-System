<?php

require "class/db.php";

session_start();

if(isset($_SESSION['aemail']))
{
    // $oemail='".$_SESSION["oemail"]."';
    $oemail=$_SESSION["aemail"];
    //echo $oemail;
}
else{
    header("location: login.php");
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

    <title>Admin</title>

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
               
                window.location.href = "multiple-select3.php?checked="+arr+"&item=delete";
            }
            else if(clickedid=='mark-approved') {
                // if(confirm("Are you sure you want to change the status to Active?")==true)
                window.location.href = "multiple-select3.php?checked="+arr+"&item=approved";
            }
            else if(clickedid=='mark-rejected') {
                // if(confirm("Are you sure you want to change the status to Inactive?")==true)
                window.location.href = "multiple-select3.php?checked="+arr+"&item=rejected";
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
    <i class="fas fa-fw fa-tachometer-alt"></i>

        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="organizations.php">
    <i class="fas fa-fw fa-building"></i>

        <span>Organizations</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="volunteers.php">
    <i class="fas fa-fw fa-hands-helping"></i>

        <span>Volunteers</span></a>
</li>
<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="requests.php">
    <i class="fas fa-fw fa-envelope"></i> 
        <span>Requests</span></a>
</li>

<hr class="sidebar-divider my-0">
<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="events.php">
    <i class="fas fa-calendar-alt"></i>

        <span>Events</span></a>
</li>

<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="donations.php">
    <i class="fas fa-money-bill"></i>

        <span>Donations</span></a>
</li>


<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="organizationappl.php">
   <i class="fas fa-fw fa-check-circle application-status-icon"></i>


        <span>Organization applications</span></a>
</li>

<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="volunteersappl.php">
   <i class="fas fa-fw fa-check-circle application-status-icon"></i>


        <span>Volunteer applications</span></a>
</li>
<hr class="sidebar-divider my-0">
<li class="nav-item">
    <a class="nav-link" href="preference.php">
    <i class="fas fa-fw fa-sliders-h"></i>



        <span>Volunteer preference</span></a>
</li>
<hr class="sidebar-divider my-0">

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

<h1 class="h3 mb-2 text-gray-800 text-center">Event requests</h1>
<div>
    <?php  
        if(isset($_SESSION['msg'])) {
            echo "<div class='message'>".$_SESSION['msg']."</div>";
            unset($_SESSION['msg']);
    }
    ?>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header">

        <form action="add.php" method="POST">
        <!-- <div style="float:right;" class="font-weight-bold text-right">
            <button type="submit" class="btn-sm btn-primary a-btn-slide-text">
            <span class="glyphicon glyphicon-edit fas fa-sm fa-plus" aria-hidden="true"></span>
            <span width=400><strong>Add new event</strong></span>
            </a>
        </div> -->
        </form>

        <!-- <div style="float:left;" class="font-weight-bold text-left">
            <button class="btn-sm btn-danger a-btn-slide-text" id="delete_multiple" onclick=multipleSelect(this.id)>
            <span class="glyphicon glyphicon-edit  " aria-hidden="true"></span>
            <span width=400><strong>Delete</strong></span>
            </button>
        </div> -->
        <div style="float:left" class="ml-1 py-0 font-weight-bold text-primary text-left">
            <button class="btn-sm btn-primary a-btn-slide-text" id="mark-approved" onclick=multipleSelect(this.id)>
            <span class="glyphicon glyphicon-edit  " aria-hidden="true"></span>
            <span width=400><strong>Approve</strong></span>
            </button>
        </div>
        <div style="float:left" class="ml-1 py-0 font-weight-bold text-primary text-left">
            <button class="btn-sm btn-primary a-btn-slide-text" id="mark-rejected" onclick=multipleSelect(this.id)>
            <span class="glyphicon glyphicon-edit  " aria-hidden="true"></span>
            <span width=400><strong>Reject</strong></span>
            </button>
        </div> 

        
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
                          
   
                        // $sql1="select * from tbl_event where oemail='".$_SESSION["oemail"]."'";

                        // $sql1="select * from tbl_organization where oemail='".$_SESSION["oemail"]."'";
    
             
        
                        $sql1="SELECT tbl_request.*, tbl_organization.oname, tbl_eventtype.etypename 
                        FROM tbl_request 
                        INNER JOIN tbl_organization ON tbl_request.oid = tbl_organization.oid 
                        INNER JOIN tbl_eventtype ON tbl_request.etypeid = tbl_eventtype.etypeid";
                        

						$result1=$db->query($sql1);
						if($result1->num_rows >0)
						{ 
                        ?>
                       
                        
                       <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                        <tr>
                            <!-- <th>
                            <b><input type='button' id="delete" value='Delete' name='delete'></b></th> -->
                            <th style="justify-content:center; text-align:center;" >
                            
                    
                            <input style='vertical-align:bottom;width:14px;height:15px;' name='checkbox-main' type='checkbox' value='Select All' id='checkbox-main' onclick=selectAll() >
                         
                            </th>
                            <th style="text-align:center;"><b>Organization</b></th>
                            <th style="text-align:center;"><b>Event type</b></th>
                         
                            <th style="text-align:center;"><b>Event name</b></th>
                      
                            <th style="text-align:center;"><b>Status</b></th>
                            
                        </tr>
                        <?php 

						while($row = $result1->fetch_assoc())
						{
			            ?>

                        <tr>
                        <td style="justify-content:center; text-align:center" width="5%"> 
                            <input  type="checkbox"  style="vertical-align:bottom;width:14px;height:15px" class="checkbox-child" name="check_list[]"  value=<?php echo $row['rid']; ?> >
                                  
                        </td>
                        
                        </form>
                        
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["oname"]; ?> </td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["etypename"]; ?> </td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["reventname"]; ?> </td>
                        <td style="justify-content:center; text-align:center" width="70%"> <?php echo $row["rstatus"]; ?> </td>
                         
                        
                     
                        

                       
                        </tr>
                        
                        <?php
                            }
                        }?>
						
                </tbody>
                
            </table>
            <div class="card">
    <!-- <div class="card-body text-center">
        <button class="btn btn-lg btn-primary a-btn-slide-text" id="mark-complete" onclick="multipleSelect(this.id)">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>Applications</strong></span>
        </button>
    </div>
    <div class="card-body text-center">
        <button class="btn btn-lg btn-primary a-btn-slide-text" id="mark-complete" onclick="multipleSelect(this.id)">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>Volunteer activities</strong></span>
        </button>
    </div> -->
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
</div>

</div>
<!-- /.container-fluid -->

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