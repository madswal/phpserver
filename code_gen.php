<?php
require "db_conn_events.php";
header('Content-Type:application/json');

	$mail = $_POST["email"];
	//$edesc = $_POST["eventdesc"];
	//$base=$_REQUEST['image'];
   //$mail ='madhan.palaniswamy14@gmail.com';
$code = rand(100000,999999);
$query = "select email,code from code_verification where email='".$mail."'";

$result = mysqli_query($con,$query) or die (mysqli_error($con));
$count_rows = mysqli_num_rows($result);
//echo $result;
if($count_rows ==0)
{
	$insertquery = "insert into code_verification (email,code) values ('$mail','$code');";
	mysqli_query($con,$insertquery) or die (mysqli_error($con));
	//echo $mail."Inside Insert &nbsp;&nbsp;".$code;
}
else
{
	$row = mysqli_fetch_assoc($result);
	$mail = $row["email"];
	//echo $mail;
	$code = $row["code"];
	//echo $mail."&nbsp;&nbsp; Inside Retrieval &nbsp;&nbsp;".$code."<br>";
}
//echo $rand;
//print "Success";
//echo "Closing Connection";
$subject="Verification Code";
$message="Your Verification code is :".$code;
$from="From:prof.event.creator@gmail.com";
$retval = mail($mail,$subject,$message,$from);

if( $retval == true ) {
            $status="Success.. Check your mail";
         }else {
            $status="Failure";
         }
mysqli_close($con);

	//$binary=base64_decode($base);
    //header('Content-Type: bitmap; charset=utf-8');
    //$file = fopen('uploaded_image.png', 'wb');
    //fwrite($file, $binary);
    //fclose($file);
	

echo json_encode($status);


?>