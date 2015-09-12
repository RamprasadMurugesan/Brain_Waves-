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

$sql = "SELECT entry,UserId,date,Max_Speed,Avg_Speed,Change_In_Speed,Distance,Duration FROM usage_details";
$result = $conn->query($sql);




if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sum= $row["entry"];
	echo "UserId: " . $row["UserId"];
	echo "date: " . $row["date"];
	echo "Max_Speed: " . $row["Max_Speed"];
	echo "Avg_Speed: " . $row["Avg_Speed"];
	echo "Change_In_Speed: " . $row["Change_In_Speed"];
	echo "Distance: " . $row["Distance"];
	echo "Duration: " . $row["Duration"];
    }
} else {
    echo "0 results";
}

//average calculation:

$query = "SELECT AVG(Max_Speed)as a FROM usage_details"; 
	 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
echo "The average of Max_Speed is".$row['a'];

}


$query = "SELECT AVG(Avg_Speed)as a FROM usage_details"; 
	 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
echo "The average of Avg_Speed is".$row['a'];

}

$query = "SELECT AVG(Change_In_Speed)as a FROM usage_details"; 
	 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
echo "The average of Change_In_Speed is".$row['a'];

}

$query = "SELECT AVG(Distance)as a FROM usage_details"; 
	 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
echo "The average Distance is".$row['a'];

}

$query = "SELECT AVG(Duration)as a FROM usage_details"; 
	 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc(); 
echo "The average of Duration is".$row['a'];

}



//$Duration_average=SELECT AVG(Duration) FROM usage_details;

//echo "$Max_Speed_average";


$conn->close();
?>

</body>
</html>