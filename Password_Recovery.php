<?php
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JGS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
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
<body class="hold-transition login-page">
    <?php
      $query=mysqli_query($con,"select * FROM companydata");
      while($row=mysqli_fetch_array($query))
      {
       $com_name=$row["School"];
       //$com_photo=$row["Photo"];
      // $_SESSION['com_photo']=$com_photo;
       $_SESSION['com_id']=$row["id"];
       //$_SESSION['com_namename']=$com_name;
      } 
    ?>
<div class="login-box">
  <div class="login-logo">
    <center><img class="logo" src="" /></center>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
          <center><h5 style="color:#004d00"><strong><?php echo $com_name; ?></strong></h5></center>
           <center><img class="logo" src="images/flame.png" /></center>
      <p class="login-box-msg">Enter your email and submit to recover your password</p>

      <form action="" method="post" id="loginform" onsubmit="return false">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" placeholder="sample@xyz.com" class="form-control" id="email">
          </div>
    
        <div class="row">
          <div class="col-12">
            <table class="table">
                <tr>
                    <td colspan="2">
                         <center><label id="msgmsg" style="font-size:12px"></label></center>  
                    </td>
                </tr>

                
                <tr>
                    <td> <button type="submit" class="btn btn-success btn-sm" id="btnsend">Send Email <i class="fa fa-paper-plane"></i> </button></td>
                </tr>
            </table>
          </div>
        </div>
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
      </div>
      <p class="mb-1">
        <a href="../Shop/">Login</a>
      </p>
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
$("#btncreate").click(function()
{ 
  $('#loginmsg').html('').css('color', 'red'); 
   var em = document.getElementById("email").value;
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
        window.location.href='Password_Login.php';
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
          $("#btnsendd").click(function(){
          $('#msgmsg').html('').css('color', 'green');
         
          var em=document.getElementById('email').value; 
          if(em=='')
          {
            
          }else
          {
          $.ajax({
           url:"sendpassword.php",
           method:"POST",
           data:{emm:em,msg:'msg'},
           success:function(data)
           {
             if(data=='success')
             {
              $('#msgmsg').html("New PASSWORD has been sent to your email").css('color', 'green');   
                 
             setInterval(function () 
            {
            $('#msgmsg').html('').css('color', 'green'); 
            }, 4000);
             }else
             {
             $('#msgmsg').html(data).css('color', 'red');  
             }
           }
          });
          }
        });
        }); 
</script>

 <script>
       $(document).ready(function(){ 
          $("#btnsend").click(function(){
          $('#msgmsg').html('').css('color', 'green');
         
          var em=document.getElementById('email').value; 
          if(em=='')
          {
            
          }else
          {
          $.ajax({
           url:"sendpassword.php",
           method:"POST",
           data:{em:em},
           success:function(data)
           {
             if(data=='success')
             {
              $('#msgmsg').html("New PASSWORD has been sent to your email").css('color', 'green');   
                 
             setInterval(function () 
            {
            $('#msgmsg').html('').css('color', 'green'); 
            }, 4000);
             }else
             {
             $('#msgmsg').html(data).css('color', 'red');  
             }
           }
          });
          }
        });
        }); 
</script>

<script>
$(function () {
    
  //$.validator.setDefaults({
   // submitHandler: function () {
    //  alert( "Form successful submitted!" );
    //}
  //});
  
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
