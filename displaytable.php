<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cardriverdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT entry,UserId,date,Max_Speed,Avg_Speed,Distance,Duration FROM usage_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "entry: " . $row["entry"] ";
	echo "UserId: " . $row["UserId"];
	echo "date: " . $row["date"];
	echo "Max_Speed: " . $row["Max_Speed"];
	echo "Avg_Speed: " . $row["Avg_Speed"];
	echo "Distance: " . $row["Distance"];
	echo "Duration: " . $row["Duration"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>