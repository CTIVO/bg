<?php
session_start();
ob_start();
$emma='';
$pasw='';
include('include/config.php');
$date = new DateTime("now", new DateTimeZone('Africa/Nairobi') );
$timenow=$date->format('Y-m-d H:i:s');
$timenow2=$date->format('Y-m-d');
$month=$date->format('M');

function random_strings($length_of_string)
{
$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
return substr(str_shuffle($str_result), 0, $length_of_string);
}

$code=random_strings(8);

require 'data/PHPMailer/src/Exception.php';
require 'data/PHPMailer/src/PHPMailer.php';
require 'data/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 $query=mysqli_query($con,"select * from companydata");
 while($row=mysqli_fetch_array($query))
 {
   $emma=htmlentities($row['cemail']);  
   $pasw=htmlentities($row['cpassword']);
   $ser=htmlentities($row['Server']);
 }
 
if(isset($_POST['em']))
{
$em=addslashes($_POST['em']);

$sql=mysqli_query($con,"SELECT * FROM users WHERE Email='$em'");
$num=mysqli_fetch_array($sql);
if($num>0)
{   
 $mail = new PHPMailer(true);
 $mail->IsSMTP();
 $mail->Host = $ser;
 $mail->SMTPAuth= true;
 $mail->Username =$emma;
 $mail->Password = $pasw;
 $mail->SMTPSecure = 'tls';
 $mail->Port = 587;
 
 $mail->setFrom($emma);
 $mail->addAddress($em);
 $mail->isHTML(true);
 $mail->Subject = "Password Recovery - MY SHOP";
 $mail->Body = "Following is  your new password on MY SHOP POS system. <br />"." Password: ".$code."<br /> Kindly make sure you have not shared your login credentials with anybody. <br />"."Click this link to visit the website: jymohgassolutions.co.ke/";
 //$mail->Body = "New Passsword ";
 $pass=md5($code);
 
 $mail->send();
 
 $sql=mysqli_query($con,"UPDATE users SET Pass='$pass',pa='$code' where Email='$em'"); 
 echo 'success';
 
}else{
   echo 'Sorry, the email entered is not recognized'; 
}
}else
{
    echo 'No email entered';
}
?>