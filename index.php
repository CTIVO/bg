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

 if(isset($_POST["loginpin"]))
 {
$pin=$_POST["thepin"];
$query=mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$sql=mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin' AND Aces='yes'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 //$sqll=mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin'");   
 while($row=mysqli_fetch_array($sql))
 {
    $id=$row["userid"];
    $_SESSION['HU_mana']=$row["Manage"];
    //$_SESSION['HU_ac']=$row["Accounts"];
   // $_SESSION['HU_hr']=$row["Hr"];
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
$_SESSION['me']='Invalid Pin';
}	
 }


$query=mysqli_query($con,"select * FROM companydata");
while($row=mysqli_fetch_array($query))
{
 $com_name=$row["School"];
 //$com_photo=$row["Photo"];
 $_SESSION['com_id']=$row["id"];
 $_SESSION['SHOPNAME']=$com_name;
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $com_name; ?></title>
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

<div class="login-box">
  <div class="login-logo">
  
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <center><h5 style="color:#004d00"><strong><?php echo $com_name; ?></strong></h5></center>
     <center><img class="logo" src="images/flame.png" /></center>
     
      <?php
      if(isset($_GET['page']))
      {
       $pg=$_GET['page'];
       if($pg=='Home')
       {
        include('hom.php'); 
       }else if($pg=='Create')
       {
        include('account.php');
       }else if($pg=='Password_Login')
       {
       include('pass.php');
       }else 
       {
         include('hom.php'); 
       }

      }else
      {
        include('hom.php');
      }
     ?>
      <div class="social-auth-links text-center mb-3">
      </div>
       <table class="table">
          <tr  style="font-size:12px">
              <td><a href="index.php?page=Home">Pin Login</a></td>
              <td><a href="index.php?page=Password_Login">Password Login</a></td>
              <td><a href="index.php?page=Create">Create Account</a></td>
          </tr>
      </table>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
      function myFunctioncreate() {
      var x = document.getElementById("pass");
      var y = document.getElementById("copass");


      if (x.type === "password") {
      x.type = "text";
      } else {
      x.type = "password";
      }

      if (y.type === "password") {
      y.type = "text";
      } else {
      y.type = "password";
      }
      }
</script>

<script>
      function myFunctionpass() {
      var x = document.getElementById("pass");
      if (x.type === "password") {
      x.type = "text";
      } else {
      x.type = "password";
      }
      }
</script>

<script>
      function myFunction() {
      var x = document.getElementById("thepin");
      if (x.type === "password") {
      x.type = "text";
      } else {
      x.type = "password";
      }
      }
</script>

<script>
  $(document).ready(function()
  { 
  $('input[name="thepin"]').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});

  });
</script>

<script>
$(document).ready(function(){ 
$("#btncreate").click(function()
{ 
  $('#loginmsg').html('').css('color', 'red'); 
   var em = document.getElementById("emaill").value;
   var pa = document.getElementById("pass").value;
   var copa = document.getElementById("copass").value;

  if(em=='' || pa=='' || copa=='')
  {
   $('#loginmsg').html('All entries required!').css('color', 'red'); 
  }else{
   
   if(pa.length < 8 )
   {
    $('#loginmsg').html('Password must be atleast 8 characters!').css('color', 'red'); 
   }else{
    if(pa != copa)
    {
     $('#loginmsg').html('Passwords must MATCH').css('color', 'red'); 
    }else
    {

    $.ajax({
    url:"login1.php",
    method:"POST",
    data:{em,pa,copa},
    success:function(data)
    {
      if(data=='success')
      {
      $('#loginmsg').html('Account Created successfully!').css('color', 'red'); 
        setInterval(function () 
        {                                     
        window.location.href='index.php?page=Password_Login';
        }, 3000);
      }
      else{
         $('#loginmsg').html(data).css('color', 'red');
      }
    }
  });
  }
}
}
  });
});
</script>

<script>
$(document).ready(function(){ 
$("#emaill").mouseleave(function()
{
     var user = document.getElementById("emaill").value;
      if(user !='')
      {
      $.ajax({
      url:"getdata.php",
      method:"POST",
      data:{user},
      success:function(data)
      {
        if(data=='create')
        {
            document.getElementById('copass').disabled = false;
            document.getElementById('btncreate').disabled = false;
            document.getElementById('pass').disabled = false;

          $('#feedback').html('Permitted to create Account').css('color', 'green'); 
          setInterval(function () 
          {                                     
          $('#feedback').html('').css('color', 'green'); 
          }, 5000);
        }else {
          $('#feedback').html(data).css('color', 'red');
            document.getElementById('copass').disabled = true;
            document.getElementById('btncreate').disabled = true;
            document.getElementById('pass').disabled = true;
          setInterval(function () 
          {                                     
          $('#feedback').html('').css('color', 'green'); 
          }, 5000); 
        }
      }
    });
    }
});
});
</script>

<script>
  $(document).ready(function(){ 
    $("#login").click(function()
    { 
       var pin = document.getElementById("thepin").value;
        $.ajax({
        url:"login1.php",
        method:"POST",
        data:{pin},
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
 $(document).ready(function(){ 
        $("#loginpass").click(function()
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
