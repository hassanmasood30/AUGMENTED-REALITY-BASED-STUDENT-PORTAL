<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vilp3d";

$SessionId = $_REQUEST["SessionIdPost"];
//$SessionId = "sp15";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `timetable` WHERE session_id='$SessionId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
    while($row = $result->fetch_assoc()) {
		
		
		$sqlcourse = "SELECT `course_name` FROM `course` WHERE `course_id` = ".$row["course_id"]."";
		$resultCourse = $conn->query($sqlcourse);
		
		
		echo "".$row["day_id"].",".$row["slots_id"].",".$row["room_id"]."";
        
		if ($resultCourse->num_rows > 0) 
		{
			while($roww = $resultCourse->fetch_assoc())
			{
				echo ",";
				echo "".$roww["course_name"]."";
				
			}
		}
		
		
		echo "|";
    }

} 



$conn->close();
?>



