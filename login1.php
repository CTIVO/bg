<?php 
session_start();
ob_start();
error_reporting(0);

$_SESSION['invoicing']='2';
include('include/config.php');
$_SESSION['Yeear']='2024';

function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}
$code=createRandomPassword();

//date_default_timezone_set('Africa/Khartoum');// change according timezone'Asia/Kolkata'

$date = new DateTime("now", new DateTimeZone('Africa/Nairobi') );
$timenow=$date->format('Y-m-d H:i:s');
$timenow2=$date->format('Y-m-d');
$month=$date->format('M');

 if(!empty($_POST["user"]))
 {
 $user=addslashes($_POST["user"]);
 $pass=addslashes($_POST["pass"]);
 $pass=md5($pass);
 
 $query=mysqli_query($con,"SELECT * FROM users WHERE Email='$user' AND Pass='$pass'");
$num=mysqli_fetch_array($query);
if($num>0)
{
    
$sql=mysqli_query($con,"SELECT * FROM users WHERE Email='$user' AND Pass='$pass' AND Aces='yes'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
    
 $sqll=mysqli_query($con,"SELECT * FROM users WHERE Email='$user' AND Pass='$pass'");   
 while($row=mysqli_fetch_array($sqll))
 {
    $id=$row["userid"];
    $_SESSION['HU_mana']=$row["Manage"];
    $_SESSION['HU_ac']=$row["Accounts"];
    $_SESSION['HU_hr']=$row["Hr"];
    $_SESSION['HU_le']=$row["Level"];
    $_SESSION['usertype']=$row["Level"];
    $uza=$row["Level"];
 }

 $sql1=mysqli_query($con,"SELECT * FROM Staffs WHERE id='$id'");
 while($row=mysqli_fetch_array($sql1))
 {
    $name=$row["Name"];
    $_SESSION['user_idd']=$row["id"];
    $st=$row["Status"];
    $poss=$row["Position"];
    $_SESSION['pos']=$poss;
 }
 
 
  if($st=='Active')
 {
 //$sql3=mysqli_query($con,"INSERT INTO activity(user,Action,Tim,Dat,shortmsg,Month)values('$id','logged in','$timenow','$timenow2','login','$month')");
 $_SESSION['name'] = $name;
 $_SESSION['betapos']='HHD/CJ2588E';
  echo 'granted';
  //$_SESSION['me']='granted';
 // header("location:data/index.php?page=Make_Sales");
  }else
  {
  echo 'acessno';
  }
 
}else
{
  echo 'You have no access to the system';
}

}else
{
echo 'Invalid login Credentials';
}
 }else  if(!empty($_POST["pin"]))
 {
 $pin=$_POST["pin"];
 $query=mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin'");
$num=mysqli_fetch_array($query);
if($num>0)
{
    
$sql=mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin' AND Aces='yes'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
    
 $sqll=mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin'");   
 while($row=mysqli_fetch_array($sqll))
 {
    $id=$row["userid"];
    $_SESSION['HU_mana']=$row["Manage"];
    $_SESSION['HU_ac']=$row["Accounts"];
    $_SESSION['HU_hr']=$row["Hr"];
    $_SESSION['HU_le']=$row["Level"];
    $_SESSION['usertype']=$row["Level"];
    $uza=$row["Level"];
 }

 $sql1=mysqli_query($con,"SELECT * FROM Staffs WHERE id='$id'");
 while($row=mysqli_fetch_array($sql1))
 {
    $name=$row["Name"];
    $_SESSION['user_idd']=$row["id"];
    $st=$row["Status"];
    $poss=$row["Position"];
    $_SESSION['pos']=$poss;
 }
 
 
  if($st=='Active')
 {
 $_SESSION['name'] = $name;
 $_SESSION['betapos']='HHD/CJ2588E';
 echo 'granted';
  }else
  {
  echo 'acessno';
  }
 
}else
{
  echo 'You have no access to the system';
}

}else
{
echo 'Invalid login Credentials';
}
 }else  if(!empty($_POST["copa"]))
 {
 $pa=md5($_POST["copa"]);
 $em=$_POST["em"];
 $sql=mysqli_query($con,"UPDATE users SET Pass='$pa' WHERE Email='$em'");
 if($sql)
 {
   echo 'success';
 }else
 {
   echo 'Error saving data';
 }
}
?>