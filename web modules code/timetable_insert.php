<?php
$tid = $_POST['tid'];
$section = $_POST['section'];
$Dayid = $_POST['Dayid'];
$Slotid = $_POST['Slotid'];
$Subject = $_POST['Subject'];
$ClassRoom = $_POST['ClassRoom'];

$db_username = 'root';
$db_password = '';
$dsn = 'mysql:host=localhost;dbname=mydb';


try
{
    $sql = "INSERT INTO timetable VALUES ('$tid','$section', '$Dayid', '$Slotid','$Subject','$ClassRoom')";
    $db = new PDO($dsn, $db_username, $db_password);

    $row = $db->exec($sql);
    header('location:timetable.php');
}
catch(Exception $e){
    $err = $e->getMessage();
}


if(isset($err)){
    echo $err;
}
  ?>