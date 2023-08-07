<?php

require "class/db.php";
session_start();

if(!isset($_SESSION['oemail']))
{
    header("location: login.php");
}

$value = $_GET['item'];
$extract_id = explode(',' ,($_GET['checked']));

if($value=="delete")
{
    foreach($extract_id as $key=>$ayid)
    {
    $sql = "Delete from tbl_program where pid=$ayid";
    $db->query($sql);
    }
}
else if($value=="complete")
{
    foreach($extract_id as $key=>$ayid)
    {
    $sql = "Update tbl_activity set aystatus='complete' where ayid=$ayid";
    $db->query($sql);
    }
}
else if($value=="incomplete")
{
    foreach($extract_id as $key=>$ayid)
    {
        $sql = "Update tbl_activity set aystatus='incomplete' where ayid=$ayid";
    $db->query($sql);
    }
}

header("location: activity.php");

?>