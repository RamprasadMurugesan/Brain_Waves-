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
<p><input name="UserID" type="text"  placeholder="User ID"></p>
<p><input name="Email" type="text"  placeholder="Email"></p>
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


if(isset($_POST['CreateAccount']))
  {
	  include  'Connect.php';
$conn = connectDB('cardriverdata');
    $Name= $_POST['Name'];
	$UserId= $_POST['UserID'];
    $Email= $_POST['Email'];
    $password = $_POST['Password'];
$sql = " INSERT INTO userdetails(UserId,Name,Email,Password) VALUES('$UserId','$Name',$Email','$password') " ;

$insertresult = mysqli_query($conn,$sql);

	$conn->close();     

    
    
    
    }
   


?>

