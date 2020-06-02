<?php
$section = $_POST['section'];
$tid = $_POST['tid'];
$Dayid = $_POST['Dayid'];
$Slotid = $_POST['Slotid'];
$Subject = $_POST['Subject'];
$ClassRoom = $_POST['ClassRoom'];

$db_username = 'root';
$db_password = '';
$dsn = 'mysql:host=localhost;dbname=mydb';


try
{
    $sql = "UPDATE `timetable` SET `dayid`='".$Dayid."', `slotid`= '".$Slotid."',`subject`= '".$Subject."',`classRoom`= '".$ClassRoom."' where timetableid='".$tid."'";
    $db = new PDO($dsn, $db_username, $db_password);

    $row = $db->exec($sql);
    header('location:updatetimetable.php');
}
catch(Exception $e){
    $err = $e->getMessage();
}


if(isset($err)){
    echo $err;
}
  ?>