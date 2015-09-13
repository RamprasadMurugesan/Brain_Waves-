<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
<style type="text/css">

body {
    background-color: #efb939;
}
 .PreviewButton{
 cursor:pointer;
 border-width:0px;
 border-style:solid;
 border-color:#000000;
 -webkit-border-radius: 4px;
 -moz-border-radius: 4px;
 border-radius: 4px;
 text-align:center;
 width:100px;
 height:40px;
 padding-top:undefinedpx;
 padding-bottom:undefinedpx;
 font-size:15px;
 font-family:arial;
 color:#ffffff;
 background-color:transparent;
 display:inline-block;
 }.PreviewButton:hover{
 background-color:transparent;
 }
	.PreviewTable{
 border:0px solid #e74c3c;
 width:100%;
 padding:0;
 -webkit-box-shadow: 2px 2px 4px 1px #a4a4a4;
 -moz-box-shadow:2px 2px 4px 1px #a4a4a4;
 box-shadow:2px 2px 4px 1px #a4a4a4;
 border-Radius:4px;
 -moz-border-radius:4px;
 -webkit-border-radius:4px;
 }.PreviewTable table{
 width:100%;
 height:100%;
 margin:0;
 border-collapse: collapse;
 border-spacing: 0;
 }.PreviewTable table thead tr{
 background:#5c5cea;
 }.PreviewTable table thead tr td{
 border:0px solid #e74c3c;
 text-align:center;
 vertical-align:middle;
 border-width:0px 0px 0px 0px;
 color:#ffffff;
 font-weight:bold;
 font-family:arial;
 font-size:14px;
 height:35px;
 }.PreviewTable table thead tr td label{
 margin-right:0px;
 margin-left:0px;
 margin-top:0px;
 margin-bottom:0px;
 color:inherit;
 font-weight:inherit;
 font-family:inherit;
 font-size:inherit;
 display:block;
 }.PreviewTable table thead tr td:first-child{
 border-width:0px 0px 0px 0px;
 }.PreviewTable table tbody tr:last-child td:first-child{
 -moz-border-radius-bottomleft:4px;
 -webkit-border-bottom-left-radius:4px;
 border-bottom-left-radius:4px;
 }.PreviewTable table tbody tr:last-child td:last-child{
 -moz-border-radius-bottomright:4px;
 -webkit-border-bottom-right-radius:4px;
 border-bottom-right-radius:4px;
 }.PreviewTable table tbody tr{
 background:#fff8f8;
 }.PreviewTable table tbody tr:hover{
 background:#ffeded;
 }.PreviewTable table tbody tr td{
 vertical-align:middle;
 height:0px;
 text-align:left;
 color:#000000;
 font-family:arial;
 font-size:12px;
 border:0px solid #e74c3c;
 border-width:0px 0px 0px 0px;
 }.PreviewTable table tbody tr td label{
 margin-right:0px;
 margin-left:20px;
 margin-top:0px;
 margin-bottom:0px;
 color:inherit;
 font-weight:inherit;
 font-family:inherit;
 font-size:inherit;
 display:block;
 }.PreviewTable table tbody tr td:first-child{
 border-width:0px 0px 0px 0px;
 }.PreviewTable table tbody tr:last-child td{
 border:0 0 0 0px;
 }}
 
 .centeralign
{
text-align: center;
}
 

</style>
	</head>
	<body>
	<?php

?>
	
<form id = "move" action="homepage.php" method="post">	</form>
<form id = "move1" action="link1.php" method="post">	</form>
<form id = "move2" action="link2.php" method="post">	</form>
<form id = "move3" action="link3.php" method="post">	</form>
<div id="TableCodePreview" class="PreviewTable">
        <table>
            <thead>
                <tr>
               <td><label><input form="move" type="submit"  class="PreviewButton"  id="viewinfo" value="Homepage" > </label></td>
               
				   					<td><label><input form="move2" type="submit"  class="PreviewButton"  id="viewinfo" value="Usage details" ></a></label></td>
					<td><label><input form="move3" type="submit"  class="PreviewButton"  id="viewinfo" value="Policy suggestions" ></a></label></td>
                </tr>
            </thead>
            <tbody>

        </table>
    </div>
	<div class="centeralign ">
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

$sql ="SELECT `entry`, `UserId`, `date`, `Max_Speed`, `Avg_Speed`, `Change_In_Speed`, `Distance`, `Duration` FROM `policy` WHERE UserId='1001'";
$result = $conn->query($sql);




if($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
         { 
        echo "<br/>";
        $sum= $row["entry"];
	<h1> echo "UserId: " . $row["UserId"]; </h1>
	$UserId= $row["UserId"];
	echo "date: " . $row["date"];
	echo "Max_Speed: " . $row["Max_Speed"];
	$Max_Speed= $row["Max_Speed"];
	echo "Avg_Speed: " . $row["Avg_Speed"];
	$Avg_Speed= $row["Avg_Speed"];
	echo "Distance: " . $row["Distance"];
	$Distance= $row["Distance"];
	echo "Duration: " . $row["Duration"];
	$Duration= $row["Duration"];
echo "<br/>";

  if($Max_Speed > 90 && $Avg_Speed > 60 && $Distance > 51 && $Duration > 1 )
{
echo "<br/>";
echo "$UserId is a Rash Driver";

echo "<br/>";
echo "Insurance plan by HDFC for $UserId is 10000/- monthly";
echo "<br/>";
echo "Insurance plan by ICICI for $UserId is 8000/- monthly";
echo "<br/>";
echo "Insurance plan by AXIS for $UserId is 7000/- monthly";

}
else{
echo "<br/>";
echo "$UserId is a safe Driver";
echo "<br/>";
echo "Insurance plan by HDFC for $UserId is 5000/- monthly";
echo "<br/>";
echo "Insurance plan by ICICI for $UserId is 3000/- monthly";
echo "<br/>";
echo "Insurance plan by AXIS for $UserId is 2000/- monthly";
}
}
 
} 



$conn->close();
?>

	
</body>