<!doctype html>
<html>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>UPDATE MARKS
</title>
<style>
Body{
    background-image: url(yoyo.JPG);
		  background-size: cover;
	}
.font{
float:left;
}
.font1{
float:right;

}

.b{
border:3px solid black;
}

.shadow{
	box-shadow: 10px 10px 5px grey;
}
</style>
</head>
<body>

<a class="nav-link" href="updatemarks_logic.php">BACK</a>
  

	<body>
	</html>
	<?php


        $aname = $_POST['aname'];
		$db_username = 'root';
		$db_password = '';
		$dsn = 'mysql:host=localhost;dbname=mydb';


	try
	{
		$sql = "SELECT coursename from regcourses where studentid ='$aname' ";
		$db = new PDO($dsn, $db_username, $db_password);	
	}catch(Exception $e){
		$err = $e->getMessage();
	}

		?>
		
	<table  border=4px width=100%>
	<tr>
	<th>COURSE NAME</th>
	<th>QUIZ MARKS</th>
	<th>ASSIGMENT MARKS</th>
	<th>SESSIONAL 1</th>
	<th>SESSIONAL 2</th>
    <th>FINAL MARKS</th>
	</tr>
	

	
	
<?php

$result =  $db->query($sql) ;
$row = $result->fetch();

?>



	<?php 
		$str_arr = explode (",", $row ['coursename']);
		//var_dump($str_arr);

		for($i=0; $i<sizeof($str_arr)-1; ++$i){
			 echo "<tr>";

			
	?>
			<?php echo "<td>";?>	<?php echo $str_arr[$i];?> <?php echo "</td>";?>
	<?php echo "<td>";?>    <div class="form-group"> <input type="text" class="form-control" name="aname"  > </div>	<?php echo "</td>";?>
    <?php echo "<td>";?>    <div class="form-group"> <input type="text" class="form-control" name="aname"  > </div>	<?php echo "</td>";?>
    <?php echo "<td>";?>    <div class="form-group"> <input type="text" class="form-control" name="aname"  > </div>	<?php echo "</td>";?>
    <?php echo "<td>";?>    <div class="form-group"> <input type="text" class="form-control" name="aname"  > </div>	<?php echo "</td>";?>
    <?php echo "<td>";?>    <div class="form-group"> <input type="text" class="form-control" name="aname"  > </div>	<?php echo "</td>";?>
	<?php	echo "</tr>";} ?>
		

	


	<?php ?>



</table>