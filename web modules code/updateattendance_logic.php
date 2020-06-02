<?php

session_start();




if(isset($_POST['aname'])){
    $_SESSION['aname'] = $_POST['aname'];
}

?>


<!doctype html>
<html>
<head>
<title>UPDATE ATTENDANCE
</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
.font{
float:left;
}
.font1{
float:right;

}


Body{
    background-image: url(yoyo.JPG);
		  background-size: cover;
	}
	.shadow{
	box-shadow: 10px 10px 5px grey;
}
</style>
</head>
<body>
<a href="updateattendance.php"><button type="button" class="btn btn-dark">BACK TO ADMIN PAGE</button></a><BR><BR>
<div class="container-fluid" >
<div class="row align-items-center myBody "  style="height:AUTO;">




    <div class="col">
	  <h1 style="margin-left:36% ;color: BLACK">UPDATE ATTENDANCE</h1><br><br>
		<div class="container" style="background-color: white;  height: auto; width: 480px; opacity: 0.8; padding: 10px; border-radius: 25px;">
			<br>
			
			<form method="POST" action="addmarks_getlogic.php">
        

             <div class="form-group">
					<span class="label-input100">STUDENT SELECTION:</span>
					<div>
						<select  required class="form-control" id="select_catalog" onchange=" myFunction()">
							<option value="">Select Student</option>
                 <?php
                         $aname = $_SESSION['aname'];
                         $con = mysqli_connect("localhost","root","","mydb");
                         $sql = "SELECT studentid, firstname,lastname from registerstudent where section = '$aname'";
			             $result = mysqli_query($con,$sql);	
                        if(mysqli_num_rows($result) > 0)
                         {
                         while ($row = mysqli_fetch_array($result))
                         {
                       
                          echo  "<option>" .$row['studentid']." : ".$row['firstname']."".$row['lastname']."</option>";
                        
                        }
						    
                        }
						
                       else
                       {
                       echo "No Data Found";
                       } 
                ?>
						</select>
					</div>
					<span class="focus-input100"></span>
				</div>

              
                <div class="form-group">
    <label for="exampleFormControlInput1">STUDENT ID:</label>
    <input type="text" class="form-control" name="aname" id="SID" value="Student Id" >
  </div>
  <button type="submit" STYLE="MARGIN-LEFT:60%" class="btn btn-dark">UPDATE ATTENDANCE</button><br>

</form>
		</div>
	</div>
	</div>
	</div>
	  
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
function myFunction() {
  var x = document.getElementById("select_catalog").value;
  var x1 = x.split(" ");
  document.getElementById("SID").value = x1[0];
}

</script>


</body>
<html>