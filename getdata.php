<?php 
session_start();
ob_start();
include('include/config.php');

 if(!empty($_POST["user"]))
 {
 $user=addslashes($_POST["user"]);
 $query=mysqli_query($con,"SELECT * FROM users WHERE Email='$user'");
$num=mysqli_fetch_array($query);
if($num>0)
{

$sql = "SELECT * FROM users WHERE Email='$user'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) 
{
  $pas=$row['Pass'];
}

if($pas=='')
{
echo 'create';
}else
{
   echo "You already have an account";
}
 }else
 {
   echo 'Confirm you have an account from this system from the System Admin';
 }
}
?>