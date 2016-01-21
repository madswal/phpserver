<?php
require "db_conn_events.php";
header('Content-Type:application/json');

	$mail = $_POST["email"];
	$code = $_POST["code"];

$query = "select 1 from code_verification where email='".$mail."' and code ='".$code."'";

$result = mysqli_query($con,$query) or die (mysqli_error($con));
$count_rows = mysqli_num_rows($result);
//echo $result;
if($count_rows ==0)
{
	$status="Verification Failed";
}
else
{
	$status="Verification Success";
}

mysqli_close($con);
echo json_encode($status);


?>