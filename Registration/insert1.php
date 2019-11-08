<?php

$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$email=$_POST['email'];
$password=$_POST['password'];
$birthDate=$_POST['birthDate'];
$phoneNumber=$_POST['phoneNumber'];
$pincode=$_POST['pincode'];
$bloodgroup=$_POST['bloodgroup'];
$height=$_POST['height'];
$weight=$_POST['weight'];
$gender=$_POST['gender'];
$category=$_POST['category'];

if (!empty($firstName) || !empty($lastName) || !empty($email)  || !empty($phoneNumber)  || !empty($password) || !empty($birthDate) || !empty($pincode) || !empty($bloodgroup)  || !empty($height) || !empty($weight) || !empty($gender) || !empty($category))
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

$SELECT ="SELECT email From login where email = ? Limit 1";
$INSERT ="INSERT Into login(firstName,lastName,email,phoneNumber,password,birthDate,pincode,bloodgroup,height,weight,gender,category) values(?,?,?,?,?,?,?,?,?,?,?,?)";

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
	$stmt->bind_param("sssissisiiss",$firstName,$lastName,$email,$phoneNumber,$password,$birthDate,$pincode,$bloodgroup,$height,$weight,$gender,$category);
	$stmt->execute();
include 'index.html';
	echo'<script type="text/javascript">
	window.onload=function(){alert("Registered Successfully");}
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
