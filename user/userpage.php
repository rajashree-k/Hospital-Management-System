<?php

$conn = mysqli_connect('localhost','root','','hospital');

if(!$conn)
{
	die('Connection failed!'.mysqli_error($conn));
}


$name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


$sql = "INSERT INTO user_login(username,email, password) VALUES('$name','$email','$password')";

if(mysqli_query($conn,$sql))
{
	echo "Registerd Successfully";
}
else
{
	echo mysqli_error($conn);
}

?>