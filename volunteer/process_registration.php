<?php 
	// error_reporting(0);
	session_start();
	
	require "class/db.php";
   
    $vid=0;

	if (isset($_POST["submit"]))
	{
                
               
                $vpswd = $_POST['vpswd'];
                $confirmvpswd = $_POST['confirmvpswd'];
                $age=$_POST['dob_year'];
                
                if($vpswd != $confirmvpswd){
                   
                        ?><script> alert("Your passwords do not match!!"); </script><?php
                       
                    
                   
                        header("location: login.php");
                    }
                  
                else {
                    
                    $sql = "insert into tbl_volunteer (vname,vphone,vemail,vpswd,vaddr,vage,vgender) VALUES ('".$_POST["vname"]."','".$_POST["vphone"]."','".$_POST["vemail"]."','".$_POST["vpswd"]."','".$_POST["vaddr"]."',$age,'".$_POST["vgender"]."')";
                    $db->query($sql);
                    
                    ?><script> alert("Your registration details have been successfully submitted. Please note that your account is currently pending approval by the admin"); </script><?php
                
                    if (isset($_POST['etypeid'])) { 
                        
                        $selectedCheckboxes = $_POST['etypeid'];
                
                        foreach ($selectedCheckboxes as $checkbox) {
                            $sql5 = "SELECT vid FROM tbl_volunteer WHERE vpswd = '$vpswd'";
                            $result5 = $db->query($sql5);
                          
                            if (mysqli_num_rows($result5) > 0) {
                                $row = mysqli_fetch_assoc($result5);
                                $vid = $row["vid"];
                                $sql6 = "insert into tbl_volunteerevents (vid,etypeid) VALUES ($vid,$checkbox)";
                                $db->query($sql6);
                                
                            }
                        }
                    }



                    if (isset($_FILES['id_card']) && $_FILES['id_card']['error'] === UPLOAD_ERR_OK) {
                        // Specify the directory where the uploaded files will be stored
                        $uploadDir = 'C:/xampp/htdocs/volunteer/uploads/';
                    
                        // Generate a unique filename for the uploaded ID card
                        $fileName = uniqid('idcard_') . '_' . $_FILES['id_card']['name'];
                    
                        // Move the uploaded file to the desired directory
                        if (move_uploaded_file($_FILES['id_card']['tmp_name'], $uploadDir . $fileName)) {
                            // File upload successful, insert the filename into the database
                            $sql2 = "UPDATE tbl_volunteer SET vcard = '$fileName' WHERE vid = (SELECT vid FROM tbl_volunteer WHERE vpswd = '$vpswd')";

                            $db->query($sql2);
                        }
                    }






                } 

	}
?>