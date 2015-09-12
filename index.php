<!DOCTYPE html>
<html>
<body>

<?php
ini_set("display_errors",0);
ini_set('allow_url_include', 1);
//****************************************************
    //db connection
  $conn=mysql_connect("localhost","root","");
  $dbname="cardriverdata";
  $table="usage_details";
  if(!$conn)
  {
     echo "Unable to connect to DB: " . mysql_error();
     exit;
  }
   if (!mysql_select_db($dbname)) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
   }
//   else { echo "Connection established with db-$dbname...";echo "<br/>";}

//******************************************************

//include 'http://dweet.io/get/latest/dweet/for/ICARE';
    //$url = 'https://dweet.io/get/dweets/for/ICARE';
$url='http://dweet.io/get/latest/dweet/for/CarUserData';
$jsonstring=file_get_contents($url);
//echo "$jsonstring";
$array=json_decode($jsonstring,true);
$len=count($array['with']);
for($var=0;$var<$len;$var++)
{ 
   if(!$data=$array['with'][$var])
         break;  
   $device=$data['thing'];
   $date_time=$data['created'];
   $date_time=substr($date_time,0,10);
    echo "$date_time";
   $cont_len=count($data['content']);
    $UserId=$data['content']['UserId'];
    $date=$data['content']['Date'];
    $Max_Speed=$data['content']['Max_Speed'];
    $Avg_Speed=$data['content']['Avg_Speed'];
    $Change_In_Speed=$data['content']['Change_In_Speed'];
    $Distance=$data['content']['Distance'];
    $Duration=$data['content']['Duration'];

   echo "$UserId  $Max_Speed $Avg_Speed $Change_In_Speed $Distance $Duration<br>";

   $query="INSERT INTO usage_details (UserId, date,Max_Speed,Avg_Speed, Change_In_Speed, Distance,Duration ) VALUES ( '$UserId', '$date','$Max_Speed','$Avg_Speed', '$Change_In_Speed', '$Distance','$Duration' )";
   $result=mysql_query($query);
   if (!$result) {
  echo "Push Failed.Could not successfully run query ($query) from DB " . mysql_error();
   exit;
    }
}
?>



</body>
</html>