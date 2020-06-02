<?php
        $ename = $_POST['ename'];
		$aname = $_POST['aname'];
        $bname = $_POST['bname'];
        $cname = $_POST['cname'];
        $dname = $_POST['dname'];
        $fname = $_POST['fname'];

		$db_username = 'root';
		$db_password = '';
		$dsn = 'mysql:host=localhost;dbname=mydb';

        try
        {
            $sql = "INSERT INTO registerstudent  VALUES ('$ename','$aname', '$bname', '$cname','$dname','$fname')";
            $db = new PDO($dsn, $db_username, $db_password);
    
            $row = $db->exec($sql);
            header('location:homeregstd.php');
            return;
        }catch(Exception $e){
            $err = $e->getMessage();
        }
    
    
        if(isset($err)){
            echo $err;
        }

	?>