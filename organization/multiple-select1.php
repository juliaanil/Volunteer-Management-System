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
    foreach($extract_id as $key=>$id)
    {
    $sql = "Delete from tbl_program where pid=$id";
    $db->query($sql);
    }
}
else if($value=="complete")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Update tbl_event set estatus='complete' where eid=$id";
    $db->query($sql);
    }
}
else if($value=="incomplete")
{
    foreach($extract_id as $key=>$id)
    {
        $sql = "Update tbl_event set estatus='incomplete' where eid=$id";
    $db->query($sql);
    }
}

header("location: events.php");

?>