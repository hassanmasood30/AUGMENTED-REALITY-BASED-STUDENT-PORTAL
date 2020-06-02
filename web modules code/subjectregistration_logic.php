<?php
		$aname = $_POST['aname'];
        $bname = $_POST['bname'];
		$db_username = 'root';
		$db_password = '';
		$dsn = 'mysql:host=localhost;dbname=mydb';

        try
        {
            $sql = "INSERT INTO regcourses VALUES ('$aname','$bname')";
            $db = new PDO($dsn, $db_username, $db_password);
    
            $row = $db->exec($sql);
            header('location:subjectregistration.php');
        }catch(Exception $e){
            $err = $e->getMessage();
        }
    
    
        if(isset($err)){
            echo $err;
        }

	?>