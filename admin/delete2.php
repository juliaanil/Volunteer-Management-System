<?php

require "class/db.php";
session_start();

if(!isset($_SESSION['aemail']))
{
    header("location: login.php");
}

$id = $_GET['id'];

$sql = "Delete from tbl_organization where oid=$id";

if($db->query($sql) == TRUE)
{
    echo"alert('Organization successfully removed!')";
    header("location: organizations.php");
}




?>