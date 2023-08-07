<?php
require "class/db.php";
session_start();

if(isset($_SESSION['oemail']))
{
    // $oemail='".$_SESSION["oemail"]."';
    $oemail=$_SESSION["oemail"];
    //echo $oemail;
}
else{
    header("location: login.php");
}

if(!empty($_POST["etypeid"]))
{
    $etypeid = $_POST["etypeid"];
    $sql_elname =  "select * from tbl_eventlist where etypeid=$etypeid";
}

?>

<option value="">Select</option>

<?php

$result_event = $db->query($sql_elname);
if( $result_event->num_rows > 0 )
{
    while( $event_row = $result_event->fetch_assoc())
    { ?>
    <option name="elid" value="<?php echo $event_row['elid'];?>"><?php echo $event_row['elname'];?></option>
    <?php
    }
}

?>