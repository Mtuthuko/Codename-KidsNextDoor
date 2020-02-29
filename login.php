<?php
session_start();
require 'conn.php';
$username = $_POST["logUsername"];
$password = $_POST["logPassword"];

$_SESSION['username']=$username;
$str = $_SESSION['username'];
$str = preg_replace('/\D/', '', $str);
$_SESSION['user_id']=$str;
$un = "";
echo $str;


$mysql="update register SET token = MD5('$password') WHERE USER_ID = $str;";
$resultt = mysqli_query($conn,$mysql);

//$mysql2="select token from register where USER_ID = $str;";
//$resultt2 = mysqli_query($conn,$mysql2);

//$row = $resultt2->fetch_assoc();
//$password = implode(" ",$row);




$mysql_qry="select * from register where username like '$username' and password like '$password' ;";


$result = mysqli_query($conn,$mysql_qry);

if ( mysqli_num_rows( $result ) > 0 )
{
	$_SESSION['username']=$username;
	$str = $_SESSION['username'];
	$str = preg_replace('/\D/', '', $str);
	$_SESSION['user_id']=$str;
	$_SESSION['finish'] = 0;
	if ( mysqli_num_rows( $result2 ) > 0 )
	{

		$row = $result2->fetch_assoc();
		$un = implode(" ",$row);
		echo $un;
		$_SESSION['finish'] = $un;
		header("Location: dashboard.php");
	} else {
		$_SESSION['finish'] = 0;
		header("Location: dashboard.php");

	}


}
else
{

	header("Location: LogOut.php");
}

 ?>
