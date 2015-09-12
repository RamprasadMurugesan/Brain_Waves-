<!DOCTYPE html>
<html>
<head>
<style type="text/css">
body {
    background-color: #efb939;
}

.textbox {
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

padding-left:5%;
}
.submit{
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
width:100%;

}
</style>
</head
<body >

<div id="login" style=" margin:0 auto; width:350px">
  <h1><strong> Welcome.</strong> Please login.</h1>
<form action="index.php" method="post">
<fieldset style="text-align:center">
<p><input style="position:relative" type="text" class="textbox" name ="Email" placeholder="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' "></p>
<p><input type="password" class="textbox" name="Password" placeholder="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "></p>

<p><input type="submit" class="submit" value="Login" name="Login"></p>
  <br>
 
  
  
<p>

New User ?<a  style="font-size:15px ; float:right" href="http://localhost/test_code/Signup.php">Create New Account</a> 
</p>
</fieldset>
</form>
</body>
</html>

<?php
// Login Code
if(isset($_POST['Login']))
{
	include 'Connect.php'; 
    $conn= connectDB("assetsdb");                              //Establishes db connection 
    if(!$conn){
		
     echo '<script>giveAlert("Failure/Database Connection is not established. Try Later!!!")</script>';
    }
    else{
		
        $email = $_POST['Email'];
        $password= $_POST['Password'];
		$sql = "Select Password from userinfo where Email='$email'";
        $r = mysqli_query($conn,$sql);
		if($r -> num_rows > 0)
		{
        $row = mysqli_fetch_row($r);
				echo " $row[0]";
        if($password===$row[0])
               {
                   $_SESSION["Email"] = $email;
                   header('Location:http://localhost/test_code/Homepage.php');
               }
               else{
                   echo ' <script>giveAlert("Failure/Enter Correct Password","index.php")</script>';
               }
		}
		else
		{
			echo '<script>giveAlert("Failure/No account has been created for this email")</script>';
		}   
    }
	$conn->close();
}
?>
