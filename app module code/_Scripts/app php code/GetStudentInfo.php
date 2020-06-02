<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vilp3d";

$Sname = $_REQUEST["SNamePost"];
//$Sname = "MUHAMMAD HAMZA ELAHI";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `student` WHERE `student_name` = '$Sname'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "".$row["student_name"].",".$row["student_f_name"].",".$row["student_id"].",".$row["program_id"].",".$row["session_id"].",".$row["student_cnic"]."";
		//echo ",";
    }
} 

$conn->close();
?>



