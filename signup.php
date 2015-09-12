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


<form action="index.php" method="post" style="margin:0 auto; width:350px">
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
$conn = connectDB('assetsdb');

if(isset($_POST['CreateAccount']))
  {
    $name= $_POST['Name'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $mobileno = $_POST['MobileNo']; 

    
    
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
   


// Validate the form information
function ValidateForm()
{

global $name,$username,$password,$email,$mobileno,$conn,$encrypted_password;


$confirmpassword = $_POST['ConfirmPassword'];

//No special characters are allowed in Name
if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
    {
       return "Failure/Only letters and white space allowed in Name"; 
    }
	
// Check for mail id	
if (!preg_match("/^[_a-z0-9-]+@[a-z0-9-]+(\.psgtech.ac.in)$/",$email)) 
    {
       return "Failure/Enter a valid email id"; 
    }

$sql = "Select * from userinfo where Email='$email'"; 
$result = mysqli_query($conn,$sql); //9659521637

if($result->num_rows != 0)  // Check whether user already exists
{
    return "Failure/Email ID already exists";
} 
	
if (!preg_match("((?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!^&*@#$%]).{6,20})",$password)) 
    {
       return "Failure/Password must contain atleast 1 uppercase,lowercase,special charater(!^&*@#$%) and a number"; 
    }
	
	if(strlen($encrypted_password)>100)
	{
		return "Failure/Password is too long. Try shorter ones!!!";
	}
	
    if($password!= $confirmpassword) //check whether passwords match
    {
      return "Failure/Passwords does not match";
    }
if (!(preg_match("/^[789][0-9]{9}$/",$mobileno)||preg_match("/^[0][789][0-9]{9}$/",$mobileno))) // Mobile number can be of 10 or 11  numbers. May start with 0 if its STD
    {
       return "Failure/Enter a valid mobile no"; 
    }
	return "true";
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
$sql = " INSERT INTO tuserinfo(Name,EmployeeID,Email,Password,DepartmentID,Designation,MobileNumber) VALUES('$name','$empid','$email','$encrypted_password','$departmentid','$designation','$mobileno') " ;
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

