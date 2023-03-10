<?php
require_once('connection.php');
$username=$pwd=$pwd1=$email='';
if(isset($_POST['submit'])){

$name = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = md5($_POST['password']);
$cpass = md5($_POST['cpassword']);
$user_type = $_POST['user_type'];

$select = " SELECT * FROM user_login WHERE email = '$email' && password = '$pass' ";

$result = mysqli_query($conn, $select);

if(mysqli_num_rows($result) > 0){

   $error[] = 'user already exist!';

}else{

   if($pass != $cpass){
	  $error[] = 'password not matched!';
   }else{
	  $insert = "INSERT INTO user_login(username, email, password) VALUES('$name','$email','$pass')";
	  mysqli_query($conn, $insert);
	  header('location:main/index.html');
   }
}

};
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
	<form action="validate.php" method="post">
		<div class="login-box">
			<h1>Register</h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Username"
						name="username" value="">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password"
						name="password" value="">
			</div>

            <div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="cpassword" placeholder="Repeat Password"
						name="cpassword" value="">
			</div>
            
			<input class="button" type="submit"
					name="Register" value="Submit">
		</div>
	</form>
</body>

</html>
