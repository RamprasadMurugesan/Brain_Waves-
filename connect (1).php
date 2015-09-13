

<?php
function connectDB($dbname)
{
 $servername ="localhost";
 $username = "root";
 $password ="";
 //$dbname = "assetsdb";
 try
 {
 $conn = mysqli_connect($servername,$username,$password,$dbname);
 return $conn;
 }
 catch(Exception $e)
 {
	
 }
}
?>