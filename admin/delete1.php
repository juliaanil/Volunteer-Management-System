<?php

require "class/db.php";
session_start();

if(!isset($_SESSION['aemail']))
{
    header("location: login.php");
}

$id = $_GET['id'];

$sql = "Delete from tbl_volunteer where vid=$id";

if($db->query($sql) == TRUE)
{
    echo"alert('Volunteer successfully removed!')";
    header("location: volunteers.php");
}

$sql2 = "Delete from tbl_volunteerevents where vid=$id";
if($db->query($sql2) == TRUE)
{
    echo"";
    
}

?>