<?php

require "class/db.php";
session_start();

if(!isset($_SESSION['aemail']))
{
    header("location: login.php");
}

$value = $_GET['item'];
$extract_id = explode(',' ,($_GET['checked']));

if($value=="delete")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Delete from tbl_program where pid=$id";
    $db->query($sql);
    }
}
else if($value=="approved")
{
    foreach ($extract_id as $key => $id) {
        $sql = "UPDATE tbl_request SET rstatus='approved' WHERE rid=$id";
        $db->query($sql);
    
        $selectSql = "SELECT * FROM tbl_request WHERE rid=$id";
        $result = $db->query($selectSql);
        if ($row = $result->fetch_assoc()) {
            $etypeid = $row['etypeid'];
            $elname = $row['reventname'];
    
            $insertSql = "INSERT INTO tbl_eventlist (etypeid, elname) VALUES ($etypeid, '$elname')";
            $db->query($insertSql);
        }
    }
    
}
else if($value=="rejected")
{
    foreach($extract_id as $key=>$id)
    {
        $sql = "Update tbl_request set rstatus='rejected' where rid=$id";
    $db->query($sql);
    }
}

header("location: requests.php");

?>