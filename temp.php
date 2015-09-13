<html>
<head>
<meta charset="utf-8">
<style type="text/css">
body {
    background-color: #efb939;
}
#signup {
line-height:3;
}
form fieldset input[type="text"], input[type="password"] , select {
background-color: #e5e5e5;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 100%;
height: 50px;
outline: none;
width: 95%;
-webkitappearance:none;
padding-left:5%;
-webkit-appearance:none;
}
form fieldset input[type="submit"] {
background-color: #008dde;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #f4f4f4;
cursor: pointer;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size:16px;
height: 50px;
-webkit-appearance:none;
width:95%;
}
.selectdisabledstyle
{
	color:#f8f8f8;
}

</style>
</head>
<body>


<form action="signup.php" method="post" style="margin:0 auto; width:350px">
<fieldset style="text-align:center">
<p><input name="Name" type="text"  placeholder="Name"></p>
<p><input name="EmpID" type="text"  placeholder="User ID"></p>
<p><input name="Email" type="text"  placeholder="E-mail"></p>
<p><input name="Password" type="password" placeholder="Password"><p>
<p><input name="ConfirmPassword" type="password"  placeholder="Confirm Password"></p>

<p> </p>
<select name="CarName">
  <option value=""disabled selected style="display:none">CarName</option>
  <option value="Professor">Hundai</option>
  <option value="Assistant Professor">Ford</option>
  <option value="Assistant Professor">Bmw</option>
</select>
<p><input type="text" name ="MobileNo"  placeholder="Model"></p>
<p><input type="submit" name="CreateAccount" value="Create Account"></p>
</fieldset>
</form>
</div>
</body>
<?php
include  'Connect.php';
$conn = connectDB('cardriverdata');

if(isset($_POST['CreateAccount']))
  {
    $Name= $_POST['Name'];
	$UserId= $_POST['UserId'];
    $Email= $_POST['Email'];
    $password = $_POST['Password'];
     

    
    
    $validation_result =  ValidateForm(); //Validate the information
	
		 $insertionresult=InsertRecord(); //Insert Record
         if($insertionresult==="true")
         {
			 echo '<script>giveAlert("Success/Request for new account submitted successfully")</script>';
            //header('Location:http://localhost//Asset//index.php');
         }
         else
         {
			 echo "<script>giveAlert('$insertionresult')</script>";
         }
    }
   


//Inserts the record
function InsertRecord()
{

global $name,$encrypted_password,$email,$mobileno,$conn;

$empid =$_POST['EmpID'];
$departmentid =$_POST['Department'];
$designation =$_POST['Designation'];

mysqli_autocommit($conn,FALSE);
$sql = "SELECT * FROM   tuserinfo WHERE  Email ='$email'";
$result = mysqli_query($conn,$sql);
if($result->num_rows == 0) // check whether the user has already submitted the request for new account
{
$sql = "INSERT INTO userdetails(UserId,Name,Email,Password) VALUES('$UserId','$Name',$Email','$Password') " ; 
$insertresult = mysqli_query($conn,$sql);
if($insertresult)
{
	// Send notification for the respective head for the approval of new account
	date_default_timezone_set('Asia/Kolkata');
    $timestamp = date('Y-m-d/H:i:s');
	$notificationnumber = generateNotificationNumber($conn);
	$heademail = formHeadEmail($email);
	$message = $name." with mailid [".$email."] has requested for authorisation of new AMS account";
	$status = "submitted";
	$notificationtype = "1";
	$notificationssql = "INSERT into notificationsinfo VALUES ('$notificationnumber','$heademail','$message','$status','$notificationtype','$timestamp')";
	
	if(mysqli_query($conn,$notificationssql))
	{
		mysqli_commit($conn);
		$conn->close();
	    return "Success/Request for new account has been submitted successfully";
	}
	else
	{
		$conn->close();
        return "Failure/Request for new account not submitted properly. Try again later";
	}
}
else
{
	$conn->close();
return "Failure/Request for new account not submitted properly. Try again later";
}
}
else
{
	$conn->close();
	return "Failure/You have already submitted request for new account";
}
}
?>

