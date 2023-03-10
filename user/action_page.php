<?php
include('connection.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(isset($_REQUEST['submit'])!='')
{
if($_REQUEST['username']=='' || $_REQUEST['email']=='' || $_REQUEST['password']==''|| $_REQUEST['repassword']=='')
{
echo "please fill the empty field.";
}
else
{
$sql="insert into user_login(username,email,password) values('".$_REQUEST['username']."', '".$_REQUEST['email']."', '".$_REQUEST['password']."')";
$res=mysqli_query($conn,$sql);
if($res)
{
echo "Record successfully inserted";
}
else
{
echo "There is some problem in inserting record";
}

}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="login.css">
	<title>Register</title>
</head>

<body>
	<form action="" method="post">
		<div class="login-box">
			<h1>Register</h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Username"
						name="username" value="">
			</div>
			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Email"
						name="email" value="">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password"
						name="password" value="">
			</div>

            <div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Repeat Password"
						name="repassword" value="">
			</div>
            
			<input class="button" type="submit"
					name="submit" value="Submit">
					<p>already have an account? <a href="index.php">login now</a></p>
		</div>
		
	</form>
</body>

</html>
