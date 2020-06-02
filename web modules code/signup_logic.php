<?php
session_start();

$aname = $_POST['aname'];
$ename = $_POST['ename'];
$pname = $_POST['pname'];



	$db_username = 'root';
	$db_password = '';
	$dsn = 'mysql:host=localhost;dbname=mydb';


	try
	{
		$sql = "INSERT INTO admin VALUES ('$aname','$ename','$pname')";
		$db = new PDO($dsn, $db_username, $db_password);

		$row = $db->exec($sql);

		header('location:index.php');


	}catch(Exception $e){
		$err = $e->getMessage();
	}


	if(isset($err)){
		echo $err;
	}


?>