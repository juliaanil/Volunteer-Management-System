<?php

require "class/db.php";
session_start();

if(!isset($_SESSION['oemail']))
{
    header("location: login.php");
}

$id = $_GET['id'];

$sql = "Delete from tbl_event where eid=$id";

if($db->query($sql) == TRUE)
{
    echo"alert('Event successfully deleted!')";
    header("location: events.php");
}




?>