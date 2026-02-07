<?php
session_start();
session_destroy();

include('include/config.php');
$date = new DateTime("now", new DateTimeZone('Africa/Nairobi') );
$timenow=$date->format('Y-m-d H:i:s');
$timenow2=$date->format('Y-m-d');
$month=$date->format('M');

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_start();
ob_start();
error_reporting(0);

if(isset($_POST["login"]))
 {
 $user=addslashes($_POST["user"]);
 $pass=addslashes($_POST["pass"]);
 $pass=md5($pass);

$query=mysqli_query($con,"SELECT * FROM users WHERE Email='$user' AND Pass='$pass' OR Username='$user' AND Pass='$pass'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$sql=mysqli_query($con,"SELECT * FROM users WHERE Email='$user' OR Username='$user' AND Pass='$pass' AND Aces='yes'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $sqll=mysqli_query($con,"SELECT * FROM users WHERE Email='$user' OR Username='$user' AND Pass='$pass' AND Aces='yes'");   
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
 $sql3=mysqli_query($con,"INSERT INTO activity(user,Action,Tim,Dat,shortmsg,Month)values('$id','logged in','$timenow','$timenow2','login','$month')");
 $_SESSION['name'] = $name;
 $_SESSION['betapos']='HHD/CJ2588E';
 
  //$_SESSION['me']='granted';
  header("location:data/index.php?page=Make_Sales");
  }else
  {
  echo 'acessno';
  }
 
}else
{
  $_SESSION['me']='acessno';
}

}else
{
$_SESSION['me']='Invalid login Credentials';
}	
 } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JGS</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="images/flam.ico">
  
  <style>
      .logo{
          max-height:100px;
      }
      
    body{
    background-image:url('images/gas3.jpg');
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
      }
      
      .card{
          box-shadow: 0 0 0 10px #4fc3dc44,
	0 0 50px #4fc3dc, 0 0 100px #4fc3dc;
	border-radius: 5px;
      }
  </style>
  
</head>
<body class="hold-transition login-page" >
  <?php
  $query=mysqli_query($con,"select * FROM companydata");
  while($row=mysqli_fetch_array($query))
  {
   $com_name=$row["School"];
   //$com_photo=$row["Photo"];
   $_SESSION['com_photo']=$com_photo;
   $_SESSION['com_id']=$row["id"];
   //$_SESSION['com_namename']=$com_name;
  } 
?>
<div class="login-box">
  <div class="login-logo">
  
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <center><h5 style="color:#004d00"><strong><?php echo $com_name; ?></strong></h5></center>
     <center><img class="logo" src="images/flame.png" /></center>
     
      <form  method="POST" action="" id="loginform" onsubmit="return false">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Email/Username</label>
            <input type="text" name="user" class="form-control" id="email" placeholder="sample@xyz.com" required />
          </div>
     
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required />
         </div>
         
          <div class="form-group">
              <?php
              $me=$_SESSION['me'];
              if($me=='' || $me==null)
              {
                  
              }else if($me=='Invalid login Credentials')
              {
              ?>
               <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <?php echo $me; ?>
              </div>
              <?php
              }else if($me=='acessno')
              {
               ?>
               <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <?php echo 'Sorry. You have no right to access the system for now! '; ?>
              </div>
               <?php
              }else if($me=='granted')
              {
               ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>ACCESS GRANTED !</strong>
                </div>
               <?php
              }
              ?>
          </div>
          
          <div class="form-group">
            <input class="form-check-input" type="checkbox" name="remember" value="true" onclick="myFunction()" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Show password</label>
          </div>
                 
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12 col-lg-12">
               <center><label id="loginmsg"></label></center>
         </div>
          <div class="col-md-12 col-lg-12">
            <button type="submit" class="btn btn-primary btn-block" name="login" id="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
      </div>
      <!-- /.social-auth-links -->
      <table class="table">
          <tr>
              <td><a href="../Shop/">Pin Login</a></td>
              <td><a href="Password_Recovery.php">I forgot my password</a></td>
          </tr>
      </table>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script>
 $(document).ready(function(){ 
var form = document.getElementById('loginform');
form.addEventListener('submit', function(e) {
 // e.preventDefault();
});
});
</script>

<script>
      function myFunction() {
      var x = document.getElementById("pass");
      if (x.type === "password") {
      x.type = "text";
      } else {
      x.type = "password";
      }
      }
</script>

  <script>
 $(document).ready(function(){ 
        $("#login").click(function()
        { 
            ///e.preventDefault();
          var user = document.getElementById("email").value;
          var pass = document.getElementById("pass").value;
          document.getElementById("loginmsg").innerHTML="";
 
               $.ajax({
            url:"login1.php",
            method:"POST",
            data:{user,pass},
            success:function(data)
            {
              if(data=='invalid')
              {
              $('#loginmsg').html('Invalid login credentials!').css('color', 'red'); 
              
                setInterval(function () 
                {                                     
                $('#loginmsg').html('').css('color', 'red');
                }, 3000);
              }
              else if(data=='acessno')
              {
               $('#loginmsg').html('Sorry. You have no right to access the system for now!').css('color', 'red');
              }else if(data=='granted')
              {
                  $('#loginmsg').html('ACCESS GRANTED').css('font-weight','bold','width','100%'); 
                   setInterval(function () 
                  {                                     
                  window.location.href='data/index.php?page=Make_Sales';
                  }, 800);
                
              }else{
                 $('#loginmsg').html(data).css('color', 'red');
              }
            }
          });
     
          });
        });
     </script>


<script>
if ( window.history.replaceState ) {
window.history.replaceState( null, null, window.location.href );
}
</script>

<script>
$(function () {
  
  $('#loginform').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>
