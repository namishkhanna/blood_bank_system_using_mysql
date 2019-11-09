<?php

$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$feedback=$_POST['feedback'];

if (!empty($name) || !empty($email)  || !empty($phone)  || !empty($feedback))
{

$host="localhost";
$dbUsername ="root";
$dbPassword ="";
$dbname="project";

$conn = new mysqli($host , $dbUsername , $dbPassword , $dbname);

if(mysqli_connect_error())
{

die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());

}else
{

$SELECT ="SELECT email From register where email = ? Limit 1";
$INSERT ="INSERT Into register(name,email,phone,feedback) values(?,?,?,?)";

$stmt =$conn->prepare($SELECT);
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum =$stmt->num_rows;

if($rnum==0)
{
	$stmt->close();
	$stmt=$conn->prepare($INSERT);
	$stmt->bind_param("ssis",$name,$email,$phone,$feedback);
	$stmt->execute();
include 'index.html';
	echo'<script type="text/javascript">
	window.onload=function(){alert("Thankyou We Will Contact You Shortly");}
	</script>';

	//echo "<font size='18' face='Arial' color='darkblue'><center><br><br><br><br>Thanks We Will Contact You Shortly</center>";
}else
{
	include 'index.html';
	echo'<script type="text/javascript">
	window.onload=function(){alert("Email Already Registered");}
	</script>';

	//echo "<font size='18' face='Arial' color='red'><center><br><br><br><br>Email Already Registered</center>";
}
$stmt->close();
$conn->close();

}

}else
{

echo "All Fields are Required";
die();

}

?>
