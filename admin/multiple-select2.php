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
    foreach($extract_id as $key=>$id)
    {
    $sql = "Update tbl_volunteer set vstatus='approved' where vid=$id";
    $db->query($sql);
    }
}
else if($value=="rejected")
{
    foreach($extract_id as $key=>$id)
    {
        $sql = "Update tbl_volunteer set vstatus='rejected' where vid=$id";
    $db->query($sql);
    }
}

header("location: volunteersappl.php");

?>